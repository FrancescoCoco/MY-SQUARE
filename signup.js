function onJSON(json)
{   
    const erroreNomeUtente = document.querySelector("#ErroreNomeUtente");
    erroreNomeUtente.innerHTML = "";
    for(utenti of json)
    {         
        if(utenti.nomeUtente.toUpperCase() == testo.value.toUpperCase()){
            erroreNomeUtente.innerHTML ="Nome Utente non disponibile";
        }
    }
}

function onResponse(response)
{
    return response.json();
}

function controlloUser(event){
    fetch("http://151.97.9.184/coco_francescomaria/HW1/controlUsername.php").then(onResponse).then(onJSON);
    testo= event.currentTarget;
    event.preventDefault();
}

function controlloReg(event){
    const errore = document.querySelector("#Errore")
    const errorePassword = document.querySelector("#ErrorePassword");
    const erroreMail = document.querySelector("#ErroreMail");
    errorePassword.innerHTML = "";
    erroreMail.innerHTML = "";

    if( formR.nome.value.length == 0 ||
        formR.cognome.value.length == 0 || 
        formR.nomeUtente.value.length == 0 ||
        formR.password.value.length == 0 || 
        formR.email.value.length == 0 ||
        formR.Cpassword.value.length == 0 
    )
     {
         
          errore.innerHTML= "Compila i campi Obbligatori!";
          event.preventDefault();
     }

     else if(formR.Cpassword.value != formR.password.value){
                errorePassword.innerHTML="Hai inserito due password differenti";
                event.preventDefault();
     }
            
     else if(formR.email.value.indexOf("@")== -1){
            erroreMail.innerHTML = "Hai inserito un'email non valida";
             event.preventDefault();
     }
}

const formR = document.querySelector("#Iscrizione");
const user = document.querySelector('label input[name = nomeUtente]');
var testo ;
formR.addEventListener('submit',controlloReg);
user.addEventListener('blur',controlloUser);

