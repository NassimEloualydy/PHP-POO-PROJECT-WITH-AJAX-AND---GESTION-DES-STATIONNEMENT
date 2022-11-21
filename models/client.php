<?php 
// require(dirname(__FILE__).'/../config/DataProvider.php');
class Client extends DataProvider{

    public function addClient($data){
      $db=$this->connect();
      if($db!=null){
        $sql="SELECT * FROM CLIENT WHERE CNI=:CNI";
        $smt=$db->prepare($sql);
        $smt->execute([":CNI"=>$data["cni"]]);
        if(count($smt->fetchAll(PDO::FETCH_OBJ))!=0)
        return json_encode(array("ticket"=>"Échec de l'insertion","type"=>"error","message"=>"SVP le cne exist deja !!"));
        $sql="SELECT * FROM CLIENT WHERE NOM=:NOM AND PRENOM=:PRENOM";
        $smt=$db->prepare($sql);
        $smt->execute([":NOM"=>$data['nom'],":PRENOM"=>$data['prenom']]);
        if(count($smt->fetchAll(PDO::FETCH_OBJ))!=0)
         return json_encode(array("ticket"=>"Échec de l'insertion","type"=>"error","message"=>"SVP le nom est prenom exist deja !!"));
         $sql="INSERT INTO CLIENT (NOM,PRENOM,SEXE,CNI,PHOTO) VALUES (:NOM,:PRENOM,:SEXE,:CNI,:PHOTO)";
        $smt=$db->prepare($sql);
        $from=$data['photo']['tmp_name'];
        $T=explode('.',$data['photo']['name']);
        $to="images/client/".$data['cni'].".".$T[1];
        move_uploaded_file($from,$to);
        $smt->execute([":NOM"=>$data["nom"],":SEXE"=>$data['sexe'],":PRENOM"=>$data["prenom"],":CNI"=>$data["cni"],":PHOTO"=>$to]);
        return json_encode(array("ticket"=>"Operation valide","type"=>"success","message"=>"Ajouter avec succes"));
      }
    
    }
    public function getData($offset){
      $db=$this->connect();
      if($db!=null){
        $sql="SELECT * FROM CLIENT LIMIT 5 OFFSET $offset";
        $smt=$db->query($sql);
        // $smt->execute(["offset",$offset]);
        $T=$smt->fetchAll(PDO::FETCH_OBJ);
        $s="";
        foreach($T as $c){
          $s.="<tr><td><img src='$c->PHOTO' class='listImgeItem' ></td>
          <td>$c->CNI</td>
          <td>$c->NOM</td>
          <td>$c->PRENOM</td>
          <td>$c->SEXE</td>
          <td><ion-icon onclick='deleteClient(".$c->ID.")' class='Icon Icon_delete' name='trash-outline'></ion-icon></td>
          <td><ion-icon class='Icon Icon_details' onclick='updateClient(".json_encode($c).")' name='pencil-outline'></ion-icon></td></tr>";
        }
         return $s;
      }
    }
    public function deletClient($id){
      $db=$this->connect();
      if($db!=null){
        $sql="SELECT * FROM CLIENT WHERE ID=$id";
        $smt=$db->query($sql);
        $T=$smt->fetchAll(PDO::FETCH_OBJ);
        if(file_exists($T[0]->PHOTO))
           unlink($T[0]->PHOTO);
          }
       $sql="DELETE FROM CLIENT WHERE ID=:ID";
       $smt=$db->prepare($sql);
       $smt->execute([":ID"=>$id]);
       $db=null;
        return "Supprimer avec succes";
       //  return json_encode(array("ticket"=>"Operation valide","message"=>"Supprimer avec success !!"));
    }

