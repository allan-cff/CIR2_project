------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------


DROP TABLE IF EXISTS public.Type_Artiste CASCADE;
DROP TABLE IF EXISTS public.Album CASCADE;
DROP TABLE IF EXISTS public.Playlist CASCADE;
DROP TABLE IF EXISTS public.Utilisateur CASCADE;
DROP TABLE IF EXISTS public.Style_Musique CASCADE;
DROP TABLE IF EXISTS public.A_creer CASCADE;
DROP TABLE IF EXISTS public.Admin CASCADE;
DROP TABLE IF EXISTS public.Appartient_a CASCADE;
DROP TABLE IF EXISTS public.Artiste CASCADE;
DROP TABLE IF EXISTS public.Contenu_Dans CASCADE;
DROP TABLE IF EXISTS public.Cree_Par CASCADE;
DROP TABLE IF EXISTS public.Morceau CASCADE;
DROP TABLE IF EXISTS public.a_compose CASCADE;
DROP TABLE IF EXISTS public.liste_attente CASCADE;

------------------------------------------------------------
-- Table: Type_Artiste
------------------------------------------------------------
CREATE TABLE public.Type_Artiste(
	ID     INT GENERATED ALWAYS AS IDENTITY ,
	Type   VARCHAR (70) NOT NULL  ,
	CONSTRAINT Type_Artiste_PK PRIMARY KEY (ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Artiste
------------------------------------------------------------
CREATE TABLE public.Artiste(
	ID                INT GENERATED ALWAYS AS IDENTITY ,
	Nom               VARCHAR (70) NOT NULL ,
	nb_auditeurs      INT  NOT NULL ,
	Image           VARCHAR (200)  ,
	ID_Type_Artiste   INT  NOT NULL  ,
	CONSTRAINT Artiste_PK PRIMARY KEY (ID)

	,CONSTRAINT Artiste_Type_Artiste_FK FOREIGN KEY (id_type_Artiste) REFERENCES public.Type_Artiste(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Album
------------------------------------------------------------
CREATE TABLE public.Album(
	ID              INT GENERATED ALWAYS AS IDENTITY ,
	Titre           VARCHAR (200) NOT NULL ,
	Date_parution   DATE  NOT NULL ,
	Image           VARCHAR (200)   ,
	CONSTRAINT Album_PK PRIMARY KEY (ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Morceau
------------------------------------------------------------
CREATE TABLE public.Morceau(
	ID         INT GENERATED ALWAYS AS IDENTITY ,
	Titre      VARCHAR (200) NOT NULL ,
	Duree      INT  NOT NULL ,
	Data           VARCHAR (1100)   ,
	ID_Album   INT    ,
	CONSTRAINT Morceau_PK PRIMARY KEY (ID)

	,CONSTRAINT Morceau_Album_FK FOREIGN KEY (ID_Album) REFERENCES public.Album(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Utilisateur
------------------------------------------------------------
CREATE TABLE public.Utilisateur(
	ID           INT GENERATED ALWAYS AS IDENTITY ,
	Prenom       VARCHAR (70) NOT NULL ,
	Nom          VARCHAR (50) NOT NULL ,
	Age          DATE  NOT NULL ,
	Mail         VARCHAR (100) NOT NULL ,
	Username	 VARCHAR (100) NOT NULL ,
	Image		 VARCHAR (100) NOT NULL ,
	Password     VARCHAR (100) NOT NULL ,
	ID_Morceau   INT    ,
	CONSTRAINT Utilisateur_PK PRIMARY KEY (ID)

	,CONSTRAINT Utilisateur_Morceau_FK FOREIGN KEY (ID_Morceau) REFERENCES public.Morceau(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Playlist
------------------------------------------------------------
CREATE TABLE public.Playlist(
	ID              INT GENERATED ALWAYS AS IDENTITY ,
	Nom             VARCHAR (60) NOT NULL ,
	Date_creation   DATE  NOT NULL ,
	Image           VARCHAR (60)  ,
	Description     VARCHAR (2000)  NOT NULL  ,
	CONSTRAINT Playlist_PK PRIMARY KEY (ID)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Style_musique
------------------------------------------------------------
CREATE TABLE public.Style_musique(
	ID             INT GENERATED ALWAYS AS IDENTITY ,
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
	Date_ajout    TIMESTAMP  NOT NULL,
	CONSTRAINT Contenu_dans_PK PRIMARY KEY (ID,ID_Playlist)

	,CONSTRAINT Contenu_dans_Morceau_FK FOREIGN KEY (ID) REFERENCES public.Morceau(ID)
	,CONSTRAINT Contenu_dans_Playlist0_FK FOREIGN KEY (ID_Playlist) REFERENCES public.Playlist(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Appartient à
------------------------------------------------------------
CREATE TABLE public.Appartient_a(
	ID           INT  NOT NULL ,
	ID_Album   INT  NOT NULL  ,
	CONSTRAINT Appartient_a_PK PRIMARY KEY (ID,ID_Album)

	,CONSTRAINT Appartient_a_Style_musique_FK FOREIGN KEY (ID) REFERENCES public.Style_musique(ID)
	,CONSTRAINT Appartient_a_Album0_FK FOREIGN KEY (ID_Album) REFERENCES public.Album(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: A créer
------------------------------------------------------------
CREATE TABLE public.A_creer(
	ID            INT  NOT NULL ,
	ID_Playlist   INT  NOT NULL  ,
	Is_favorite   BOOLEAN  NOT NULL  ,
	Is_historique   BOOLEAN  NOT NULL  ,
	Is_liste_attente   BOOLEAN  NOT NULL  ,
	CONSTRAINT A_creer_PK PRIMARY KEY (ID,ID_Playlist)

	,CONSTRAINT A_creer_Utilisateur_FK FOREIGN KEY (ID) REFERENCES public.Utilisateur(ID)
	,CONSTRAINT A_creer_Playlist0_FK FOREIGN KEY (ID_Playlist) REFERENCES public.Playlist(ID)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: A composé
------------------------------------------------------------
CREATE TABLE public.A_compose(
	ID           INT  NOT NULL ,
	ID_Artiste   INT  NOT NULL  ,
	CONSTRAINT A_compose_PK PRIMARY KEY (ID,ID_Artiste)

	,CONSTRAINT A_compose_Album_FK FOREIGN KEY (ID) REFERENCES public.Album(ID)
	,CONSTRAINT A_compose_Artiste0_FK FOREIGN KEY (ID_Artiste) REFERENCES public.Artiste(ID)
)WITHOUT OIDS;





