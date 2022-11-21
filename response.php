<?php
require('models/admin.php');
require('models/client.php');
require('models/Parking.php');
require('models/Stationnement.php');
$op=$_POST['op']?? "";
$admin=new Admin();
$client=new Client();
$Parking=new Parking();
$Stationnement=new Stationnement();
if($op=="Inscrire"){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $pw=$_POST['pw'];
    $from=$_FILES['photo']['tmp_name'];
    $T=explode(".",$_FILES['photo']['name']);
    $to="images/admin/".$nom."_".$prenom.".".$T[1];
    $r=$admin->Inscrire($to,$nom,$prenom,$email,$pw);
    if($r=="valide"){
        move_uploaded_file($from,$to);
    }
echo $r;
}
if($op=="connxion"){
    $email=$_POST['email'];
    $pw=$_POST['pw'];
    echo $admin->connxion($email,$pw);
}
if($op=="addClient"){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $sexe=$_POST['sexe'];
    $cni=$_POST['cni'];
    $photo=$_FILES['photo'];
   echo  $client->addClient(array(
                        "nom"=>$nom
                        ,"prenom"=>$prenom
                        ,"sexe"=>$sexe
                        ,"cni"=>$cni
                        ,"photo"=>$photo
                    ));

}
if($op=="quitter"){
 session_start();
 session_destroy();
 echo json_encode(array("ticket"=>"Quiter avec success","message"=>"Au revoire"));
}
if($op=="testAdminCnx"){
    session_start();
   echo !isset($_SESSION['nom'])?json_encode(array("type"=>"error","ticket"=>"Accès refusé","message"=>"Svp tu doit faire votre connexion !!")):json_encode(array("type"=>"success","nom"=>$_SESSION['nom'],"prenom"=>$_SESSION["prenom"],"path"=>$_SESSION["path"]));
}
if($op=="getDataClient"){
    $offset=$_POST['ofsset'];
    echo $client->getData($offset);
}
if($op=="deleteClient"){
$id=$_POST['id'];
    echo $client->deletClient($id);
}
if($op=="updateClient"){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $sexe=$_POST['sexe'];
    $cni=$_POST['cni'];
    $id=$_POST['id'];
    $photo=isset($_FILES['photo'])?$_FILES['photo']:null;    
   echo $client->updateClient(array("nom"=>$nom,"prenom"=>$prenom,"cni"=>$cni,"sexe"=>$sexe,"id"=>$id,"photo"=>$photo));
}

