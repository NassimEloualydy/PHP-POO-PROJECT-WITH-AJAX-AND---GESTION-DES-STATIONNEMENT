<?php
//require(dirname(__FILE__).'/../config/DataProvider.php');
class Parking extends DataProvider{
    public function addParking($data){
    $db=$this->connect();
    if($db!=null){
        $sql="SELECT * FROM PARKING WHERE NOM=:NOM";
        $smt=$db->prepare($sql);
        $smt->execute([":NOM"=>$data['nom']]);
        if(count($smt->fetchAll(PDO::FETCH_OBJ))!=0)
        return json_encode(array("message"=>"SVP le nom de paeking exist deja !!","type"=>"error","ticket"=>"Operation invalide !!"));
        $sql="SELECT * FROM PARKING WHERE ADRESSE=:ADRESSE";
        $smt=$db->prepare($sql);
        $smt->execute([":ADRESSE"=>$data['adresse']]);
        if(count($smt->fetchAll(PDO::FETCH_OBJ))!=0)
        return json_encode(array("message"=>"SVP l'Adresse de paeking exist deja !!","type"=>"error","ticket"=>"Operation invalide !!"));
        $from=$data['photo']['tmp_name'];
        $ext=explode(".",$data['photo']['name'])[1];
        $to="images/parking/".str_replace(' ','',$data['nom']).".".$ext;
        move_uploaded_file($from,$to);
        $sql="INSERT INTO PARKING (PHOTO,NOM,ADRESSE,VILLE,NB_PLACE,NB_PLACE_LIBRE) VALUES (:PHOTO,:NOM,:ADRESSE,:VILLE,:NB_PLACE,:NB_PLACE_LIBRE)";
        $smt=$db->prepare($sql);
        $smt->execute([":PHOTO"=>$to,":NOM"=>$data['nom'],":ADRESSE"=>$data['adresse'],":VILLE"=>$data["ville"],":NB_PLACE"=>$data['nbrPlace'],":NB_PLACE_LIBRE"=>$data['nbrPlaceLibre']]);
        return json_encode(array("message"=>"Ajouter avec success","type"=>"success","ticket"=>"Operation valide !!"));
    }
    }
    public function getData($offset){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT * FROM PARKING LIMIT 5 OFFSET $offset";
            $smt=$db->query($sql);
            // $smt->execute(["offset",$offset]);
            $T=$smt->fetchAll(PDO::FETCH_OBJ);   
            $r="";
            foreach($T as $p){
                $r.="<tr><td><img src='$p->PHOTO' class='listImgeItem' ></td>
                <td>$p->NOM</td>
                <td>$p->VILLE</td>
                <td>$p->ADRESSE</td>
                <td><ion-icon onclick='deleteParking(".$p->ID.")' class='Icon Icon_delete' name='trash-outline'></ion-icon></td>
                <td><ion-icon class='Icon Icon_update' onclick='updateParking(".json_encode($p).")' name='pencil-outline'></ion-icon></td>
                <td><ion-icon onClick='DetailParking(".json_encode($p).")' class='Icon Icon_details' name='information-circle-outline'></ion-icon>  </td></tr>";       
            }
            return $r;

        }
    }
    public function deleteParking($id){
        $db=$this->connect();
        if($db!=null){
           $sql="SELECT * FROM PARKING WHERE ID=:ID";
           $smt=$db->prepare($sql);
           $smt->execute([":ID"=>$id]);
            $T=$smt->fetchAll(PDO::FETCH_OBJ);
            if(file_exists($T[0]->PHOTO))
             unlink($T[0]->PHOTO);
            $sql="DELETE FROM PARKING WHERE ID=:ID";
            $smt=$db->prepare($sql);
            $smt->execute([":ID"=>$id]);
            return "Supprimer avec success";
        }
    }
    public function updateParking($data){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT * FROM PARKING WHERE ID=!:ID AND NOM=:NOM";
            $smt=$db->prepare($sql);
            $smt->execute([":ID"=>$data['id'],":NOM"=>$data["nom"]]);
            if(count($smt->fetchAll(PDO::FETCH_OBJ))!=0)
            return json_encode(array("message"=>"SVP le nom exist deja !!","type"=>"error","ticket"=>"Operation Invalide"));
            $sql="SELECT * FROM PARKING WHERE ID=!:ID AND ADRESSE=:ADRESSE";
            $smt=$db->prepare($sql);
            $smt->execute([":ID"=>$data['id'],":ADRESSE"=>$data["adresse"]]);
            if(count($smt->fetchAll(PDO::FETCH_OBJ))!=0)
            return json_encode(array("message"=>"SVP l'Adresse exist deja !!","type"=>"error","ticket"=>"Operation Invalide"));            
            $sql="UPDATE PARKING SET NOM=:NOM,ADRESSE=:ADRESSE,VILLE=:VILLE,NB_PLACE=:NB_PLACE,NB_PLACE_LIBRE=:NB_PLACE_LIBRE WHERE ID=:ID";
            // PHOTO,NOM,ADRESSE,VILLE,NB_PLACE,NB_PLACE_LIBRE
            $data_update=array(":NOM"=>$data['nom'],":ADRESSE"=>$data['adresse'],":VILLE"=>$data["ville"],":NB_PLACE"=>$data['nbrPlace'],":NB_PLACE_LIBRE"=>$data['nbrPlaceLibre'],":ID"=>$data["id"]);
            if($data['photo']!=null){
                $from=$data['photo']['tmp_name'];
                $ext=explode(".",$data['photo']['name'])[1];
                $to="images/parking/".str_replace(' ','',$data['nom']).".".$ext;
                $sql="SELECT * FROM PARKING WHERE ID=".$data['id']."";
                $smt=$db->query($sql);
                $T=$smt->fetchAll(PDO::FETCH_OBJ);
                if(file_exists($T[0]->PHOTO))
                unlink($T[0]->PHOTO);
                move_uploaded_file($from,$to);
                $data_update=array(":PHOTO"=>$to,":NOM"=>$data['nom'],":ADRESSE"=>$data['adresse'],":VILLE"=>$data["ville"],":NB_PLACE"=>$data['nbrPlace'],":NB_PLACE_LIBRE"=>$data['nbrPlaceLibre'],":ID"=>$data["id"]);
                $sql="UPDATE PARKING SET NOM=:NOM,ADRESSE=:ADRESSE,VILLE=:VILLE,NB_PLACE=:NB_PLACE,NB_PLACE_LIBRE=:NB_PLACE_LIBRE,PHOTO=:PHOTO WHERE ID=:ID";                
            }
            $smt=$db->prepare($sql);
            $smt->execute($data_update);
            return json_encode(array("message"=>"Moddifier avec succes","type"=>"succes","ticket"=>"Operation Valide"));         
        }
    }
    public function search($data){
        $db=$this->connect();
         if($db!=null){
            $sql="SELECT P.* FROM PARKING P 
            INNER JOIN PARKING P1 ON P.ID=P1.ID
            INNER JOIN PARKING P2 ON P.ID=P2.ID
            INNER JOIN PARKING P3 ON P.ID=P3.ID
            INNER JOIN PARKING P4 ON P.ID=P4.ID
            INNER JOIN PARKING P5 ON P.ID=P5.ID
            WHERE 
            P1.NOM LIKE '%".$data['nom']."%' AND
            P2.ADRESSE LIKE '%".$data['adresse']."%' AND
            P3.VILLE LIKE '%".$data['ville']."%' AND
            P4.NB_PLACE LIKE '%".$data['nbrPlace']."%' AND
            P5.NB_PLACE_LIBRE LIKE '%".$data['nbrPlaceLibre']."%'
            ";
            $smt=$db->query($sql);
            $t=$smt->fetchAll(PDO::FETCH_OBJ);
            $r="";
            foreach($t as $p){
                $r.="<tr><td><img src='$p->PHOTO' class='listImgeItem' ></td>
                <td>$p->NOM</td>
                <td>$p->VILLE</td>
                <td>$p->ADRESSE</td>
                <td><ion-icon onclick='deleteParking(".$p->ID.")' class='Icon Icon_delete' name='trash-outline'></ion-icon></td>
                <td><ion-icon class='Icon Icon_update' onclick='updateParking(".json_encode($p).")' name='pencil-outline'></ion-icon></td>
                <td><ion-icon onClick='DetailParking(".json_encode($p).")' class='Icon Icon_details' name='information-circle-outline'></ion-icon>  </td></tr>";       
            }
            return $r;
        }
    }
    public function geNbrParkingParNbrPlace(){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT NOM,NB_PLACE FROM PARKING";
            $smt=$db->query($sql);
            return json_encode($smt->fetchAll(PDO::FETCH_OBJ));
        }
    }
    public function geNbrParkingVille(){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT COUNT(ID) AS 'NBR_PARKING',VILLE FROM PARKING VILLE GROUP BY VILLE";
            $smt=$db->query($sql);
            return json_encode($smt->fetchAll(PDO::FETCH_OBJ));
        }
    }
    public function getLatestAddedParking(){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT * FROM PARKING ORDER BY ID DESC";
            $smt=$db->query($sql);
            $T=$smt->fetchAll(PDO::FETCH_OBJ);
            $s="";
            foreach($T as $c){
              $s.="<div class='itemLatestAdded'><img src='$c->PHOTO' class='listImgeItem' > $c->NOM</div>";
            }
            return $s;
        
        }
    }
}