 public function updateClient($data){
  $db=$this->connect();
  if($db!=null){
    $sql="SELECT * FROM CLIENT WHERE CNI=:CNI AND ID!=:ID";
    $smt=$db->prepare($sql);
    $smt->execute([":CNI"=>$data["cni"],":ID"=>$data["id"]]);
    if(count($smt->fetchAll(PDO::FETCH_OBJ))!=0)
    return json_encode(array("type"=>"error","ticket"=>"Operation invalide !!","message"=>"SVP cet cni exist deja !!"));   
    $sql="SELECT * FROM CLIENT WHERE NOM=:NOM AND PRENOM=:PRENOM AND ID!=:ID";
    $smt=$db->prepare($sql);
    $smt->execute([":NOM"=>$data['nom'],":PRENOM"=>$data['prenom'],":ID"=>$data["id"]]);
   if(count($smt->fetchAll(PDO::FETCH_OBJ))!=0)
   return json_encode(array("type"=>"error","ticket"=>"Operation invalide !!","message"=>"SVP le nom e le prenom exist deja !!"));   
   $sql="UPDATE CLIENT SET NOM=:NOM,PRENOM=:PRENOM,CNI=:CNI,SEXE=:SEXE WHERE ID=:ID";
   $dataSql=array(":NOM"=>$data["nom"],":PRENOM"=>$data["prenom"],":CNI"=>$data["cni"],":SEXE"=>$data["sexe"],":ID"=>$data["id"]);
   if($data["photo"]!=null){
     $sql="SELECT * FROM CLIENT WHERE ID=:ID";
     $smt=$db->prepare($sql);
     $smt->execute([":ID"=>$data['id']]);
     $T=$smt->fetchAll(PDO::FETCH_OBJ);
     if(file_exists($T[0]->PHOTO))
     unlink($T[0]->PHOTO);
     $name=explode(".",$data["photo"]["name"]);
     $from=$data["photo"]["tmp_name"];
     $to="images/client/".$data['cni'].".".$name[1];
      move_uploaded_file($from,$to);
      $sql="UPDATE CLIENT SET NOM=:NOM,PRENOM=:PRENOM,PHOTO=:PHOTO,CNI=:CNI,SEXE=:SEXE WHERE ID=:ID";
      $dataSql=array("PHOTO"=>$to,":NOM"=>$data["nom"],":PRENOM"=>$data["prenom"],":CNI"=>$data["cni"],":SEXE"=>$data["sexe"],":ID"=>$data["id"]);
   }
   $smt=$db->prepare($sql);
   $smt->execute($dataSql);
   return json_encode(array("type"=>"success","ticket"=>"Operation valide !!","message"=>"Moddifier avec success !"));   
  }
 }    
 public function search($data){
  $db=$this->connect();
  if($db!=null){
    $sql="SELECT c.* FROM CLIENT c 
          INNER JOIN CLIENT c1 on c.ID=c1.ID
          INNER JOIN CLIENT c2 on c.ID=c2.ID
          INNER JOIN CLIENT c3 on c.ID=c3.ID
          INNER JOIN CLIENT c4 on c.ID=c4.ID          
          WHERE c1.NOM like :NOM AND c2.PRENOM like :PRENOM AND c3.SEXE like :SEXE AND c4.CNI like :CNI";
    $smt=$db->prepare($sql);
    $smt->execute([":NOM"=>'%'.$data["nom"].'%',":PRENOM"=>'%'.$data["prenom"].'%',":SEXE"=>'%'.$data["sexe"].'%',":CNI"=>'%'.$data["cni"].'%']);
    $T=$smt->fetchAll(PDO::FETCH_OBJ);
    $s="";
    foreach($T as $c){
      $s.="<tr><td><img src='$c->PHOTO' class='listImgeItem' ></td>
      <td>$c->CNI</td>
      <td>$c->NOM</td>
      <td>$c->PRENOM</td>
      <td>$c->SEXE</td>
      <td><ion-icon onclick='deleteClient(".$c->ID.")' class='Icon Icon_delete' name='trash-outline'></ion-icon></td>
      <td><ion-icon class='Icon Icon_details' onclick='updateClient(".json_encode($c).")' name='pencil-outline'></ion-icon></td></tr>";
    }
     return $s;

  }
 }
 public function latestClientAdded(){
  $db=$this->connect();
  if($db!=null){
    $sql="SELECT * FROM CLIENT ORDER BY ID DESC";
    $smt=$db->prepare($sql);
    $smt->execute();
    $T=$smt->fetchAll(PDO::FETCH_OBJ);
    $s="";
    foreach($T as $c){
      $s.="<div class='itemLatestAdded'><img src='$c->PHOTO' class='listImgeItem' > $c->NOM $c->PRENOM</div>";
    }
    return $s;
  }
 }
 public function exporterExcelClient(){
  $db=$this->connect();
  if($db!=null){
    $sql="SELECT NOM,PRENOM,CNI,SEXE FROM CLIENT";
    $smt=$db->prepare($sql);
    $smt->execute();
    $data="CNI;NOM;PRENOM;SXE\n";
    $T=$smt->fetchAll(PDO::FETCH_OBJ);
    foreach($T as $c){
      $data.="$c->CNI;";
      $data.="$c->NOM;";
      $data.="$c->PRENOM;";
      $data.="$c->SEXE;\n";
    }
    // header("Content-Type: application/xls");
    // header("Content-Disposition: attachment; filename=exportfile.xls");
    // header("Pragma: no-cache");
    // header("Expires: 0");    
    header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=exportfile.xls");
header("Pragma: no-cache");
header("Expires: 0");
    echo $data;
}
// ///
//   $queryexport = ("
// SELECT username,password,fullname FROM ecustomer_users
// WHERE fk_customer='".$fk_customer."'
// ");

// $row = mysql_fetch_assoc($queryexport);

// $result = mysql_query($queryexport);
// $header = '';

// for ($i = 0; $i < $count; $i++){
//    $header .= mysql_field_name($result, $i)."\t";
//    }

// while($row = mysql_fetch_row($result)){
//    $line = '';
//    foreach($row as $value){
//           if(!isset($value) || $value == ""){
//                  $value = "\t";
//           }else{
//                  $value = str_replace('"', '""', $value);
//                  $value = '"' . $value . '"' . "\t";
//                  }
//           $line .= $value;
//           }
//    $data .= trim($line)."\n";
//    $data = str_replace("\r", "", $data);

// if ($data == "") {
//    $data = "\nno matching records found\n";
//    }
// }
// header("Content-type: application/vnd.ms-excel; name='excel'");
// header("Content-Disposition: attachment; filename=exportfile.xls");
// header("Pragma: no-cache");
// header("Expires: 0");

// // output data
// return $header."\n".$data;

// mysql_close($conn);`

 }
}

