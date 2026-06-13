DROP DATABASE IF EXISTS association_sportive;
CREATE DATABASE association_sportive;
USE association_sportive;



-- COMMUNES

CREATE TABLE Communes (
    id_commune BIGINT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    CodePostal INT NOT NULL,
    Departement INT NOT NULL,
    Region VARCHAR(50) NOT NULL,

    CONSTRAINT PK_Communes PRIMARY KEY (id_commune)
);

-- SPORTS

CREATE TABLE Sports (
    id_sport BIGINT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    Federation VARCHAR(50) NOT NULL,

    CONSTRAINT PK_Sports PRIMARY KEY (id_sport)
);

-- CLUBS

CREATE TABLE Clubs (
    id_club BIGINT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    nb_licencies INT NOT NULL,

    id_commune BIGINT NOT NULL,
    id_sport BIGINT NOT NULL,

    CONSTRAINT PK_Clubs PRIMARY KEY (id_club),
    CONSTRAINT FK_Clubs_Communes FOREIGN KEY (id_commune) REFERENCES Communes(id_commune)
        ON DELETE CASCADE,
    CONSTRAINT FK_Clubs_Sports FOREIGN KEY (id_sport) REFERENCES Sports(id_sport)
        ON DELETE CASCADE
);

-- DETAILS_CLUB (relation 1-1)

CREATE TABLE Details_Club (
    id_detail BIGINT NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    site_web VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    num_tel VARCHAR(15) NOT NULL,
    desc_club VARCHAR(200) NOT NULL,

    id_club BIGINT NOT NULL UNIQUE,

    CONSTRAINT PK_Details_Club PRIMARY KEY (id_detail),
    CONSTRAINT FK_Details_Club_Clubs FOREIGN KEY (id_club) REFERENCES Clubs(id_club)
        ON DELETE CASCADE
);

-- EQUIPEMENTS

CREATE TABLE Equipements (
    id_equipement BIGINT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    type_equip VARCHAR(50) NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    
    id_commune BIGINT NOT NULL,

    CONSTRAINT PK_Equipements PRIMARY KEY (id_equipement),
    CONSTRAINT FK_Equipements_Communes FOREIGN KEY (id_commune) REFERENCES Communes(id_commune)
        ON DELETE CASCADE
);

-- LICENCIES

CREATE TABLE Licencies (
    id_licencies BIGINT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255),

    CONSTRAINT PK_Licencies PRIMARY KEY (id_licencies)
);

-- SEANCES

CREATE TABLE Seances (
    id_seance BIGINT NOT NULL,
    date_seance DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    niveau VARCHAR(40) NOT NULL,   --débutants, seniors, etc

    id_club BIGINT NOT NULL,
    id_equipement BIGINT NOT NULL,

    CONSTRAINT PK_Seances PRIMARY KEY (id_seance),
    CONSTRAINT FK_Seances_Clubs FOREIGN KEY (id_club) REFERENCES Clubs(id_club)
        ON DELETE CASCADE,
    CONSTRAINT FK_Seances_Equipements FOREIGN KEY (id_equipement) REFERENCES Equipements(id_equipement)
        ON DELETE CASCADE
);

-- INSCRIPTIONS  (relation N-N)

CREATE TABLE Inscriptions (
    id_inscription BIGINT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255),
    date_inscription DATE NOT NULL,

    id_seance BIGINT NOT NULL,

    CONSTRAINT PK_Inscriptions PRIMARY KEY (id_inscription),
    CONSTRAINT FK_Inscriptions_Seances FOREIGN KEY (id_seance) REFERENCES Seances(id_seance)
        ON DELETE CASCADE
);
