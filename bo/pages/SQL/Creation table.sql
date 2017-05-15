CREATE TABLE CATEGORIES(

    id_categorie INT NOT NULL AUTO_INCREMENT,
    nom_categorie VARCHAR(50) NOT NULL,
    description_categorie VARCHAR(255),
    filter CHAR(1) NOT NULL,
    PRIMARY KEY(id_categorie)

);


CREATE TABLE EQUIPES(

    nom_equipe VARCHAR(50) NOT NULL,
    description_equipe VARCHAR(255),
    nb_article INT NOT NULL DEFAULT '0',
    /*categorie_equipe INT REFERENCES CATEGOERIES(id_categorie),*/
    categorie_equipe VARCHAR (100),
    PRIMARY KEY(nom_equipe)

);


CREATE TABLE PROJETS(

    id_projet INT NOT NULL AUTO_INCREMENT,
    nom_projet VARCHAR(50) NOT NULL,
    description_projet TEXT,
    /*categorie_projet INT REFERENCES CATEGOERIES(id_categorie),*/
    categorie_projet VARCHAR(100) REFERENCES CATEGORIES(id_categorie),
    /*PRIMARY KEY (id_projet)*/
    PRIMARY KEY (id_projet, nom_projet)

);


    CREATE TABLE ARTICLES(

        id_article INT NOT NULL AUTO_INCREMENT,
        nom_article VARCHAR(50) NOT NULL,
        description_article VARCHAR(100) NOT NULL,
        contenu_article TEXT NOT NULL,
        image TEXT NULL,
        date_publication TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
        date_modification TIMESTAMP NULL DEFAULT NULL,
        is_delete BOOLEAN NOT NULL DEFAULT FALSE,
        /*categorie_article INT REFERENCES CATEGOERIES(id_categorie),*/
        categorie_article VARCHAR(100),
        PRIMARY KEY (id_article)

    );


CREATE TABLE COMMENTAIRES(
    
    id_commentaire INT NOT NULL AUTO_INCREMENT,
    contenu TEXT,
    date_publication TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    date_modification TIMESTAMP NULL DEFAULT NULL,
    is_delete BOOLEAN NOT NULL DEFAULT FALSE,
    article INT REFERENCES articles(id_article),
    PRIMARY KEY (id_commentaire)

);


CREATE TABLE DROITS(

    id_droit int NOT NULL AUTO_INCREMENT,
    role VARCHAR(50),
    PRIMARY KEY (id_droit)

);


CREATE TABLE UTILISATEURS(

    id_utilisateur INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL,
    pseudo VARCHAR(50) NOT NULL,
    avatar TEXT NULL,
    mdp CHAR(60) NOT NULL,
    presentation TEXT,
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    date_modification TIMESTAMP NULL DEFAULT NULL,
    activation BOOLEAN NOT NULL DEFAULT FALSE,
    is_deleted BOOLEAN NOT NULL DEFAULT FALSE,
    access_token CHAR(32),
    droit INT REFERENCES DROITS(id_droit),
    PRIMARY KEY(id_utilisateur)

);


CREATE TABLE RASSEMBLE(
    
    utilisateur INT REFERENCES UTILISATEURS(id_utilisateur),
    nom_equipe VARCHAR(50) REFERENCES EQUIPES(nom),
    droit INT REFERENCES DROITS(id_droit),
    token_temp CHAR(32),
    PRIMARY KEY (utilisateur, nom_equipe)

);