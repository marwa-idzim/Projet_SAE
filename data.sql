USE association_sportive;

-- Création de données de notre site web

-- COMMUNES
-- id_commune, nom, CodePostal, Departement, Region


INSERT IGNORE INTO Communes VALUES
(1001, 'Paris', 75000, 75, 'Ile-de-France'),
(1002, 'Lyon', 69000, 69, 'Auvergne-Rhone-Alpes'),
(1003, 'Marseille', 13000, 13, 'Provence-Alpes-Cote dAzur'),
(1004, 'Lille', 59000, 59, 'Hauts-de-France'),
(1005, 'Bordeaux', 33000, 33, 'Nouvelle-Aquitaine'),
(1006, 'Sarcelles', 95200, 95, 'Ile-de-France'),
(1007, 'Saint-Denis', 93200, 93, 'Ile-de-France'),
(1008, 'Montreuil', 93100, 93, 'Ile-de-France'),
(1009, 'Nice', 6000, 6, 'Provence-Alpes-Cote dAzur'),
(1010, 'Strasbourg', 67000, 67, 'Grand Est');

-- SPORTS
-- id_sport, nom , Federation


INSERT IGNORE INTO Sports VALUES
(1, 'Football', 'FFF'),
(2, 'Basketball', 'FFBB'),
(3, 'Tennis', 'FFT'),
(4, 'Natation', 'FFN'),
(5, 'Rugby', 'FFR'),
(6, 'Handball', 'FFHB'),
(7, 'Volleyball', 'FFVB'),
(8, 'Athletisme', 'FFA'),
(9, 'Judo', 'FFJDA'),
(10, 'Cyclisme', 'FFC');

-- CLUBS
-- id_club,nom,nb_licencies,id_commune,id_sport

INSERT IGNORE INTO Clubs VALUES
(101, 'Paris Football Club', 350, 1001, 1),
(102, 'Lyon Basket Academy', 180, 1002, 2),
(103, 'Marseille Tennis Club', 120, 1003, 3),
(104, 'Lille Natation', 95, 1004, 4),
(105, 'Bordeaux Rugby Club', 220, 1005, 5),
(106, 'AS Sarcelles Natation', 160, 1006, 4),
(107, 'Saint-Denis Handball', 210, 1007, 6),
(108, 'Montreuil Volley Club', 140, 1008, 7),
(109, 'Nice Athletisme', 175, 1009, 8),
(110, 'Strasbourg Judo Academy', 130, 1010, 9);


-- DETAILS CLUB
-- id_detail,adresse,site_web,email ,num_tel,desc_club,id_club

INSERT IGNORE INTO Details_Club VALUES
(
    1,
    '12 rue Victor Hugo',
    'www.parisfc.fr',
    'contact@parisfc.fr',
    '0102030405',
    'Club de football parisien',
    101
),

(
    2,
    '8 avenue des Sports',
    'www.lyonbasket.fr',
    'contact@lyonbasket.fr',
    '0203040506',
    'Club de basketball de Lyon',
    102
),

(
    3,
    '25 boulevard Central',
    'www.marseilletennis.fr',
    'contact@marseilletennis.fr',
    '0304050607',
    'Club de tennis marseillais',
    103
),

(
    4,
    '15 rue du Stade',
    'www.lillenatation.fr',
    'contact@lillenatation.fr',
    '0405060708',
    'Club de natation de Lille',
    104
),

(
    5,
    '50 avenue Atlantique',
    'www.bordeauxrugby.fr',
    'contact@bordeauxrugby.fr',
    '0506070809',
    'Club de rugby bordelais',
    105
),
(
    6,
    '14 avenue de la Piscine',
    'www.sarcellesnatation.fr',
    'contact@sarcellesnatation.fr',
    '0611223344',
    'Club de natation de Sarcelles pour tous niveaux',
    106
),

(
    7,
    '2 rue des Champions',
    'www.saintdenishand.fr',
    'contact@saintdenishand.fr',
    '0622334455',
    'Club de handball de Saint-Denis',
    107
),

(
    8,
    '18 boulevard Voltaire',
    'www.montreuilvolley.fr',
    'contact@montreuilvolley.fr',
    '0633445566',
    'Club de volleyball de Montreuil',
    108
),

(
    9,
    '5 promenade des Sports',
    'www.niceathletisme.fr',
    'contact@niceathletisme.fr',
    '0644556677',
    'Club dathletisme de Nice',
    109
),

(
    10,
    '9 rue du Dojo',
    'www.strasbourgjudo.fr',
    'contact@strasbourgjudo.fr',
    '0655667788',
    'Club de judo de Strasbourg',
    110
);

-- EQUIPEMENTS
-- id_equipement,nom,type_equip,adresse,id_commune

INSERT IGNORE INTO Equipements VALUES
(
    201,
    'Stade Municipal Paris',
    'Stade',
    '10 rue du Stade',
    1001
),

(
    202,
    'Gymnase Lyon Centre',
    'Gymnase',
    '22 avenue des Sports',
    1002
),

(
    203,
    'Terrain Tennis Marseille',
    'Terrain Tennis',
    '5 rue du Tennis',
    1003
),

(
    204,
    'Piscine Lille Nord',
    'Piscine',
    '18 boulevard Nord',
    1004
),

(
    205,
    'Stade Rugby Bordeaux',
    'Stade Rugby',
    '7 avenue Atlantique',
    1005
),
(206, 'Piscine Sarcelles Olympique', 'Piscine', '3 avenue de la Piscine', 1006),

(207, 'Gymnase Saint-Denis Centre', 'Gymnase', '12 rue des Sports', 1007),

(208, 'Salle Volley Montreuil', 'Salle Sportive', '8 avenue Voltaire', 1008),

