function switchForm(rmvClass,addClass){
    // 'containerFormLogin'
    // 'switchcontainerFormLogin'
document.getElementById('cnxInscrire').classList.remove(rmvClass);
document.getElementById('cnxInscrire').classList.add(addClass);
document.getElementById('nomAdmin').value="";
document.getElementById('prenomAdmin').value="";
document.getElementById('emailAdmin').value="";
document.getElementById('pwAdmin').value="";
}
function Inscrire(){
    var photo=document.getElementById('photoAdmin').files.length==1?document.getElementById('photoAdmin').files[0]:null;
    var nom=document.getElementById('nomAdmin').value;
    var prenom=document.getElementById('prenomAdmin').value;
    var email=document.getElementById('emailAdmin').value;
    var pw=document.getElementById('pwAdmin').value;
    var valid=true;
    if(photo==null){
        alert("SVP la photo est obligatoire !!");
        valid=false;
    }
    if(valid==true){
        for(i=0;i<document.querySelectorAll('.formInscValidation').length;i++){
            if(document.querySelectorAll('.formInscValidation')[i].value==""){
              alert(`SVP le champe ${document.querySelectorAll('.formInscValidation')[i].name} est obligatoire !!`);
              valid=false
              break;
            }
          }
      
    }
    if(valid==true){
        var f=new FormData();
        f.append("photo",photo);
        f.append("nom",nom);
        f.append("prenom",prenom);
        f.append("email",email);
        f.append("pw",pw);
        f.append("op","Inscrire")
           var xhr=new XMLHttpRequest();
           xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                if(this.responseText=="valide"){
                    switchForm('switchcontainerFormLogin','containerFormLogin')
                }else
                alert(this.responseText);
            }
           }
           xhr.open("POST","response.php",false);
           xhr.send(f);
    }
}
function cnx(){
var email=document.getElementById('emailCnx').value;    
var pw=document.getElementById('pwCnx').value;
if(email!=""){
 if(pw!=""){
    var f=new FormData();
    f.append("email",email);
    f.append("pw",pw);
    f.append("op","connxion");
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status=200 && this.readyState==4){ 
        var t=JSON.parse(this.responseText);
        if(t.type=="error"){
            toastr.error(t.message,t.ticket,{positionClass:"toast-bottom-right"})
        }else{
            toastr.success(t.message,t.ticket,{positionClass:"toast-bottom-right"})
             window.location.href="client.php";
        }
        }
    }
    xhr.open("POST","response.php",false);
    xhr.send(f);
 }else
 alert("SVP le mot de passe est obligatore !!")
}else
alert("SVP le email est obligatoire !!")
}
function switchMenu(){
    document.getElementById('menu').classList.remove('menu');
    document.getElementById('menu').classList.add('showMenu');
}
function showForm(){
    document.getElementById('formulaire').classList.remove("formulaire");
    document.getElementById('formulaire').classList.add('showFormulaire');
}
function hideFormClient(){
    document.getElementById('formulaire').classList.add("formulaire");
    document.getElementById('formulaire').classList.remove('showFormulaire');
    document.getElementById("cniClient").value="";
    document.getElementById("nomClient").value="";
    document.getElementById("prenomClient").value="";
    document.getElementById("sexeClient").value="";
    document.getElementById("submitClient").value="Ajouter";

}

