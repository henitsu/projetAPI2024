CREATE TABLE medecin(
   Id_Medecin INT AUTO_INCREMENT,
   Civilite VARCHAR(50),
   Nom VARCHAR(50),
   Prenom VARCHAR(50),
   PRIMARY KEY(Id_Medecin)
);

CREATE TABLE usager(
   idusager INT AUTO_INCREMENT,
   Civilite VARCHAR(50),
   Nom VARCHAR(50),
   Prenom VARCHAR(50),
   Adresse VARCHAR(50),
   DateNaissance DATE,
   LieuNaissance VARCHAR(50),
   NumSecu VARCHAR(50),
   Id_Medecin INT NOT NULL,
   PRIMARY KEY(idusager),
   FOREIGN KEY(Id_Medecin) REFERENCES medecin(Id_Medecin)
);

CREATE TABLE secretaire(
   Id_Secretaire INT AUTO_INCREMENT,
   Civilite VARCHAR(50),
   Nom VARCHAR(50),
   Prenom VARCHAR(50),
   Login VARCHAR(10),
   PRIMARY KEY(Id_Secretaire)
);

CREATE TABLE rdv(
   idusager INT,
   Id_Medecin INT,
   DateHeureRDV DATETIME,
   DureeConsultationMinutes INT,
   PRIMARY KEY(idusager, Id_Medecin, DateHeureRDV),
   FOREIGN KEY(idusager) REFERENCES usager(idusager),
   FOREIGN KEY(Id_Medecin) REFERENCES medecin(Id_Medecin)
);

INSERT INTO `secretaire` (`Id_Secretaire`, `Civilite`, `Nom`, `Prenom`, `Login`) VALUES ('1', 'Mlle', 'Jonquille', 'Tamara', 'TJonquille');
INSERT INTO `secretaire` (`Id_Secretaire`, `Civilite`, `Nom`, `Prenom`, `Login`) VALUES ('2', 'Mme', 'Lapin', 'Marie', 'MLapin');
INSERT INTO `secretaire` (`Id_Secretaire`, `Civilite`, `Nom`, `Prenom`, `Login`) VALUES ('3', 'Mlle', 'Coquelicot', 'Annie', 'ACoquelicot');
INSERT INTO `secretaire` (`Id_Secretaire`, `Civilite`, `Nom`, `Prenom`, `Login`) VALUES ('4', 'Mme', 'Tulipe', 'Suzanne', 'STulipe');
INSERT INTO `secretaire` (`Id_Secretaire`, `Civilite`, `Nom`, `Prenom`, `Login`) VALUES ('5', 'M', 'Brioche', 'Bobby', 'BBrioche');
INSERT INTO `secretaire` (`Id_Secretaire`, `Civilite`, `Nom`, `Prenom`, `Login`) VALUES ('6', 'M', 'Bouvier', 'Christophe', 'CBouvier');

INSERT INTO `medecin` (`Id_Medecin`, `Civilite`, `Nom`, `Prenom`) VALUES ('1', 'M', 'Dupont', 'Pierre');
INSERT INTO `medecin` (`Id_Medecin`, `Civilite`, `Nom`, `Prenom`) VALUES ('2', 'Mme', 'Dupuis', 'Jeanne');
INSERT INTO `medecin` (`Id_Medecin`, `Civilite`, `Nom`, `Prenom`) VALUES ('3', 'M', 'Dujardin', 'Jean');
INSERT INTO `medecin` (`Id_Medecin`, `Civilite`, `Nom`, `Prenom`) VALUES ('4', 'Mme', 'Dujour', 'Marine');

INSERT INTO `usager` (`idusager`, `Civilite`, `Nom`, `Prenom`, `Adresse`, `DateNaissance`, `LieuNaissance`, `NumSecu`, `Id_Medecin`) VALUES ('1', 'M', 'Briard', 'Bernard', 'adresse Bernard Briard', '1966-10-10', 'Toulouse', 'A1234567890', '1');
INSERT INTO `usager` (`idusager`, `Civilite`, `Nom`, `Prenom`, `Adresse`, `DateNaissance`, `LieuNaissance`, `NumSecu`, `Id_Medecin`) VALUES ('2', 'M', 'Degeois', 'Alexis', 'adresse Alexis Degeois', '2000-11-11', 'Paris', 'B1234567890', '2');
INSERT INTO `usager` (`idusager`, `Civilite`, `Nom`, `Prenom`, `Adresse`, `DateNaissance`, `LieuNaissance`, `NumSecu`, `Id_Medecin`) VALUES ('3', 'M', 'Meunier', 'Samuel', 'adresse Samuel Meunier', '1989-12-12', 'Nice', 'C1234567890', '3');
INSERT INTO `usager` (`idusager`, `Civilite`, `Nom`, `Prenom`, `Adresse`, `DateNaissance`, `LieuNaissance`, `NumSecu`, `Id_Medecin`) VALUES ('4', 'Mme', 'Laroche', 'Johana', 'adresse Johana Laroche', '1980-01-01', 'Paris', 'D1234567890', '4');
INSERT INTO `usager` (`idusager`, `Civilite`, `Nom`, `Prenom`, `Adresse`, `DateNaissance`, `LieuNaissance`, `NumSecu`, `Id_Medecin`) VALUES ('5', 'Mme', 'Lemaire', 'Kathie', 'adresse Kathie Lemaire', '2000-02-02', 'Agen', 'E1234567890', '1');
INSERT INTO `usager` (`idusager`, `Civilite`, `Nom`, `Prenom`, `Adresse`, `DateNaissance`, `LieuNaissance`, `NumSecu`, `Id_Medecin`) VALUES ('6', 'Mme', 'Meyer', 'Sarah', 'adresse Sarah Meyer', '1989-09-09', 'Brest', 'F1234567890', '2');

INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('1', '1', '2024-12-18 14:00:00', '30');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('2', '2', '2024-02-21 08:00:00', '60');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('3', '3', '2024-01-11 18:00:00', '30');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('4', '4', '2024-03-28 15:30:00', '30');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('5', '1', '2024-02-21 13:00:00', '60');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('6', '2', '2024-03-13 12:45:00', '30');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('3', '3', '2024-03-28 19:00:00', '30');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('4', '4', '2024-05-10 11:30:00', '60');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('5', '1', '2024-04-18 10:00:00', '30');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('6', '2', '2024-03-27 9:00:00', '30');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('1', '1', '2024-06-10 16:00:00', '60');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('2', '2', '2024-03-12 17:30:00', '30');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('5', '1', '2024-08-11 14:30:00', '60');
INSERT INTO `rdv` (`idusager`, `Id_Medecin`, `DateHeureRDV`, `DureeConsultationMinutes`) VALUES ('6', '2', '2024-04-30 16:45:00', '60');
