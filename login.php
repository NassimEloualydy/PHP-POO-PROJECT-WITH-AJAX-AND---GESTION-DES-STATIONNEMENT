<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/style.css'>
    <script src='login.js'></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<body>
    <div class="containerLogin">
        <div class="itemLogin">
            <center>
                <h3>Bonjour Dans notre Application </h3>
                <div class="imgLogin"></div>
            </center>
        </div>
        <div class="itemLogin">
          <div  id="cnxInscrire" class="containerFormLogin">
            <div class="containerFormLoginItem">
                <center>
                    <h3>Formulaire de connxion</h3>
                    <br>
                    <div class="containerInputLogin">
                        <div>Email :</div>
                        <input type="text" id="emailCnx" class="inputLogin">
                    </div>
                    <br>
                    <div class="containerInputLogin">
                        <div>Mot de Passe :</div>
                        <input type="text" id="pwCnx" class="inputLogin">
                    </div>
                  <br>
                    <input type="button" value="Connexion" onclick="cnx()" class="btnInput">
                    <input type="button" value="Inscription" onclick="switchForm('containerFormLogin','switchcontainerFormLogin')" class="btnInputLink">
                </center>
            </div>
            <div class="containerFormLoginItem">
                <center>
                    <h3>Formulaire D'Inscription</h3>
                    <br>
                    <div class="containerInputLogin">
                        <div>Photo :</div>
                        <input type="file" id="photoAdmin" class="">
                    </div>
                    <br>
                    <div class="containerInputLogin">
                        <div>Nom :</div>
                        <input type="text" id="nomAdmin" name="nom" class="formInscValidation inputLogin">
                    </div>
                    <br>
                    <div class="containerInputLogin">
                        <div>Prenom :</div>
                        <input type="text" id="prenomAdmin" name="prenom" class="formInscValidation inputLogin">
                    </div>
                    <br>
                    <div class="containerInputLogin">
                        <div>Email :</div>
                        <input type="text" id="emailAdmin" name="email" class="formInscValidation inputLogin">
                    </div>
                    <br>
                    <div class="containerInputLogin">
                        <div>Mot de passe :</div>
                        <input type="text" id="pwAdmin" name="mot de passe" class="formInscValidation inputLogin">
                    </div>
                    <br>

                    <input type="button" value="Inscription" onclick="Inscrire()" class="btnInput">
                    <input type="button" value="Connexion" onclick="switchForm('switchcontainerFormLogin','containerFormLogin')" class="btnInputLink">

                </center>

            </div>
          </div>
        </div>
    </div>
</body>
</html>