function submitBtnClient(){
var msg;
    if(document.getElementById("submitClient").value=="Ajouter")
      msg=testValidationForm('photoClient','validFormClient');
    else
    msg=testValidationForm(null,'validFormClient');

if(msg==""){
var photo=document.getElementById("photoClient").files[0];
var cni=document.getElementById("cniClient").value;
var nom=document.getElementById("nomClient").value;
var prenom=document.getElementById("prenomClient").value;
var sexe=document.getElementById("sexeClient").value;
var f=new FormData();
f.append("cni",cni);
f.append("nom",nom);
f.append("prenom",prenom);
f.append("sexe",sexe);
f.append("photo",photo);
f.append("id",idClient);
if(document.getElementById("submitClient").value=="Ajouter")
f.append("op","addClient");
else
f.append("op","updateClient");
var xhr=new XMLHttpRequest();
xhr.onreadystatechange=function(){
    console.log(this.responseText);
    if(this.readyState==4 && this.status==200){
            var {type,message,ticket}=JSON.parse(this.responseText);
        if(type=="success"){
    toastr.success(message,ticket,{positionClass:"toast-bottom-right"});
    hideFormClient();
    getDataClient();    
        }else
         toastr.warning(message,ticket,{positionClass:"toast-bottom-right"});
     }
}
xhr.open("post","response.php",false);
xhr.send(f);
}else
toastr.warning(msg,"Formulaire est invalide !!",{positionClass:"toast-bottom-right"});
}
function testValidationForm(photo,className){
    var valid=true;
    var msg="";
    if(photo!=null && document.getElementById(photo).files.length!=1){
        msg="SVP la photo est obligatoire !!";
        valid=false;
    }
//    alert(document.querySelectorAll('.'+className).length);
    if(valid==true){
        for(i=0;i<document.querySelectorAll('.'+className).length;i++){
            if(document.querySelectorAll('.'+className)[i].value=="" && document.querySelectorAll('.'+className)[i].type=="text"){
              msg=`SVP le champe ${document.querySelectorAll('.'+className)[i].name} est obligatoire !!`;
              valid=false
              break;
            }
          }
      
    }
    return msg;
}
function quite(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            var {ticket,message}=JSON.parse(this.responseText);
            toastr.info(message,ticket,{positionClass:"toast-bottom-right"});
            window.location.href="login.php";
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","quitter");
    xhr.send(f);a
}
function testAdminCnx(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            var {type}=JSON.parse(this.responseText);
            if(type=="error"){
                var {message,ticket}=JSON.parse(this.responseText);
                toastr.error(message,ticket,{positionClass:"toast-bottom-right"});
                window.location.href="login.php";
            }else{
                var {nom,path,prenom}=JSON.parse(this.responseText);
                document.getElementById("adminPhoto").src=path;
                document.getElementById("adminFullName").innerHTML=nom+" "+prenom;                
            }
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","testAdminCnx");
    xhr.send(f);
}
function getDataClient(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            if(this.responseText!=""){
                document.getElementById('listClient').innerHTML=this.responseText;
            }else{
                k--;                
            }
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","getDataClient");
    f.append("ofsset",k);
    xhr.send(f);
}
var k=0;
function previouseListClient(){
    if(k!=0){
        k-=5;
        getDataClient();    
    }
}

function previouseListClient(){
        k+=5;
        getDataClient();    
}

