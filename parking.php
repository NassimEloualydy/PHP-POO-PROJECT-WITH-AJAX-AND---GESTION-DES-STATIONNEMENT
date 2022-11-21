<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/style.css'>
    <script src='login.js'></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body onload="testAdminCnx();getDataParking();geNbrParkingVille();geNbrParkingParNbrPlace();getLatestAddedParking()">
 <div id="FormDetail" class="detailForm">
    <center>
    <ion-icon onclick="switchMenu()" class="iconMenu" name="reorder-three-outline"></ion-icon>      

       <br>
       <h3>Detail Parking</h3>  
       <br>
       <img  id="imgParkingDetail"  class="ComptAdmin">
       <br>
       <div class="containerInfoDetails">
        <div class="containerInfoDetailsItem">Nom :</div>
        <div id="nomParkingDetail" class="containerInfoDetailsItem"> </div>
       </div>
       <br>
       <div class="containerInfoDetails">
        <div class="containerInfoDetailsItem">Adresse :</div>
        <div id="adresseParkingDetail" class="containerInfoDetailsItem"> </div>
       </div>
       <br>
       <div class="containerInfoDetails">
        <div  class="containerInfoDetailsItem">Ville :</div>
        <div id="villeParkingDetail" class="containerInfoDetailsItem"> </div>
       </div>
       <br>
       <div class="containerInfoDetails">
        <div class="containerInfoDetailsItem">Nombre de place :</div>
        <div id="nbrPlaceParkingDetail" class="containerInfoDetailsItem"> </div>
       </div>
       <br>
       <div class="containerInfoDetails">
        <div class="containerInfoDetailsItem">Nombre de place libre :</div>
        <div  id="nbrPlaceLibreParkingDetail" class="containerInfoDetailsItem"> </div>
       </div>
       <br>
       <br>
       <input type="button" value="Annuler" onclick="hideFormDetail()" style="border-color: white;" class="btnInput">&nbsp;

       <br>
 
    </center>
 </div>
<!-- detailForm -->
 <div id="formulaire" class="formulaire" style="overflow: hidden;overflow-y:scroll;"> 
    <center>
        <br>
        <h3>Formulaire</h3>
        <br>
        <div class="formInput">
            Photo :
            <input type="file" name="photo" id="photoParking" style="border:none;" class="validFormParking formInputText">
         </div>
        <br>
        <div class="formInput">
            Nom :
            <input type="text" name="nom" id="nomParking" class="validFormParking formInputText">
         </div>
        <br>
         <div class="formInput">
            Adresse :
            <input type="text" name="adresse" id="adresseParking" class="validFormParking formInputText">
         </div>
        <br>
        <div class="formInput">
            Ville :
            <input type="text" name="ville" id="villeParking" class="validFormParking formInputText">
         </div>
        <br>
        <div class="formInput">
            Nombre de place  :
            <input type="text" name="Nombre de place" id="nbrPlace" class="validFormParking formInputText">
         </div>
        <br>
        <div class="formInput">
            Nombre de Place Libre :
            <input type="text" name="Nombre de Place Libre" id="nbrPlaceLibre" class="validFormParking formInputText">
         </div>
        <br>

        <input type="button" value="Ajouter" id="submitParking" onclick="submitBtnParking()" style="border-color: white;" class="btnInput">&nbsp;
        <input type="button" value="Annuler" onclick="hideFormParking()" style="border-color: white;" class="btnInput">
        <br>
        <br>
    </center>
 </div>
<div class="containerMenuBody">
        <div id="menu" class="menu">
          <?php 
            include('menu.php');
          ?> 
    </div>
        <div class="body">
            <ion-icon onclick="switchMenu()" class="iconMenu" name="reorder-three-outline"></ion-icon>      
            <h3 class="title">Gestion Parking</h3>
            <center>
            <br>
                <br>
                <br>
 
                <div class="charts">
                    <div class="containerCharts">
                        <div class="itemChart">
                            <br>
                          <h5>
                              Les nombre des ville par parking
                          </h5>
                        <canvas id="myChartnbrParkingParVille"></canvas>
                    </div>
                        <div class="itemChart">
                        <br>
                          <h5>
                              Les nombre des ville par parking
                          </h5>
                        <canvas id="myChartnbrParkingParNbrPlace"></canvas>

                        </div>
                    </div>
                <!--  -->
                </div>
                <br>
 

                <div class="listAndState">
                <div class="listItem">
                   <h3 class="title">Les Parking</h3>
                   <input type="button" onclick="showForm()" class="btnInput btnAdd" value="Ajouter"/>
                   <form action="response.php" method="POST">
                    <input type="hidden" name="op" value="exporterExcelClient">  
                   <input type="submit" value="Exporter Excel" class="btnInput btnExporterXml">
                   </form>
                   <br>
                   <br>
                   <br>
                   <br>
                   <div class="containerSearchInput">
                        <input type="text" placeholder="Nom" id="nomParkingSearch" class="inputSearch"><br><br>
                        <input type="text" placeholder="Adresse" id="adresseParkingSearch" class="inputSearch">
                    </div>
                    <br>
                    <div class="containerSearchInput">
                        <input type="text" placeholder="Ville" id="villeParkingSearch" class="inputSearch"><br><br>
                        <input type="text" placeholder="Nombre De Place" id="nbrPlaceParkingSearch" class="inputSearch">
                    </div>
<br>
<div class="containerSearchInput">
                        <input type="text" placeholder="Nombre De Place Libre" id="nbrPlaceLibreParkingSearch" class="inputSearch"><br><br>
                        <input type="text" placeholder="Nombre De Place"  class="inputSearch" style="visibility: hidden;">
                    </div>
<br>
<input type="button" onclick="searchParking()" class="btnInput" value="Chercher"/>&nbsp;
<input type="button" onclick="getDataClient()" class="btnInput" value="Actualiser"/>
                   <br>
                   <br>
                   <div class="container">

                   <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Parking</th>
                <th>Nom</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th colspan="3">Options</th>
            </tr>
        </thead>
        <tbody id="listParking"> 
        </tbody>
    </table>
    <br>
    <br>
    <input type="button" value="Précédent" onclick="previouseListClient()" class="btnInput">
    <input type="button" value="Suivant" onclick="nextListClient()" class="btnInput">
    <br>
    <br>

    </div>

                </div>
                <br>
                <div class="stateItem">
                <h3 class="title">Latest</h3>
                <br>                  <br>
                <div id="latestParkingAdded"></div>
                <!-- <div class="itemLatestAdded">
                <img src='$c->PHOTO' class='listImgeItem' >
                Nabssim
                  </div>
                  <div class="itemLatestAdded">
                    
                  </div> -->
                </div>
                </div>
                <br>
                <br>
 
        </center>
        </div>
    </div>
</body>
</html>