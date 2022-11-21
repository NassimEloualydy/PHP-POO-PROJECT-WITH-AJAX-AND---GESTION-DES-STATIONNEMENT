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
<body onload="testAdminCnx();getDataAdmin()">
 
<div class="containerMenuBody">
        <div id="menu" class="menu">
          <?php 
            include('menu.php');
          ?> 
    </div>
        <div class="body">
            <center>
                <br>
                <br>
                <h3>Moddifier votre compt</h3>
                <br>
                <div class="formInput">
                        Photo :
                        <input type="file" name="nom" id="photoAdmin" style="background-color: white;outline: none;border-color: white;color: black;" class="validFormClient formInputText">
                </div>
        
                <br>
        <div class="formInput">
                Nom :
                <input type="text" name="nom" id="nomAdmin" style="background-color: white;outline: none;border-color: white;color: black;border-bottom-color: black;" class="validFormClient formInputText">
        </div>
        <br>
        <div class="formInput">
            Prenom :
            <input type="text" name="nom" id="prenomAdmin" style="background-color: white;outline: none;border-color: white;color: black;border-bottom-color: black;" class="validFormClient formInputText">
    </div>
    <br>
    <div class="formInput">
        Email :
        <input type="text" name="nom" id="emailAdmin" style="background-color: white;outline: none;border-color: white;color: black;border-bottom-color: black;" class="validFormClient formInputText">
</div>
<br>
<div class="formInput">
    Mot de passe :
    <input type="text" name="nom" id="pwAdmin" style="background-color: white;outline: none;border-color: white;color: black;border-bottom-color: black;" class="validFormClient formInputText">
</div>

<br>
<input type="button" value="Moddifier" onclick="updateAdmin()" class="btnInput">
<br>

            </center>
      </div>
    </div>
</body>
</html>