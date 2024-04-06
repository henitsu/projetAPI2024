CREATE TABLE MEDECIN(
   ID_MEDECIN INT AUTO_INCREMENT,
   CIVILITE VARCHAR(5) NOT NULL,
   NOM VARCHAR(50) NOT NULL,
   PRENOM VARCHAR(50) NOT NULL,
   CONSTRAINT PK_MEDECIN PRIMARY KEY(ID_MEDECIN)
);

CREATE TABLE USAGER(
   ID_USAGER INT AUTO_INCREMENT,
   CIVILITE VARCHAR(50) NOT NULL,
   NOM VARCHAR(50) NOT NULL,
   PRENOM VARCHAR(50) NOT NULL,
   SEXE CHAR(1) NOT NULL,
   ADRESSE VARCHAR(50) NOT NULL,
   CODE_POSTAL CHAR(5) NOT NULL,
   VILLE VARCHAR(50) NOT NULL,
   DATE_NAIS DATE NOT NULL,
   LIEU_NAIS VARCHAR(50) NOT NULL,
   NUM_SECU CHAR(15) NOT NULL,
   ID_MEDECIN INT NOT NULL,
   CONSTRAINT PK_USAGER PRIMARY KEY(ID_USAGER),
   CONSTRAINT AK_USAGER UNIQUE(NUM_SECU),
   CONSTRAINT FK_USAGER_MEDECIN FOREIGN KEY(ID_MEDECIN) REFERENCES MEDECIN(ID_MEDECIN)
);

CREATE TABLE CONSULTATION(
   ID_CONSULT INT AUTO_INCREMENT,
   DATE_CONSULT DATE NOT NULL,
   HEURE_CONSULT TIME NOT NULL,
   DUREE_CONSULT TINYINT NOT NULL,
   ID_MEDECIN INT NOT NULL,
   ID_USAGER INT NOT NULL,
   CONSTRAINT PK_CONSULTATION PRIMARY KEY(ID_CONSULT),
   CONSTRAINT AK_CONSULTATION_IDX2 UNIQUE(ID_MEDECIN, DATE_CONSULT, HEURE_CONSULT),
   CONSTRAINT AK_CONSULTATION_IDX1 UNIQUE(ID_USAGER, DATE_CONSULT, HEURE_CONSULT),
   CONSTRAINT FK_CONSULTATION_MEDECIN FOREIGN KEY(ID_MEDECIN) REFERENCES MEDECIN(ID_MEDECIN),
   CONSTRAINT FK_CONSULTATION_USAGER FOREIGN KEY(ID_USAGER) REFERENCES USAGER(ID_USAGER)
);