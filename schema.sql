DROP DATABASE IF EXISTS association_sportive;
CREATE DATABASE association_sportive;
USE association_sportive;

DROP TABLE Membres;
DROP TABLE Profils_Membres;
DROP TABLE Sports;
DROP TABLE Entraineurs;
DROP TABLE Equipes;
DROP TABLE Seances;
DROP TABLE Inscriptions;




-- MEMBRES

CREATE TABLE Membres (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    date_naissance DATE,
    date_inscription DATE NOT NULL
);

-- PROFILS MEMBRES (1-1)

CREATE TABLE Profils_Membres (
    id_profil INT AUTO_INCREMENT PRIMARY KEY,
    id_membre INT UNIQUE NOT NULL,
    telephone VARCHAR(20),
    adresse VARCHAR(255),
    certificat_medical BOOLEAN DEFAULT FALSE,
    contact_urgence VARCHAR(255),

    FOREIGN KEY (id_membre) REFERENCES membres(id_membre)
    ON DELETE CASCADE
);

-- SPORTS

CREATE TABLE Sports (
    id_sport INT AUTO_INCREMENT PRIMARY KEY,
    nom_sport VARCHAR(100) NOT NULL,
    description VARCHAR(1000)
);

-- ENTRAINEURS

CREATE TABLE Entraineurs (
    id_entraineur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255)
);

-- EQUIPES

CREATE TABLE Equipes (
    id_equipe INT AUTO_INCREMENT PRIMARY KEY,
    nom_equipe VARCHAR(100) NOT NULL,
    categorie VARCHAR(50),
    id_sport INT NOT NULL,
    id_entraineur INT,

    FOREIGN KEY (id_sport) REFERENCES sports(id_sport),

    FOREIGN KEY (id_entraineur) REFERENCES entraineurs(id_entraineur)
);

-- SEANCES

CREATE TABLE Seances (
    id_seance INT AUTO_INCREMENT PRIMARY KEY,
    id_equipe INT NOT NULL,
    date_seance DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    lieu VARCHAR(255),

    FOREIGN KEY (id_equipe) REFERENCES equipes(id_equipe)
    ON DELETE CASCADE
);

-- INSCRIPTIONS (N-N)

CREATE TABLE Inscriptions (
    id_membre INT,
    id_equipe INT,
    date_inscription DATE NOT NULL,
    role VARCHAR(50),

    PRIMARY KEY(id_membre, id_equipe),

    FOREIGN KEY (id_membre) REFERENCES membres(id_membre)
    ON DELETE CASCADE,

    FOREIGN KEY (id_equipe) REFERENCES equipes(id_equipe)
    ON DELETE CASCADE
);