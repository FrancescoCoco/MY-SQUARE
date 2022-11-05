function controlloLog(event){
    const campoVuoto = document.querySelector("#Errore");
    campoVuoto.innerHTML = "";
    if(formL.nomeUtente.value.length == 0 ||formL.password.value.length == 0)
     {
         campoVuoto.innerHTML="Non hai inserito dati";
         event.preventDefault();
     }
     
}

const formL = document.querySelector("#LogIn");
formL.addEventListener('submit',controlloLog);





