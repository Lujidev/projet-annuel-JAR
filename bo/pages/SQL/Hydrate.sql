INSERT INTO categories(nom_categorie, description_categorie, filter) VALUES('Langage C', 'Langage de programmation', 'p');
INSERT INTO categories(nom_categorie, description_categorie, filter) VALUES('PHP', 'Langage de programmation', 'p');
INSERT INTO categories(nom_categorie, description_categorie, filter) VALUES('Langage C++', 'Langage de programmation', 'e');
INSERT INTO categories(nom_categorie, description_categorie, filter) VALUES('Nouveaute', 'Catégorie regroupant tous les nouveautés', 'a');
INSERT INTO categories(nom_categorie, description_categorie, filter) VALUES('Lua', 'Simple et efficace', 'e');
INSERT INTO categories(nom_categorie, description_categorie, filter) VALUES('Actu', 'Catégorie regroupant tous les actus', 'a');
INSERT INTO categories(nom_categorie, description_categorie, filter) VALUES('Raclette', 'De la cuisine bien lourde', 'e');

INSERT INTO droits(role) VALUES("visiteur");
INSERT INTO droits(role) VALUES("rédacteur");
INSERT INTO droits(role) VALUES("moderateur");
INSERT INTO droits(role) VALUES("membre_equipe");
INSERT INTO droits(role) VALUES("sous_chef_equipe");
INSERT INTO droits(role) VALUES("chef_equipe");

INSERT INTO projets(nom_projet, description_projet, categorie_projet) VALUES('xXx', 'un projet top secret', '1');
INSERT INTO projets(nom_projet, description_projet, categorie_projet) VALUES('Tp de langage C', 'devoir maison numero 1', '2');

INSERT INTO commentaires(contenu) VALUES('Trop lol');
INSERT INTO commentaires(contenu) VALUES('mdr!');
INSERT INTO commentaires(contenu) VALUES('cool');
