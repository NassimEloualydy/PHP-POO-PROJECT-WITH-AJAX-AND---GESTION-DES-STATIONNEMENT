<?php
require(dirname(__FILE__).'/../config/DataProvider.php');
class Admin extends DataProvider{
    public function Inscrire($path,$nom,$prenom,$email,$pw){
        $db=$this->connect();
        if($db!=null){
            $sql="SELECT * FROM admin WHERE nom=:nom AND prenom=:prenom";
            $smt=$db->prepare($sql);
            $smt->execute([':nom'=>$nom,':prenom'=>$prenom]);
            if(!$smt->fetchAll()){
            $sql="SELECT * FROM admin WHERE email=:email";
            $smt=$db->prepare($sql);
            $smt->execute([":email"=>$email]);
            if(!$smt->fetchAll()){
              $sql="SELECT * FROM admin WHERE pw=:pw";
              $smt=$db->prepare($sql);
              $smt->execute([":pw"=>$pw]);
              if(!$smt->fetchAll()){
                $sql="INSERT INTO admin (NOM,PRENOM,EMAIL,PW,PHOTO) VALUES (:nom,:prenom,:email,:pw,:path)";
                $smt=$db->prepare($sql);
                $smt->execute([":nom"=>$nom,":prenom"=>$prenom,":email"=>$email,":pw"=>$pw,":path"=>$path]);
                return "valide";
              }else
              return "SVP cet mot de passe exist deja !!";
            }else
            return "SVP cet email exist deja !!";
            }else
            return "SVP le nom et le prenom exist deja !!";
        }
    }
    public function connxion($email,$pw){
      $db=$this->connect();
      if($db!=null){
        $sql="SELECT * FROM admin WHERE EMAIL=:email and PW=:pw";
        $smt=$db->prepare($sql);
        $smt->execute([":email"=>$email,":pw"=>$pw]);
        $T=$smt->fetchAll(PDO::FETCH_OBJ);
        if(count($T)==1){
          @ob_start();
          session_start();
          $_SESSION['nom']=$T[0]->NOM;
          $_SESSION['prenom']=$T[0]->PRENOM;
          $_SESSION['path']=$T[0]->PHOTO;
          $_SESSION['id']=$T[0]->ID;
          return json_encode(array("type"=>"succes","ticket"=>"Connxion avec succes","message"=>"Bonjour ".$T[0]->NOM." ".$T[0]->PRENOM." "));
        }else 
        return json_encode(array("type"=>"error","ticket"=>"Connexion échoué","message"=>"l'email ou le mot de passe est introvable !!"));
      }
    }
    public function getDataAdmin(){
      
      $db=$this->connect();
      if($db!=null){       
        session_start();
        $id=$_SESSION["id"];
        $sql="SELECT * FROM ADMIN WHERE ID=$id";
        $smt=$db->query($sql);
        $t=$smt->fetchAll(PDO::FETCH_OBJ);
        return json_encode(array("nom"=>$t[0]->NOM,"prenom"=>$t[0]->PRENOM,"email"=>$t[0]->EMAIL,"pw"=>$t[0]->PW));
      }
    }  
    public function updateCompt($data){
       $db=$this->connect();
       if($db!=null){
        session_start();
        $id=$_SESSION["id"];
        $sql="SELECT * FROM ADMIN WHERE ID!=$id AND NOM='".$data["nom"]."' AND PRENOM='".$data["prenom"]."'";
        $smt=$db->query($sql);
        if(count($smt->fetchAll(PDO::FETCH_OBJ))>0)
        return json_encode(array("type"=>"error","ticket"=>"Operaion invalide !!","message"=>"SVP le nom et le prenom exist deja !!"));

        $sql="SELECT * FROM ADMIN WHERE ID!=$id AND email='".$data["email"]."'";
        $smt=$db->query($sql);
        if(count($smt->fetchAll(PDO::FETCH_OBJ))>0)
        return json_encode(array("type"=>"error","ticket"=>"Operaion invalide !!","message"=>"SVP le email exist deja !!"));

        $sql="SELECT * FROM ADMIN WHERE ID!=$id AND pw='".$data["pw"]."'";
        $smt=$db->query($sql);
        if(count($smt->fetchAll(PDO::FETCH_OBJ))>0)
        return json_encode(array("type"=>"error","ticket"=>"Operaion invalide !!","message"=>"SVP le mot de passe exist deja !!"));

        if($data["photo"]!=null){

          $sql="SELECT * FROM ADMIN WHERE ID=$id";
          $smt=$db->query($sql);
          $t=$smt->fetchAll(PDO::FETCH_OBJ);
          if(file_exists($t[0]->PHOTO))
            unlink($t[0]->PHOTO);
          $from=$data['photo']['tmp_name'];
          $ext=explode(".",$data["photo"]["name"])[1];
          $to="images/admin/".$data["nom"]."_".$data["prenom"].".".$ext;
          move_uploaded_file($from,$to);

          $sql="UPDATE ADMIN SET NOM=:NOM,PRENOM=:PRENOM,EMAIL=:EMAIL,PW=:PW,PHOTO=:PHOTO WHERE ID=:ID";
          $dataSql=array(
            ":NOM"=>$data["nom"],
            ":PRENOM"=>$data["prenom"],
            ":EMAIL"=>$data["email"],
            ":PW"=>$data["pw"],
            ":PHOTO"=>$to,
            ":ID"=>$id
          );
          $_SESSION['path']=$to;

        }
        $sql="UPDATE ADMIN SET NOM=:NOM,PRENOM=:PRENOM,EMAIL=:EMAIL,PW=:PW WHERE ID=:ID";
        $dataSql=array(
          ":NOM"=>$data["nom"],
          ":PRENOM"=>$data["prenom"],
          ":EMAIL"=>$data["email"],
          ":PW"=>$data["pw"],
          ":ID"=>$id
        );
        $_SESSION['nom']=$data["nom"];
        $_SESSION['prenom']=$data["prenom"];
        $_SESSION['id']=$id;

        $smt=$db->prepare($sql);
        $smt->execute($dataSql);
        return json_encode(array("type"=>"Success","ticket"=>"Operaion Valide !!","message"=>"Moddifier avec succes "));
             }
    } 
}