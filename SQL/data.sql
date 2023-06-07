INSERT INTO playlist (nom,date_creation,description) VALUES 
('Rap', '2021-08-10','Playlist de rap'),
('Rap US', '2021-04-10','Playlist de rap US'),
('House', '2021-01-11','Playlist de house'),
('FAVORIS', '2023-06-01','Vos titres favoris'),
('LISTE ATTENTE', '2023-06-02', ''),
('HISTORIQUE', '2023-06-03', ''),

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