(209, 'Piste Athletisme Nice', 'Piste', '20 promenade des Sports', 1009),

(210, 'Dojo Strasbourg', 'Dojo', '4 rue du Dojo', 1010),

(211, 'Terrain Multisport Sarcelles', 'Terrain Multisport', '7 rue Victor Hugo', 1006),

(212, 'Stade Municipal Saint-Denis', 'Stade', '15 avenue Republique', 1007),

(213, 'Gymnase Montreuil Sud', 'Gymnase', '30 rue de Paris', 1008),

(214, 'Centre Sportif Nice Ouest', 'Centre Sportif', '11 avenue Mediterranee', 1009),

(215, 'Balle de Basket', 'Ballon', '9 rue des Moissons', 1010),
(216, 'Ballon de Football', 'Ballon', '30 Rue des Bles', 1009),
(217, 'Raquettes de Tennis', 'Raquette', '27 avenue Georges Brassens', 1003),
(218, 'Raquette de Ping-Pong', 'Raquette', '31 avenue de 1962', 1008),
(219, 'Chasubles', 'Vetement', '12 rue Louis XIV', 1009);


-- LICENCIES
-- id_licencies,nom,prenom ,email

INSERT IGNORE INTO Licencies VALUES
(301, 'Dupont', 'Alice', 'alice.dupont@mail.fr'),
(302, 'Martin', 'Lucas', 'lucas.martin@mail.fr'),
(303, 'Bernard', 'Emma', 'emma.bernard@mail.fr'),
(304, 'Petit', 'Tom', 'tom.petit@mail.fr'),
(305, 'Garcia', 'Lina', 'lina.garcia@mail.fr'),
(306, 'Moreau', 'Julie', 'julie.moreau@mail.fr'),
(307, 'Lefevre', 'Nathan', 'nathan.lefevre@mail.fr'),
(308, 'Roux', 'Sarah', 'sarah.roux@mail.fr'),
(309, 'Faure', 'Enzo', 'enzo.faure@mail.fr'),
(310, 'Mercier', 'Camille', 'camille.mercier@mail.fr'),
(311, 'Blanc', 'Leo', 'leo.blanc@mail.fr'),
(312, 'Guerin', 'Eva', 'eva.guerin@mail.fr'),
(313, 'Chevalier', 'Noa', 'noa.chevalier@mail.fr'),
(314, 'Francois', 'Ines', 'ines.francois@mail.fr'),
(315, 'Elhosary', 'Ramy', 'ramy.elh@mail.fr'),
(315, 'Idzim', 'Marwa', 'mrw.idz@mail.fr'),
(315, 'Andrianandrainy', 'Jim', 'jim.shan@mail.fr'),
(315, 'Mbappe', 'Kyky', 'kyky.mbappe@mail.fr');


-- SEANCES
-- id_seance, date_seance, heure_debut, heure_fin,niveau, id_club, id_equipement

INSERT IGNORE INTO Seances VALUES
(
    401,
    '2026-01-10',
    '18:00:00',
    '20:00:00',
    'Seniors',
    101,
    201
),

(
    402,
    '2026-01-11',
    '17:00:00',
    '19:00:00',
    'Debutants',
    102,
    202
),

(
    403,
    '2026-01-12',
    '16:00:00',
    '18:00:00',
    'Intermediaire',
    103,
    203
),

(
    404,
    '2026-01-13',
    '19:00:00',
    '21:00:00',
    'Seniors',
    104,
    204
),

(
    405,
    '2026-01-14',
    '18:30:00',
    '20:30:00',
    'Competition',
    105,
    205
),
(
    406,
    '2026-01-15',
    '18:00:00',
    '20:00:00',
    'Competition',
    106,
    206
),

(
    407,
    '2026-01-16',
    '17:30:00',
    '19:30:00',
    'Seniors',
    107,
    207
),

(
    408,
    '2026-01-17',
    '16:00:00',
    '18:00:00',
    'Debutants',
    108,
    208
),

(
    409,
    '2026-01-18',
    '18:30:00',
    '20:30:00',
    'Intermediaire',
    109,
    209
),

(
    410,
    '2026-01-19',
    '19:00:00',
    '21:00:00',
    'Competition',
    110,
    210
);


-- INSCRIPTIONS
-- id_inscription, nom, prenom, email, date_inscription, id_seance

INSERT IGNORE INTO Inscriptions VALUES
(
    501,
    'Dupont',
    'Alice',
    'alice.dupont@mail.fr',
    '2025-09-01',
    401
),

(
    502,
    'Martin',
    'Lucas',
    'lucas.martin@mail.fr',
    '2025-09-02',
    402
),

(
    503,
    'Bernard',
    'Emma',
    'emma.bernard@mail.fr',
    '2025-09-03',
    403
),

(
    504,
    'Petit',
    'Tom',
    'tom.petit@mail.fr',
    '2025-09-04',
    404
),

(
    505,
    'Garcia',
    'Lina',
    'lina.garcia@mail.fr',
    '2025-09-05',
    405
),
(
    506,
    'Moreau',
    'Julie',
    'julie.moreau@mail.fr',
    '2025-09-06',
    406
),

(
    507,
    'Lefevre',
    'Nathan',
    'nathan.lefevre@mail.fr',
    '2025-09-07',
    407
),

(
    508,
    'Roux',
    'Sarah',
    'sarah.roux@mail.fr',
    '2025-09-08',
    408
),

(
    509,
    'Faure',
    'Enzo',
    'enzo.faure@mail.fr',
    '2025-09-09',
    409
),

(
    510,
    'Mercier',
    'Camille',
    'camille.mercier@mail.fr',
    '2025-09-10',
    410
);