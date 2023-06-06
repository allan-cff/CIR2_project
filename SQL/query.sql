

    
INSERT INTO album (titre,date_parution) VALUES 
('The Dark Side of the Moon', '1973-03-01'),
('Kamikaze', '2018-08-31'),
('Etrange histoire de monsieur Anderson','2022-06-22'),
('Album collaboratif de Test avec artiste 1, 2 et 3', '2023-02-02');

INSERT INTO type_artiste (type) VALUES 
('Chanteur'),
('Groupe'),
('Compositeur'),
('DJ'),
('Producteur');

INSERT INTO artiste (nom,nb_auditeurs,id_type_artiste) VALUES
('Eminem', 66000000, 1),
('Nekfeu', 9600000, 1),
('Damso', 670000, 1),
('Orelsan', 1000, 1),
('PNL', 400000, 2),
('Lomepal', 757000, 1),
('Bigflo et Oli', 7800000, 2),
('SCH', 1230000, 1),
('Ninho', 700, 1),
('Jul', 467760, 1),
('Laylow', 100000, 1),
('Pink Floyd', 1400000, 2);

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
('House', '2021-01-11','Playlist de house'),
('FAVORIS', '2023-06-01','Vos titres favoris'),
('LISTE ATTENTE', '2023-06-02', ''),
('HISTORIQUE', '2023-06-03', ''),
('TEST', '2001-08-08', '');

INSERT INTO style_musique (type_musique) VALUES
('Rap'),
('Rap US'),
('House'),
('Pop'),
('Rock'),
('Classique');

INSERT INTO utilisateur (prenom,nom,age,mail,username,password, id_morceau) VALUES
('Allan', 'Cueff', '2003-01-24', 'allan.cueff@isen-ouest.yncrea.fr', 'allan-cff','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', 2),
('Alexandre', 'Le Goff', '2003-07-27', 'alexandre.legoff@isen-ouest.yncrea.fr', 'alexandre-lgf','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL),
('Mathieu', 'Le Roux', '2003-08-12', 'mathieu.leroux@isen-ouest.yncrea.fr', 'mathieu-lrx','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL),
('Mathis', 'Meunier', '2004-09-04', 'mathis.meunier@isen-ouest.yncrea.fr', 'mathis-mnr','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL),
('Alix', 'Perrin', '2003-01-30', 'alix.perrin@isen-ouest.yncrea.fr', 'alix-prr','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL),
('Léa', 'Pouliquen', '2003-03-12', 'lea.pouliquen@isen-ouest.yncrea.fr', 'lea-pql','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL),
('Léna', 'Riou', '2003-05-12', 'lena.riou@isen-ouest.yncrea.fr', 'lena-riu','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL),
('Pauline', 'Zarka', '2003-06-12', 'pauline.zarka@isen-ouest.yncrea.fr', 'pauline-zrk','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL),
('Titouan', 'Bouffort', '2003-01-24', 'titouan.bouffort@isen-ouest.yncrea.fr', 'titouan-bft','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL),
('Louis', 'Bouvier', '2003-07-27', 'louis.bouvier@isen-ouest.yncrea.fr', 'louis-bvr','$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK', NULL);

INSERT INTO a_creer (id, id_playlist, is_favorite, is_liste_attente, is_historique) VALUES 
(1, 3, FALSE, FALSE, FALSE),
(4, 1, FALSE, FALSE, FALSE),
(2, 2, FALSE, FALSE, FALSE),
(3, 1, FALSE, FALSE, FALSE),
(1, 4, TRUE, FALSE, FALSE),
(1, 5, FALSE, TRUE, FALSE),
(1, 6, FALSE, FALSE, TRUE);

INSERT INTO contenu_dans (id, id_playlist, date_ajout) VALUES
(1, 2, '2004-12-23'),
(4, 2, '2006-07-01'),
(2, 2, '215-04-17'),
(3, 2, '2012-12-12'),
(11, 1, '2003-08-29'),
(13, 3, '2008-09-09'),
(12, 1, '2001-01-01'),
(1, 4, '2002-02-17'),
(3, 4, '2006-01-24'),
(5, 4, '2010-06-17'),
(7, 4, '2007-10-11'),
(9, 4, '2020-02-06'),
(13, 5, '2000-07-12'),
(12, 5, '1997-05-13'),
(10, 6, '1980-01-17'),
(1, 6, '1999-08-10');

INSERT INTO appartient_a (id, id_album) VALUES
(4, 1),
(2, 2),
(3, 2);

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

INSERT INTO a_compose (id, id_artiste) VALUES
(2, 1),
(1, 12),
(4, 1),
(4, 2),
(4, 3),
(3, 1);