if($op=="searchClient"){
    $cni=$_POST["cni"];
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $sexe=$_POST["sexe"];
    echo $client->search(array("nom"=>$nom,"prenom"=>$prenom,"cni"=>$cni,"sexe"=>$sexe));
}
if($op=="latestClientAdded"){
    echo $client->latestClientAdded();
}
if($op=="exporterExcelClient"){
 $client->exporterExcelClient();
}
if($op=="addParking"){
   $nom=$_POST['nom'];
   $adresse=$_POST['adresse'];
   $ville=$_POST['ville'];
   $nbrPlace=$_POST['nbrPlace'];
   $nbrPlaceLibre=$_POST['nbrPlaceLibre'];
   $photo=$_FILES['photo'];
   echo $Parking->addParking(array("nom"=>$nom,"adresse"=>$adresse,"ville"=>$ville,"nbrPlace"=>$nbrPlace,"nbrPlaceLibre"=>$nbrPlaceLibre,"photo"=>$photo));
}
if($op=="getParkings"){
    $offset=$_POST["offset"];
    echo $Parking->getData($offset);
}
if($op=="deleteParling"){
    $id=$_POST["id"];
    echo $Parking->deleteParking($id);
}
if($op=="updateParking"){
    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $nbrPlace=$_POST['nbrPlace'];
    $nbrPlaceLibre=$_POST['nbrPlaceLibre'];
    $photo=isset($_FILES['photo'])?$_FILES['photo']:null;
    echo $Parking->updateParking(array("id"=>$id,"nom"=>$nom,"adresse"=>$adresse,"ville"=>$ville,"nbrPlace"=>$nbrPlace,"nbrPlaceLibre"=>$nbrPlaceLibre,"photo"=>$photo));
 
}
if($op=="searchParking"){
    $nom=$_POST['nom'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $nbrPlace=$_POST['nbrPlace'];
    $nbrPlaceLibre=$_POST['nbrPlaceLibre'];
    echo $Parking->search(array("nom"=>$nom,"adresse"=>$adresse,"ville"=>$ville,"nbrPlace"=>$nbrPlace,"nbrPlaceLibre"=>$nbrPlaceLibre));
}
if($op=="geNbrParkingParNbrPlace"){
    echo $Parking->geNbrParkingParNbrPlace();
}
if($op=="geNbrParkingVille"){
    echo $Parking->geNbrParkingVille();
}
if($op=="getLatestAddedParking"){
    echo $Parking->getLatestAddedParking();
}
if($op=="getClientStation"){
    echo $Stationnement->getClientStation();
}
if($op=="getParkingStation"){
    echo $Stationnement->getParkingStation();
}
if($op=="addStationnement"){
    $dateStation=$_POST['dateStation'];
    $dateSorti=$_POST['dateSorti'];
    $client=$_POST['client'];
    $parking=$_POST['parking'];
    $prix=$_POST['prix'];
    $typeTarif=$_POST['typeTarif'];
    echo $Stationnement->addStationnement(array(
        "dateSorti"=>$dateSorti,
        "client"=>$client,
        "parking"=>$parking,
        "prix"=>$prix,
        "typeTarif"=>$typeTarif,
        "dateStation"=>$dateStation,
    ));
}
if($op=="getDataStationement"){
    $offset=$_POST["offsetePark"];
     echo $Stationnement->geData($offset);
}
if($op=="deleteStationement"){
    $id=$_POST["id"];
    echo $Stationnement->deleteItem($id);
}
if($op=="updateStationnement"){
    $dateStation=$_POST['dateStation'];
    $dateSorti=$_POST['dateSorti'];
    $client=$_POST['client'];
    $parking=$_POST['parking'];
    $prix=$_POST['prix'];
    $typeTarif=$_POST['typeTarif'];
    $id=$_POST["id"];
    echo $Stationnement->updateStationnement(array(
        "dateSorti"=>$dateSorti,
        "client"=>$client,
        "parking"=>$parking,
        "prix"=>$prix,
        "typeTarif"=>$typeTarif,
        "dateStation"=>$dateStation,
        "id"=>$id
    ));
   
}
if($op=="searchStationement"){
    $cni_stationement=$_POST["cni_stationement"];
    $nom_stationement=$_POST["nom_stationement"];
    $prenom_stationement=$_POST["prenom_stationement"];
    $sexe_stationement=$_POST["sexe_stationement"];
    $nomParking_stationement=$_POST["nomParking_stationement"];
    $adresseParking_stationement=$_POST["adresseParking_stationement"];
    $villeParking_stationement=$_POST["villeParking_stationement"];
    $nbrPlaceParking_stationement=$_POST["nbrPlaceParking_stationement"];
    $nbrPlaceLibreParking_stationement=$_POST["nbrPlaceLibreParking_stationement"];
    $date_stationement=$_POST["date_stationement"];
    $dateSortie_stationement=$_POST["dateSortie_stationement"];
    $prix_stationement=$_POST["prix_stationement"];
    $typeTarif_stationement=$_POST["typeTarif_stationement"];
    echo $Stationnement->search(array(
        "cni_stationement"=>$cni_stationement,
        "nom_stationement"=>$nom_stationement,
        "prenom_stationement"=>$prenom_stationement,
        "sexe_stationement"=>$sexe_stationement,
        "nomParking_stationement"=>$nomParking_stationement,
        "adresseParking_stationement"=>$adresseParking_stationement,
        "villeParking_stationement"=>$villeParking_stationement,
        "nbrPlaceParking_stationement"=>$nbrPlaceParking_stationement,
        "nbrPlaceLibreParking_stationement"=>$nbrPlaceLibreParking_stationement,
        "date_stationement"=>$date_stationement,
        "dateSortie_stationement"=>$dateSortie_stationement,
        "prix_stationement"=>$prix_stationement,
        "typeTarif_stationement"=>$typeTarif_stationement,
    ));
}
if($op=="getNbrClientParClient"){
    echo $Stationnement->getNbrClientParClient();
}
if($op=="getNbrStationParClient"){
    echo $Stationnement->getNbrStationParClient();
}
if($op=="latestAddedStationement"){
    echo $Stationnement->latestAddedStationement();
}
if($op=="getDataAdmin"){
    echo $admin->getDataAdmin();
}
if($op=="updateAdmin"){
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $email=$_POST["email"];
    $pw=$_POST["pw"];
    $photo=isset($_FILES['photo'])?$_FILES['photo']:null;
    echo $admin->updateCompt(array(
        "nom"=>$nom,
        "prenom"=>$prenom,
        "email"=>$email,
        "pw"=>$pw,
        "photo"=>$photo
    ));
    
}