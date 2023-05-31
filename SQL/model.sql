------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Type_Artiste
------------------------------------------------------------
CREATE TABLE public.Type_Artiste(
	ID     SERIAL NOT NULL ,
	Type   VARCHAR (70) NOT NULL  ,
	CONSTRAINT Type_Artiste_PK PRIMARY KEY (ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Artiste
------------------------------------------------------------
CREATE TABLE public.Artiste(
	ID                INT  NOT NULL ,
	Nom               VARCHAR (70) NOT NULL ,
	Description       VARCHAR (2000)  NOT NULL ,
	nb_auditeurs      INT  NOT NULL ,
	ID_Type_Artiste   INT  NOT NULL  ,
	CONSTRAINT Artiste_PK PRIMARY KEY (ID)

	,CONSTRAINT Artiste_Type_Artiste_FK FOREIGN KEY (ID_Type_Artiste) REFERENCES public.Type_Artiste(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Album
------------------------------------------------------------
CREATE TABLE public.Album(
	ID              SERIAL NOT NULL ,
	Titre           VARCHAR (70) NOT NULL ,
	Date_parution   DATE  NOT NULL ,
	Image           VARCHAR (200) NOT NULL  ,
	CONSTRAINT Album_PK PRIMARY KEY (ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Morceau
------------------------------------------------------------
CREATE TABLE public.Morceau(
	ID         SERIAL NOT NULL ,
	Titre      VARCHAR (60) NOT NULL ,
	Duree      INT  NOT NULL ,
	ID_Album   INT    ,
	CONSTRAINT Morceau_PK PRIMARY KEY (ID)

	,CONSTRAINT Morceau_Album_FK FOREIGN KEY (ID_Album) REFERENCES public.Album(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Utilisateur
------------------------------------------------------------
CREATE TABLE public.Utilisateur(
	ID           SERIAL NOT NULL ,
	Prenom       VARCHAR (70) NOT NULL ,
	Nom          VARCHAR (50) NOT NULL ,
	Age          INT  NOT NULL ,
	Mail         VARCHAR (100) NOT NULL ,
	Password     VARCHAR (100) NOT NULL ,
	ID_Morceau   INT    ,
	CONSTRAINT Utilisateur_PK PRIMARY KEY (ID)

	,CONSTRAINT Utilisateur_Morceau_FK FOREIGN KEY (ID_Morceau) REFERENCES public.Morceau(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Playlist
------------------------------------------------------------
CREATE TABLE public.Playlist(
	ID              SERIAL NOT NULL ,
	Nom             VARCHAR (60) NOT NULL ,
	Date_creation   DATE  NOT NULL ,
	Image           VARCHAR (60) NOT NULL ,
	Description     VARCHAR (2000)  NOT NULL  ,
	CONSTRAINT Playlist_PK PRIMARY KEY (ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Admin
------------------------------------------------------------
CREATE TABLE public.Admin(
	ID               SERIAL NOT NULL ,
	ID_Utilisateur   INT  NOT NULL  ,
	CONSTRAINT Admin_PK PRIMARY KEY (ID)

	,CONSTRAINT Admin_Utilisateur_FK FOREIGN KEY (ID_Utilisateur) REFERENCES public.Utilisateur(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Style_musique
------------------------------------------------------------
CREATE TABLE public.Style_musique(
	ID             INT  NOT NULL ,
	Type_musique   VARCHAR (60) NOT NULL  ,
	CONSTRAINT Style_musique_PK PRIMARY KEY (ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Créé par
------------------------------------------------------------
CREATE TABLE public.Cree_par(
	ID           INT  NOT NULL ,
	ID_Morceau   INT  NOT NULL  ,
	CONSTRAINT Cree_par_PK PRIMARY KEY (ID,ID_Morceau)

	,CONSTRAINT Cree_par_Artiste_FK FOREIGN KEY (ID) REFERENCES public.Artiste(ID)
	,CONSTRAINT Cree_par_Morceau0_FK FOREIGN KEY (ID_Morceau) REFERENCES public.Morceau(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Contenu dans
------------------------------------------------------------
CREATE TABLE public.Contenu_dans(
	ID            INT  NOT NULL ,
	ID_Playlist   INT  NOT NULL  ,
	CONSTRAINT Contenu_dans_PK PRIMARY KEY (ID,ID_Playlist)

	,CONSTRAINT Contenu_dans_Morceau_FK FOREIGN KEY (ID) REFERENCES public.Morceau(ID)
	,CONSTRAINT Contenu_dans_Playlist0_FK FOREIGN KEY (ID_Playlist) REFERENCES public.Playlist(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Appartient à
------------------------------------------------------------
CREATE TABLE public.Appartient_a(
	ID           INT  NOT NULL ,
	ID_Morceau   INT  NOT NULL  ,
	CONSTRAINT Appartient_a_PK PRIMARY KEY (ID,ID_Morceau)

	,CONSTRAINT Appartient_a_Style_musique_FK FOREIGN KEY (ID) REFERENCES public.Style_musique(ID)
	,CONSTRAINT Appartient_a_Morceau0_FK FOREIGN KEY (ID_Morceau) REFERENCES public.Morceau(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: A créer
------------------------------------------------------------
CREATE TABLE public.A_creer(
	ID            INT  NOT NULL ,
	ID_Playlist   INT  NOT NULL  ,
	CONSTRAINT A_creer_PK PRIMARY KEY (ID,ID_Playlist)

	,CONSTRAINT A_creer_Utilisateur_FK FOREIGN KEY (ID) REFERENCES public.Utilisateur(ID)
	,CONSTRAINT A_creer_Playlist0_FK FOREIGN KEY (ID_Playlist) REFERENCES public.Playlist(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Liste_attente
------------------------------------------------------------
CREATE TABLE public.Liste_attente(
	ID           INT  NOT NULL ,
	ID_Morceau   INT  NOT NULL ,
	Position     INT  NOT NULL  ,
	CONSTRAINT Liste_attente_PK PRIMARY KEY (ID,ID_Morceau)

	,CONSTRAINT Liste_attente_Utilisateur_FK FOREIGN KEY (ID) REFERENCES public.Utilisateur(ID)
	,CONSTRAINT Liste_attente_Morceau0_FK FOREIGN KEY (ID_Morceau) REFERENCES public.Morceau(ID)
)WITHOUT OIDS;



