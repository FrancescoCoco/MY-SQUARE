CREATE TABLE utenti ( 
nome varchar(255) ,
cognome varchar(255) , 
email varchar(255),
nomeUtente varchar(255) primary key , 
password varchar(255),
avatar varchar(255)
);

CREATE TABLE post ( 
id integer AUTO_INCREMENT  primary key,
titolo varchar(255),  
url varchar(255), 
nomeUtente varchar(255) references Utenti(nomeUtente),
dataPost datetime);

CREATE TABLE likes (
    nomeUtente varchar(255) references Utenti(nomeUtente),
    post integer references Post(id),
    Primary key(nomeUtente,post)
);

CREATE TABLE follower(
     seguace varchar(255) references Utenti(nomeUtente),
     seguito varchar(255) references Utenti(nomeUtente), 
     primary key(seguace,seguito)
);

mysql -h 151.97.9.184 -u coco_francescomaria -p7592265140