function deleteClient(id){
    if(window.confirm("Voulez vous vraiment supprmer cet client ?")){
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
             toastr.success(this.responseText,"Operation valide",{positionClass:"toast-bottom-right"});
             getDataClient();
            }
        }
        xhr.open("POST","response.php",false);
        var f=new FormData();
        f.append("id",id);
        f.append("op","deleteClient");
        xhr.send(f);
    }
}
var idClient=0;
function updateClient(client){
    var {NOM,PRENOM,CNI,SEXE,ID}=client;
    document.getElementById("nomClient").value=NOM;
    document.getElementById("prenomClient").value=PRENOM;
    document.getElementById("cniClient").value=CNI;
    document.getElementById("sexeClient").value=SEXE;
    document.getElementById("submitClient").value="Moddifier";
    showForm();  
    idClient=ID;
}
function searchClient(){
    var nom=document.getElementById('nomS').value;
    var prenom=document.getElementById('prenomS').value;
    var sexe=document.getElementById('sexeS').value;
    var cni=document.getElementById('CNIS').value;
    var f=new FormData();
    f.append("nom",nom);
    f.append("prenom",prenom);
    f.append("sexe",sexe);
    f.append("cni",cni);
    f.append("op","searchClient");
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            document.getElementById('listClient').innerHTML=this.responseText;
        }
    }
    xhr.open("POST","response.php",false);
    xhr.send(f);
}
function getLatestAdd(){
  var xhr=new XMLHttpRequest();
  xhr.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
       document.getElementById("latestClientAdded").innerHTML=this.responseText;
    }
  }
  xhr.open("POST","response.php",false);
  var f=new FormData();
  f.append("op","latestClientAdded");
  xhr.send(f);
}
function exportExel(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            alert(this.responseText);
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","exporterExcelClient");
    xhr.send(f);
}
function switchUrl(url){
    window.location.href=url;
}
function submitBtnParking(){
    var msg;
    if(document.getElementById("submitParking").value=="Ajouter")
      msg=testValidationForm('photoParking','validFormParking');
    else
    msg=testValidationForm(null,'validFormParking');
    if(msg==""){
        var photo= document.getElementById('photoParking').files.length==1?document.getElementById('photoParking').files[0]:null;
        var nom= document.getElementById('nomParking').value;
        var adresse= document.getElementById('adresseParking').value;
        var ville= document.getElementById('villeParking').value;
        var nbrPlace= document.getElementById('nbrPlace').value;
        var nbrPlaceLibre= document.getElementById('nbrPlaceLibre').value;  
        
      if(isFinite(nbrPlace)){
        if(isFinite(nbrPlaceLibre)){
            if(nbrPlace>nbrPlaceLibre){
                var xhr=new XMLHttpRequest();
                xhr.onreadystatechange=function(){
                    if(this.status==200 && this.readyState==4){
                        console.log(this.responseText);

                        var {message,type,ticket}=JSON.parse(this.responseText);
                        if(type=="error"){
                            toastr.warning(message,ticket,{positionClass:"toast-bottom-right"});
                        }
                        if(type=="success"){
                            toastr.success(message,ticket,{positionClass:"toast-bottom-right"});
                            getDataParking();
                            hideFormParking();
                        }else
                        console.log(this.responseText);

                    }
                }
                xhr.open("POST","response.php",false);
                var f=new FormData();
                f.append("nom",nom);
                f.append("adresse",adresse);
                f.append("ville",ville);
                f.append("nbrPlace",nbrPlace);
                f.append("nbrPlaceLibre",nbrPlaceLibre);
                f.append("photo",photo);
                if(document.getElementById('submitParking').value=="Moddifier"){
                    
                    f.append("op","updateParking");
                    f.append("id",idParking);
                }
                else
                f.append("op","addParking");
                xhr.send(f);

            }else
            toastr.warning("SVP le nombre de place doit etre superieur a le nombre de place libre !!","Formulaire invalide",{positionClass:"toast-bottom-right"});
        }else
        toastr.warning("SVP le nombre de place libre doit etre un entier !!","Forulaire invalide",{positionClass:"toast-bottom-right"});
      }else
        toastr.warning("SVP le nombre de place doit etre un entier !!","Formulaire invalide !!",{positionClass:"toast-bottom-right"});
}else
    toastr.warning(msg,"Formualire invalide !!",{positionClass:"toast-bottom-right"});
}
function hideFormParking(){
document.getElementById('formulaire').classList.add("formulaire");
document.getElementById('formulaire').classList.remove('showFormulaire');          
document.getElementById('photoParking').value="";               
document.getElementById('nomParking').value="";               
document.getElementById('adresseParking').value="";
document.getElementById('villeParking').value="";
document.getElementById('nbrPlace').value="";
document.getElementById('nbrPlaceLibre').value="";
document.getElementById('submitParking').value="Ajouter";
}
var offsetParking=0;
function getDataParking(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
    document.getElementById("listParking").innerHTML=this.responseText;
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","getParkings");
    f.append("offset",offsetParking);
    xhr.send(f);
}
function deleteParking(id){
    if(window.confirm("Voulez vous vraiment supprimer cet parking ?")){
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                toastr.success("Supprimer avec succes ","Operation valide",{positionClass:"toast-bottom-right"});
                getDataParking();
    
            }
        }
        xhr.open("POST","response.php",false);
        var f=new FormData();
        f.append("id",id);
        f.append("op","deleteParling");
        xhr.send(f);       
    }
}
var idParking=-1;
function updateParking(data){
var{ID,NOM,ADRESSE,VILLE,NB_PLACE,NB_PLACE_LIBRE } =data;
document.getElementById('nomParking').value=NOM;               
document.getElementById('adresseParking').value=ADRESSE;
document.getElementById('villeParking').value=VILLE;
document.getElementById('nbrPlace').value=NB_PLACE;
document.getElementById('nbrPlaceLibre').value=NB_PLACE_LIBRE;
document.getElementById('submitParking').value="Moddifier";
idParking=ID;
document.getElementById('formulaire').classList.remove("formulaire");
document.getElementById('formulaire').classList.add('showFormulaire');          
}

