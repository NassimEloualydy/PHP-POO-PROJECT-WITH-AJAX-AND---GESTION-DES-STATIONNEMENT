<?php
class Stationnement extends DataProvider{
    
    public function getClientStation(){
        $db=$this->connect();
        if($db!=null){
            $SQL="SELECT * FROM CLIENT";
            $smt=$db->query($SQL);
            $T=$smt->fetchAll(PDO::FETCH_OBJ);
            $r="<option value=''>Choisire un Client</option>";
            foreach($T as $c){
                $r.="<option value='".$c->ID."'>".$c->NOM." ".$c->PRENOM."</option>";
            }
            return $r;
        }
    }

    public function getParkingStation(){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT * FROM PARKING";
            $smt=$db->query($sql);
            $T=$smt->fetchAll(PDO::FETCH_OBJ);
            $r="<option value=''>Choisire un Parking</option>";
            foreach($T as $p){
                $r.="<option value=".$p->ID.">".$p->NOM."</option>";
            }
            return $r;
        }
    }
    public function addStationnement($data){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT * FROM PARKING WHERE ID=".$data['parking']."";
            $smt=$db->query($sql);
            $T=$smt->fetchAll(PDO::FETCH_OBJ);
            if($T[0]->NB_PLACE_LIBRE==0)
            return json_encode(array("type"=>"error","ticket"=>"Insertion invalide !!","message"=>"SVP cet park est plein"));
            $sql="UPDATE PARKING SET NB_PLACE_LIBRE=NB_PLACE_LIBRE-1 WHERE ID=:ID";
            $smt=$db->prepare($sql);
            $smt->execute([":ID"=>$data["parking"]]);
            $sql="INSERT INTO stationnement (DATE_STATE,ID_CLIENT,ID_PARK,PRIX,TYPE_TARIF,DATE_SORTIE) VALUES (:dateStation,:client,:parking,:prix,:typeTarif,:dateSorti)";
            $smt=$db->prepare($sql);
            $smt->execute([":dateStation"=>$data["dateStation"],":client"=>$data["client"],":parking"=>$data["parking"],":prix"=>$data["prix"],":dateSorti"=>$data["dateSorti"],":typeTarif"=>$data["typeTarif"]]);
            return json_encode(array("type"=>"success","message"=>"Stationnement ajouter avec succes !!","ticket"=>"Operationn valide "));
        }
    }
    public function geData($offset){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT 
            p.PHOTO AS 'PHOTO_PARKING',	
            p.NOM	AS 'NOM_PARKING',
            p.ADRESSE	AS 'ADRESSE_PARKING',
            p.VILLE	AS 'VILLE_PARKING',
            p.NB_PLACE AS 'NB_PLACE',	
            p.NB_PLACE_LIBRE AS 'NB_PLACE_LIBRE' ,C.PHOTO AS 'PHOTO_CLIENT'
            ,C.NOM AS 'NOM_CLIENT',
            C.PRENOM  AS 'PRENOM_CLIENT',
            C.CNI AS 'CNE_CLIENT',
            C.SEXE AS 'SEXE',
            S.ID,
            S.DATE_STATE,
            S.ID_CLIENT,
            S.ID_PARK,
            S.PRIX,
            S.TYPE_TARIF,
            S.DATE_SORTIE FROM stationnement S INNER JOIN parking P ON P.ID=S.ID_PARK INNER JOIN client C ON C.ID=S.ID_CLIENT LIMIT 5 OFFSET $offset";
            $smt=$db->query($sql);
            $t=$smt->fetchAll(PDO::FETCH_OBJ);
            $r="";
            foreach($t as $s){
                $r.="
                <tr><td><img src='$s->PHOTO_PARKING' class='listImgeItem' ></td>
                <td>$s->NOM_CLIENT $s->PRENOM_CLIENT</td>
                <td>$s->NOM_PARKING</td>
                <td>$s->DATE_STATE</td>
                <td>$s->DATE_SORTIE</td>
                <td><ion-icon onclick='deleteStationnement(".$s->ID.")' class='Icon Icon_delete' name='trash-outline'></ion-icon></td>
                <td><ion-icon class='Icon Icon_update' onclick='updateStationnement(".json_encode($s).")' name='pencil-outline'></ion-icon></td>
                <td><ion-icon onClick='DetailStationnement(".json_encode($s).")' class='Icon Icon_details' name='information-circle-outline'></ion-icon>  </td></tr>";       
            }
            return $r;
        }

    }
    public function deleteItem($id){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT * FROM stationnement WHERE ID=$id";
            $smt=$db->query($sql);
            $t=$smt->fetchAll(PDO::FETCH_OBJ);
            $id_p=$t[0]->ID_PARK;
            $sql="UPDATE PARKING SET NB_PLACE_LIBRE=NB_PLACE_LIBRE+1 WHERE ID=:ID";
            $smt=$db->prepare($sql);
            $smt->execute([":ID"=>$id_p]);
            $SQL="DELETE FROM stationnement WHERE ID=:ID";
            $smt=$db->prepare($SQL);
            $smt->execute([":ID"=>$id]);
            return "Supprimer avec succes";
        }
    }
    public function updateStationnement($data){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT * FROM stationnement WHERE ID=".$data['id']."";
            $smt=$db->query($sql);
            $t=$smt->fetchAll(PDO::FETCH_OBJ);
            if($t[0]->ID_PARK!=$data['parking']){
                $sql="SELECT * FROM PARKING WHERE ID=".$data['parking']."";
                $smt=$db->query($sql);
                $T=$smt->fetchAll(PDO::FETCH_OBJ);
                if($T[0]->NB_PLACE_LIBRE==0)
                return json_encode(array("type"=>"error","ticket"=>"Insertion invalide !!","message"=>"SVP cet park est plein"));    
            }
            $sql="UPDATE stationnement SET DATE_STATE=:DATE_STATE,ID_CLIENT=:ID_CLIENT,ID_PARK=:ID_PARK,PRIX=:PRIX,TYPE_TARIF=:TYPE_TARIF,DATE_SORTIE=:DATE_SORTIE WHERE ID=:ID";
            $smt=$db->prepare($sql);
            $smt->execute([":DATE_STATE"=>$data["dateStation"],":ID_CLIENT"=>$data["client"],":ID_PARK"=>$data["parking"],":PRIX"=>$data["prix"],":DATE_SORTIE"=>$data["dateSorti"],":TYPE_TARIF"=>$data["typeTarif"],":ID"=>$data["id"]]);
            return json_encode(array("type"=>"success","ticket"=>"Operation valide","message"=>"Modification avec success !!"));    
            
          
        }
    }
    public function search($data){
        $db=$this->connect();
        if($db!=null){
            $SQL="   
            SELECT        
            p.PHOTO AS 'PHOTO_PARKING',	
            p.NOM	AS 'NOM_PARKING',
            p.ADRESSE	AS 'ADRESSE_PARKING',
            p.VILLE	AS 'VILLE_PARKING',
            p.NB_PLACE AS 'NB_PLACE',	
            p.NB_PLACE_LIBRE AS 'NB_PLACE_LIBRE' ,C.PHOTO AS 'PHOTO_CLIENT'
            ,C.NOM AS 'NOM_CLIENT',
            C.PRENOM  AS 'PRENOM_CLIENT',
            C.CNI AS 'CNE_CLIENT',
            C.SEXE AS 'SEXE',
            S.ID,
            S.DATE_STATE,
            S.ID_CLIENT,
            S.ID_PARK,
            S.PRIX,
            S.TYPE_TARIF,
            S.DATE_SORTIE FROM stationnement S INNER JOIN parking P ON P.ID=S.ID_PARK INNER JOIN client C ON C.ID=S.ID_CLIENT
            INNER JOIN client c1 on C.ID=c1.ID
            INNER JOIN client c2 on C.ID=c2.ID
            INNER JOIN client c3 on C.ID=c3.ID
            INNER JOIN client c4 on C.ID=c4.ID
            
            INNER JOIN parking P1 ON P.ID=P1.ID
            INNER JOIN parking P2 ON P.ID=P2.ID
            INNER JOIN parking P3 ON P.ID=P3.ID
            INNER JOIN parking P4 ON P.ID=P4.ID
            INNER JOIN parking P5 ON P.ID=P5.ID
           
            INNER JOIN stationnement s1 ON s1.ID=S.ID
            INNER JOIN stationnement s2 ON s2.ID=S.ID
            INNER JOIN stationnement s3 ON s3.ID=S.ID
            INNER JOIN stationnement s4 ON s4.ID=S.ID
            
            WHERE 
            
            c4.CNI LIKE '%".$data["cni_stationement"]."%' AND
            c1.NOM LIKE '%".$data["nom_stationement"]."%' AND
            c2.PRENOM LIKE '%".$data["prenom_stationement"]."%' AND
            c3.SEXE LIKE '%".$data["sexe_stationement"]."%' AND
 
            P5.NOM LIKE '%".$data["nomParking_stationement"]."%' AND
            P1.ADRESSE LIKE '%".$data["adresseParking_stationement"]."%' AND
            P2.VILLE LIKE '%".$data["villeParking_stationement"]."%' AND
            P3.NB_PLACE LIKE '%".$data["nbrPlaceParking_stationement"]."%' AND
            P4.NB_PLACE_LIBRE LIKE '%".$data["nbrPlaceLibreParking_stationement"]."%' AND

            s2.DATE_STATE LIKE '%".$data["date_stationement"]."%' AND
            s1.DATE_SORTIE LIKE '%".$data["dateSortie_stationement"]."%' AND
            s3.PRIX LIKE '%".$data["prix_stationement"]."%' AND
            s4.TYPE_TARIF LIKE '%".$data["typeTarif_stationement"]."%' 

            ";
            $smt=$db->query($SQL);
            $t=$smt->fetchAll(PDO::FETCH_OBJ);
            $r="";
            foreach($t as $s){
                $r.="
                <tr><td><img src='$s->PHOTO_PARKING' class='listImgeItem' ></td>
                <td>$s->NOM_CLIENT $s->PRENOM_CLIENT</td>
                <td>$s->NOM_PARKING</td>
                <td>$s->DATE_STATE</td>
                <td>$s->DATE_SORTIE</td>
                <td><ion-icon onclick='deleteStationnement(".$s->ID.")' class='Icon Icon_delete' name='trash-outline'></ion-icon></td>
                <td><ion-icon class='Icon Icon_update' onclick='updateStationnement(".json_encode($s).")' name='pencil-outline'></ion-icon></td>
                <td><ion-icon onClick='DetailStationnement(".json_encode($s).")' class='Icon Icon_details' name='information-circle-outline'></ion-icon>  </td></tr>";       
            }
            return $r;

        }
    }
      public function getNbrClientParClient(){
        $db=$this->connect();
        if($db!=null){
            $SQL="SELECT P.NOM,COUNT(S.ID_CLIENT) AS 'NBR_CLIENT' FROM stationnement S INNER JOIN parking P ON P.ID=S.ID_PARK GROUP BY P.NOM";
            $smt=$db->query($SQL);
            return json_encode($smt->fetchAll(PDO::FETCH_OBJ));
        }
      }
      public function getNbrStationParClient(){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT C.NOM,C.PRENOM,COUNT(S.ID) AS 'NBR_STATION' FROM CLIENT C INNER JOIN stationnement S ON C.ID=S.ID_CLIENT GROUP BY C.NOM,C.PRENOM ";
            $smt=$db->query($sql);
            return json_encode($smt->fetchAll(PDO::FETCH_OBJ));
        }
      }
      public function latestAddedStationement(){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT C.* FROM stationnement S INNER JOIN CLIENT C ON C.ID=S.ID_CLIENT ORDER BY S.ID DESC";
            $smt=$db->query($sql);
            $T=$smt->fetchAll(PDO::FETCH_OBJ);
            $s="";
            foreach($T as $c){
              $s.="<div class='itemLatestAdded'><img src='$c->PHOTO' class='listImgeItem' > $c->NOM $c->PRENOM</div>";
            }
            return $s;

        }
      }
}
