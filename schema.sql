DROP DATABASE IF EXISTS association_sportive;
CREATE DATABASE association_sportive CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE association_sportive;

CREATE TABLE Communes (
    id_commune BIGINT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    CodePostal INT NOT NULL,
    Departement INT NOT NULL,
    Region VARCHAR(80) NOT NULL,
    CONSTRAINT PK_Communes PRIMARY KEY (id_commune)
);

CREATE TABLE Sports (
    id_sport BIGINT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    Federation VARCHAR(50) NOT NULL,
    CONSTRAINT PK_Sports PRIMARY KEY (id_sport)
);

CREATE TABLE Clubs (
    id_club BIGINT NOT NULL,
    nom VARCHAR(80) NOT NULL,
    id_commune BIGINT NOT NULL,
    id_sport BIGINT NOT NULL,
    CONSTRAINT PK_Clubs PRIMARY KEY (id_club),
    CONSTRAINT FK_Clubs_Communes FOREIGN KEY (id_commune) REFERENCES Communes(id_commune) ON DELETE CASCADE,
    CONSTRAINT FK_Clubs_Sports FOREIGN KEY (id_sport) REFERENCES Sports(id_sport) ON DELETE CASCADE
);

CREATE TABLE Details_Club (
    id_detail BIGINT NOT NULL,
    adresse VARCHAR(100) NOT NULL,
    site_web VARCHAR(100),
    email VARCHAR(100),
    num_tel VARCHAR(20),
    desc_club TEXT,
    id_club BIGINT NOT NULL,
    CONSTRAINT PK_Details_Club PRIMARY KEY (id_detail),
    CONSTRAINT UQ_Details_Club UNIQUE (id_club),
    CONSTRAINT FK_Details_Club_Clubs FOREIGN KEY (id_club) REFERENCES Clubs(id_club) ON DELETE CASCADE
);

CREATE TABLE Equipements (
    id_equipement BIGINT NOT NULL,
    nom VARCHAR(80) NOT NULL,
    type_equip VARCHAR(50) NOT NULL,
    adresse VARCHAR(100) NOT NULL,
    id_commune BIGINT NOT NULL,
    CONSTRAINT PK_Equipements PRIMARY KEY (id_equipement),
    CONSTRAINT FK_Equipements_Communes FOREIGN KEY (id_commune) REFERENCES Communes(id_commune) ON DELETE CASCADE
);

CREATE TABLE Licencies (
    id_licencies BIGINT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    CONSTRAINT PK_Licencies PRIMARY KEY (id_licencies),
    CONSTRAINT UQ_Licencies_Email UNIQUE (email)
);

CREATE TABLE Seances (
    id_seance BIGINT NOT NULL,
    date_seance DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    niveau VARCHAR(50) NOT NULL,
    id_club BIGINT NOT NULL,
    id_equipement BIGINT NOT NULL,
    CONSTRAINT PK_Seances PRIMARY KEY (id_seance),
    CONSTRAINT FK_Seances_Clubs FOREIGN KEY (id_club) REFERENCES Clubs(id_club) ON DELETE CASCADE,
    CONSTRAINT FK_Seances_Equipements FOREIGN KEY (id_equipement) REFERENCES Equipements(id_equipement) ON DELETE CASCADE
);

CREATE TABLE Inscriptions (
    id_inscription BIGINT NOT NULL,
    date_inscription DATE NOT NULL,
    id_licencies BIGINT NOT NULL,
    id_seance BIGINT NOT NULL,
    CONSTRAINT PK_Inscriptions PRIMARY KEY (id_inscription),
    CONSTRAINT FK_Inscriptions_Licencies FOREIGN KEY (id_licencies) REFERENCES Licencies(id_licencies) ON DELETE CASCADE,
    CONSTRAINT FK_Inscriptions_Seances FOREIGN KEY (id_seance) REFERENCES Seances(id_seance) ON DELETE CASCADE,
    CONSTRAINT UQ_Licencie_Seance UNIQUE (id_licencies, id_seance)
);