function DetailParking(data){
    document.getElementById("FormDetail").classList.add("showDetailForm");
    document.getElementById("FormDetail").classList.remove("detailForm");
    var {NOM,PHOTO,ADRESSE,NB_PLACE_LIBRE,NB_PLACE,VILLE}=data;
    document.getElementById("nomParkingDetail").innerHTML=NOM;
    document.getElementById("adresseParkingDetail").innerHTML=ADRESSE;
    document.getElementById("villeParkingDetail").innerHTML=VILLE;
    document.getElementById("nbrPlaceParkingDetail").innerHTML=NB_PLACE;
    document.getElementById("nbrPlaceLibreParkingDetail").innerHTML=NB_PLACE_LIBRE;
    document.getElementById("imgParkingDetail").src=PHOTO;
}
function hideFormDetail(){
    document.getElementById("FormDetail").classList.remove("showDetailForm");
    document.getElementById("FormDetail").classList.add("detailForm");
   
}
function searchParking(){
        var nom =document.getElementById('nomParkingSearch').value;
        var adresse =document.getElementById('adresseParkingSearch').value;
        var ville =document.getElementById('villeParkingSearch').value;
        var nbrPlace =document.getElementById('nbrPlaceParkingSearch').value;
        var nbrPlaceLibre =document.getElementById('nbrPlaceLibreParkingSearch').value;
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                document.getElementById("listParking").innerHTML=this.responseText;
            }
        }
        xhr.open("POST","response.php",false);
        var f=new FormData();
        f.append("nom",nom);
        f.append("adresse",adresse);
        f.append("ville",ville);
        f.append("nbrPlace",nbrPlace);
        f.append("nbrPlaceLibre",nbrPlaceLibre);
        f.append("op","searchParking");
        xhr.send(f);
}
var myChartnbrParkingParVille = null;          
var myChartnbrParkingParNbrPlace=null;
function geNbrParkingParNbrPlace(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            var data=JSON.parse(this.responseText);
            var labels1=new Array();
            var data1=new Array();
            for(i=0;i<data.length;i++){
               data1.push(data[i].NB_PLACE);
               labels1.push(data[i].NOM);
            }
            data = {
              labels: labels1,
              datasets: [{
                label: 'Les parking et leur Nombre de place',
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 205, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                  'rgb(255, 99, 132)',
                  'rgb(255, 159, 64)',
                  'rgb(255, 205, 86)',
                  'rgb(75, 192, 192)',
                  'rgb(54, 162, 235)',
                  'rgb(153, 102, 255)',
                  'rgb(201, 203, 207)'
                ],
                data: data1,
              }]
            };
            var config = {
              type: 'bar',
              data: data,
              options: {}
            };
            if(myChartnbrParkingParNbrPlace!=null){
              myChartnbrParkingParNbrPlace.destroy();
          }
          // document.getElementById('myChartnbrParkingParNbrPlace')
          myChartnbrParkingParNbrPlace = new Chart($("#myChartnbrParkingParNbrPlace"),config);
         
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","geNbrParkingParNbrPlace");
    xhr.send(f);
}
function geNbrParkingVille(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
    var data=JSON.parse(this.responseText);
    var labels1=new Array();
    var data1=new Array();
    for(i=0;i<data.length;i++){
       data1.push(data[i].NBR_PARKING);
       labels1.push(data[i].VILLE);
    }
    data = {
      labels: labels1,
      datasets: [{
        label: 'Nombre Parking par ville',
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
        data: data1,
      }]
    };
    var config = {
      type: 'bar',
      data: data,
      options: {}
    };
    if(myChartnbrParkingParVille!=null){
      myChartnbrParkingParVille.destroy();
  }
  // document.getElementById('myChartnbrParkingParVille')
  myChartnbrParkingParVille = new Chart($("#myChartnbrParkingParVille"),config);
    


        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","geNbrParkingVille");
    xhr.send(f);

}
function getLatestAddedParking(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("latestParkingAdded").innerHTML=this.responseText;
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","getLatestAddedParking");
    xhr.send(f);
}

