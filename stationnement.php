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
<body onload="testAdminCnx();getClientStation();getParkingStation();getDataSocitertationement();getNbrClientParClient();getNbrStationParClient();latestAddedStationement();">
 <div id="FormDetail" class="detailForm">
    <center>
        <br>
        <h3>Les detail de stationnement</h3>
        <br>
     <div class="containerDetailStion">
        <div class="clientDetail">
            <center>
                <br>            <img  id="PHOTO_CLIENT_DETAIL_STATION"  class="ComptAdmin">
                <br>
       <table class="tableDetail">
        <tr><th>Cne : </th><td id="CNE_CLIENT_DETAIL_STATION"> Nassim</td></tr>
        <tr><th>Nom : </th><td id="NOM_CLIENT_DETAIL_STATION"> Nassim</td></tr>
        <tr><th>Prnom : </th><td id="PRENOM_CLIENT_DETAIL_STATION"> el</td></tr>
        <tr><th>Sexe : </th><td id="SEXE_CLIENT_DETAIL_STATION"> el</td></tr>
       </table>
        

            </center>
        </div><br>
        <div class="parkingAndStationDetail">
        <center>
        <br>            
            <img  id="imgParkingDetailStation"  class="ComptAdmin">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
       <table class="tableDetail">
        <tr><th>Nom Parking: </th><td id="PARKING_NOM_DETAIL_STATION"> Nassim</td> <th>Adresse : </th><td id="PARKING_ADRESSE_DETAIL_STATION"> Nassim</td></tr>
        <tr><th>Ville Parking : </th><td id="PARKING_VILLE_DETAIL_STATION"> el</td> <th>Nombre De Place : </th><td id="PARKING_NB_PLACE_DETAIL_STATION"> Nassim</td></tr>
        
        <tr><th colspan="2" >Nombre de place libre : </th><td  colspan="2" id="PARKING_NB_PLACE_LIBRE_DETAIL_STATION"> Nassim</td></tr> 
        <tr><th colspan="2" >Date de stationnement : </th><td  colspan="2" id="DATE_DTATIONEMENT_DETAIL_STATION"> Nassim</td></tr>
        
        <tr><th colspan="2">Prix : </th><td colspan="2" id="PRIX_DETAIL_STATION"> Nassim</td></tr>
        <tr><th colspan="2">Type de Tarif : </th><td colspan="2" id="TYPE_TARIF_DETAIL_STATION"> Nassim</td></tr>
        
        <tr><th>Date Sortie : </th><td id="DATE_SORTIE_DETAIL_STATION" > Nassim</td></tr>
       </table>
        

            </center>

        </div>
     </div> 
     <br>
     <input type="button" value="Annuler" onclick="hideDetailFormStation()" style="border-color: white;" class="btnInput">
    </center>
    <br>
<br>
 </div>
<!-- detailForm -->
 <div id="formulaire" class="formulaire"> 
    <center>
        <br>
        <h3>Formulaire</h3>
        <br>
        <div class="formInput">
            Date de stationnement :
            <input type="date" name="Date de stationnement" id="dateStationn" class="validFormSationement formInputText">
         </div>
         <br>
        <div class="formInput">
            Date de Sortie :
            <input type="date" name="Date de sortie" id="dateSortiStationn" class="validFormSationement formInputText">
         </div>

        <br>
         <div class="formInput">
            Client :
            <select name="Client" class="validFormSationement formInputText" id="clientStationn">
                <option value="">Choisire un client</option>
            </select>
         </div>
         <br>
         <div class="formInput">
            Parking :
            <select name="Parking" class="validFormSationement formInputText" id="parkingStationn">
                <option value="">Choisire un Parking</option>
            </select>
         </div>
        <br>
        <div class="formInput">
            Prix :
            <input type="text" name="Prix" id="prixStationn" class="validFormSationement formInputText">
         </div>
        <br>

        <div class="formInput">
            Type de tarif:
            <select name="Type de tarif" id="typeTarifStationn" id="" class="validFormSationement formInputText">
                <option value="">Chisire un tarif</option>
            <option id="1h  6,00 DH TTC/Heur">  1h  6,00 DH TTC/Heur  JOUR </option>
