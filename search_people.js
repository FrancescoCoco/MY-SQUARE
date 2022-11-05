    function onThumbnailClick(json) {
    modalView = document.querySelector('#modal-view');
    document.body.classList.add('no-scroll');
    modalView.style.top = window.pageYOffset + 'px';
    for(cliccato of json) { 
    const contenuto= document.createElement("div");
    contenuto.classList.add("contenuto");
    const chiusura = document.createElement("div");
    chiusura.classList.add("chiusura");
    const imageChiusura= document.createElement("img");
    imageChiusura.classList.add("imageChiusura");
    imageChiusura.src= "chiusura.jpg"
    imageChiusura.addEventListener('click',onModalClick);
    chiusura.appendChild(imageChiusura);
    const image = document.createElement("img");
    image.classList.add("imageClick");
    image.src = cliccato.avatar;
    const informazioni= document.createElement("div");
    informazioni.classList.add("informazioni");
    const nome = document.createElement("div");
    nome.classList.add("nomeClick");
    nome.textContent="Nome "+ cliccato.nome;
    const cognome = document.createElement("div");
    cognome.classList.add("cognomeClick");
    cognome.textContent="Cognome: " +cliccato.cognome;
    const email = document.createElement("div");
    email.classList.add("emailClick");
    email.textContent="Email: "+ cliccato.email;
    const nomeUtente = document.createElement("div");
    nomeUtente.classList.add("nomeUtenteClick");
    nomeUtente.textContent="Nome Utente: "+cliccato.nomeUtente;
    const follower = document.createElement("div");
    follower.classList.add("follower");
    follower.textContent="Follower: "+ cliccato.seguaci;
    const seguiti = document.createElement("div");
    seguiti.classList.add("seguiti");
    seguiti.textContent="Seguiti: " +cliccato.seguiti;
    informazioni.appendChild(nome);
    informazioni.appendChild(cognome);
    informazioni.appendChild(email);
    informazioni.appendChild(nomeUtente);
    informazioni.appendChild(seguiti);
    informazioni.appendChild(follower);
    contenuto.appendChild(image);
    contenuto.appendChild(informazioni);
    modalView.appendChild(chiusura);
    modalView.appendChild(contenuto);
    modalView.classList.remove('hidden');
    }
  }
  
  function onModalClick() {
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML = '';
  }

function creaModale(){
   event.preventDefault();
   const imageClick = event.currentTarget;
   boxUtentecliccato= imageClick.parentNode;
   const input = boxUtentecliccato.querySelector("input[type=submit]");
   fetch("http://151.97.9.184/coco_francescomaria/HW1/Modale.php?cliccato="+input.name).then(onResponse).then(onThumbnailClick);
}


function onText(text){
     if(tastoSegui.value=="Segui"){
        tastoSegui.removeEventListener('click',smettiseguiUtente);
        tastoSegui.value= text;
        tastoSegui.addEventListener('click',seguiUtente);
     }
     if(tastoSegui.value=="Segui_già"){
        tastoSegui.removeEventListener('click',seguiUtente);
        tastoSegui.value = text;
        tastoSegui.addEventListener('click',smettiseguiUtente);
     }
     aggiorna();
}


function onJSON(json)
{   
    const boxUtenti = document.querySelector("#boxUtenti");
    boxUtenti.innerHTML = '';
    for(utente of json)
    {   
        const boxUtente = document.createElement("div");
        boxUtente.classList.add("BoxUtente");
        boxUtente.setAttribute("id",utente.nomeUtente);
        const nomeUtente = document.createElement("span");
        nomeUtente.classList.add("nomeUtente");
        nomeUtente.textContent = utente.nomeUtente;
        const avatar = document.createElement("img");
        avatar.classList.add("avatar");
        avatar.src = utente.avatar;
        boxUtente.appendChild(avatar);
        avatar.addEventListener('click', creaModale);
        boxUtente.appendChild(nomeUtente);
        const buttonBox = document.createElement("div");
        buttonBox.classList.add("buttonBox");
        const buttonFollow = document.createElement("input");
        buttonFollow.setAttribute("type", "submit");
        if(utente.isfollow=='1'){
        buttonFollow.setAttribute("value","Segui_già");
        buttonFollow.addEventListener('click',smettiseguiUtente);
        }
        else {
        buttonFollow.setAttribute("value","Segui");
            buttonFollow.addEventListener('click',seguiUtente);
        }
        buttonFollow.setAttribute("name",utente.seguito);
        buttonBox.appendChild(buttonFollow);
        boxUtente.appendChild(buttonBox);
        boxUtenti.appendChild(boxUtente);
    }
    }


function onResponse(response)
{   
    return response.json();
}

function onResponseSegui(response)
{   
    return response.text();
}


function cercaUtente(event){
event.preventDefault();
const form_data = {method: 'post', body: new FormData(formCerca)};
fetch(event.currentTarget.action, form_data).then(onResponse).then(onJSON);
}

function seguiUtente(event){
event.preventDefault();
tastoSegui = event.currentTarget;
fetch("http://151.97.9.184/coco_francescomaria/HW1/FollowPeople.php?seguito="+tastoSegui.name).then(onResponseSegui).then(onText);
}

function smettiseguiUtente(event){
    event.preventDefault();
    tastoSegui = event.currentTarget;
    fetch("http://151.97.9.184/coco_francescomaria/HW1/DisFollowPeople.php?seguito="+tastoSegui.name).then(onResponseSegui).then(onText);
    }

function aggiorna(){
    fetch("http://151.97.9.184/coco_francescomaria/HW1/OnResponse.php").then(onResponse).then(onJSON);
}

function apriModaleMenu(){
    document.body.classList.add('no-scroll');
    modalView = document.querySelector('#modal-view');
    modalView.style.top = window.pageYOffset + 'px';
    modalView.classList.remove('hidden');
    const chiusura = document.createElement("div");
    chiusura.classList.add("chiusura");
    const imageChiusura= document.createElement("img");
    imageChiusura.classList.add("imageChiusura");
    imageChiusura.src= "chiusura.jpg"
    imageChiusura.addEventListener('click',onModalClick);
    chiusura.appendChild(imageChiusura);
    const info = document.createElement("div");
    info.classList.add("contenuto");
    const contenuto= document.createElement("div");
    contenuto.classList.add("contenutoLink");
    const searchPeople = document.createElement("a");
    searchPeople.textContent= "Search_People";
    searchPeople.href="search_people.php";
    const home = document.createElement("a");
    home.textContent= "Home";
    home.href="home.php";
    const searchContent = document.createElement("a");
    searchContent.textContent= "Search_Content";
    searchContent.href="search_content.php";
    const logout = document.createElement("a");
    logout.textContent= "Logout";
    logout.href="logout.php";
    contenuto.appendChild(searchPeople);
    contenuto.appendChild(home);
    contenuto.appendChild(searchContent);
    contenuto.appendChild(logout);
    modalView.appendChild(chiusura);
    info.appendChild(contenuto);
    modalView.appendChild(info);
    modalView.classList.remove('hidden');
    }
var tastoSegui;
var modalView ;
let formCerca = document.querySelector("#RicercaUtente");
const divMenu= document.querySelector("div#menuBar");
formCerca.addEventListener('submit',cercaUtente);
divMenu.addEventListener("click",apriModaleMenu);
aggiorna(); 