function getClientStation(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            document.getElementById("clientStationn").innerHTML=this.responseText;
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","getClientStation");
    xhr.send(f);
}
function getParkingStation(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            document.getElementById("parkingStationn").innerHTML=this.responseText;
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","getParkingStation");
    xhr.send(f);
}
function submitBtnStationement(){
    var msg=testValidationForm(null,'validFormSationement');
     
    if(msg==""){
        var dateStation =document.getElementById("dateStationn").value;  
        var dateSorti =document.getElementById("dateSortiStationn").value;  
        var client =document.getElementById("clientStationn").value;  
        var parking =document.getElementById("parkingStationn").value;  
        var prix =document.getElementById("prixStationn").value;  
        var typeTarif =document.getElementById("typeTarifStationn").value;  
        if(isFinite(prix)==true){
          var xhr=new XMLHttpRequest();
          xhr.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var {type,message,ticket}=JSON.parse(this.responseText);
                if(type=="error")
                toastr.warning(message,ticket,{positionClass:"toast-bottom-right"});
                if(type=="success"){
                    toastr.success(message,ticket,{positionClass:"toast-bottom-right"});
                    hideFormStationnement();
                    getDataSocitertationement();

                }else
                console.log(this.responseText);
            }
          }
          xhr.open("POST","response.php",false);
          var f=new FormData();
          if(document.getElementById("submitStationement").value=="Moddifier")          
          f.append("op","updateStationnement");
          else
          f.append("op","addStationnement");
          f.append("dateStation",dateStation);
          f.append("dateSorti",dateSorti);
          f.append("client",client);
          f.append("parking",parking);
          f.append("prix",prix);
          f.append("typeTarif",typeTarif);
          f.append("id",idStationement);
          xhr.send(f);

        }else
        toastr.warning("SVP le prix doit etre un chiffre","Formulaire inalide !!",{positionClass:"toast-bottom-right"});

    }else
    
    toastr.warning(msg,"Formulaire inalide !!",{positionClass:"toast-bottom-right"});

}
function hideFormStationnement(){
    document.getElementById('formulaire').classList.add("formulaire");
    document.getElementById('formulaire').classList.remove('showFormulaire');
    document.getElementById("dateStationn").value="";  
    document.getElementById("dateSortiStationn").value="";  
    document.getElementById("clientStationn").value="";  
    document.getElementById("parkingStationn").value=""; 
    document.getElementById("prixStationn").value="";  
    document.getElementById("typeTarifStationn").value="";  
    document.getElementById("submitStationement").value="Ajouter";
}
var ofssetStationement=0;
function getDataSocitertationement(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            document.getElementById("listStationement").innerHTML=this.responseText;
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","getDataStationement");
    f.append("offsetePark",ofssetStationement);
    xhr.send(f);
}
function deleteStationnement(id){
    if(window.confirm("voulez vous vraiment suppreimer cet stationnement ?")){
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                toastr.success(this.responseText,"Operation Valide",{positionClass:"toast-bottom-right"});
                getDataSocitertationement();
            }

        }
        xhr.open("POST","response.php",false);
        var f=new FormData();
        f.append("op","deleteStationement");
        f.append("id",id);
        xhr.send(f);
    }
}
var idStationement=0;
function updateStationnement(data){
    var {ID,ID_CLIENT,DATE_STATE,ID_PARK,PRIX,TYPE_TARIF,DATE_SORTIE}=data;
    document.getElementById("dateStationn").value=DATE_STATE;  
    document.getElementById("dateSortiStationn").value=DATE_SORTIE;  
    document.getElementById("clientStationn").value=ID_CLIENT;  
    document.getElementById("parkingStationn").value=ID_PARK; 
    document.getElementById("prixStationn").value=PRIX;  
    document.getElementById("typeTarifStationn").value=TYPE_TARIF;  
    idStationement=ID;
    document.getElementById('formulaire').classList.remove("formulaire");
    document.getElementById('formulaire').classList.add('showFormulaire');
    document.getElementById("submitStationement").value="Moddifier";
}
function DetailStationnement(data){
    var {
        ADRESSE_PARKING,
        DATE_SORTIE,
        DATE_STATE,
        ID,
        ID_CLIENT,
        ID_PARK,
        NB_PLACE,
        NB_PLACE_LIBRE,
        NOM_CLIENT,
        CNE_CLIENT,
        NOM_PARKING,
        PHOTO_CLIENT,
        PHOTO_PARKING,
        PRENOM_CLIENT,
        PRIX,
        SEXE,
        TYPE_TARIF,
        VILLE_PARKING,
        }=data;
    document.getElementById("PHOTO_CLIENT_DETAIL_STATION").src=PHOTO_CLIENT;
    document.getElementById("CNE_CLIENT_DETAIL_STATION").innerHTML=CNE_CLIENT;
    document.getElementById("NOM_CLIENT_DETAIL_STATION").innerHTML=NOM_CLIENT;
    document.getElementById("PRENOM_CLIENT_DETAIL_STATION").innerHTML=PRENOM_CLIENT;
    document.getElementById("SEXE_CLIENT_DETAIL_STATION").innerHTML=SEXE;
    document.getElementById("imgParkingDetailStation").src=PHOTO_PARKING;
    document.getElementById("PARKING_NOM_DETAIL_STATION").innerHTML=NOM_PARKING;
    document.getElementById("PARKING_ADRESSE_DETAIL_STATION").innerHTML=ADRESSE_PARKING;
    document.getElementById("PARKING_VILLE_DETAIL_STATION").innerHTML=VILLE_PARKING;
    document.getElementById("PARKING_NB_PLACE_DETAIL_STATION").innerHTML=NB_PLACE;
    document.getElementById("PARKING_NB_PLACE_LIBRE_DETAIL_STATION").innerHTML=NB_PLACE_LIBRE;
    document.getElementById("DATE_DTATIONEMENT_DETAIL_STATION").innerHTML=DATE_STATE;
    document.getElementById("PRIX_DETAIL_STATION").innerHTML=PRIX;
    document.getElementById("TYPE_TARIF_DETAIL_STATION").innerHTML=TYPE_TARIF;
    document.getElementById("DATE_SORTIE_DETAIL_STATION").innerHTML=DATE_SORTIE;
    document.getElementById("FormDetail").classList.add("showDetailForm");
    document.getElementById("FormDetail").classList.remove("detailForm");
}
function hideDetailFormStation(){
    document.getElementById("FormDetail").classList.remove("showDetailForm");
    document.getElementById("FormDetail").classList.add("detailForm");

}
function searchStationement(){
 var cni_stationement=document.getElementById("cni_stationement").value;
 var nom_stationement=document.getElementById("nom_stationement").value;
 var prenom_stationement=document.getElementById("prenom_stationement").value;
 var sexe_stationement=document.getElementById("sexe_stationement").value;
 var nomParking_stationement=document.getElementById("nomParking_stationement").value;
 var adresseParking_stationement=document.getElementById("adresseParking_stationement").value;
 var villeParking_stationement=document.getElementById("villeParking_stationement").value;
 var nbrPlaceParking_stationement=document.getElementById("nbrPlaceParking_stationement").value;
 var nbrPlaceLibreParking_stationement=document.getElementById("nbrPlaceLibreParking_stationement").value;
 var date_stationement=document.getElementById("date_stationement").value;
 var dateSortie_stationement=document.getElementById("dateSortie_stationement").value;
 var prix_stationement=document.getElementById("prix_stationement").value;
 var typeTarif_stationement=document.getElementById("typeTarif_stationement").value;
 var xhr=new XMLHttpRequest();
 xhr.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
        document.getElementById("listStationement").innerHTML=this.responseText;
    }
 }
 xhr.open("POST","response.php",false);
 var f=new FormData();
 f.append("op","searchStationement");
 f.append("cni_stationement",cni_stationement);
 f.append("nom_stationement",nom_stationement);
 f.append("prenom_stationement",prenom_stationement);
 f.append("sexe_stationement",sexe_stationement);
 f.append("nomParking_stationement",nomParking_stationement);
 f.append("adresseParking_stationement",adresseParking_stationement);
 f.append("villeParking_stationement",villeParking_stationement);
 f.append("nbrPlaceParking_stationement",nbrPlaceParking_stationement);
 f.append("nbrPlaceLibreParking_stationement",nbrPlaceLibreParking_stationement);
 f.append("date_stationement",date_stationement);
 f.append("dateSortie_stationement",dateSortie_stationement);
 f.append("prix_stationement",prix_stationement);
 f.append("typeTarif_stationement",typeTarif_stationement);
 xhr.send(f);
} 
var nbrClientParClient=null;

