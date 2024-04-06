-- Création de la table medecin
CREATE TABLE medecin(
   id_medecin INT AUTO_INCREMENT,
   civilite VARCHAR(5) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   CONSTRAINT pk_medecin PRIMARY KEY(id_medecin)
);

-- Création de la table usager
CREATE TABLE usager(
   id_usager INT AUTO_INCREMENT,
   civilite VARCHAR(50) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   sexe CHAR(1) NOT NULL,
   adresse VARCHAR(50) NOT NULL,
   code_postal CHAR(5) NOT NULL,
   ville VARCHAR(50) NOT NULL,
   date_nais DATE NOT NULL,
   lieu_nais VARCHAR(50) NOT NULL,
   num_secu CHAR(15) NOT NULL,
   id_medecin INT NOT NULL,
   CONSTRAINT pk_usager PRIMARY KEY(id_usager),
   CONSTRAINT ak_usager UNIQUE(num_secu),
   CONSTRAINT fk_usager_medecin FOREIGN KEY(id_medecin) REFERENCES medecin(id_medecin)
);

-- Création de la table consultation
CREATE TABLE consultation(
   id_consult INT AUTO_INCREMENT,
   date_consult DATE NOT NULL,
   heure_consult TIME NOT NULL,
   duree_consult TINYINT NOT NULL,
   id_medecin INT NOT NULL,
   id_usager INT NOT NULL,
   CONSTRAINT pk_consultation PRIMARY KEY(id_consult),
   CONSTRAINT ak_consultation_idx2 UNIQUE(id_medecin, date_consult, heure_consult),
   CONSTRAINT ak_consultation_idx1 UNIQUE(id_usager, date_consult, heure_consult),
   CONSTRAINT fk_consultation_medecin FOREIGN KEY(id_medecin) REFERENCES medecin(id_medecin),
   CONSTRAINT fk_consultation_usager FOREIGN KEY(id_usager) REFERENCES usager(id_usager)
);

-- Insertion des données pour medecin

INSERT INTO medecin (civilite, nom, prenom) VALUES ('M.', 'Mermoz', 'Jean');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('M.', 'Saint-Exupery', 'Antoine');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('M.', 'Guillaumet', 'Henri');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('M.', 'Lindbergh', 'Charles');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('Mme', 'Earhart', 'Amelia');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('M.', 'Yeager', 'Chuck');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('M.', 'Gagarin', 'Yuri');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('Mme', 'Auriol', 'Jacqueline');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('Mme', 'Terechkova', 'Valentina');
INSERT INTO medecin (civilite, nom, prenom) VALUES ('M.', 'White', 'Edward');

-- Insertion des données pour usager
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Itadori', 'Yuji', 'M', '123 Fantasy Street', '75001', 'Magic City', '1996-03-20', 'Fairyland', '123456789012345', 1);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('Mme', 'Kugisaki', 'Nobara', 'F', '456 Fantasy Street', '75002', 'Magic City', '1997-08-07', 'Fairyland', '234567890123456', 2);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Fushiguro', 'Megumi', 'M', '789 Fantasy Street', '75003', 'Magic City', '1998-12-22', 'Fairyland', '345678901234567', 3);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Satoru', 'Gojo', 'M', '88 Tokyo Street', '75003', 'Tokyo', '1989-12-22', 'Fairyland', '425347586972825', 3);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Nanami', 'Kento', 'M', '89 Tokyo Street', '75003', 'Tokyo', '1988-02-16', 'Fairyland', '637289453619805', 1);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Mouse', 'Mickey', 'M', '123 Disney Lane', '75004', 'Magic City', '1928-11-18', 'Fairyland', '456789012345678', 4);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('Mme', 'Duck', 'Daisy', 'F', '456 Disney Lane', '75005', 'Magic City', '1940-01-09', 'Fairyland', '567890123456789', 5);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Ali', 'Aladdin', 'M', '789 Disney Lane', '75015', 'Magic City', '1992-11-25', 'Fairyland', '987654321098765', 6);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('Mme', 'Mermaid', 'Ariel', 'F', '102 Ocean Palace', '75008', 'Atlantica', '1989-11-17', 'Under the Sea', '123456789012348', 9);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('Mme', 'Tower', 'Rapunzel', 'F', '103 Tower Street', '75009', 'Corona', '2010-11-24', 'Hidden Tower', '123456789012349', 10);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Midoriya', 'Izuku', 'M', '789 Hero Avenue', '75010', 'Musutafu', '2002-07-15', 'Musutafu', '456123789012345', 1);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('Mme', 'Yaoyorozu', 'Momo', 'F', '456 Hero Avenue', '75011', 'Musutafu', '2003-09-23', 'Musutafu', '567234890123456', 2);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Bakugo', 'Katsuki', 'M', '123 Hero Avenue', '75012', 'Musutafu', '2002-04-20', 'Musutafu', '678345901234567', 3);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Uraraka', 'Ochaco', 'F', '789 Hero Avenue', '75013', 'Musutafu', '2001-12-27', 'Musutafu', '789456012345678', 4);
INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES ('M.', 'Todoroki', 'Shoto', 'M', '456 Hero Avenue', '75014', 'Musutafu', '2002-01-11', 'Musutafu', '890567123456789', 5);

-- Insertion des données pour les consultations
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-10', '09:00:00', 30, 1, 2);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-11', '10:00:00', 45, 2, 3);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-12', '11:00:00', 60, 3, 4);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-13', '14:00:00', 30, 4, 5);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-14', '15:00:00', 45, 5, 6);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-15', '16:00:00', 60, 6, 7);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-16', '09:30:00', 30, 7, 8);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-17', '10:30:00', 45, 8, 9);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-18', '11:30:00', 60, 9, 10);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-19', '14:30:00', 30, 10, 1);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-20', '15:30:00', 45, 1, 2);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-21', '16:30:00', 60, 2, 3);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-22', '09:45:00', 30, 3, 4);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-23', '10:45:00', 45, 4, 5);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-24', '09:30:00', 30, 1, 11);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-25', '10:30:00', 45, 2, 12);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-26', '11:30:00', 60, 3, 13);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-27', '14:30:00', 30, 4, 14);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-28', '15:30:00', 45, 5, 1);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-29', '09:00:00', 30, 6, 2);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-04-30', '10:00:00', 45, 7, 3);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-05-01', '11:00:00', 60, 8, 4);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-05-02', '14:00:00', 30, 9, 5);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-05-03', '15:00:00', 45, 10, 6);
INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES ('2024-05-04', '16:00:00', 60, 1, 7);