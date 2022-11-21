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

</head>
<body onload="testAdminCnx();getDataClient();getLatestAdd()">
 <div id="formulaire" class="formulaire">
    <center>
        <br>
        <h3>Formulaire</h3>
        <br>
        <div class="formInput">
            Photo :
            <input type="file" name="photo" id="photoClient" style="border:none;" class="validFormClient formInputText">
         </div>
        <br>
        <div class="formInput">
            Cni :
            <input type="text" name="cni" id="cniClient" class="validFormClient formInputText">
         </div>
        <br>
         <div class="formInput">
            Nom :
            <input type="text" name="nom" id="nomClient" class="validFormClient formInputText">
         </div>
        <br>
        <div class="formInput">
            Prenom :
            <input type="text" name="prenom" id="prenomClient" class="validFormClient formInputText">
         </div>
        <br>
        <div class="formInput">
            Sexe :
            <select name="sexe" class="validFormClient formInputText" id="sexeClient">
                <option value="">Chosisire le sexe</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
         </div>
        <br>

        <input type="button" value="Ajouter" id="submitClient" onclick="submitBtnClient()" style="border-color: white;" class="btnInput">&nbsp;
        <input type="button" value="Annuler" onclick="hideFormClient()" style="border-color: white;" class="btnInput">
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
            <h3 class="title">Gestion Client</h3>
            <center>
            <!-- <br>
                <br>
                <br>
 
                <div class="charts">
                    
                </div>
                <br> -->
                <br>
                <br>
                <br>
 

                <div class="listAndState">
                <div class="listItem">
                   <h3 class="title">Les client</h3>
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
                        <input type="text" placeholder="Nom" id="nomS" class="inputSearch"><br><br>
                        <input type="text" placeholder="Prenom" id="prenomS" class="inputSearch">
                    </div>
                    <br>
                    <div class="containerSearchInput">
                        <input type="text" placeholder="Sexe" id="sexeS" class="inputSearch"><br><br>
                        <input type="text" placeholder="CNI" id="CNIS" class="inputSearch">
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
                <th>Client</th>
                <th>Cni</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Sexe</th>
                <th colspan="2">Options</th>
            </tr>
        </thead>
        <tbody id="listClient"> 
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
                <div id="latestClientAdded"></div>
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