function getNbrClientParClient(){
 var xhr=new XMLHttpRequest();
 xhr.onreadystatechange=function(){
   if(this.status==200 && this.readyState==4){
    var data=JSON.parse(this.responseText);
    var labels1=new Array();
    var data1=new Array();
    for(i=0;i<data.length;i++){
       data1.push(data[i].NBR_CLIENT);
       labels1.push(data[i].NOM);
    }
    data = {
      labels: labels1,
      datasets: [{
        label: 'Le nombre des client par parking',
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
        data: data1,
      }]
    };
    var config = {
      type: 'bar',
      data: data,
      options: {}
    };
    if(nbrClientParClient!=null){
      nbrClientParClient.destroy();
  }
  // document.getElementById('nbrClientParClient')
  nbrClientParClient = new Chart($("#nbrClientParClient"),config);

   }
   
 } 
 xhr.open("POST","response.php",false);
 var f=new FormData();
 f.append("op","getNbrClientParClient");
 xhr.send(f);
 
}
var NbrStationParClient=null;
function getNbrStationParClient(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            var data=JSON.parse(this.responseText);
            var labels1=new Array();
            var data1=new Array();
            for(i=0;i<data.length;i++){
               data1.push(data[i].NBR_STATION);
               labels1.push(data[i].NOM);
            }
            data = {
              labels: labels1,
              datasets: [{
                label: 'Le nombre des client par parking',
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 205, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                  'rgb(255, 99, 132)',
                  'rgb(255, 159, 64)',
                  'rgb(255, 205, 86)',
                  'rgb(75, 192, 192)',
                  'rgb(54, 162, 235)',
                  'rgb(153, 102, 255)',
                  'rgb(201, 203, 207)'
                ],
                data: data1,
              }]
            };
            var config = {
              type: 'bar',
              data: data,
              options: {}
            };
            if(NbrStationParClient!=null){
              NbrStationParClient.destroy();
          }
          // document.getElementById('NbrStationParClient')
          NbrStationParClient = new Chart($("#NbrStationParClient"),config);
        
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData;
    f.append("op","getNbrStationParClient");
    xhr.send(f);
}