<option id="2h12,00 DH TTC/Heur">2h12,00 DH TTC/HeurJOUR</option>
<option id="3h18,00 DH TTC/Heur">3h18,00 DH TTC/HeurJOUR</option>
<option id="4h24,00 DH TTC/Heur">4h24,00 DH TTC/HeurJOUR</option>
<option id="5h24,00 DH TTC/Heur">5h24,00 DH TTC/HeurJOUR</option>
<option id="6h24,00 DH TTC/Heur">6h24,00 DH TTC/HeurJOUR</option>
<option id="7h24,00 DH TTC/Heur">7h24,00 DH TTC/HeurJOUR</option>
<option id="8h30,00 DH TTC/Heur">8h30,00 DH TTC/HeurJOUR</option>
<option id="9h33,00 DH TTC/Heur">9h33,00 DH TTC/HeurJOUR</option>
<option id="10h36,00 DH TTC/Heur">10h36,00 DH TTC/HeurJOUR</option>
<option id="11h39,00 DH TTC/Heur">11h39,00 DH TTC/HeurJOUR</option>
<option id="12h40,00 DH TTC/Heur">12h40,00 DH TTC/HeurJOUR</option>
<option id="1h5,00 DH TTC/Heur">1h5,00 DH TTC/HeurNUIT</option>
<option id="2h7,00 DH TTC/Heur">2h7,00 DH TTC/HeurNUIT</option>
<option id="3h10,00 DH TTC/Heur">3h10,00 DH TTC/HeurNUIT</option>
<option id="4h13,00 DH TTC/Heur">4h13,00 DH TTC/HeurNUIT</option>
<option id="5h16,00 DH TTC/Heur">5h16,00 DH TTC/HeurNUIT</option>
<option id="6h19,00 DH TTC/Heur">6h19,00 DH TTC/HeurNUIT</option>
<option id="7h25,00 DH TTC/Heur">7h25,00 DH TTC/HeurNUIT</option>
<option id="8h25,00 DH TTC/Heur">8h25,00 DH TTC/HeurNUIT</option>
<option id="9h25,00 DH TTC/Heur">9h25,00 DH TTC/HeurNUIT</option>
<option id="10h25,00 DH TTC/Heur">10h25,00 DH TTC/HeurNUIT</option>
<option id="11h25,00 DH TTC/Heur">11h25,00 DH TTC/HeurNUIT</option>
<option id="12h25,00 DH TTC/Heur">12h25,00 DH TTC/HeurNUIT</option>
            </select>
         </div>
        <br>

        <input type="button" value="Ajouter" id="submitStationement" onclick="submitBtnStationement()" style="border-color: white;" class="btnInput">&nbsp;
        <input type="button" value="Annuler" onclick="hideFormStationnement()" style="border-color: white;" class="btnInput">
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
            <h3 class="title">Gestion Des Stationnement</h3>
            <center>
            <br>
                <br>
                <br>
 
                <div class="charts">
                    <div class="containerCharts">
                        <div class="itemChart">
                            <br>
                          <h5>
                              Le nombre des Client par Parking
                          </h5>
                    <canvas id="nbrClientParClient"></canvas> 
                    </div>
                        <div class="itemChart">
                        <br>
                          <h5>
                              Le Nombre des Stationnement par Client
                          </h5>
                         <canvas id="NbrStationParClient"></canvas>

                        </div>
                    </div>
                <!--  -->
                </div>
                <br>
 

                <div class="listAndState listAndStateStationnement">
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
                        <input type="text" placeholder="Cni" id="cni_stationement" class="inputSearch  inputSearchThree"><br><br>
                        <input type="text" placeholder="Nom" id="nom_stationement" class="inputSearch  inputSearchThree"><br><br>
                        <input type="text" placeholder="Prenom" id="prenom_stationement" class="inputSearch  inputSearchThree">
                    </div>
                    <br>
                    <div class="containerSearchInput">
                        <input type="text" placeholder="Sexe" id="sexe_stationement" class="inputSearch  inputSearchThree"><br><br>
                        <input type="text" placeholder="Nom Parking" id="nomParking_stationement" class="inputSearch  inputSearchThree"><br><br>
                        <input type="text" placeholder="Adresse Paeking" id="adresseParking_stationement" class="inputSearch  inputSearchThree">
                    </div>
<br>
<div class="containerSearchInput">
                        <input type="text" placeholder="Ville" id="villeParking_stationement" class="inputSearch  inputSearchThree"><br><br>
                        <input type="text" placeholder="Nombre de place" id="nbrPlaceParking_stationement" class="inputSearch  inputSearchThree"><br><br>
                        <input type="text" placeholder="Nombre De Place Libre" id="nbrPlaceLibreParking_stationement" class="inputSearch  inputSearchThree">
                    </div>
<br>
<div class="containerSearchInput">
    <input type="text" placeholder="Date de Stationnement" id="date_stationement" class="inputSearch  inputSearchThree"><br><br>
    <input type="text" placeholder="Date de Sortie" id="dateSortie_stationement" class="inputSearch  inputSearchThree"><br><br>
    <input type="text" placeholder="Prix" id="prix_stationement" class="inputSearch  inputSearchThree">
</div>
<br>
<div class="containerSearchInput">
                        <input type="text" placeholder="Type de Tarif" id="typeTarif_stationement"  class="inputSearch  inputSearchThree"><br><br>
                        <input type="text" style="visibility: hidden;"  class="inputSearch  inputSearchThree"><br><br>
                        <input type="text"  style="visibility: hidden;" class="inputSearch  inputSearchThree">
                    </div>
<br>
<input type="button" onclick="searchStationement()" class="btnInput" value="Chercher"/>&nbsp;
<input type="button" onclick="getDataClient()" class="btnInput" value="Actualiser"/>
                   <br>
                   <br>
                   <div class="container">

                   <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Client</th>
                <th>Nom & Prenom</th>
                <th>Parking</th>
                <th>Date Arrive</th>
                <th>Date Sortie</th>
                <th colspan="3">Options</th>
            </tr>
        </thead>
        <tbody id="listStationement"> 
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
                <div id="latestStationAdded"></div>
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