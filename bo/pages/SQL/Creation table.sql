CREATE TABLE CATEGORIES(

    id_categorie INT NOT NULL AUTO_INCREMENT,
    nom_categorie VARCHAR(50) NOT NULL,
    description_categorie VARCHAR(255),
    filter CHAR(1) NOT NULL,
    PRIMARY KEY(id_categorie)

);


CREATE TABLE EQUIPES(

    id INT NOT NULL AUTO_INCREMENT,
    nom_equipe VARCHAR(50) NOT NULL,
    description_equipe VARCHAR(255),
    nb_article INT NOT NULL DEFAULT '0',
    createur INT NOT NULL REFERENCES UTILISATEURS(id_utilisateur),
    equipier VARCHAR(255),
    /*categorie_equipe INT REFERENCES CATEGOERIES(id_categorie),*/
    categorie_equipe VARCHAR (100),
    PRIMARY KEY(id)

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
        is_deleted BOOLEAN NOT NULL DEFAULT FALSE,
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
    is_deleted BOOLEAN NOT NULL DEFAULT FALSE,
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
    activation VARCHAR(255) NOT NULL DEFAULT FALSE,
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
    pj_mp VARCHAR(500),
    is_read_mp BOOLEAN NOT NULL DEFAULT FALSE,
    is_deleted_auteur BOOLEAN NOT NULL DEFAULT FALSE,
    is_deleted_destinataire BOOLEAN NOT NULL DEFAULT FALSE,
    date_publication_mp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id_mp)

);

CREATE TABLE NOTIFICATIONS(
    id_notif INT NOT NULL AUTO_INCREMENT,
    preview VARCHAR(255),
    sujet VARCHAR(255),
    notif_desc VARCHAR(255),
    id_link INT REFERENCES UTILISATEURS(id_utilisateur),
    filter VARCHAR(30),
    send_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id_notif)
);

CREATE TABLE TODO(
    id_todo INT NOT NULL AUTO_INCREMENT,
    content VARCHAR(255),
    team INT,
    is_done BOOLEAN NOT NULL,
    PRIMARY KEY (id_todo)
);

CREATE TABLE TEAMMATES(
    id_team_link INT NOT NULL AUTO_INCREMENT,
    id_team INT,
    id_user INT,
    is_accepted VARCHAR(255),
    PRIMARY KEY (id_team_link)
);