function latestAddedStationement(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function (){
        if(this.status==200 && this.readyState==4){
            document.getElementById("latestStationAdded").innerHTML=this.responseText;
        }
    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","latestAddedStationement");
    xhr.send(f);
}
function getDataAdmin(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            var {nom,prenom,email,pw}=JSON.parse(this.responseText);
            document.getElementById("nomAdmin").value=nom;
            document.getElementById("prenomAdmin").value=prenom;
            document.getElementById("emailAdmin").value=email;
            document.getElementById("pwAdmin").value=pw;
        }

    }
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("op","getDataAdmin");
    xhr.send(f);
}
function updateAdmin(){
    var nom=document.getElementById("nomAdmin").value;
    var prenom=document.getElementById("prenomAdmin").value;
    var email=document.getElementById("emailAdmin").value;
    var pw= document.getElementById("pwAdmin").value;
    var photo=document.getElementById("photoAdmin").files.length==1?document.getElementById("photoAdmin").files[0]:null;
   if(nom!="" && prenom!="" && email!="" && pw!=""){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            var {type,message,ticket}=JSON.parse(this.responseText);
            if(type=="error"){
                toastr.warning(message,ticket,{positionClass:"toast-bottom-right"});
            }else{

                toastr.success(message,ticket,{positionClass:"toast-bottom-right"});
                window.location.reload();
            }

        }
    }      
    xhr.open("POST","response.php",false);
    var f=new FormData();
    f.append("nom",nom);
    f.append("prenom",prenom);
    f.append("email",email);
    f.append("pw",pw);
    f.append("op","updateAdmin");
    f.append("photo",photo);
    xhr.send(f);
   }else
   alert("SVP tout les champs sont obligatoire !!")

}