mysql

CREATE TABLE 'checkpoint1'.'pot_de_vin'(
'id' INT NOT NULL AUTO_INCREMENT,
'name' VARCHAR(100) NOT NULL,
'payment' INT NOT NULL,
PRIMARY KEY ('id'));


CREATE TABLE checkpoint1.pot_de_vin(
id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(100) NOT NULL,
payment INT NOT NULL,
PRIMARY KEY (id));

INSERT INTO checkpoint1.pot_de_vin(`name`, `payment`) VALUES ('harry', '500');
INSERT INTO checkpoint1.pot_de_vin(`name`, `payment`) VALUES ('henry', '1500');
INSERT INTO checkpoint1.pot_de_vin(`name`, `payment`) VALUES ('larry', '500');
INSERT INTO checkpoint1.pot_de_vin(`name`, `payment`) VALUES ('john', '500');
INSERT INTO checkpoint1.pot_de_vin(`name`, `payment`) VALUES ('jack', '2500');
INSERT INTO checkpoint1.pot_de_vin(`name`, `payment`) VALUES ('al', '500');
INSERT INTO checkpoint1.pot_de_vin(`name`, `payment`) VALUES ('robert', '5500');


