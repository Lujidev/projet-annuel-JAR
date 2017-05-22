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
    createur INT NOT NULL REFERENCES UTILISATEURS(id_utilisateur),
    equipier VARCHAR(255),
    /*categorie_equipe INT REFERENCES CATEGOERIES(id_categorie),*/
    categorie_equipe VARCHAR (100),
    PRIMARY KEY(nom_equipe)

);


CREATE TABLE PROJETS(

    id_projet INT NOT NULL AUTO_INCREMENT,
    nom_projet VARCHAR(50) NOT NULL,
    description_projet TEXT,
    createur INT NOT NULL REFERENCES UTILISATEURS(id_utilisateur),
    equipier VARCHAR(255),
    /*categorie_projet INT REFERENCES CATEGOERIES(id_categorie),*/
    categorie_projet VARCHAR(100) REFERENCES CATEGORIES(id_categorie),
    /*PRIMARY KEY (id_projet)*/
    img_projet VARCHAR(255) DEFAULT 'defaultProject',
    PRIMARY KEY (id_projet, nom_projet)

);


    CREATE TABLE ARTICLES(

        id_article INT NOT NULL AUTO_INCREMENT,
        nom_article VARCHAR(50) NOT NULL,
        description_article VARCHAR(100) NOT NULL,
        contenu_article TEXT NOT NULL,
        image VARCHAR(255) DEFAULT 'defaultArticle',
        auteur INT NOT NULL REFERENCES UTILISATEURS(id_utilisateur),
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
    auteur INT NOT NULL REFERENCES UTILISATEURS(id_utilisateur),
    lien_article INT NOT NULL REFERENCES ARTICLES(id_article),
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
    avatar VARCHAR(255) DEFAULT 'defaultAvatar',
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

CREATE TABLE MESSAGESP(

    id_mp INT NOT NULL AUTO_INCREMENT,
    sujet VARCHAR(255),
    contenu_mp TEXT,
    auteur_mp INT NOT NULL REFERENCES UTILISATEURS(id_article),
    destinataire_mp INT NOT NULL REFERENCES UTILISATEURS(id_article),
    is_read_mp BOOLEAN NOT NULL DEFAULT FALSE,
    date_publication_mp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id_mp)

);