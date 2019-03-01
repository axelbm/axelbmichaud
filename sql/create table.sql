USE gestion_reunions;

CREATE TABLE UTILISATEURS(
    courriel VARCHAR(64) NOT NULL,
    nom VARCHAR(64) NOT NULL,
    prenom VARCHAR(64) NOT NULL,
    motdepasse VARCHAR(256) NOT NULL,
    administrateur TINYINT(2) NOT NULL,
    
    PRIMARY KEY(courriel)
);


CREATE TABLE CONNEXIONS(
    courriel VARCHAR(64) NOT NULL,
    date DATETIME NOT NULL,
    cle VARCHAR(64),

    PRIMARY KEY(courriel)
);


CREATE TABLE REUNIONS(
    reunionid INT(8) NOT NULL AUTO_INCREMENT,
    date DATETIME NOT NULL,
    createur VARCHAR(64) NOT NULL,
    statut VARCHAR(8) NOT NULL,
    
    PRIMARY KEY(reunionid)
);


CREATE TABLE DOSSIERS(
    dossierid INT(8) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(64) NOT NULL,
    description TEXT NOT NULL,
    
    PRIMARY KEY(dossierid)
);


CREATE TABLE POINTDORDRES(
    pointdordreid INT(8) NOT NULL AUTO_INCREMENT,
    reunionid INT(8) NOT NULL,
    titre VARCHAR(64) NOT NULL,
    description TEXT NOT NULL,
    dossierid INT(8),
    compterendu TEXT NOT NULL,
    
    PRIMARY KEY(pointdordreid)
);


CREATE TABLE PARTICIPATIONS(
    reunionid INT(8) NOT NULL,
    courriel VARCHAR(64) NOT NULL,
    statutid VARCHAR(8) NOT NULL,
    
    PRIMARY KEY(reunionid, courriel)
);


CREATE TABLE PARTICIPATIONSTATUT(
    statutid VARCHAR(8) NOT NULL,
    nom VARCHAR(64) NOT NULL,
    description VARCHAR(512) NOT NULL,
    ordre INT NOT NULL,  
    
    PRIMARY KEY(statutid)
);


CREATE TABLE INVITATION(
    courriel VARCHAR(64) NOT NULL,
    cle VARCHAR(64) NOT NULL UNIQUE,
    
    PRIMARY KEY(courriel)
);


CREATE TABLE MESSAGES(
    auteur VARCHAR(64) NOT NULL,
    destinataire VARCHAR(64) NOT NULL,
    date DATETIME NOT NULL,
    message TEXT NOT NULL,
    vue TINYINT(1) NOT NULL,
    
    PRIMARY KEY(auteur, destinataire, date)
);


ALTER TABLE
    POINTDORDRES ADD CONSTRAINT FK_pointdordres__reunionid FOREIGN KEY(reunionid) REFERENCES REUNIONS(reunionid);
ALTER TABLE
    POINTDORDRES ADD CONSTRAINT FK_pointdordres__dossierid FOREIGN KEY(dossierid) REFERENCES DOSSIERS(dossierid);
ALTER TABLE
    PARTICIPATIONS ADD CONSTRAINT FK_participations__reunionid FOREIGN KEY(reunionid) REFERENCES REUNIONS(reunionid);
ALTER TABLE
    PARTICIPATIONS ADD CONSTRAINT FK_participations__courriel FOREIGN KEY(courriel) REFERENCES UTILISATEURS(courriel);
ALTER TABLE
    PARTICIPATIONS ADD CONSTRAINT FK_participations__statutid FOREIGN KEY(statutid) REFERENCES PARTICIPATIONT(statutid);
ALTER TABLE
    MESSAGES ADD CONSTRAINT FK_messages__auteur FOREIGN KEY(auteur) REFERENCES UTILISATEURS(courriel);
ALTER TABLE
    MESSAGES ADD CONSTRAINT FK_messages__destinataire FOREIGN KEY(destinataire) REFERENCES UTILISATEURS(courriel);
ALTER TABLE
    REUNIONS ADD CONSTRAINT FK_reunions__createur FOREIGN KEY(createur) REFERENCES UTILISATEURS(courriel);
ALTER TABLE
    CONNEXIONS ADD CONSTRAINT FK_connexions__courriel FOREIGN KEY(courriel) REFERENCES UTILISATEURS(courriel);