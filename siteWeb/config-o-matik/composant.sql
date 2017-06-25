CREATE TABLE filtres_composants (
       id INT NOT NULL PRIMARY KEY,
       filtre VARCHAR(250) NOT NULL
);

INSERT INTO filtres_composants (id, filtre) VALUES (0, 'Compatible avec tout');
INSERT INTO filtres_composants (id, filtre) VALUES (1, 'Intel');

CREATE TABLE composants (
       id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
       comp_type VARCHAR(30) NOT NULL,
       comp_name VARCHAR(30) NOT NULL,
       brand VARCHAR(25) NOT NULL,	
       price REAL NOT NULL,
       description VARCHAR(500) NOT NULL,
       create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       filtre INT NOT NULL DEFAULT '0' REFERENCES filtres_composants (filtre)
);

INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('cpu', 'Core i7', 'intel', 500.99, 'Super');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('cpu', 'Core i5', 'intel', 350.50, 'Cool');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('cpu', 'Pentium', 'amd', 100, 'Pas top');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('cpu', 'Tracteur', 'amd', 50, 'Not safe');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('screen', 'DLE1916E', 'Dell', 199.90, '20pouces');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('screen', 'LG19M38A-B', 'LG', 94.80, '60Hz 19pouces');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('screen', 'S19E450BW', 'SAMSUNG', 130.50, '19pouces');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('ram', 'DDR3', 'Kingstone', 21.90, 'G2o');
INSERT INTO composants (comp_type, comp_name, brand, price, description) VALUES('ram', 'DDR3', 'Corsair', 20, '2Go');
