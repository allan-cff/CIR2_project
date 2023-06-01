DELETE FROM album;
DELETE FROM artiste;
DELETE FROM morceau;
DELETE FROM playlist;
DELETE FROM style_musique;
DELETE FROM utilisateur;
DELETE FROM admin;
DELETE FROM a_creer;
DELETE FROM contenu_dans;
DELETE FROM appartient_a;
DELETE FROM cree_par;
DELETE FROM liste_attente;

INSERT INTO album (titre,date_parution) VALUES 
('The Dark Side of the Moon', '1973-03-01'),
('Kamikaze', '2018-08-31'),
('Etrange histoire de monsieur Anderson','2022-06-22');

INSERT INTO type_artiste (type) VALUES 
('Chanteur'),
('Groupe'),
('Compositeur'),
('DJ'),
('Producteur');

INSERT INTO artiste (nom,description,nb_auditeurs,id_type_artiste) VALUES
('Eminem', 'Rappeur anglais, tres fort, il rap tres vite, bravo !', 66000000, 1),
('Nekfeu', 'Rappeur français, tres fort, il rap tres vite, bravo !', 9600000, 1),
('Damso', 'Rappeur belge, tres fort, il rap tres vite, bravo !', 670000, 1),
('Orelsan', 'Rappeur français, tres fort, il rap tres vite, bravo !', 1000, 1),
('PNL', 'Rappeur français, tres fort, il rap tres vite, bravo !', 400000, 2),
('Lomepal', 'Rappeur français, tres fort, il rap tres vite, bravo !', 757000, 1),
('Bigflo et Oli', 'Rappeur français, tres fort, il rap tres vite, bravo !', 7800000, 2),
('SCH', 'Rappeur français, tres fort, il rap tres vite, bravo !', 1230000, 1),
('Ninho', 'Rappeur français, tres fort, il rap tres vite, bravo !', 700, 1),
('Jul', 'Rappeur français, tres fort, il rap tres vite, bravo !', 467760, 1),
('Laylow', 'Rappeur français, tres fort, il rap tres vite, bravo !', 100000, 1);

INSERT INTO morceau (titre,duree,id_album) VALUES
('The Box', 196, NULL),
('Rap God', 366, 2),
('Lose Yourself', 326, 2),
('Godzilla', 210, 2),
('Stan', 360, NULL),
('Without Me', 290, NULL),
('Mockingbird', 251, NULL),
('Not Afraid', 263, 2),
('The Real Slim Shady', 284, 2),
('Venom', 253, 2),
('Special', 218, 1),
('R9R-Line', 201, 1),
('Jubel', 254, NULL);

INSERT INTO playlist (nom,date_creation,description) VALUES 
('Rap', '2021-08-10','Playlist de rap'),
('Rap US', '2021-04-10','Playlist de rap US'),
('House', '2021-01-11','Playlist de house');

INSERT INTO style_musique (type_musique) VALUES
('Rap'),
('Rap US'),
('House'),
('Pop'),
('Rock'),
('Classique');

INSERT INTO utilisateur (prenom,nom,age,mail,username,password) VALUES
('Allan', 'Cueff', '2003-01-24', 'allan.cueff@isen-ouest.yncrea.fr', 'allan-cff','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Alexandre', 'Le Goff', '2003-07-27', 'alexandre.legoff@isen-ouest.yncrea.fr', 'alexandre-lgf','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Mathieu', 'Le Roux', '2003-08-12', 'mathieu.leroux@isen-ouest.yncrea.fr', 'mathieu-lrx','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Mathis', 'Meunier', '2004-09-04', 'mathis.meunier@isen-ouest.yncrea.fr', 'mathis-mnr','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Alix', 'Perrin', '2003-01-30', 'alix.perrin@isen-ouest.yncrea.fr', 'alix-prr','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Léa', 'Pouliquen', '2003-03-12', 'lea.pouliquen@isen-ouest.yncrea.fr', 'lea-pql','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Léna', 'Riou', '2003-05-12', 'lena.riou@isen-ouest.yncrea.fr', 'lena-riu','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Pauline', 'Zarka', '2003-06-12', 'pauline.zarka@isen-ouest.yncrea.fr', 'pauline-zrk','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Titouan', 'Bouffort', '2003-01-24', 'titouan.bouffort@isen-ouest.yncrea.fr', 'titouan-bft','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK'),
('Louis', 'Bouvier', '2003-07-27', 'louis.bouvier@isen-ouest.yncrea.fr', 'louis-bvr','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK');

INSERT INTO admin (id_utilisateur) VALUES
(1);

INSERT INTO a_creer (id, id_playlist) VALUES 
(1, 3),
(4, 1),
(2, 2),
(3, 1);

INSERT INTO contenu_dans (id, id_playlist) VALUES
(1, 2),
(4, 2),
(2, 2),
(3, 2),
(11, 1),
(13, 3),
(12, 1);

INSERT INTO appartient_a (id, id_morceau) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(1, 11),
(1, 12),
(3, 13);

INSERT INTO cree_par (id, id_morceau) VALUES 
(3, 12),
(11, 12),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10);

INSERT INTO liste_attente (id, id_morceau, position) VALUES 
(1, 1, 1),
(1, 7, 2),
(1, 4, 3),
(4, 10, 1),
(4, 11, 2),
(4, 5, 3);
