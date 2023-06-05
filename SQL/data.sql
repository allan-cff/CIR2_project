--
-- PostgreSQL database dump
--

-- Dumped from database version 13.10 (Debian 13.10-0+deb11u1)
-- Dumped by pg_dump version 13.10 (Debian 13.10-0+deb11u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'SQL_ASCII';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: a_compose; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.a_compose (
    id integer NOT NULL,
    id_artiste integer NOT NULL
);


ALTER TABLE public.a_compose OWNER TO postgres;

--
-- Name: a_creer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.a_creer (
    id integer NOT NULL,
    id_playlist integer NOT NULL,
    is_favorite boolean NOT NULL,
    is_historique boolean NOT NULL,
    is_liste_attente boolean NOT NULL
);


ALTER TABLE public.a_creer OWNER TO postgres;

--
-- Name: admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    id_utilisateur integer NOT NULL
);


ALTER TABLE public.admin OWNER TO postgres;

--
-- Name: admin_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.admin ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.admin_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: album; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.album (
    id integer NOT NULL,
    titre character varying(200) NOT NULL,
    date_parution date NOT NULL,
    image character varying(200)
);


ALTER TABLE public.album OWNER TO postgres;

--
-- Name: album_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.album ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.album_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: appartient_a; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.appartient_a (
    id integer NOT NULL,
    id_album integer NOT NULL
);


ALTER TABLE public.appartient_a OWNER TO postgres;

--
-- Name: artiste; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.artiste (
    id integer NOT NULL,
    nom character varying(70) NOT NULL,
    nb_auditeurs integer NOT NULL,
    image character varying(200),
    id_type_artiste integer NOT NULL
);


ALTER TABLE public.artiste OWNER TO postgres;

--
-- Name: artiste_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.artiste ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.artiste_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: contenu_dans; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contenu_dans (
    id integer NOT NULL,
    id_playlist integer NOT NULL,
    date_ajout timestamp without time zone NOT NULL
);


ALTER TABLE public.contenu_dans OWNER TO postgres;

--
-- Name: cree_par; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cree_par (
    id integer NOT NULL,
    id_morceau integer NOT NULL
);


ALTER TABLE public.cree_par OWNER TO postgres;

--
-- Name: morceau; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.morceau (
    id integer NOT NULL,
    titre character varying(200) NOT NULL,
    duree integer NOT NULL,
    data character varying(1000),
    id_album integer
);


ALTER TABLE public.morceau OWNER TO postgres;

--
-- Name: morceau_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.morceau ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.morceau_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: playlist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.playlist (
    id integer NOT NULL,
    nom character varying(60) NOT NULL,
    date_creation date NOT NULL,
    image character varying(60),
    description character varying(2000) NOT NULL
);


ALTER TABLE public.playlist OWNER TO postgres;

--
-- Name: playlist_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.playlist ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.playlist_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: style_musique; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.style_musique (
    id integer NOT NULL,
    type_musique character varying(60) NOT NULL
);


ALTER TABLE public.style_musique OWNER TO postgres;

--
-- Name: style_musique_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.style_musique ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.style_musique_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: type_artiste; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_artiste (
    id integer NOT NULL,
    type character varying(70) NOT NULL
);


ALTER TABLE public.type_artiste OWNER TO postgres;

--
-- Name: type_artiste_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.type_artiste ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.type_artiste_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utilisateur (
    id integer NOT NULL,
    prenom character varying(70) NOT NULL,
    nom character varying(50) NOT NULL,
    age date NOT NULL,
    mail character varying(100) NOT NULL,
    username character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    is_admin boolean NOT NULL,
    id_morceau integer
);


ALTER TABLE public.utilisateur OWNER TO postgres;

--
-- Name: utilisateur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.utilisateur ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.utilisateur_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Data for Name: a_compose; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.a_compose (id, id_artiste) FROM stdin;
1	2
1	1
2	1
3	1
4	9
5	9
6	9
7	10
8	10
9	10
10	10
11	10
12	3
13	3
14	3
15	3
16	3
17	58
18	58
19	68
19	58
19	69
20	58
21	74
22	74
22	86
23	74
24	74
25	107
25	108
26	107
27	107
28	107
29	107
30	86
31	125
31	86
31	126
32	74
32	86
33	86
34	144
35	144
36	144
37	144
38	105
38	116
39	105
40	105
41	177
42	177
43	178
44	178
45	178
46	40
47	40
48	206
49	206
50	206
51	206
52	206
53	225
54	225
55	225
56	225
57	226
58	226
59	226
60	227
61	227
62	227
63	228
64	228
65	228
66	236
66	237
66	238
67	236
68	236
69	236
70	276
71	276
72	276
\.


--
-- Data for Name: a_creer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.a_creer (id, id_playlist, is_favorite, is_historique, is_liste_attente) FROM stdin;
1	3	f	f	f
4	1	f	f	f
2	2	f	f	f
3	1	f	f	f
1	4	t	f	f
1	5	f	f	t
1	6	f	t	f
11	8	t	f	f
11	9	f	f	t
11	10	f	t	f
\.


--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admin (id, id_utilisateur) FROM stdin;
\.


--
-- Data for Name: album; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.album (id, titre, date_parution, image) FROM stdin;
1	Avatar: The Way of Water (Original Motion Picture Soundtrack)	2022-12-15	https://i.scdn.co/image/ab67616d0000b273c8044633efdd0e991224e197
2	Dawn FM (Alternate World)	2022-01-07	https://i.scdn.co/image/ab67616d0000b273ade87e5f9c3764f0a1e5df64
3	Dawn FM	2022-01-06	https://i.scdn.co/image/ab67616d0000b2734ab2520c2c77a1d66b9ee21d
4	Midnights	2022-10-21	https://i.scdn.co/image/ab67616d0000b273bb54dde68cd23e2a268ae0f5
5	Red (Taylor's Version)	2021-11-12	https://i.scdn.co/image/ab67616d0000b273318443aab3531a0558e79a4d
6	Fearless (Taylor's Version)	2021-04-09	https://i.scdn.co/image/ab67616d0000b273a48964b5d9a3d6968ae3e0de
7	Did you know that there's a tunnel under Ocean Blvd	2023-03-24	https://i.scdn.co/image/ab67616d0000b27359ae8cf65d498afdd5585634
8	Blue Banisters	2021-10-22	https://i.scdn.co/image/ab67616d0000b2736946deb6f548e464b385ee0e
9	Chemtrails Over The Country Club	2021-03-19	https://i.scdn.co/image/ab67616d0000b273ca929c6e766cb8591a286e0d
10	Norman Fucking Rockwell!	2019-08-30	https://i.scdn.co/image/ab67616d0000b273879e9318cb9f4e05ee552ac9
11	Lust For Life	2017-07-21	https://i.scdn.co/image/ab67616d0000b27395e2fd1accb339fa14878190
12	CALL ME IF YOU GET LOST: The Estate Sale	2023-03-31	https://i.scdn.co/image/ab67616d0000b273aa95a399fd30fbb4f6f59fca
13	CALL ME IF YOU GET LOST	2021-06-25	https://i.scdn.co/image/ab67616d0000b273696b4e67423edd64784bfbb4
14	IGOR	2019-05-17	https://i.scdn.co/image/ab67616d0000b2737005885df706891a3c182a57
15	Flower Boy	2017-07-21	https://i.scdn.co/image/ab67616d0000b2738940ac99f49e44f59e6f7fb3
16	Cherry Bomb + Instrumentals	2015-04-13	https://i.scdn.co/image/ab67616d0000b27337906edcfbfde42b203097f2
17	Donda	2021-08-29	https://i.scdn.co/image/ab67616d0000b273cad190f1a73c024e5a40dddd
18	JESUS IS KING	2019-10-25	https://i.scdn.co/image/ab67616d0000b2731bb797bbfe2480650b6c2964
19	KIDS SEE GHOSTS	2018-06-08	https://i.scdn.co/image/ab67616d0000b273013c00ee367dd85396f79c82
20	ye	2018-06-01	https://i.scdn.co/image/ab67616d0000b2730cd942c1a864afa4e92d04f2
21	Mr. Morale & The Big Steppers	2022-05-13	https://i.scdn.co/image/ab67616d0000b2732e02117d76426a08ac7c174f
22	Black Panther The Album Music From And Inspired By	2018-02-09	https://i.scdn.co/image/ab67616d0000b273c027ad28821777b00dcaa888
23	DAMN.	2017-04-14	https://i.scdn.co/image/ab67616d0000b2738b52c6b9bc4e43d873869699
24	untitled unmastered.	2016-03-04	https://i.scdn.co/image/ab67616d0000b2738c697f553a46006a5d8886b2
25	Her Loss	2022-11-04	https://i.scdn.co/image/ab67616d0000b27302854a7060fccc1a66a4b5ad
26	Honestly, Nevermind	2022-06-17	https://i.scdn.co/image/ab67616d0000b2738dc0d801766a5aa6a33cbe37
27	Certified Lover Boy	2021-09-03	https://i.scdn.co/image/ab67616d0000b273cd945b4e3de57edd28481a3f
28	Dark Lane Demo Tapes	2020-05-01	https://i.scdn.co/image/ab67616d0000b273bba7cfaf7c59ff0898acba1f
29	Care Package	2019-08-02	https://i.scdn.co/image/ab67616d0000b2739c1e02d4becb7c5bbca01e2a
30	SOS	2022-12-09	https://i.scdn.co/image/ab67616d0000b27370dbc9f47669d120ad874ec1
31	Dear Evan Hansen (Original Motion Picture Soundtrack)	2021-09-24	https://i.scdn.co/image/ab67616d0000b273a7a9d81575b10a3bc8b69914
32	Black Panther The Album Music From And Inspired By	2018-02-09	https://i.scdn.co/image/ab67616d0000b273c027ad28821777b00dcaa888
33	Ctrl	2017-06-09	https://i.scdn.co/image/ab67616d0000b2734c79d5ec52a6d0302f3add25
34	The Car	2022-10-21	https://i.scdn.co/image/ab67616d0000b27307823ee6237208c835802663
35	Tranquility Base Hotel & Casino	2018-05-10	https://i.scdn.co/image/ab67616d0000b2738895ff0f90525f4aa9437c27
36	AM	2013-09-09	https://i.scdn.co/image/ab67616d0000b2734ae1c4c5c45aabe565499163
37	Suck It and See	2011-06-06	https://i.scdn.co/image/ab67616d0000b273cb44038b22f3d8a5e4e62d5a
38	Black Panther: Wakanda Forever - Music From and Inspired By	2022-11-11	https://i.scdn.co/image/ab67616d0000b273992a1f56ac5382848277cff2
39	ANTI	2016-01-28	https://i.scdn.co/image/ab67616d0000b2737b688587a6754481c53f6bb7
40	Unapologetic	2012-12-11	https://i.scdn.co/image/ab67616d0000b2736ede83cf8307a1d0174029ac
41	Happier Than Ever	2021-07-30	https://i.scdn.co/image/ab67616d0000b2732a038d3bf875d23e4aeaa84e
42	WHEN WE ALL FALL ASLEEP, WHERE DO WE GO?	2019-03-29	https://i.scdn.co/image/ab67616d0000b27350a3147b4edd7701a876c6ce
43	RENAISSANCE	2022-07-29	https://i.scdn.co/image/ab67616d0000b2730e58a0f8308c1ad403d105e7
44	The Lion King: The Gift	2019-07-19	https://i.scdn.co/image/ab67616d0000b2734ccc03169b086af698178a99
45	Lemonade	2016-04-23	https://i.scdn.co/image/ab67616d0000b27389992f4d7d4ab94937bf9e23
46	Blonde	2016-08-20	https://i.scdn.co/image/ab67616d0000b273c5649add07ed3720be9d5526
47	channel ORANGE	2012-07-10	https://i.scdn.co/image/ab67616d0000b2737aede4855f6d0d738012e2e5
48	KID A MNESIA	2021-11-05	https://i.scdn.co/image/ab67616d0000b273bbaaa8bf9aedb07135d2c6d3
49	OK Computer OKNOTOK 1997 2017	2017-06-23	https://i.scdn.co/image/ab67616d0000b2738dabbbc97ad7194a38e90a21
50	A Moon Shaped Pool	2016-05-08	https://i.scdn.co/image/ab67616d0000b27345643f5cf119cbc9d2811c22
51	TKOL RMX 1234567	2011-10-10	https://i.scdn.co/image/ab67616d0000b273256aaad72501b877b3e85682
52	The King Of Limbs	2011-02-18	https://i.scdn.co/image/ab67616d0000b273a9be6a9b8b5831a4c431ab9f
53	The Slow Rush	2020-02-14	https://i.scdn.co/image/ab67616d0000b27358267bd34420a00d5cf83a49
54	Currents	2015-07-17	https://i.scdn.co/image/ab67616d0000b2739e1cfc756886ac782e363d79
55	Lonerism	2012-01-01	https://i.scdn.co/image/ab67616d0000b273370c12f82872c9cfaee80193
56	InnerSpeaker	2010-05-21	https://i.scdn.co/image/ab67616d0000b273176e82d09ac75d62810f0056
57	Harry's House	2022-05-20	https://i.scdn.co/image/ab67616d0000b2732e8ed79e177ff6011076f5f0
58	Fine Line	2019-12-13	https://i.scdn.co/image/ab67616d0000b27377fdcfda6535601aff081b6a
59	Harry Styles	2017-05-12	https://i.scdn.co/image/ab67616d0000b2736c619c39c853f8b1d67b7859
60	Positions	2020-10-30	https://i.scdn.co/image/ab67616d0000b2735ef878a782c987d38d82b605
61	thank u, next	2019-02-08	https://i.scdn.co/image/ab67616d0000b27356ac7b86e090f307e218e9c8
62	Sweetener	2018-08-17	https://i.scdn.co/image/ab67616d0000b273c3af0c2355c24ed7023cd394
63	Planet Her	2021-06-25	https://i.scdn.co/image/ab67616d0000b2734df3245f26298a1579ecc321
64	Hot Pink	2019-11-07	https://i.scdn.co/image/ab67616d0000b27382b243023b937fd579a35533
65	Amala	2018-03-30	https://i.scdn.co/image/ab67616d0000b273c42f6b7b41537a5fae06840a
66	Top Gun: Maverick (Music From The Motion Picture)	2022-05-27	https://i.scdn.co/image/ab67616d0000b27302701cfe03aca6827b5c5449
67	Dawn Of Chromatica	2021-09-03	https://i.scdn.co/image/ab67616d0000b273335b00966a9839d4dde60256
68	BORN THIS WAY THE TENTH ANNIVERSARY	2021-06-25	https://i.scdn.co/image/ab67616d0000b2739e79e2cf1144541288fc30c0
69	Chromatica	2020-05-29	https://i.scdn.co/image/ab67616d0000b2736040effba89b9b00a6f6743a
70	Music Of The Spheres	2021-10-15	https://i.scdn.co/image/ab67616d0000b273ec10f247b100da1ce0d80b6d
71	Everyday Life	2019-11-22	https://i.scdn.co/image/ab67616d0000b273733913465adb99353020b805
72	A Head Full of Dreams	2015-12-04	https://i.scdn.co/image/ab67616d0000b2738ff7c3580d429c8212b9a3b6
\.


--
-- Data for Name: appartient_a; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.appartient_a (id, id_album) FROM stdin;
1	1
2	1
3	1
1	2
2	2
3	2
1	3
2	3
3	3
3	4
3	5
3	6
4	7
3	7
4	8
3	8
4	9
3	9
4	10
3	10
4	11
3	11
5	12
6	12
5	13
6	13
5	14
6	14
5	15
6	15
5	16
6	16
7	17
5	17
6	17
7	18
5	18
6	18
7	19
5	19
6	19
7	20
5	20
6	20
8	21
5	21
6	21
9	21
8	22
5	22
6	22
9	22
8	23
5	23
6	23
9	23
8	24
5	24
6	24
9	24
10	25
2	25
5	25
6	25
11	25
10	26
2	26
5	26
6	26
11	26
10	27
2	27
5	27
6	27
11	27
10	28
2	28
5	28
6	28
11	28
10	29
2	29
5	29
6	29
11	29
3	30
12	30
6	30
3	31
12	31
6	31
3	32
12	32
6	32
3	33
12	33
6	33
13	34
14	34
15	34
16	34
17	34
13	35
14	35
15	35
16	35
17	35
13	36
14	36
15	36
16	36
17	36
13	37
14	37
15	37
16	37
17	37
18	38
3	38
19	38
18	39
3	39
19	39
18	40
3	40
19	40
4	41
20	41
3	41
4	42
20	42
3	42
3	43
12	43
3	44
12	44
3	45
12	45
21	46
22	46
21	47
22	47
23	48
24	48
25	48
26	48
15	48
16	48
23	49
24	49
25	49
26	49
15	49
16	49
23	50
24	50
25	50
26	50
15	50
16	50
23	51
24	51
25	51
26	51
15	51
16	51
23	52
24	52
25	52
26	52
15	52
16	52
27	53
14	53
28	53
16	53
27	54
14	54
28	54
16	54
27	55
14	55
28	55
16	55
27	56
14	56
28	56
16	56
3	57
3	58
3	59
3	60
3	61
3	62
29	63
3	63
29	64
3	64
29	65
3	65
4	66
29	66
3	66
4	67
29	67
3	67
4	68
29	68
3	68
4	69
29	69
3	69
15	70
3	70
15	71
3	71
15	72
3	72
\.


--
-- Data for Name: artiste; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.artiste (id, nom, nb_auditeurs, image, id_type_artiste) FROM stdin;
1	The Weeknd	3296033	https://i.scdn.co/image/ab6761610000e5eb01b9b4ec2a05d0805428acfa	1
2	Simon Franglen	28920	https://i.scdn.co/image/ab67616d0000b273c8044633efdd0e991224e197	1
3	Tyler, The Creator	2335384	https://i.scdn.co/image/ab6761610000e5eb8278b782cbb5a3963db88ada	1
4	Lil Wayne	1013045	https://i.scdn.co/image/ab6761610000e5ebc63aded6f4bf4d06d1377106	1
5	Swedish House Mafia	1887314	https://i.scdn.co/image/ab6761610000e5eb3acc752dbb488a55fffa9af8	2
6	Oneohtrix Point Never	517359	https://i.scdn.co/image/ab6761610000e5ebdcb37659a650e2e700c94986	1
7	Sebastian Ingrosso	376432	https://i.scdn.co/image/ab6761610000e5eb0ddf983126c8dadd64163664	1
8	Salvatore Ganacci	135946	https://i.scdn.co/image/ab6761610000e5eb1db8bcce24a6b88044fdb460	1
9	Taylor Swift	3992405	https://i.scdn.co/image/ab6761610000e5eb5a00969a4698c3132a15fbb0	1
10	Lana Del Rey	3424368	https://i.scdn.co/image/ab6761610000e5ebb99cacf8acd5378206767261	1
11	Gary Lightbody	9287	https://i.scdn.co/image/ab6761610000e5eb7ddb04387d61f44573b82959	1
12	Ed Sheeran	2941330	https://i.scdn.co/image/ab6761610000e5eb9e690225ad4445530612ccc9	1
13	Colbie Caillat	1672261	https://i.scdn.co/image/ab6761610000e5eb73462adec54d5201d5a4bf09	1
14	Jon Batiste	224112	https://i.scdn.co/image/ab6761610000e5ebb253187f8ad8d77b98625fd4	1
15	SYML	681917	https://i.scdn.co/image/ab6761610000e5eb63de489d2b164a4768953938	1
16	RIOPY	111322	https://i.scdn.co/image/ab6761610000e5eb5ae0cf47c4e8d3cc67a37e19	1
17	Father John Misty	854650	https://i.scdn.co/image/ab6761610000e5ebdadc30179c554ac7912f8477	1
18	Bleachers	720316	https://i.scdn.co/image/ab6761610000e5eb10b8516a9d63202c9e325260	1
19	Tommy Genesis	210165	https://i.scdn.co/image/ab6761610000e5ebe5669e45b783819c17c1ac06	2
20	Nikki Lane	87944	https://i.scdn.co/image/ab6761610000e5eb5ff27e25948f76f84590bf3d	1
21	Zella Day	601580	https://i.scdn.co/image/ab6761610000e5ebf07625ed8cff82132521c156	1
22	Weyes Blood	596273	https://i.scdn.co/image/ab6761610000e5eb92b2757e7003d4f77e5a5d05	1
23	A$AP Rocky	1998876	https://i.scdn.co/image/ab6761610000e5ebee452efcf24aa4124fb28d94	1
24	Playboi Carti	1204520	https://i.scdn.co/image/ab6761610000e5eb504ff11d788162fbf8078654	1
25	Stevie Nicks	990139	https://i.scdn.co/image/de290cc5eb07bc3b2921008725d70d9d1573246c	1
26	Sean Ono Lennon	40065	https://i.scdn.co/image/ab67616d0000b27323e34a13e4f1a206fe0db54c	1
27	DJ Drama	381239	https://i.scdn.co/image/ab6761610000e5eb53ab08562b594332034c6aca	1
28	42 Dugg	213141	https://i.scdn.co/image/ab6761610000e5eb40c29d16a1bc236c8c67bb14	1
29	YoungBoy Never Broke Again	572989	https://i.scdn.co/image/ab6761610000e5eba213bd0d2152db1ce9c8da70	1
30	Ty Dolla $ign	964119	https://i.scdn.co/image/ab6761610000e5ebd9dde4a54073dbd58fb91c7d	1
31	Teezo Touchdown	90711	https://i.scdn.co/image/ab6761610000e5eb06668d921476ea8883f516b6	7
32	Domo Genesis	368045	https://i.scdn.co/image/ab6761610000e5eb326a61a99773406cc8a6b0dd	1
33	Brent Faiyaz	941047	https://i.scdn.co/image/ab6761610000e5eb2749cce858c97642feda7a92	1
34	Fana Hues	98956	https://i.scdn.co/image/ab6761610000e5ebbeabe96ea1037b17da712ac9	1
35	DAISY WORLD	11985	https://i.scdn.co/image/ab6761610000e5eb66d80d3f4bdd17b014f30298	1
36	Lil Uzi Vert	1422720	https://i.scdn.co/image/ab6761610000e5eb30122c0d3ead72f96bb5ee93	1
37	Pharrell Williams	2099807	https://i.scdn.co/image/ab6761610000e5eb714fad357f3aa2bb4826d1a6	1
38	Vince Staples	942932	https://i.scdn.co/image/ab6761610000e5eb53054f8bc7e0153daefe12cc	1
39	Rex Orange County	1239142	https://i.scdn.co/image/ab6761610000e5ebffb90f91cb2f487d7309f7bc	2
40	Frank Ocean	2632547	https://i.scdn.co/image/ab6761610000e5ebfbc3faec4a370d8393bee7f1	1
41	Kali Uchis	1526942	https://i.scdn.co/image/ab6761610000e5eb4ddb58b186bace4ed7e9f26e	1
42	Jaden	813904	https://i.scdn.co/image/ab6761610000e5eb0376b56af63682d48579fa85	1
43	Estelle	1357673	https://i.scdn.co/image/ab6761610000e5ebf4710a4c927b222cfa785257	1
44	Anna of the North	352838	https://i.scdn.co/image/ab6761610000e5eb6e0fc542f21c5c6b25996798	2
45	Steve Lacy	1504004	https://i.scdn.co/image/ab6761610000e5eb09ac9d040c168d4e4f58eb42	1
46	Cole Alexander	2506	https://i.scdn.co/image/ab6761610000e5ebdf42bb5965fc3a24b6c1ec89	1
47	Shane Powers	1943	localhost/Ressources/default.png	1
48	Syd	511375	https://i.scdn.co/image/ab6761610000e5eb292f77f733a60b12ee55dadf	2
49	Chaz Bundick	77360	https://i.scdn.co/image/a9016a844d9f274ea5450d184c4cc8a5ed66d6be	1
50	ScHoolboy Q	1275373	https://i.scdn.co/image/ab6761610000e5ebe697a7ddf7af3a306428fa73	1
51	Roy Ayers	407685	https://i.scdn.co/image/3fb0b3b86b8f6c36e08ba038880afc7911bb0f52	1
52	Wanya Morris	440	https://i.scdn.co/image/87b3e8b2cdcd03e176dc80f0a8f79b35d4f684dd	1
53	DāM-FunK	16442	https://i.scdn.co/image/ab6761610000e5eb5016148f87438e846765c8a7	1
54	Austin Feinstein	6278	localhost/Ressources/default.png	1
55	Aaron Shaw	2046	https://i.scdn.co/image/ab6761610000e5ebc38e99e73d74e8f4708dae5a	1
56	Samantha Nelson	2046	localhost/Ressources/default.png	1
57	Charlie Wilson	191267	https://i.scdn.co/image/ab6761610000e5ebb8f7bfe7c0158c9dd17db8e6	1
58	Kanye West	6017462	https://i.scdn.co/image/ab6761610000e5eb867008a971fae0f4d913f63a	1
59	Coco O.	76614	https://i.scdn.co/image/ab6761610000e5eb71ad873c6172fe92804edfdd	1
60	Alice Smith	131843	https://i.scdn.co/image/b29f951aeaf25b3cfe0b44b3136566510171da23	1
61	Leon Ware	135006	https://i.scdn.co/image/0db0df88f9457029b0b58cfb852c36c607241e45	1
62	Clem Creevy	1480	localhost/Ressources/default.png	1
63	Sunday Service Choir	80464	https://i.scdn.co/image/ab6761610000e5ebeeddda7878eb282a03c52b1e	2
64	Ant Clemons	65646	https://i.scdn.co/image/ab6761610000e5eb4134be1de8807186cc9d0467	1
65	Fred Hammond	78785	https://i.scdn.co/image/b97b37a7eb83bcefaea0f2120579729a20fd49c2	1
66	Clipse	743144	https://i.scdn.co/image/dba80f94d4be6d119eb5ffa772016ef58bc51413	2
67	Kenny G	452797	https://i.scdn.co/image/ab6772690000c46cb1c9c1588c4035499770118f	1
68	KIDS SEE GHOSTS	679834	https://i.scdn.co/image/ab6761610000e5eb22c693c66a5494d88194d543	2
69	Kid Cudi	3581278	https://i.scdn.co/image/ab6761610000e5eb876faa285687786c3d314ae0	1
70	Pusha T	1124559	https://i.scdn.co/image/ab6761610000e5ebc5b88a3924d8318f25f20594	1
71	Louis Prima	587430	https://i.scdn.co/image/85e8343b215c98ad063417ac2f6b63919557721a	1
72	Yasiin Bey	3718	localhost/Ressources/default.png	1
73	PARTYNEXTDOOR	951447	https://i.scdn.co/image/ab6761610000e5eb4e3dee8baac75dad1fea791e	1
74	Kendrick Lamar	3028466	https://i.scdn.co/image/ab6761610000e5eb437b9e2a82505b3d93ff1022	1
75	Blxst	255947	https://i.scdn.co/image/ab6761610000e5ebadd460a1d2f7ca170d2422ec	1
76	Amanda Reifer	23453	https://i.scdn.co/image/ab6761610000e5ebdc6dab7d5bceacc93c0cc974	1
77	Sampha	433174	https://i.scdn.co/image/ab6761610000e5ebf04bf365d7b153b4a81e6c40	1
78	Taylour Paige	18037	https://i.scdn.co/image/ab6761610000e5eb8e5a8ed4bb07804dc8ebe8b0	1
79	Summer Walker	886531	https://i.scdn.co/image/ab6761610000e5eb9ac284d0d6afcb53a65558b3	1
80	Ghostface Killah	759481	https://i.scdn.co/image/ee2180486a42e11b6a0dfafdba9e2dbb9297a9b3	1
81	Kodak Black	967226	https://i.scdn.co/image/ab6761610000e5eb4bd22c1711d22aa647a61097	1
82	Baby Keem	1005615	https://i.scdn.co/image/ab6761610000e5ebd6f2323c1971fd5a70cd0255	1
83	Sam Dew	25932	https://i.scdn.co/image/ab6761610000e5eb51ecfd1ae9e8e2c1ba5e6e85	1
84	Tanna Leone	42010	https://i.scdn.co/image/ab6761610000e5ebaf556fb3db64684522f67757	1
85	Beth Gibbons	330429	https://i.scdn.co/image/ab6761610000e5ebbceb4bbb7796939613709aca	1
86	SZA	1900968	https://i.scdn.co/image/ab6761610000e5eb7eb7f6371aad8e67e01f0a03	1
87	2 Chainz	1074239	https://i.scdn.co/image/ab6761610000e5ebf556662d187b9191c421be1c	1
88	Saudi	4264	https://i.scdn.co/image/ab6761610000e5eb14c105a48c334c735301c1d1	2
89	Khalid	1416758	https://i.scdn.co/image/ab6761610000e5eb31072db9da0311ecfabe96bf	1
90	Swae Lee	259101	https://i.scdn.co/image/ab6761610000e5ebe3b454b6333a895beb4aa564	1
91	Yugen Blakrok	18221	https://i.scdn.co/image/ab6761610000e5ebe64306e76cf0ce626aa2245a	1
92	Jorja Smith	769475	https://i.scdn.co/image/ab6761610000e5eb90081ebf6b41aa8d0a3522fe	1
93	SOB X RBE	272415	https://i.scdn.co/image/ab6761610000e5eb24e6f9ce2527f8241ee1947d	2
94	Ab-Soul	538359	https://i.scdn.co/image/ab6761610000e5eb313ba2f006e069072e6ed486	1
95	Anderson .Paak	824052	https://i.scdn.co/image/ab6761610000e5eb96287bd47570ff13f0c01496	1
96	James Blake	1470500	https://i.scdn.co/image/ab6761610000e5eb568ef832399d06317da80a85	1
97	Jay Rock	868974	https://i.scdn.co/image/ab6761610000e5eb02012f4390f3c8e7424766a3	1
98	Future	1750552	https://i.scdn.co/image/ab6761610000e5eb24e41f491b129093a6fee383	2
99	Zacari	205086	https://i.scdn.co/image/ab6761610000e5ebdb78fbd1c000f16792795648	1
100	Babes Wodumo	7803	https://i.scdn.co/image/ab67616d0000b273799143b30879f7496e63a187	1
101	Mozzy	196728	https://i.scdn.co/image/ab6761610000e5eb95c2739935f8e72ed3fafb97	1
102	Sjava	12851	https://i.scdn.co/image/ab6761610000e5eb3795a16b55269a8445fab673	1
103	REASON	200802	https://i.scdn.co/image/ab6761610000e5eb540ab35f9d3c8894a79193d0	2
104	Travis Scott	1405385	https://i.scdn.co/image/ab6761610000e5ebe707b87e3f65997f6c09bfff	1
105	Rihanna	6149682	https://i.scdn.co/image/ab6761610000e5eb99e4fca7c0b7cb166d915789	1
106	U2	4059025	https://i.scdn.co/image/ab6761610000e5ebbfdf5b8c863b5f8c4519e032	2
107	Drake	4964675	https://i.scdn.co/image/ab6761610000e5eb4293385d324db8558179afd9	2
108	21 Savage	1136352	https://i.scdn.co/image/ab6761610000e5eb35ca7d2181258b51c0f2cf9e	1
109	Lil Baby	872273	https://i.scdn.co/image/ab6761610000e5eb6cad3eff5adc29e20f189a6c	1
110	Lil Durk	559737	https://i.scdn.co/image/ab6761610000e5eba0461c1f2218374aa672ce4e	1
111	Giveon	705134	https://i.scdn.co/image/ab6761610000e5eb0219b6643b1ec449b0951bfe	1
112	JAY-Z	4412183	https://i.scdn.co/image/ab6761610000e5ebc75afcd5a9027f60eaebb5e4	1
113	Young Thug	1084688	https://i.scdn.co/image/ab6761610000e5eb547d2b41c9f2c97318aad0ed	1
114	Yebba	209186	https://i.scdn.co/image/ab6761610000e5ebc7c93edb239b99c22a84bdd9	1
115	Project Pat	352959	https://i.scdn.co/image/47a46e916b2b4291e2fcf12f560e9c5575018ab6	1
116	Tems	227767	https://i.scdn.co/image/ab6761610000e5eb1d3357f91de16a31b194ed32	1
117	Rick Ross	2013080	https://i.scdn.co/image/ab6761610000e5eb8196a8109c28a8b8aca28fae	1
118	Chris Brown	3553875	https://i.scdn.co/image/ab6761610000e5ebe50aa80e0f5869f84f6874d1	1
119	Fivio Foreign	384488	https://i.scdn.co/image/ab6761610000e5eb366afadc7bfc1671fb1d4f2c	1
120	Sosa Geek	1883	https://i.scdn.co/image/ab67616d0000b2733154f333558b0bb3d0bab250	1
121	J. Cole	2697083	https://i.scdn.co/image/ab6761610000e5ebadd503b411a712e277895c8a	1
122	James Fauntleroy	14749	https://i.scdn.co/image/ab6761610000e5ebe48a7f38c0aed50db51b3fbe	1
123	Don Toliver	998979	https://i.scdn.co/image/ab6761610000e5ebeb63bf6379a9ea8453a30020	1
124	Phoebe Bridgers	1165711	https://i.scdn.co/image/ab6761610000e5eb626686e362d30246e816cc5b	1
125	Ben Platt	334422	https://i.scdn.co/image/ab6761610000e5eb7316f8a5d9f35c14ea08d256	1
126	Sam Smith	2115880	https://i.scdn.co/image/ab6761610000e5eba8eef8322e55fc49ab436eea	1
127	Colton Ryan	13796	https://i.scdn.co/image/ab67616d0000b27300f4533a52d61641b7369b90	1
128	Nik Dodani	232	https://i.scdn.co/image/ab67616d0000b27300f4533a52d61641b7369b90	7
129	Kaitlyn Dever	10238	localhost/Ressources/default.png	1
130	Danny Pino	188	localhost/Ressources/default.png	1
131	Amy Adams	157225	https://i.scdn.co/image/eb75e4c21bda45df023d29471e188fb6e9eb0bf2	1
132	Amandla Stenberg	59672	https://i.scdn.co/image/ab6761610000e5ebf7b1473693d503276f007802	1
133	Liz Kate	701	https://i.scdn.co/image/ab6761610000e5ebd8af6fe40d0ddd33c0125367	1
134	DeMarius Copes	138	localhost/Ressources/default.png	1
135	Isaac Powell	1613	localhost/Ressources/default.png	1
136	Hadiya Eshe’	36	localhost/Ressources/default.png	1
137	Dear Evan Hansen Choir	378	localhost/Ressources/default.png	2
138	Julianne Moore	4608	localhost/Ressources/default.png	1
139	Carrie Underwood	1352955	https://i.scdn.co/image/ab6761610000e5ebc1c077c305eb4b2bcac25fd5	1
140	Dan + Shay	495195	https://i.scdn.co/image/ab6761610000e5eb1e6f4e64dc26772155d61ce2	2
141	FINNEAS	663177	https://i.scdn.co/image/ab6761610000e5ebd1e2c2636101af74819bbe1a	1
142	Tori Kelly	517415	https://i.scdn.co/image/ab6761610000e5eb5211314fc3379104442b7c32	1
143	Isaiah Rashad	693169	https://i.scdn.co/image/ab6761610000e5eb1ff1685224034e6c12538722	1
144	Arctic Monkeys	5053689	https://i.scdn.co/image/ab6761610000e5eb7da39dea0a72f581535fb11f	2
145	DBN Gogo	24507	https://i.scdn.co/image/ab6761610000e5eb5f147faf3678ea8044ec4235	7
146	Sino Msolo	272	https://i.scdn.co/image/ab6761610000e5ebdbf68cb621058d452c4d3cab	1
147	Kamo Mphela	3796	https://i.scdn.co/image/ab6761610000e5eb3ea784b25bbf95a9c287253a	7
148	Young Stunna	3904	https://i.scdn.co/image/ab6761610000e5eb24a6d973ef9ed685c3f4ab27	1
149	Busiswa	2524	https://i.scdn.co/image/ab6761610000e5ebf91fdebf17b5451182560947	1
150	Burna Boy	394757	https://i.scdn.co/image/ab6761610000e5eba0e4780f120345edddeaada9	1
151	Vivir Quintana	24277	https://i.scdn.co/image/ab6761610000e5eb334c07e60892c24e133c6e02	1
152	Mare Advertencia Lirika	1633	https://i.scdn.co/image/ab6761610000e5eb8b71cbeb9d2ad4bdc660bbdc	1
153	Foudeqush	70545	https://i.scdn.co/image/ab6761610000e5eb23babaa680d1cfa5f3b5c4bf	7
154	Ludwig Göransson	116350	https://i.scdn.co/image/e7a97b420e09f4f125cd3e14fca5e7ea174e74e0	1
155	Snow Tha Product	97876	https://i.scdn.co/image/ab6761610000e5eb0d214c67744b1864b3a0d7bc	1
156	E-40	430522	https://i.scdn.co/image/ab6761610000e5eb8ca18cf65fbe696a56d9cfda	1
157	Stormzy	549943	https://i.scdn.co/image/ab6761610000e5eba66d3bfba2c1f0b4a0b278e5	1
158	Fireboy DML	209460	https://i.scdn.co/image/ab6761610000e5eb883c0730c0ea767039cec6db	1
159	Tobe Nwigwe	114707	https://i.scdn.co/image/ab6761610000e5eb5e1f8984ab0a6f2cd152b7ca	1
160	Fat Nwigwe	904	https://i.scdn.co/image/ab6761610000e5ebbc8eed317ebaac73311cd1f3	1
161	Adn Maya Colectivo	14966	https://i.scdn.co/image/ab6761610000e5eb7079b8fa333d0dbe23f9fefb	7
162	Pat Boy	1	https://i.scdn.co/image/ab6761610000e5ebff201f137dbf830d1bd77e4a	7
163	Yaalen K'uj	499	localhost/Ressources/default.png	7
164	All Mayan Winik	499	localhost/Ressources/default.png	7
165	OG DAYV	17766	https://i.scdn.co/image/ab6761610000e5eba2b620ff66bdf0f18cb83f5a	7
166	CKay	433578	https://i.scdn.co/image/ab6761610000e5ebb6a94d2f183c0a550d434be7	1
167	PinkPantheress	1222213	https://i.scdn.co/image/ab6761610000e5ebfd7a593cda27e19c8768edea	1
168	Bloody Civilian	16211	https://i.scdn.co/image/ab6761610000e5ebf483db208391d69d58006fcc	1
169	Rema	922476	https://i.scdn.co/image/ab6761610000e5ebb193cbc1a9e1d99437b20364	2
170	Aleman	75358	https://i.scdn.co/image/ab6761610000e5eb6c1d2882997b15d14a7a7661	1
171	Blue Rojo	11005	https://i.scdn.co/image/ab6761610000e5eb86c7def2cbc17b0900c6575e	2
172	Calle x Vida	8836	https://i.scdn.co/image/ab67616d0000b273e63687e885a9723e2880a12c	2
173	Guadalupe de Jesús Chan Poot	6458	localhost/Ressources/default.png	1
174	Eminem	5979101	https://i.scdn.co/image/ab6761610000e5eba00b11c129b27a88fc72f36b	1
175	David Guetta	3910793	https://i.scdn.co/image/ab6761610000e5eb75348e1aade2645ad9c58829	1
176	Mikky Ekko	329970	https://i.scdn.co/image/ab6761610000e5eb81d954dd35145481964ddd6c	1
177	Billie Eilish	2233564	https://i.scdn.co/image/ab6761610000e5ebd8b9980db67272cb4d2c3daf	1
178	Beyoncé	4941763	https://i.scdn.co/image/ab6761610000e5eb12e3f20d05a8d6cfde988715	1
179	BEAM	91094	https://i.scdn.co/image/ab6761610000e5eb057a84dd63ea0cabb05ad4bd	2
180	Grace Jones	591208	https://i.scdn.co/image/ab6761610000e5ebc1c97da9c6326675e8c493cd	1
181	James Earl Jones	48183	https://i.scdn.co/image/ab67616d0000b273abfa781f7b1abbf48b481a3e	1
182	Chiwetel Ejiofor	18557	https://i.scdn.co/image/ab6761610000e5eba2ef3ba93fd75a548efe0c03	1
183	Tekno	102229	https://i.scdn.co/image/ab6761610000e5ebbdfa92a97f9da3258e7776e9	7
184	Lord Afrixana	2372	https://i.scdn.co/image/ab6761610000e5ebd3594f33d9cf7bbcba9f8500	1
185	Mr Eazi	120264	https://i.scdn.co/image/ab6761610000e5eb2797183a750d20da02f293ba	1
186	Yemi Alade	38414	https://i.scdn.co/image/ab6761610000e5eb2ce4e49443ccea1a7abf2e4d	1
187	JD McCrary	47812	https://i.scdn.co/image/ab6761610000e5ebb7045f5664fcd729c905e90f	1
188	Shahadi Wright Joseph	1990	https://i.scdn.co/image/ab6761610000e5eb2707a2fe54769871232016e2	1
189	Billy Eichner	88155	https://i.scdn.co/image/ab6761610000e5eb2660d94f968e40fb64887f7d	1
190	Seth Rogen	1776	https://i.scdn.co/image/ab6761610000e5eb098ada25bad2c88d4b590dc1	1
191	Childish Gambino	2266308	https://i.scdn.co/image/ab6761610000e5eb3ef779aa0d271adb2b6a3ded	1
192	Oumou Sangaré	33744	https://i.scdn.co/image/ab6761610000e5eb701aa97a73c93843574f63ee	1
193	Beyoncé Knowles Carter	522	localhost/Ressources/default.png	1
194	Salatiel	62348	https://i.scdn.co/image/ab6761610000e5eb5cce9c2d058b651b796ac5c9	1
195	Blue Ivy	105447	localhost/Ressources/default.png	2
196	SAINt JHN	703538	https://i.scdn.co/image/ab6761610000e5eb2a1356370e5fce1b25df0ac9	1
197	Wizkid	313117	https://i.scdn.co/image/ab6761610000e5eb9050b61368975fda051cdc06	1
198	Tiwa Savage	121686	https://i.scdn.co/image/ab6761610000e5eba1249cdde9d1e7b53148fcde	1
199	John Kani	9216	localhost/Ressources/default.png	2
200	Shatta Wale	8359	https://i.scdn.co/image/ab6761610000e5eb7bd706881e7d739d32bafb43	1
201	Major Lazer	1974122	https://i.scdn.co/image/ab6761610000e5eb133f44ab343b35c715a4ac97	2
202	Jack White	1055102	https://i.scdn.co/image/ab6761610000e5eb1a8b7c92db7199450ed040e6	1
203	Earl Sweatshirt	1023026	https://i.scdn.co/image/ab6761610000e5eb5e93db92ca7864585fbe5f28	1
204	John Mayer	3043276	https://i.scdn.co/image/ab6761610000e5ebe926dd683e1700a6d65bd835	1
205	André 3000	45555	https://i.scdn.co/image/5c8d57d92825466637905f0d4219064cb39333e9	1
206	Radiohead	6004057	https://i.scdn.co/image/ab6761610000e5eba03696716c9ee605006047fd	2
207	Caribou	1181382	https://i.scdn.co/image/ab6761610000e5ebf9da16d673af005d53bab9cc	1
208	Jacques Greene	252893	https://i.scdn.co/image/ab6761610000e5ebe99fca392647694cfe5689ec	1
209	Nathan Fake	321484	https://i.scdn.co/image/ab6761610000e5eb61050d0f1d957c92519d1c36	1
210	Harmonic 313	49698	https://i.scdn.co/image/ab67616d0000b273114c3a15a64a1c5f7ac9c52f	1
211	Mark Pritchard	134604	https://i.scdn.co/image/ab6761610000e5ebb9c2ee6d92297e21108d22ca	1
212	Lone	355896	https://i.scdn.co/image/ab6761610000e5eb404b517fc3a2497c90637737	1
213	Pearson Sound	81150	https://i.scdn.co/image/5188e8e5880fcb8203caef0bc724a435fd698482	1
214	Four Tet	1130757	https://i.scdn.co/image/ab6761610000e5eb84e29d09b4917bec2700a0d7	1
215	Thriller	29442	https://i.scdn.co/image/ab67616d0000b273284c0dffd90deef0d0ddf327	2
216	Illum Sphere	66527	https://i.scdn.co/image/ab6761610000e5eb98ace4829d7c27c30654d0ab	1
217	Brokenchord	36151	https://i.scdn.co/image/ab6761610000e5eb471e3a800bceaec38c888ddb	1
218	altrice	14966	https://i.scdn.co/image/ab6761610000e5ebbffdcffd0f57736ee04072e3	1
219	Blawan	82433	https://i.scdn.co/image/3fd858b01ff4e2bc7325e1c4b92eb75e38e7dc15	1
220	Modeselektor	560374	https://i.scdn.co/image/ab6761610000e5ebdbf9a15ccc6d609c6491243b	2
221	Objekt	80339	https://i.scdn.co/image/ab6761610000e5eb08aea9ebeb9054e6614a63f2	1
222	Jamie xx	759615	https://i.scdn.co/image/ab6761610000e5eb0f9ac8c1b304b9010585df33	1
223	Anstam	16814	https://i.scdn.co/image/ab67616d0000b2739d1007ceb38315103901d824	2
224	SBTRKT	779807	https://i.scdn.co/image/ab6761610000e5eb09b004d8164118bc13864afd	1
225	Tame Impala	2530646	https://i.scdn.co/image/ab6761610000e5eb90357ef28b3a012a1d1b2fa2	1
226	Harry Styles	1954164	https://i.scdn.co/image/ab6761610000e5ebf7db7c8ede90a019c54590bb	1
227	Ariana Grande	2674547	https://i.scdn.co/image/ab6761610000e5ebcdce7620dc940db079bf4952	1
228	Doja Cat	1945272	https://i.scdn.co/image/ab6761610000e5eb727a2ac15afe659be999beba	1
229	Nicki Minaj	3281391	https://i.scdn.co/image/ab6761610000e5eb6a8e5e8752d1dc2dafa63f20	1
230	Missy Elliott	1558704	https://i.scdn.co/image/ab6761610000e5ebf6691f40d906f097e9fbaa4c	1
231	JID	634940	https://i.scdn.co/image/ab6761610000e5eb8f0270ec23a53f3c1fe91849	1
232	Smino	523978	https://i.scdn.co/image/ab6761610000e5eb665eca0564934b82f47c49bc	1
233	Gucci Mane	1915550	https://i.scdn.co/image/ab6761610000e5ebb9b77f64bd278ffde2c94428	1
234	Tyga	2198623	https://i.scdn.co/image/ab6761610000e5ebf91c2e559a5a8233d3b35fb1	1
235	Konshens	115459	https://i.scdn.co/image/ab6761610000e5eb24c97baf849c5a549718d5eb	1
236	Lady Gaga	5314926	https://i.scdn.co/image/ab6761610000e5ebc8d3d98a1bccbe71393dbfbf	1
237	OneRepublic	3271254	https://i.scdn.co/image/ab6761610000e5eb57138b98e7ddd5a86ee97a9b	2
238	Hans Zimmer	1947908	https://i.scdn.co/image/ab6761610000e5eb371632043a8c12bb7eeeaf9d	1
239	Harold Faltermeyer	340963	https://i.scdn.co/image/595485b5a0d83252a95f5fcb21a7101f73b08386	1
240	Lorne Balfe	198566	https://i.scdn.co/image/ab6761610000e5eb9f83c28b83ec36891d73cc9c	1
241	Kenny Loggins	1183925	https://i.scdn.co/image/ab6761610000e5ebe5ade0d346536449c7a75b48	1
242	Miles Teller	38357	localhost/Ressources/default.png	1
243	LSDXOXO	52021	https://i.scdn.co/image/ab6761610000e5ebb8eae8aec8927355bf594894	1
244	COUCOU CHLOE	136002	https://i.scdn.co/image/ab6761610000e5eb2ad901643a00101e8cb88ad3	1
245	Arca	3032007	https://i.scdn.co/image/ab6761610000e5ebf10c9c6d4832c6f7d1d41f12	2
246	Rina Sawayama	785506	https://i.scdn.co/image/ab6761610000e5eb8cb645e0a77bf015feda7fb9	1
247	Clarence Clarity	178350	https://i.scdn.co/image/ab6761610000e5eb99c53137be374fd4fd78e966	1
248	Pabllo Vittar	354269	https://i.scdn.co/image/ab6761610000e5eb9401203023e2dc35d1ee8578	1
249	Charli XCX	1723188	https://i.scdn.co/image/ab6761610000e5eb576cb43281160e345f728b71	1
250	A. G. Cook	239662	https://i.scdn.co/image/ab6761610000e5eb9df0f924a5e609c8da143cd5	1
251	Ashnikko	731125	https://i.scdn.co/image/ab6761610000e5eb200914459687748118b36954	1
252	Oscar Scheller	85129	https://i.scdn.co/image/ab6761610000e5eb0e7decf620785dc958cea39d	1
253	BLACKPINK	1077299	https://i.scdn.co/image/ab6761610000e5ebc9690bc711d04b3d4fd4b87c	2
254	Shygirl	360699	https://i.scdn.co/image/ab6761610000e5eb661d95827980b123fab37497	1
255	Mura Masa	792069	https://i.scdn.co/image/ab6761610000e5eb0dc4ed15229eb4ea10206693	1
256	Doss	104172	https://i.scdn.co/image/ab6761610000e5ebf4c855bbac6671f45e979c71	1
257	Dorian Electra	256318	https://i.scdn.co/image/ab6761610000e5ebb61b6e56f0404d8de5f6014e	1
258	Chris Greatti	598	localhost/Ressources/default.png	7
259	Count Baldor	3336	https://i.scdn.co/image/ab6761610000e5eb715256da8f4a9fd014b0309e	7
260	Elton John	3754494	https://i.scdn.co/image/ab6761610000e5eb0a7388b95df960b5c0da8970	1
261	Chester Lockhart	14754	https://i.scdn.co/image/ab6761610000e5eb345c0e8c4eb572867d388a21	1
262	Mood Killer	14378	https://i.scdn.co/image/ab6761610000e5eb67e3b6573b3d7b19896cf1a8	1
263	Lil Texas	38798	https://i.scdn.co/image/ab6761610000e5eb5f87f4ee7f06d5468d5cb29b	1
264	Planningtorock	187281	https://i.scdn.co/image/ab6761610000e5ebdcc6f709059906d6271dfb2a	1
265	Bree Runway	237468	https://i.scdn.co/image/ab6761610000e5eba21d905242bc31171f893593	1
266	JIMMY EDGAR	136879	https://i.scdn.co/image/ab6761610000e5eb88900bd9e4a394900978ab13	1
267	Tchami	290763	https://i.scdn.co/image/ab6761610000e5ebfc95608aa4fe9512bb8781d8	1
268	BloodPop®	14700	https://i.scdn.co/image/ab6761610000e5ebdedb069c0fd879a2d87f80b2	1
269	Kylie Minogue	2534007	https://i.scdn.co/image/ab6761610000e5eb8fba8ba5daf99cad45ca354b	1
270	Big Freedia	99161	https://i.scdn.co/image/ab6761610000e5ebf4176f98fc10c838a50f8a28	1
271	The Highwomen	84455	https://i.scdn.co/image/ab6761610000e5eba0d6a5086e07adf1a9c3590e	2
272	Brittney Spencer	5134	https://i.scdn.co/image/ab6761610000e5eb1ae2cfdf38011f33123663a9	1
273	Madeline Edwards	8507	https://i.scdn.co/image/ab6761610000e5eb4bddbcab5d9912f55da2b3b7	1
274	Years & Years	918575	https://i.scdn.co/image/ab6761610000e5eb5a00879e258b7c4e76816e52	2
275	Orville Peck	261750	https://i.scdn.co/image/ab6761610000e5eb7b1eab5bbcfd5b2dd57c1753	1
276	Coldplay	6910613	https://i.scdn.co/image/ab6761610000e5eb989ed05e1f0570cc4726c2d3	2
277	Selena Gomez	1949597	https://i.scdn.co/image/ab6761610000e5eba5205abffd84341e5bace828	1
278	We Are KING	19665	https://i.scdn.co/image/ab6761610000e5eb25be8d51c6a5499a2b0116e8	2
279	Jacob Collier	287333	https://i.scdn.co/image/ab6761610000e5eb6b6a07bd9cceae9bd48be09b	1
280	BTS	1365490	https://i.scdn.co/image/ab6761610000e5eb5704a64f34fe29ff73ab56bb	2
\.


--
-- Data for Name: contenu_dans; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contenu_dans (id, id_playlist, date_ajout) FROM stdin;
1	2	2004-12-23 00:00:00
4	2	2006-07-01 00:00:00
2	2	0215-04-17 00:00:00
3	2	2012-12-12 00:00:00
11	1	2003-08-29 00:00:00
13	3	2008-09-09 00:00:00
12	1	2001-01-01 00:00:00
1	4	2002-02-17 00:00:00
3	4	2006-01-24 00:00:00
5	4	2010-06-17 00:00:00
7	4	2007-10-11 00:00:00
9	4	2020-02-06 00:00:00
13	5	2000-07-12 00:00:00
12	5	1997-05-13 00:00:00
10	6	1980-01-17 00:00:00
1	6	1999-08-10 00:00:00
\.


--
-- Data for Name: cree_par; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cree_par (id, id_morceau) FROM stdin;
1	1
2	2
2	3
2	4
2	5
2	6
2	7
2	8
2	9
2	10
2	11
2	12
2	13
2	14
2	15
2	16
2	17
2	18
2	19
2	20
1	21
1	22
1	23
1	24
1	25
1	26
1	27
1	28
3	28
1	29
1	30
1	31
1	32
1	33
1	34
4	34
1	35
1	36
5	37
1	37
1	38
6	38
1	39
7	39
8	39
1	40
5	40
1	41
1	42
1	43
1	44
1	45
1	46
1	47
1	48
3	48
1	49
1	50
1	51
1	52
1	53
1	54
4	54
1	55
1	56
9	57
9	58
9	59
9	60
10	60
9	61
9	62
9	63
9	64
9	65
9	66
9	67
9	68
9	69
9	70
9	71
9	72
9	73
9	74
9	75
9	76
9	77
9	78
9	79
11	79
9	80
9	81
9	82
9	83
12	83
9	84
9	85
9	86
9	87
9	88
9	89
9	90
9	91
9	92
9	93
9	94
9	95
9	96
13	96
9	97
9	98
9	99
9	100
9	101
9	102
9	103
9	104
9	105
9	106
9	107
9	108
9	109
10	110
10	111
10	112
10	113
10	114
10	115
14	115
10	116
10	117
10	118
10	119
15	119
10	120
16	120
10	121
17	121
10	122
18	122
10	123
10	124
19	124
10	125
10	126
10	127
10	128
10	129
10	130
10	131
10	132
10	133
10	134
10	135
10	136
10	137
10	138
10	139
10	140
10	141
10	142
10	143
10	144
10	145
10	146
10	147
10	148
10	149
20	149
10	150
10	151
21	151
22	151
10	152
10	153
10	154
10	155
10	156
10	157
10	158
10	159
10	160
10	161
10	162
10	163
10	164
10	165
10	166
10	167
1	167
10	168
10	169
10	170
10	171
23	171
24	171
10	172
23	172
10	173
10	174
10	175
10	176
10	177
25	177
10	178
26	178
10	179
10	180
10	181
3	182
27	182
3	183
3	184
28	184
3	185
29	185
30	185
3	186
3	187
4	187
3	188
3	189
31	189
3	190
32	190
3	191
33	191
34	191
3	192
3	193
35	193
3	194
3	195
36	195
37	195
3	196
3	197
3	198
3	199
38	199
3	200
3	201
23	201
3	202
27	202
3	203
3	204
28	204
3	205
29	205
30	205
3	206
3	207
4	207
3	208
3	209
31	209
3	210
32	210
3	211
33	211
34	211
3	212
3	213
35	213
3	214
3	215
36	215
37	215
3	216
3	217
3	218
3	219
3	220
3	221
3	222
3	223
3	224
3	225
3	226
3	227
3	228
3	229
3	230
39	230
3	231
40	231
3	232
3	233
41	233
3	234
23	234
3	235
42	235
3	236
43	236
3	237
39	237
44	237
3	238
3	239
40	239
45	239
3	240
4	240
3	241
3	242
3	243
3	244
46	244
3	245
47	245
3	246
48	246
3	247
49	247
50	247
3	248
51	248
48	248
41	248
3	249
3	250
52	250
53	250
54	250
48	250
3	251
55	251
56	251
54	251
3	252
50	252
3	253
57	253
49	253
48	253
41	253
3	254
4	254
58	254
3	255
37	255
59	255
3	256
60	256
61	256
62	256
3	257
3	258
3	259
3	260
3	261
3	262
3	263
58	264
58	265
58	266
58	267
58	268
58	269
58	270
58	271
58	272
58	273
58	274
58	275
58	276
58	277
58	278
58	279
58	280
58	281
58	282
58	283
58	284
63	284
58	285
58	286
58	287
58	288
58	289
30	289
64	289
58	290
64	290
58	291
58	292
65	292
58	293
66	293
67	293
58	294
68	295
70	295
68	296
68	297
71	297
68	298
30	298
68	299
68	300
72	300
68	301
58	302
58	303
58	304
58	305
73	305
58	306
58	307
73	307
58	308
74	309
74	310
74	311
74	312
75	312
76	312
74	313
77	313
74	314
74	315
74	316
78	316
74	317
79	317
80	317
74	318
74	319
74	320
81	320
74	321
74	322
82	322
83	322
74	323
74	324
84	324
74	325
85	325
74	326
74	327
74	328
74	329
86	329
50	330
87	330
88	330
89	331
90	331
38	332
91	332
92	333
93	334
94	335
95	335
96	335
97	336
74	336
98	336
96	336
99	337
99	338
100	338
101	339
102	339
103	339
74	340
104	340
1	341
74	341
74	342
74	343
74	344
74	345
74	346
74	347
105	347
74	348
74	349
74	350
74	351
99	351
74	352
106	352
74	353
74	354
74	355
74	356
74	357
74	358
74	359
74	360
74	361
74	362
74	363
107	364
108	364
107	365
108	365
107	366
108	366
107	367
107	368
108	368
107	369
108	369
107	370
108	370
107	371
108	371
107	372
108	372
107	373
108	373
104	373
107	374
108	374
107	375
107	376
107	377
108	377
108	378
107	379
107	380
107	381
107	382
107	383
107	384
107	385
107	386
107	387
107	388
107	389
107	390
107	391
107	392
107	393
108	393
107	394
107	395
107	396
109	396
107	397
110	397
111	397
107	398
112	398
107	399
104	399
107	400
98	400
113	400
107	401
107	402
98	402
107	403
107	404
114	404
107	405
107	406
108	406
115	406
107	407
107	408
107	409
116	409
107	410
30	410
107	411
4	411
117	411
107	412
69	412
107	413
107	414
107	415
107	416
111	416
107	417
118	417
107	418
107	419
98	419
107	420
107	421
98	422
107	422
113	422
107	423
24	423
107	424
107	425
107	426
119	426
120	426
107	427
107	428
107	429
107	430
107	431
107	432
107	433
107	434
107	435
107	436
107	437
107	438
121	438
107	439
107	440
117	440
107	441
107	442
122	442
107	443
107	444
86	445
86	446
86	447
86	448
86	449
86	450
86	451
123	451
86	452
86	453
86	454
86	455
86	456
124	456
86	457
86	458
86	459
86	460
86	461
86	462
86	463
86	464
104	464
125	465
125	466
127	467
125	467
128	467
129	468
130	468
131	468
125	469
129	469
132	470
125	471
132	471
133	471
134	471
135	471
136	471
129	471
137	471
129	472
125	472
125	473
138	474
127	475
126	476
79	476
86	477
139	478
140	478
141	479
142	480
74	481
74	482
86	482
50	483
87	483
88	483
89	484
90	484
38	485
91	485
92	486
93	487
94	488
95	488
96	488
97	489
74	489
98	489
96	489
99	490
99	491
100	491
101	492
102	492
103	492
74	493
104	493
1	494
74	494
86	495
86	496
104	496
86	497
74	497
86	498
86	499
86	500
86	501
86	502
86	503
86	504
86	505
122	505
86	506
86	507
143	507
86	508
144	509
144	510
144	511
144	512
144	513
144	514
144	515
144	516
144	517
144	518
144	519
144	520
144	521
144	522
144	523
144	524
144	525
144	526
144	527
144	528
144	529
144	530
144	531
144	532
144	533
144	534
144	535
144	536
144	537
144	538
144	539
144	540
144	541
144	542
144	543
144	544
144	545
144	546
144	547
144	548
144	549
144	550
144	551
144	552
144	553
105	554
145	555
146	555
147	555
148	555
149	555
150	556
116	557
151	558
152	558
153	559
154	559
155	560
156	560
157	561
158	562
159	563
160	563
161	564
162	564
163	564
164	564
165	565
98	565
166	566
167	566
168	567
169	567
170	568
169	568
145	569
146	569
147	569
148	569
149	569
171	570
172	571
153	571
173	572
105	573
105	574
86	574
105	575
105	576
105	577
107	577
105	578
105	579
105	580
105	581
105	582
105	583
105	584
105	585
105	586
105	587
105	588
105	589
174	589
105	590
105	591
98	591
105	592
105	593
175	593
105	594
105	595
176	595
105	596
118	596
105	597
105	598
105	599
105	600
177	601
177	602
177	603
177	604
177	605
177	606
177	607
177	608
177	609
177	610
177	611
177	612
177	613
177	614
177	615
177	616
177	617
177	618
177	619
177	620
177	621
177	622
177	623
177	624
177	625
177	626
177	627
177	628
177	629
177	630
178	631
178	632
178	633
178	634
178	635
179	635
178	636
178	637
178	638
178	639
178	640
180	640
116	640
178	641
178	642
178	643
178	644
178	645
178	646
181	647
178	648
181	649
178	650
182	651
183	652
184	652
185	652
186	652
187	653
188	653
150	654
187	655
182	655
178	656
74	656
189	657
190	657
187	657
178	658
112	658
191	658
192	658
193	659
191	659
194	660
37	660
178	660
195	661
196	661
178	661
197	661
193	662
198	663
185	663
191	664
199	664
178	665
200	665
201	665
181	666
178	667
178	668
178	669
202	669
178	670
178	671
1	671
178	672
178	673
178	674
178	675
96	675
178	676
74	676
178	677
178	678
178	679
40	680
40	681
40	682
40	683
40	684
40	685
40	686
40	687
40	688
40	689
40	690
40	691
40	692
40	693
40	694
40	695
40	696
40	697
40	698
40	699
40	700
40	701
40	702
40	703
203	703
40	704
40	705
40	706
40	707
40	708
204	708
40	709
40	710
40	711
205	711
40	712
40	713
206	714
206	715
206	716
206	717
206	718
206	719
206	720
206	721
206	722
206	723
206	724
206	725
206	726
206	727
206	728
206	729
206	730
206	731
206	732
206	733
206	734
206	735
206	736
206	737
206	738
206	739
206	740
206	741
206	742
206	743
206	744
206	745
206	746
206	747
206	748
206	749
206	750
206	751
206	752
206	753
206	754
206	755
206	756
206	757
206	758
206	759
206	760
206	761
206	762
206	763
206	764
206	765
207	765
206	766
208	766
206	767
209	767
206	768
210	768
206	769
211	769
206	770
212	770
206	771
213	771
206	772
214	772
206	773
215	773
206	774
216	774
206	775
206	776
217	776
206	777
218	777
206	778
219	778
206	779
220	779
206	780
221	780
206	781
222	781
206	782
223	782
206	783
224	783
206	784
206	785
206	786
206	787
206	788
206	789
206	790
206	791
225	792
225	793
225	794
225	795
225	796
225	797
225	798
225	799
225	800
225	801
225	802
225	803
225	804
225	805
225	806
225	807
225	808
225	809
225	810
225	811
225	812
225	813
225	814
225	815
225	816
225	817
225	818
225	819
225	820
225	821
225	822
225	823
225	824
225	825
225	826
225	827
225	828
225	829
225	830
225	831
225	832
225	833
225	834
225	835
225	836
225	837
225	838
225	839
226	840
226	841
226	842
226	843
226	844
226	845
226	846
226	847
226	848
226	849
226	850
226	851
226	852
226	853
226	854
226	855
226	856
226	857
226	858
226	859
226	860
226	861
226	862
226	863
226	864
226	865
226	866
226	867
226	868
226	869
226	870
226	871
226	872
226	873
226	874
227	875
227	876
227	877
228	877
227	878
227	879
1	879
227	880
227	881
30	881
227	882
227	883
227	884
227	885
227	886
227	887
227	888
227	889
227	890
227	891
227	892
227	893
227	894
227	895
227	896
227	897
227	898
227	899
227	900
227	901
227	902
37	902
227	903
229	903
227	904
227	905
227	906
227	907
227	908
227	909
227	910
227	911
230	911
227	912
227	913
227	914
227	915
228	916
228	917
228	918
113	918
228	919
228	920
228	921
227	921
228	922
228	923
1	923
228	924
228	925
231	925
228	926
228	927
228	928
228	929
86	929
228	930
228	931
232	931
228	932
228	933
228	934
228	935
233	935
228	936
228	937
228	938
228	939
228	940
228	941
234	941
228	942
228	943
228	944
228	945
235	945
228	946
228	947
228	948
228	949
228	950
228	951
228	952
228	953
228	954
239	955
236	955
238	955
240	955
241	956
239	957
236	957
238	957
240	957
242	958
239	959
236	959
238	959
240	959
237	960
239	961
236	961
238	961
240	961
239	962
236	962
238	962
240	962
239	963
236	963
238	963
240	963
239	964
236	964
238	964
240	964
236	965
239	966
236	966
238	966
240	966
236	967
243	967
236	968
244	968
236	969
227	969
245	969
236	970
246	970
247	970
236	971
248	971
236	972
249	972
250	972
236	973
251	973
252	973
236	974
253	974
254	974
255	974
236	975
256	975
236	976
257	976
258	976
259	976
236	977
260	977
261	977
262	977
263	977
236	978
264	978
236	979
265	979
266	979
236	980
267	980
268	980
236	981
236	982
236	983
236	984
236	985
236	986
236	987
236	988
236	989
236	990
236	991
236	992
236	993
236	994
269	995
270	996
271	997
272	997
273	997
125	998
274	999
275	1000
236	1001
236	1002
236	1003
236	1004
227	1004
236	1005
236	1006
236	1007
236	1008
236	1009
236	1010
253	1010
236	1011
236	1012
236	1013
236	1014
260	1014
236	1015
236	1016
276	1017
276	1018
276	1019
276	1020
276	1021
277	1021
276	1022
278	1022
279	1022
276	1023
276	1024
276	1025
276	1026
280	1026
276	1027
276	1028
276	1029
276	1030
276	1031
276	1032
276	1033
276	1034
276	1035
276	1036
276	1037
276	1038
276	1039
276	1040
276	1041
276	1042
276	1043
276	1044
276	1045
276	1046
276	1047
276	1048
276	1049
276	1050
276	1051
276	1052
276	1053
276	1054
276	1055
\.


--
-- Data for Name: morceau; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.morceau (id, titre, duree, data, id_album) FROM stdin;
1	Nothing Is Lost (You Give Me Strength)	1	test	1
2	Into the Water	1	test	1
3	Happiness Is Simple	1	test	1
4	A New Star	1	test	1
5	Converging Paths	1	test	1
6	Rescue and Loss	1	test	1
7	Family Is Our Fortress	1	test	1
8	Leaving Home	1	test	1
9	The Way of Water	1	test	1
10	Payakan	1	test	1
11	Mighty Eywa	1	test	1
12	Friends	1	test	1
13	Cove of the Ancestors	1	test	1
14	The Tulkun Return	1	test	1
15	The Hunt	1	test	1
16	Na'vi Attack	1	test	1
17	Eclipse	1	test	1
18	Bad Parents	1	test	1
19	Knife Fight	1	test	1
20	From Darkness to Light	1	test	1
21	Dawn FM	1	test	2
22	Gasoline	1	test	2
23	How Do I Make You Love Me?	1	test	2
24	Take My Breath	1	test	2
25	Sacrifice	1	test	2
26	A Tale By Quincy	1	test	2
27	Out of Time	1	test	2
28	Here We Go… Again (feat. Tyler, the Creator)	1	test	2
29	Best Friends	1	test	2
30	Is There Someone Else?	1	test	2
31	Starry Eyes	1	test	2
32	Every Angel is Terrifying	1	test	2
33	Don’t Break My Heart	1	test	2
34	I Heard You're Married (feat. Lil Wayne)	1	test	2
35	Less Than Zero	1	test	2
36	Phantom Regret by Jim	1	test	2
37	Moth To A Flame (with The Weeknd)	1	test	2
38	Dawn FM - OPN Remix	1	test	2
39	How Do I Make You Love Me? - Sebastian Ingrosso & Salvatore Ganacci Remix	1	test	2
40	Sacrifice (Remix) (feat. Swedish House Mafia)	1	test	2
41	Dawn FM	1	test	3
42	Gasoline	1	test	3
43	How Do I Make You Love Me?	1	test	3
44	Take My Breath	1	test	3
45	Sacrifice	1	test	3
46	A Tale By Quincy	1	test	3
47	Out of Time	1	test	3
48	Here We Go… Again (feat. Tyler, the Creator)	1	test	3
49	Best Friends	1	test	3
50	Is There Someone Else?	1	test	3
51	Starry Eyes	1	test	3
52	Every Angel is Terrifying	1	test	3
53	Don’t Break My Heart	1	test	3
54	I Heard You’re Married (feat. Lil Wayne)	1	test	3
55	Less Than Zero	1	test	3
56	Phantom Regret by Jim	1	test	3
57	Lavender Haze	1	test	4
58	Maroon	1	test	4
59	Anti-Hero	1	test	4
60	Snow On The Beach (feat. Lana Del Rey)	1	test	4
61	You're On Your Own, Kid	1	test	4
62	Midnight Rain	1	test	4
63	Question...?	1	test	4
64	Vigilante Shit	1	test	4
65	Bejeweled	1	test	4
66	Labyrinth	1	test	4
67	Karma	1	test	4
68	Sweet Nothing	1	test	4
69	Mastermind	1	test	4
70	State Of Grace (Taylor's Version)	1	test	5
71	Red (Taylor's Version)	1	test	5
72	Treacherous (Taylor's Version)	1	test	5
73	I Knew You Were Trouble (Taylor's Version)	1	test	5
74	All Too Well (Taylor's Version)	1	test	5
75	22 (Taylor's Version)	1	test	5
76	I Almost Do (Taylor's Version)	1	test	5
77	We Are Never Ever Getting Back Together (Taylor's Version)	1	test	5
78	Stay Stay Stay (Taylor's Version)	1	test	5
79	The Last Time (feat. Gary Lightbody of Snow Patrol) (Taylor’s Version)	1	test	5
80	Holy Ground (Taylor's Version)	1	test	5
81	Sad Beautiful Tragic (Taylor's Version)	1	test	5
82	The Lucky One (Taylor's Version)	1	test	5
83	Everything Has Changed (feat. Ed Sheeran) (Taylor’s Version)	1	test	5
84	Starlight (Taylor's Version)	1	test	5
85	Begin Again (Taylor's Version)	1	test	5
86	The Moment I Knew (Taylor's Version)	1	test	5
87	Come Back...Be Here (Taylor's Version)	1	test	5
88	Girl At Home (Taylor's Version)	1	test	5
89	State Of Grace (Acoustic Version) (Taylor's Version)	1	test	5
90	Fearless (Taylor’s Version)	1	test	6
91	Fifteen (Taylor’s Version)	1	test	6
92	Love Story (Taylor’s Version)	1	test	6
93	Hey Stephen (Taylor’s Version)	1	test	6
94	White Horse (Taylor’s Version)	1	test	6
95	You Belong With Me (Taylor’s Version)	1	test	6
96	Breathe (feat. Colbie Caillat) (Taylor’s Version)	1	test	6
97	Tell Me Why (Taylor’s Version)	1	test	6
98	You’re Not Sorry (Taylor’s Version)	1	test	6
99	The Way I Loved You (Taylor’s Version)	1	test	6
100	Forever & Always (Taylor’s Version)	1	test	6
101	The Best Day (Taylor’s Version)	1	test	6
102	Change (Taylor’s Version)	1	test	6
103	Jump Then Fall (Taylor’s Version)	1	test	6
104	Untouchable (Taylor’s Version)	1	test	6
105	Forever & Always (Piano Version) (Taylor’s Version)	1	test	6
214	BLESSED	1	test	13
106	Come In With The Rain (Taylor’s Version)	1	test	6
107	Superstar (Taylor’s Version)	1	test	6
108	The Other Side Of The Door (Taylor’s Version)	1	test	6
109	Today Was A Fairytale (Taylor’s Version)	1	test	6
110	The Grants	1	test	7
111	Did you know that there's a tunnel under Ocean Blvd	1	test	7
112	Sweet	1	test	7
113	A&W	1	test	7
114	Judah Smith Interlude	1	test	7
115	Candy Necklace (feat. Jon Batiste)	1	test	7
116	Jon Batiste Interlude	1	test	7
117	Kintsugi	1	test	7
118	Fingertips	1	test	7
119	Paris, Texas (feat. SYML)	1	test	7
120	Grandfather please stand on the shoulders of my father while he's deep-sea fishing (feat. RIOPY)	1	test	7
121	Let The Light In (feat. Father John Misty)	1	test	7
122	Margaret (feat. Bleachers)	1	test	7
123	Fishtail	1	test	7
124	Peppers (feat. Tommy Genesis)	1	test	7
125	Taco Truck x VB	1	test	7
126	Text Book	1	test	8
127	Blue Banisters	1	test	8
128	Arcadia	1	test	8
129	Interlude - The Trio	1	test	8
130	Black Bathing Suit	1	test	8
131	If You Lie Down With Me	1	test	8
132	Beautiful	1	test	8
133	Violets for Roses	1	test	8
134	Dealer	1	test	8
135	Thunder	1	test	8
136	Wildflower Wildfire	1	test	8
137	Nectar Of The Gods	1	test	8
138	Living Legend	1	test	8
139	Cherry Blossom	1	test	8
140	Sweet Carolina	1	test	8
141	White Dress	1	test	9
142	Chemtrails Over The Country Club	1	test	9
143	Tulsa Jesus Freak	1	test	9
144	Let Me Love You Like A Woman	1	test	9
145	Wild At Heart	1	test	9
146	Dark But Just A Game	1	test	9
147	Not All Who Wander Are Lost	1	test	9
148	Yosemite	1	test	9
149	Breaking Up Slowly	1	test	9
150	Dance Till We Die	1	test	9
151	For Free	1	test	9
152	Norman fucking Rockwell	1	test	10
153	Mariners Apartment Complex	1	test	10
154	Venice Bitch	1	test	10
155	Fuck it I love you	1	test	10
156	Doin' Time	1	test	10
157	Love song	1	test	10
158	Cinnamon Girl	1	test	10
159	How to disappear	1	test	10
160	California	1	test	10
161	The Next Best American Record	1	test	10
162	The greatest	1	test	10
163	Bartender	1	test	10
164	Happiness is a butterfly	1	test	10
165	hope is a dangerous thing for a woman like me to have - but I have it	1	test	10
166	Love	1	test	11
167	Lust For Life (with The Weeknd)	1	test	11
168	13 Beaches	1	test	11
169	Cherry	1	test	11
170	White Mustang	1	test	11
171	Summer Bummer (feat. A$AP Rocky & Playboi Carti)	1	test	11
172	Groupie Love (feat. A$AP Rocky)	1	test	11
173	In My Feelings	1	test	11
174	Coachella - Woodstock In My Mind	1	test	11
175	God Bless America - And All The Beautiful Women In It	1	test	11
176	When The World Was At War We Kept Dancing	1	test	11
177	Beautiful People Beautiful Problems (feat. Stevie Nicks)	1	test	11
178	Tomorrow Never Came (feat. Sean Ono Lennon)	1	test	11
179	Heroin	1	test	11
180	Change	1	test	11
181	Get Free	1	test	11
182	SIR BAUDELAIRE (feat. DJ Drama)	1	test	12
183	CORSO	1	test	12
184	LEMONHEAD (feat. 42 Dugg)	1	test	12
185	WUSYANAME (feat. Youngboy Never Broke Again & Ty Dolla $ign)	1	test	12
186	LUMBERJACK	1	test	12
187	HOT WIND BLOWS (feat. Lil Wayne)	1	test	12
188	MASSA	1	test	12
189	RUNITUP (feat. Teezo Touchdown)	1	test	12
190	MANIFESTO (feat. Domo Genesis)	1	test	12
191	SWEET / I THOUGHT YOU WANTED TO DANCE (feat. Brent Faiyaz & Fana Hues)	1	test	12
192	MOMMA TALK	1	test	12
193	RISE! (feat. DAISY WORLD)	1	test	12
194	BLESSED	1	test	12
195	JUGGERNAUT (feat. Lil Uzi Vert & Pharrell Williams)	1	test	12
196	WILSHIRE	1	test	12
197	SAFARI	1	test	12
198	EVERYTHING MUST GO	1	test	12
199	STUNTMAN (feat. Vince Staples)	1	test	12
200	WHAT A DAY	1	test	12
201	WHARF TALK (feat. A$AP Rocky)	1	test	12
202	SIR BAUDELAIRE (feat. DJ Drama)	1	test	13
203	CORSO	1	test	13
204	LEMONHEAD (feat. 42 Dugg)	1	test	13
205	WUSYANAME (feat. Youngboy Never Broke Again & Ty Dolla $ign)	1	test	13
206	LUMBERJACK	1	test	13
207	HOT WIND BLOWS (feat. Lil Wayne)	1	test	13
208	MASSA	1	test	13
209	RUNITUP (feat. Teezo Touchdown)	1	test	13
210	MANIFESTO (feat. Domo Genesis)	1	test	13
211	SWEET / I THOUGHT YOU WANTED TO DANCE (feat. Brent Faiyaz & Fana Hues)	1	test	13
212	MOMMA TALK	1	test	13
213	RISE! (feat. DAISY WORLD)	1	test	13
215	JUGGERNAUT (feat. Lil Uzi Vert & Pharrell Williams)	1	test	13
216	WILSHIRE	1	test	13
217	SAFARI	1	test	13
218	IGOR'S THEME	1	test	14
219	EARFQUAKE	1	test	14
220	I THINK	1	test	14
221	EXACTLY WHAT YOU RUN FROM YOU END UP CHASING	1	test	14
222	RUNNING OUT OF TIME	1	test	14
223	NEW MAGIC WAND	1	test	14
224	A BOY IS A GUN*	1	test	14
225	PUPPET	1	test	14
226	WHAT'S GOOD	1	test	14
227	GONE, GONE / THANK YOU	1	test	14
228	I DON'T LOVE YOU ANYMORE	1	test	14
229	ARE WE STILL FRIENDS?	1	test	14
230	Foreword (feat. Rex Orange County)	1	test	15
231	Where This Flower Blooms (feat. Frank Ocean)	1	test	15
232	Sometimes...	1	test	15
233	See You Again (feat. Kali Uchis)	1	test	15
234	Who Dat Boy (feat. A$AP Rocky)	1	test	15
235	Pothole (feat. Jaden Smith)	1	test	15
236	Garden Shed (feat. Estelle)	1	test	15
237	Boredom (feat. Rex Orange County & Anna of the North)	1	test	15
238	I Ain't Got Time!	1	test	15
239	911 / Mr. Lonely (feat. Frank Ocean & Steve Lacy)	1	test	15
240	Droppin' Seeds (feat. Lil' Wayne)	1	test	15
241	November	1	test	15
242	Glitter	1	test	15
243	Enjoy Right Now, Today	1	test	15
244	DEATHCAMP (feat. Cole Alexander)	1	test	16
245	BUFFALO (feat. Shane Powers)	1	test	16
246	PILOT (feat. Sydney Bennett)	1	test	16
247	RUN (feat. Chaz Bundick & ScHoolboy Q)	1	test	16
248	FIND YOUR WINGS (feat. Roy Ayers, Sydney Bennett & Kali Uchis)	1	test	16
249	CHERRY BOMB	1	test	16
250	BLOW MY LOAD (feat. Wanya Morris, Dâm-Funk, Austin Feinstein & Sydney Bennett)	1	test	16
251	2SEATER (feat. Aaron Shaw, Samantha Nelson & Austin Feinstein)	1	test	16
252	THE BROWN STAINS OF DARKEESE LATIFAH PART 6-12 (REMIX) (feat. ScHoolboy Q)	1	test	16
253	FUCKING YOUNG / PERFECT (feat. Charlie Wilson, Chaz Bundick, Sydney Bennett & Kali Uchis)	1	test	16
254	SMUCKERS (feat. Lil Wayne & Kanye West)	1	test	16
255	KEEP DA O'S (feat. Pharrell Williams & Coco O.)	1	test	16
256	OKAGA, CA (feat. Alice Smith, Leon Ware & Clem Creevy)	1	test	16
257	DEATHCAMP - Instrumental	1	test	16
258	BUFFALO - Instrumental	1	test	16
259	PILOT - Instrumental	1	test	16
260	RUN - Instrumental	1	test	16
261	FIND YOUR WINGS - Instrumental	1	test	16
262	CHERRY BOMB - Instrumental	1	test	16
263	BLOW MY LOAD - Instrumental	1	test	16
264	Donda Chant	1	test	17
265	Jail	1	test	17
266	God Breathed	1	test	17
267	Off The Grid	1	test	17
268	Hurricane	1	test	17
269	Praise God	1	test	17
270	Jonah	1	test	17
271	Ok Ok	1	test	17
272	Junya	1	test	17
273	Believe What I Say	1	test	17
274	24	1	test	17
275	Remote Control	1	test	17
276	Moon	1	test	17
277	Heaven and Hell	1	test	17
278	Donda	1	test	17
279	Keep My Spirit Alive	1	test	17
280	Jesus Lord	1	test	17
281	New Again	1	test	17
282	Tell The Vision	1	test	17
283	Lord I Need You	1	test	17
284	Every Hour	1	test	18
285	Selah	1	test	18
286	Follow God	1	test	18
287	Closed On Sunday	1	test	18
288	On God	1	test	18
289	Everything We Need	1	test	18
290	Water	1	test	18
291	God Is	1	test	18
292	Hands On	1	test	18
293	Use This Gospel	1	test	18
294	Jesus Is Lord	1	test	18
295	Feel The Love	1	test	19
296	Fire	1	test	19
297	4th Dimension	1	test	19
298	Freeee (Ghost Town Pt. 2)	1	test	19
299	Reborn	1	test	19
300	Kids See Ghosts	1	test	19
301	Cudi Montage	1	test	19
302	I Thought About Killing You	1	test	20
303	Yikes	1	test	20
304	All Mine	1	test	20
305	Wouldn't Leave	1	test	20
306	No Mistakes	1	test	20
307	Ghost Town	1	test	20
308	Violent Crimes	1	test	20
309	United In Grief	1	test	21
310	N95	1	test	21
311	Worldwide Steppers	1	test	21
312	Die Hard	1	test	21
313	Father Time (feat. Sampha)	1	test	21
314	Rich - Interlude	1	test	21
315	Rich Spirit	1	test	21
316	We Cry Together	1	test	21
317	Purple Hearts	1	test	21
318	Count Me Out	1	test	21
319	Crown	1	test	21
320	Silent Hill	1	test	21
321	Savior - Interlude	1	test	21
322	Savior	1	test	21
323	Auntie Diaries	1	test	21
324	Mr. Morale	1	test	21
325	Mother I Sober (feat. Beth Gibbons of Portishead)	1	test	21
326	Mirror	1	test	21
327	The Heart Part 5	1	test	21
328	Black Panther	1	test	22
329	All The Stars (with SZA)	1	test	22
330	X (with 2 Chainz & Saudi)	1	test	22
331	The Ways (with Swae Lee)	1	test	22
332	Opps (with Yugen Blakrok)	1	test	22
333	I Am	1	test	22
334	Paramedic!	1	test	22
335	Bloody Waters (with Anderson .Paak & James Blake)	1	test	22
336	King's Dead (with Kendrick Lamar, Future & James Blake)	1	test	22
337	Redemption Interlude	1	test	22
338	Redemption (with Babes Wodumo)	1	test	22
339	Seasons (with Sjava & Reason)	1	test	22
340	Big Shot (with Travis Scott)	1	test	22
341	Pray For Me (with Kendrick Lamar)	1	test	22
342	BLOOD.	1	test	23
343	DNA.	1	test	23
344	YAH.	1	test	23
345	ELEMENT.	1	test	23
346	FEEL.	1	test	23
347	LOYALTY. FEAT. RIHANNA.	1	test	23
348	PRIDE.	1	test	23
349	HUMBLE.	1	test	23
350	LUST.	1	test	23
351	LOVE. FEAT. ZACARI.	1	test	23
352	XXX. FEAT. U2.	1	test	23
353	FEAR.	1	test	23
354	GOD.	1	test	23
355	DUCKWORTH.	1	test	23
356	untitled 01 | 08.19.2014.	1	test	24
357	untitled 02 | 06.23.2014.	1	test	24
358	untitled 03 | 05.28.2013.	1	test	24
359	untitled 04 | 08.14.2014.	1	test	24
360	untitled 05 | 09.21.2014.	1	test	24
361	untitled 06 | 06.30.2014.	1	test	24
362	untitled 07 | 2014 - 2016	1	test	24
363	untitled 08 | 09.06.2014.	1	test	24
364	Rich Flex	1	test	25
365	Major Distribution	1	test	25
366	On BS	1	test	25
367	BackOutsideBoyz	1	test	25
368	Privileged Rappers	1	test	25
369	Spin Bout U	1	test	25
370	Hours In Silence	1	test	25
371	Treacherous Twins	1	test	25
372	Circo Loco	1	test	25
373	Pussy & Millions (feat. Travis Scott)	1	test	25
374	Broke Boys	1	test	25
375	Middle of the Ocean	1	test	25
376	Jumbotron Shit Poppin	1	test	25
377	More M’s	1	test	25
378	3AM on Glenwood	1	test	25
379	I Guess It’s Fuck Me	1	test	25
380	Intro	1	test	26
381	Falling Back	1	test	26
382	Texts Go Green	1	test	26
383	Currents	1	test	26
384	A Keeper	1	test	26
385	Calling My Name	1	test	26
386	Sticky	1	test	26
387	Massive	1	test	26
388	Flight's Booked	1	test	26
389	Overdrive	1	test	26
390	Down Hill	1	test	26
391	Tie That Binds	1	test	26
392	Liability	1	test	26
393	Jimmy Cooks (feat. 21 Savage)	1	test	26
394	Champagne Poetry	1	test	27
395	Papi’s Home	1	test	27
396	Girls Want Girls (with Lil Baby)	1	test	27
397	In The Bible (with Lil Durk & Giveon)	1	test	27
398	Love All (with JAY-Z)	1	test	27
399	Fair Trade (with Travis Scott)	1	test	27
400	Way 2 Sexy (with Future & Young Thug)	1	test	27
401	TSU	1	test	27
402	N 2 Deep	1	test	27
403	Pipe Down	1	test	27
404	Yebba’s Heartbreak	1	test	27
405	No Friends In The Industry	1	test	27
406	Knife Talk (with 21 Savage ft. Project Pat)	1	test	27
407	7am On Bridle Path	1	test	27
408	Race My Mind	1	test	27
409	Fountains (with Tems)	1	test	27
410	Get Along Better	1	test	27
411	You Only Live Twice (with Lil Wayne & Rick Ross)	1	test	27
412	IMY2 (with Kid Cudi)	1	test	27
413	F*****g Fans	1	test	27
414	Deep Pockets	1	test	28
415	When To Say When	1	test	28
416	Chicago Freestyle (feat. Giveon)	1	test	28
417	Not You Too (feat. Chris Brown)	1	test	28
418	Toosie Slide	1	test	28
419	Desires (with Future)	1	test	28
420	Time Flies	1	test	28
421	Landed	1	test	28
422	D4L	1	test	28
423	Pain 1993 (with Playboi Carti)	1	test	28
424	Losses	1	test	28
425	From Florida With Love	1	test	28
426	Demons (feat. Fivio Foreign & Sosa Geek)	1	test	28
427	War	1	test	28
428	Dreams Money Can Buy	1	test	29
429	The Motion	1	test	29
430	How Bout Now	1	test	29
431	Trust Issues	1	test	29
432	Days in The East	1	test	29
433	Draft Day	1	test	29
434	4pm in Calabasas	1	test	29
435	5 Am in Toronto	1	test	29
436	I Get Lonely	1	test	29
437	My Side	1	test	29
438	Jodeci Freestyle (feat. J. Cole)	1	test	29
439	Club Paradise	1	test	29
440	Free Spirit (feat. Rick Ross)	1	test	29
441	Heat Of The Moment	1	test	29
540	Knee Socks	1	test	36
442	Girls Love Beyoncé (feat. James Fauntleroy)	1	test	29
443	Paris Morton Music	1	test	29
444	Can I	1	test	29
445	SOS	1	test	30
446	Kill Bill	1	test	30
447	Seek & Destroy	1	test	30
448	Low	1	test	30
449	Love Language	1	test	30
450	Blind	1	test	30
451	Used (feat. Don Toliver)	1	test	30
452	Snooze	1	test	30
453	Notice Me	1	test	30
454	Gone Girl	1	test	30
455	Smoking on my Ex Pack	1	test	30
456	Ghost in the Machine (feat. Phoebe Bridgers)	1	test	30
457	F2F	1	test	30
458	Nobody Gets Me	1	test	30
459	Conceited	1	test	30
460	Special	1	test	30
461	Too Late	1	test	30
462	Far	1	test	30
463	Shirt	1	test	30
464	Open Arms (feat. Travis Scott)	1	test	30
465	Waving Through A Window - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
466	For Forever - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
467	Sincerely Me - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
468	Requiem - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
469	If I Could Tell Her - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
470	The Anonymous Ones - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
471	You Will Be Found - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
472	Only Us - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
473	Words Fail - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
474	So Big / So Small - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
475	A Little Closer - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
476	You Will Be Found (Sam Smith & Summer Walker Version) - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
477	The Anonymous Ones (SZA Version) - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
478	Only Us (Carrie Underwood & Dan + Shay Version) - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
479	A Little Closer (FINNEAS Version) - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
480	Waving Through A Window (Tori Kelly Version) - From The “Dear Evan Hansen” Original Motion Picture Soundtrack	1	test	31
481	Black Panther	1	test	32
482	All The Stars (with SZA)	1	test	32
483	X (with 2 Chainz & Saudi)	1	test	32
484	The Ways (with Swae Lee)	1	test	32
485	Opps (with Yugen Blakrok)	1	test	32
486	I Am	1	test	32
487	Paramedic!	1	test	32
488	Bloody Waters (with Anderson .Paak & James Blake)	1	test	32
489	King's Dead (with Kendrick Lamar, Future & James Blake)	1	test	32
490	Redemption Interlude	1	test	32
491	Redemption (with Babes Wodumo)	1	test	32
492	Seasons (with Sjava & Reason)	1	test	32
493	Big Shot (with Travis Scott)	1	test	32
494	Pray For Me (with Kendrick Lamar)	1	test	32
495	Supermodel	1	test	33
496	Love Galore (feat. Travis Scott)	1	test	33
497	Doves In The Wind (feat. Kendrick Lamar)	1	test	33
498	Drew Barrymore	1	test	33
499	Prom	1	test	33
500	The Weekend	1	test	33
501	Go Gina	1	test	33
502	Garden (Say It Like Dat)	1	test	33
503	Broken Clocks	1	test	33
504	Anything	1	test	33
505	Wavy (Interlude) (feat. James Fauntleroy)	1	test	33
506	Normal Girl	1	test	33
507	Pretty Little Birds (feat. Isaiah Rashad)	1	test	33
508	20 Something	1	test	33
509	There’d Better Be A Mirrorball	1	test	34
510	I Ain’t Quite Where I Think I Am	1	test	34
511	Sculptures Of Anything Goes	1	test	34
512	Jet Skis On The Moat	1	test	34
513	Body Paint	1	test	34
514	The Car	1	test	34
515	Big Ideas	1	test	34
516	Hello You	1	test	34
517	Mr Schwartz	1	test	34
518	Perfect Sense	1	test	34
519	Star Treatment	1	test	35
520	One Point Perspective	1	test	35
521	American Sports	1	test	35
522	Tranquility Base Hotel & Casino	1	test	35
523	Golden Trunks	1	test	35
524	Four Out Of Five	1	test	35
525	The World's First Ever Monster Truck Front Flip	1	test	35
526	Science Fiction	1	test	35
527	She Looks Like Fun	1	test	35
528	Batphone	1	test	35
529	The Ultracheese	1	test	35
530	Do I Wanna Know?	1	test	36
531	R U Mine?	1	test	36
532	One For The Road	1	test	36
533	Arabella	1	test	36
534	I Want It All	1	test	36
535	No. 1 Party Anthem	1	test	36
536	Mad Sounds	1	test	36
537	Fireside	1	test	36
538	Why'd You Only Call Me When You're High?	1	test	36
539	Snap Out Of It	1	test	36
541	I Wanna Be Yours	1	test	36
542	She's Thunderstorms	1	test	37
543	Black Treacle	1	test	37
544	Brick By Brick	1	test	37
545	The Hellcat Spangled Shalalala	1	test	37
546	Don't Sit Down 'Cause I've Moved Your Chair	1	test	37
547	Library Pictures	1	test	37
548	All My Own Stunts	1	test	37
549	Reckless Serenade	1	test	37
550	Piledriver Waltz	1	test	37
551	Love is a Laserquest	1	test	37
552	Suck It and See	1	test	37
553	That's Where You're Wrong	1	test	37
554	Lift Me Up - From Black Panther: Wakanda Forever - Music From and Inspired By	1	test	38
555	Love & Loyalty (Believe)	1	test	38
556	Alone	1	test	38
557	No Woman No Cry	1	test	38
558	Árboles Bajo El Mar	1	test	38
559	Con La Brisa	1	test	38
560	La Vida	1	test	38
561	Interlude	1	test	38
562	Coming Back For You	1	test	38
563	They Want It, But No	1	test	38
564	Laayli' kuxa'ano'one	1	test	38
565	Limoncello	1	test	38
566	Anya Mmiri	1	test	38
567	Wake Up	1	test	38
568	Pantera	1	test	38
569	Jele	1	test	38
570	Inframundo	1	test	38
571	No Digas Mi Nombre	1	test	38
572	Mi Pueblo	1	test	38
573	Born Again	1	test	38
574	Consideration	1	test	39
575	James Joint	1	test	39
576	Kiss It Better	1	test	39
577	Work	1	test	39
578	Desperado	1	test	39
579	Woo	1	test	39
580	Needed Me	1	test	39
581	Yeah, I Said It	1	test	39
582	Same Ol’ Mistakes	1	test	39
583	Never Ending	1	test	39
584	Love On The Brain	1	test	39
585	Higher	1	test	39
586	Close To You	1	test	39
587	Phresh Out The Runway	1	test	40
588	Diamonds	1	test	40
589	Numb	1	test	40
590	Pour It Up	1	test	40
591	Loveeeeeee Song	1	test	40
592	Jump	1	test	40
593	Right Now	1	test	40
594	What Now	1	test	40
595	Stay	1	test	40
596	Nobody's Business	1	test	40
597	Love Without Tragedy / Mother Mary	1	test	40
598	Get It Over With	1	test	40
599	No Love Allowed	1	test	40
600	Lost In Paradise	1	test	40
601	Getting Older	1	test	41
602	I Didn't Change My Number	1	test	41
603	Billie Bossa Nova	1	test	41
604	my future	1	test	41
605	Oxytocin	1	test	41
606	GOLDWING	1	test	41
607	Lost Cause	1	test	41
608	Halley's Comet	1	test	41
609	Not My Responsibility	1	test	41
610	OverHeated	1	test	41
611	Everybody Dies	1	test	41
612	Your Power	1	test	41
613	NDA	1	test	41
614	Therefore I Am	1	test	41
615	Happier Than Ever	1	test	41
616	Male Fantasy	1	test	41
617	!!!!!!!	1	test	42
618	bad guy	1	test	42
619	xanny	1	test	42
620	you should see me in a crown	1	test	42
621	all the good girls go to hell	1	test	42
622	wish you were gay	1	test	42
623	when the party's over	1	test	42
624	8	1	test	42
625	my strange addiction	1	test	42
626	bury a friend	1	test	42
627	ilomilo	1	test	42
628	listen before i go	1	test	42
629	i love you	1	test	42
630	goodbye	1	test	42
631	I'M THAT GIRL	1	test	43
632	COZY	1	test	43
633	ALIEN SUPERSTAR	1	test	43
634	CUFF IT	1	test	43
635	ENERGY (feat. Beam)	1	test	43
636	BREAK MY SOUL	1	test	43
637	CHURCH GIRL	1	test	43
638	PLASTIC OFF THE SOFA	1	test	43
639	VIRGO'S GROOVE	1	test	43
640	MOVE (feat. Grace Jones & Tems)	1	test	43
641	HEATED	1	test	43
642	THIQUE	1	test	43
643	ALL UP IN YOUR MIND	1	test	43
644	AMERICA HAS A PROBLEM	1	test	43
645	PURE/HONEY	1	test	43
646	SUMMER RENAISSANCE	1	test	43
647	balance (mufasa interlude)	1	test	44
648	BIGGER	1	test	44
649	the stars (mufasa interlude)	1	test	44
650	FIND YOUR WAY BACK	1	test	44
651	uncle scar (scar interlude)	1	test	44
652	DON'T JEALOUS ME	1	test	44
653	danger (young simba & young nala interlude)	1	test	44
654	JA ARA E	1	test	44
655	run away (scar & young simba interlude)	1	test	44
656	NILE	1	test	44
657	new lesson (timon, pumbaa & young simba interlude)	1	test	44
658	MOOD 4 EVA (feat. Oumou Sangaré)	1	test	44
659	reunited (nala & simba interlude)	1	test	44
660	WATER	1	test	44
661	BROWN SKIN GIRL	1	test	44
662	come home (nala interlude)	1	test	44
663	KEYS TO THE KINGDOM	1	test	44
664	follow me (simba & rafiki interlude)	1	test	44
665	ALREADY	1	test	44
666	remember (mufasa interlude)	1	test	44
667	Pray You Catch Me	1	test	45
668	Hold Up	1	test	45
669	Don't Hurt Yourself (feat. Jack White)	1	test	45
670	Sorry	1	test	45
671	6 Inch (feat. The Weeknd)	1	test	45
672	Daddy Lessons	1	test	45
673	Love Drought	1	test	45
674	Sandcastles	1	test	45
675	Forward (feat. James Blake)	1	test	45
676	Freedom (feat. Kendrick Lamar)	1	test	45
677	All Night	1	test	45
678	Formation	1	test	45
679	Sorry - Original Demo	1	test	45
680	Nikes	1	test	46
681	Ivy	1	test	46
682	Pink + White	1	test	46
683	Be Yourself	1	test	46
684	Solo	1	test	46
685	Skyline To	1	test	46
686	Self Control	1	test	46
687	Good Guy	1	test	46
688	Nights	1	test	46
689	Solo (Reprise)	1	test	46
690	Pretty Sweet	1	test	46
691	Facebook Story	1	test	46
692	Close To You	1	test	46
693	White Ferrari	1	test	46
694	Seigfried	1	test	46
695	Godspeed	1	test	46
696	Futura Free	1	test	46
697	Start	1	test	47
698	Thinkin Bout You	1	test	47
699	Fertilizer	1	test	47
700	Sierra Leone	1	test	47
701	Sweet Life	1	test	47
702	Not Just Money	1	test	47
703	Super Rich Kids	1	test	47
704	Pilot Jones	1	test	47
705	Crack Rock	1	test	47
706	Pyramids	1	test	47
707	Lost	1	test	47
708	White	1	test	47
709	Monks	1	test	47
710	Bad Religion	1	test	47
711	Pink Matter	1	test	47
712	Forrest Gump	1	test	47
713	End	1	test	47
714	Everything In Its Right Place	1	test	48
715	Kid A	1	test	48
716	The National Anthem	1	test	48
717	How to Disappear Completely	1	test	48
718	Treefingers	1	test	48
719	Optimistic	1	test	48
720	In Limbo	1	test	48
721	Idioteque	1	test	48
722	Morning Bell	1	test	48
723	Motion Picture Soundtrack	1	test	48
724	Untitled	1	test	48
725	Packt Like Sardines In a Crushd Tin Box	1	test	48
726	Pyramid Song	1	test	48
727	Pulk/Pull Revolving Doors	1	test	48
728	You And Whose Army?	1	test	48
729	I Might Be Wrong	1	test	48
730	Knives Out	1	test	48
731	Morning Bell/Amnesiac	1	test	48
732	Dollars and Cents	1	test	48
733	Hunting Bears	1	test	48
734	Airbag - Remastered	1	test	49
735	Paranoid Android - Remastered	1	test	49
736	Subterranean Homesick Alien - Remastered	1	test	49
737	Exit Music (For A Film) - Remastered	1	test	49
738	Let Down - Remastered	1	test	49
739	Karma Police - Remastered	1	test	49
740	Fitter Happier - Remastered	1	test	49
741	Electioneering - Remastered	1	test	49
742	Climbing Up the Walls - Remastered	1	test	49
743	No Surprises - Remastered	1	test	49
744	Lucky - Remastered	1	test	49
745	The Tourist - Remastered	1	test	49
746	I Promise	1	test	49
747	Man of War	1	test	49
748	Lift	1	test	49
749	Lull - Remastered	1	test	49
750	Meeting in the Aisle - Remastered	1	test	49
751	Melatonin - Remastered	1	test	49
752	A Reminder - Remastered	1	test	49
753	Polyethylene (Parts 1 & 2) - Remastered	1	test	49
754	Burn the Witch	1	test	50
755	Daydreaming	1	test	50
756	Decks Dark	1	test	50
757	Desert Island Disk	1	test	50
758	Ful Stop	1	test	50
759	Glass Eyes	1	test	50
760	Identikit	1	test	50
761	The Numbers	1	test	50
762	Present Tense	1	test	50
763	Tinker Tailor Soldier Sailor Rich Man Poor Man Beggar Man Thief	1	test	50
764	True Love Waits	1	test	50
765	Little By Little - Caribou Rmx	1	test	51
766	Lotus Flower - Jacques Greene Rmx	1	test	51
767	Morning Mr Magpie - Nathan Fake Rmx	1	test	51
768	Bloom - Harmonic 313 Rmx	1	test	51
769	Bloom - Mark Pritchard Rmx	1	test	51
770	Feral - Lone RMX	1	test	51
771	Morning Mr Magpie - Pearson Sound Scavenger RMX	1	test	51
772	Separator - Four Tet RMX	1	test	51
773	Give Up The Ghost - Thriller Houseghost Remix	1	test	51
774	Codex (Illum Sphere)	1	test	51
775	Little By Little (Shed)	1	test	51
776	Give Up The Ghost - Brokenchord Rmx	1	test	51
777	TKOL - Altrice Rmx	1	test	51
778	Bloom - Blawan Rmx	1	test	51
779	Good Evening Mrs Magpie - Modeselektor RMX	1	test	51
780	Bloom - Objekt RMX	1	test	51
781	Bloom - Jamie xx Rework	1	test	51
782	Separator - Anstam RMX	1	test	51
783	Lotus Flower - SBTRKT RMX	1	test	51
784	Bloom	1	test	52
785	Morning Mr Magpie	1	test	52
786	Little By Little	1	test	52
787	Feral	1	test	52
788	Lotus Flower	1	test	52
789	Codex	1	test	52
790	Give Up The Ghost	1	test	52
791	Separator	1	test	52
792	One More Year	1	test	53
793	Instant Destiny	1	test	53
794	Borderline	1	test	53
795	Posthumous Forgiveness	1	test	53
796	Breathe Deeper	1	test	53
797	Tomorrow's Dust	1	test	53
798	On Track	1	test	53
799	Lost In Yesterday	1	test	53
800	Is It True	1	test	53
801	It Might Be Time	1	test	53
802	Glimmer	1	test	53
803	One More Hour	1	test	53
804	Let It Happen	1	test	54
805	Nangs	1	test	54
806	The Moment	1	test	54
807	Yes I'm Changing	1	test	54
808	Eventually	1	test	54
809	Gossip	1	test	54
810	The Less I Know The Better	1	test	54
811	Past Life	1	test	54
812	Disciples	1	test	54
813	'Cause I'm A Man	1	test	54
814	Reality In Motion	1	test	54
815	Love/Paranoia	1	test	54
816	New Person, Same Old Mistakes	1	test	54
817	Be Above It	1	test	55
818	Endors Toi	1	test	55
819	Apocalypse Dreams	1	test	55
820	Mind Mischief	1	test	55
821	Music To Walk Home By	1	test	55
822	Why Won't They Talk To Me?	1	test	55
823	Feels Like We Only Go Backwards	1	test	55
824	Keep On Lying	1	test	55
825	Elephant	1	test	55
826	She Just Won't Believe Me	1	test	55
827	Nothing That Has Happened So Far Has Been Anything We Could Control	1	test	55
828	Sun's Coming Up	1	test	55
829	It Is Not Meant To Be	1	test	56
830	Desire Be Desire Go	1	test	56
831	Alter Ego	1	test	56
832	Lucidity	1	test	56
833	Why Won't You Make Up Your Mind?	1	test	56
834	Solitude Is Bliss	1	test	56
835	Jeremy's Storm	1	test	56
836	Expectation	1	test	56
837	The Bold Arrow Of Time	1	test	56
838	Runway Houses City Clouds	1	test	56
839	I Don't Really Mind	1	test	56
840	Music For a Sushi Restaurant	1	test	57
841	Late Night Talking	1	test	57
842	Grapejuice	1	test	57
843	As It Was	1	test	57
844	Daylight	1	test	57
845	Little Freak	1	test	57
846	Matilda	1	test	57
847	Cinema	1	test	57
848	Daydreaming	1	test	57
849	Keep Driving	1	test	57
850	Satellite	1	test	57
851	Boyfriends	1	test	57
852	Love Of My Life	1	test	57
853	Golden	1	test	58
854	Watermelon Sugar	1	test	58
855	Adore You	1	test	58
856	Lights Up	1	test	58
857	Cherry	1	test	58
858	Falling	1	test	58
859	To Be So Lonely	1	test	58
860	She	1	test	58
861	Sunflower, Vol. 6	1	test	58
862	Canyon Moon	1	test	58
863	Treat People With Kindness	1	test	58
864	Fine Line	1	test	58
865	Meet Me in the Hallway	1	test	59
866	Sign of the Times	1	test	59
867	Carolina	1	test	59
868	Two Ghosts	1	test	59
869	Sweet Creature	1	test	59
870	Only Angel	1	test	59
871	Kiwi	1	test	59
872	Ever Since New York	1	test	59
873	Woman	1	test	59
874	From the Dining Table	1	test	59
875	shut up	1	test	60
876	34+35	1	test	60
877	motive (with Doja Cat)	1	test	60
878	just like magic	1	test	60
879	off the table (with The Weeknd)	1	test	60
880	six thirty	1	test	60
881	safety net (feat. Ty Dolla $ign)	1	test	60
882	my hair	1	test	60
883	nasty	1	test	60
884	west side	1	test	60
885	love language	1	test	60
886	positions	1	test	60
887	obvious	1	test	60
888	pov	1	test	60
889	imagine	1	test	61
890	needy	1	test	61
891	NASA	1	test	61
892	bloodline	1	test	61
893	fake smile	1	test	61
894	bad idea	1	test	61
895	make up	1	test	61
896	ghostin	1	test	61
897	in my head	1	test	61
898	7 rings	1	test	61
899	thank u, next	1	test	61
900	break up with your girlfriend, i'm bored	1	test	61
901	raindrops (an angel cried)	1	test	62
902	blazed (feat. Pharrell Williams)	1	test	62
903	the light is coming (feat. Nicki Minaj)	1	test	62
904	R.E.M	1	test	62
905	God is a woman	1	test	62
906	sweetener	1	test	62
907	successful	1	test	62
908	everytime	1	test	62
909	breathin	1	test	62
910	no tears left to cry	1	test	62
911	borderline (feat. Missy Elliott)	1	test	62
912	better off	1	test	62
913	goodnight n go	1	test	62
914	pete davidson	1	test	62
915	get well soon	1	test	62
916	Woman	1	test	63
917	Naked	1	test	63
918	Payday (feat. Young Thug)	1	test	63
919	Get Into It (Yuh)	1	test	63
920	Need to Know	1	test	63
921	I Don't Do Drugs (feat. Ariana Grande)	1	test	63
922	Love To Dream	1	test	63
923	You Right	1	test	63
924	Been Like This	1	test	63
925	Options (feat. JID)	1	test	63
926	Ain't Shit	1	test	63
927	Imagine	1	test	63
928	Alone	1	test	63
929	Kiss Me More (feat. SZA)	1	test	63
930	Cyber Sex	1	test	64
931	Won't Bite (feat. Smino)	1	test	64
932	Rules	1	test	64
933	Bottom Bitch	1	test	64
934	Say So	1	test	64
935	Like That (feat. Gucci Mane)	1	test	64
936	Talk Dirty	1	test	64
937	Addiction	1	test	64
938	Streets	1	test	64
939	Shine	1	test	64
940	Better Than Me	1	test	64
941	Juicy	1	test	64
942	Go To Town	1	test	65
943	Cookie Jar	1	test	65
944	Roll With Us	1	test	65
945	Wine Pon You (feat. Konshens)	1	test	65
946	Fancy	1	test	65
947	Wild Beach	1	test	65
948	Morning Light	1	test	65
949	Candy	1	test	65
950	Game	1	test	65
951	Casual	1	test	65
952	Down Low	1	test	65
953	Body Language	1	test	65
954	All Nighter	1	test	65
955	Main Titles (You’ve Been Called Back to Top Gun)	1	test	66
956	Danger Zone	1	test	66
957	Darkstar	1	test	66
958	Great Balls Of Fire - Live	1	test	66
959	You’re Where You Belong / Give ‘Em Hell	1	test	66
960	I Ain't Worried	1	test	66
961	Dagger One Is Hit / Time To Let Go	1	test	66
962	Tally Two / What’s The Plan / F-14	1	test	66
963	The Man, The Legend / Touchdown	1	test	66
964	Penny Returns - Interlude	1	test	66
965	Hold My Hand	1	test	66
966	Top Gun Anthem	1	test	66
967	Alice - LSDXOXO Remix	1	test	67
968	Stupid Love - COUCOU CHLOE Remix	1	test	67
969	Rain On Me (with Ariana Grande) - Arca Remix	1	test	67
970	Free Woman - Rina Sawayama & Clarence Clarity Remix	1	test	67
971	Fun Tonight - Pabllo Vittar Remix	1	test	67
972	911 - Charli XCX & A. G. Cook Remix	1	test	67
973	Plastic Doll - Ashnikko Remix	1	test	67
974	Sour Candy (with BLACKPINK) - Shygirl & Mura Masa Remix	1	test	67
975	Enigma - Doss Remix	1	test	67
976	Replay - Dorian Electra Remix	1	test	67
977	Sine From Above (with Elton John) - Chester Lockhart, Mood Killer & Lil Texas Remix	1	test	67
978	1000 Doves - Planningtorock Remix	1	test	67
979	Babylon - Bree Runway & Jimmy Edgar Remix	1	test	67
980	Babylon - Haus Labs Version	1	test	67
981	Marry The Night	1	test	68
982	Born This Way	1	test	68
983	Government Hooker	1	test	68
984	Judas	1	test	68
985	Americano	1	test	68
986	Hair	1	test	68
987	Scheiße	1	test	68
988	Bloody Mary	1	test	68
989	Bad Kids	1	test	68
990	Highway Unicorn (Road To Love)	1	test	68
991	Heavy Metal Lover	1	test	68
992	Electric Chapel	1	test	68
993	Yoü And I	1	test	68
994	The Edge Of Glory	1	test	68
995	Marry The Night	1	test	68
996	Judas	1	test	68
997	Highway Unicorn (Road To Love)	1	test	68
998	Yoü And I	1	test	68
999	The Edge Of Glory	1	test	68
1000	Born This Way - The Country Road Version	1	test	68
1001	Chromatica I	1	test	69
1002	Alice	1	test	69
1003	Stupid Love	1	test	69
1004	Rain On Me (with Ariana Grande)	1	test	69
1005	Free Woman	1	test	69
1006	Fun Tonight	1	test	69
1007	Chromatica II	1	test	69
1008	911	1	test	69
1009	Plastic Doll	1	test	69
1010	Sour Candy (with BLACKPINK)	1	test	69
1011	Enigma	1	test	69
1012	Replay	1	test	69
1013	Chromatica III	1	test	69
1014	Sine From Above (with Elton John)	1	test	69
1015	1000 Doves	1	test	69
1016	Babylon	1	test	69
1017	🪐	1	test	70
1018	Higher Power	1	test	70
1019	Humankind	1	test	70
1020	✨	1	test	70
1021	Let Somebody Go	1	test	70
1022	❤️	1	test	70
1023	People of The Pride	1	test	70
1024	Biutyful	1	test	70
1025	🌎	1	test	70
1026	My Universe	1	test	70
1027	♾	1	test	70
1028	Coloratura	1	test	70
1029	Sunrise	1	test	71
1030	Church	1	test	71
1031	Trouble In Town	1	test	71
1032	BrokEn	1	test	71
1033	Daddy	1	test	71
1034	WOTW / POTP	1	test	71
1035	Arabesque	1	test	71
1036	When I Need A Friend	1	test	71
1037	Guns	1	test	71
1038	Orphans	1	test	71
1039	Èkó	1	test	71
1040	Cry Cry Cry	1	test	71
1041	Old Friends	1	test	71
1042	بنی آدم	1	test	71
1043	Champion Of The World	1	test	71
1044	Everyday Life	1	test	71
1045	A Head Full of Dreams	1	test	72
1046	Birds	1	test	72
1047	Hymn for the Weekend	1	test	72
1048	Everglow	1	test	72
1049	Adventure of a Lifetime	1	test	72
1050	Fun (feat. Tove Lo)	1	test	72
1051	Kaleidoscope	1	test	72
1052	Army of One	1	test	72
1053	Amazing Day	1	test	72
1054	Colour Spectrum	1	test	72
1055	Up&Up	1	test	72
\.


--
-- Data for Name: playlist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.playlist (id, nom, date_creation, image, description) FROM stdin;
1	Rap	2021-08-10	\N	Playlist de rap
2	Rap US	2021-04-10	\N	Playlist de rap US
3	House	2021-01-11	\N	Playlist de house
4	FAVORIS	2023-06-01	\N	Vos titres favoris
5	LISTE ATTENTE	2023-06-02	\N	
6	HISTORIQUE	2023-06-03	\N	
7	TEST	2001-08-08	\N	
8	FAVORIS	2023-06-05	\N	Vos titres favoris
9	LISTE D'ATTENTE	2023-06-05	\N	
10	HISTORIQUE	2023-06-05	\N	
\.


--
-- Data for Name: style_musique; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.style_musique (id, type_musique) FROM stdin;
1	canadian contemporary r&b
2	canadian pop
3	pop
4	art pop
5	hip hop
6	rap
7	chicago rap
8	conscious hip hop
9	west coast rap
10	canadian hip hop
11	toronto rap
12	r&b
13	garage rock
14	modern rock
15	permanent wave
16	rock
17	sheffield indie
18	barbadian pop
19	urban contemporary
20	electropop
21	lgbtq+ hip hop
22	neo soul
23	alternative rock
24	art rock
25	melancholia
26	oxford indie
27	australian psych
28	neo-psychedelic
29	dance pop
\.


--
-- Data for Name: type_artiste; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_artiste (id, type) FROM stdin;
1	Person
2	Group
3	Choir
4	Orchestra
5	Character
6	Other
7	Unknown
\.


--
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utilisateur (id, prenom, nom, age, mail, username, password, is_admin, id_morceau) FROM stdin;
1	Allan	Cueff	2003-01-24	allan.cueff@isen-ouest.yncrea.fr	allan-cff	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	t	\N
2	Alexandre	Le Goff	2003-07-27	alexandre.legoff@isen-ouest.yncrea.fr	alexandre-lgf	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
3	Mathieu	Le Roux	2003-08-12	mathieu.leroux@isen-ouest.yncrea.fr	mathieu-lrx	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
4	Mathis	Meunier	2004-09-04	mathis.meunier@isen-ouest.yncrea.fr	mathis-mnr	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
5	Alix	Perrin	2003-01-30	alix.perrin@isen-ouest.yncrea.fr	alix-prr	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
6	Léa	Pouliquen	2003-03-12	lea.pouliquen@isen-ouest.yncrea.fr	lea-pql	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
7	Léna	Riou	2003-05-12	lena.riou@isen-ouest.yncrea.fr	lena-riu	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
8	Pauline	Zarka	2003-06-12	pauline.zarka@isen-ouest.yncrea.fr	pauline-zrk	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
9	Titouan	Bouffort	2003-01-24	titouan.bouffort@isen-ouest.yncrea.fr	titouan-bft	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
10	Louis	Bouvier	2003-07-27	louis.bouvier@isen-ouest.yncrea.fr	louis-bvr	$2y$10$7.gHsr3BZbDn3xnvU1yqrON49S6GdgO.3RoH0Tr6jz3QD8qzk4jDK	f	\N
11	test	test	2029-06-06	hey@gmail.com	hey@gmail.com	$2y$10$WKgqzzBncVzCCRCb9wVmaORA446bjYFV0rEmpENBKAoY1guZW0rwC	f	\N
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admin_id_seq', 1, false);


--
-- Name: album_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.album_id_seq', 72, true);


--
-- Name: artiste_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.artiste_id_seq', 280, true);


--
-- Name: morceau_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.morceau_id_seq', 1055, true);


--
-- Name: playlist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.playlist_id_seq', 10, true);


--
-- Name: style_musique_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.style_musique_id_seq', 29, true);


--
-- Name: type_artiste_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_artiste_id_seq', 7, true);


--
-- Name: utilisateur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.utilisateur_id_seq', 11, true);


--
-- Name: a_compose a_compose_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.a_compose
    ADD CONSTRAINT a_compose_pk PRIMARY KEY (id, id_artiste);


--
-- Name: a_creer a_creer_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.a_creer
    ADD CONSTRAINT a_creer_pk PRIMARY KEY (id, id_playlist);


--
-- Name: admin admin_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pk PRIMARY KEY (id);


--
-- Name: album album_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album
    ADD CONSTRAINT album_pk PRIMARY KEY (id);


--
-- Name: appartient_a appartient_a_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.appartient_a
    ADD CONSTRAINT appartient_a_pk PRIMARY KEY (id, id_album);


--
-- Name: artiste artiste_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.artiste
    ADD CONSTRAINT artiste_pk PRIMARY KEY (id);


--
-- Name: contenu_dans contenu_dans_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contenu_dans
    ADD CONSTRAINT contenu_dans_pk PRIMARY KEY (id, id_playlist);


--
-- Name: cree_par cree_par_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cree_par
    ADD CONSTRAINT cree_par_pk PRIMARY KEY (id, id_morceau);


--
-- Name: morceau morceau_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.morceau
    ADD CONSTRAINT morceau_pk PRIMARY KEY (id);


--
-- Name: playlist playlist_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.playlist
    ADD CONSTRAINT playlist_pk PRIMARY KEY (id);


--
-- Name: style_musique style_musique_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.style_musique
    ADD CONSTRAINT style_musique_pk PRIMARY KEY (id);


--
-- Name: type_artiste type_artiste_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_artiste
    ADD CONSTRAINT type_artiste_pk PRIMARY KEY (id);


--
-- Name: utilisateur utilisateur_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pk PRIMARY KEY (id);


--
-- Name: a_compose a_compose_album_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.a_compose
    ADD CONSTRAINT a_compose_album_fk FOREIGN KEY (id) REFERENCES public.album(id);


--
-- Name: a_compose a_compose_artiste0_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.a_compose
    ADD CONSTRAINT a_compose_artiste0_fk FOREIGN KEY (id_artiste) REFERENCES public.artiste(id);


--
-- Name: a_creer a_creer_playlist0_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.a_creer
    ADD CONSTRAINT a_creer_playlist0_fk FOREIGN KEY (id_playlist) REFERENCES public.playlist(id);


--
-- Name: a_creer a_creer_utilisateur_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.a_creer
    ADD CONSTRAINT a_creer_utilisateur_fk FOREIGN KEY (id) REFERENCES public.utilisateur(id);


--
-- Name: admin admin_utilisateur_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_utilisateur_fk FOREIGN KEY (id_utilisateur) REFERENCES public.utilisateur(id);


--
-- Name: appartient_a appartient_a_album0_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.appartient_a
    ADD CONSTRAINT appartient_a_album0_fk FOREIGN KEY (id_album) REFERENCES public.album(id);


--
-- Name: appartient_a appartient_a_style_musique_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.appartient_a
    ADD CONSTRAINT appartient_a_style_musique_fk FOREIGN KEY (id) REFERENCES public.style_musique(id);


--
-- Name: artiste artiste_type_artiste_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.artiste
    ADD CONSTRAINT artiste_type_artiste_fk FOREIGN KEY (id_type_artiste) REFERENCES public.type_artiste(id);


--
-- Name: contenu_dans contenu_dans_morceau_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contenu_dans
    ADD CONSTRAINT contenu_dans_morceau_fk FOREIGN KEY (id) REFERENCES public.morceau(id);


--
-- Name: contenu_dans contenu_dans_playlist0_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contenu_dans
    ADD CONSTRAINT contenu_dans_playlist0_fk FOREIGN KEY (id_playlist) REFERENCES public.playlist(id);


--
-- Name: cree_par cree_par_artiste_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cree_par
    ADD CONSTRAINT cree_par_artiste_fk FOREIGN KEY (id) REFERENCES public.artiste(id);


--
-- Name: cree_par cree_par_morceau0_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cree_par
    ADD CONSTRAINT cree_par_morceau0_fk FOREIGN KEY (id_morceau) REFERENCES public.morceau(id);


--
-- Name: morceau morceau_album_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.morceau
    ADD CONSTRAINT morceau_album_fk FOREIGN KEY (id_album) REFERENCES public.album(id);


--
-- Name: utilisateur utilisateur_morceau_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_morceau_fk FOREIGN KEY (id_morceau) REFERENCES public.morceau(id);


--
-- Name: TABLE a_compose; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.a_compose TO web_project;


--
-- Name: TABLE a_creer; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.a_creer TO web_project;


--
-- Name: TABLE admin; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.admin TO web_project;


--
-- Name: SEQUENCE admin_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.admin_id_seq TO web_project;


--
-- Name: TABLE album; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.album TO web_project;


--
-- Name: SEQUENCE album_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.album_id_seq TO web_project;


--
-- Name: TABLE appartient_a; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.appartient_a TO web_project;


--
-- Name: TABLE artiste; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.artiste TO web_project;


--
-- Name: SEQUENCE artiste_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.artiste_id_seq TO web_project;


--
-- Name: TABLE contenu_dans; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.contenu_dans TO web_project;


--
-- Name: TABLE cree_par; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.cree_par TO web_project;


--
-- Name: TABLE morceau; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.morceau TO web_project;


--
-- Name: SEQUENCE morceau_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.morceau_id_seq TO web_project;


--
-- Name: TABLE playlist; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.playlist TO web_project;


--
-- Name: SEQUENCE playlist_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.playlist_id_seq TO web_project;


--
-- Name: TABLE style_musique; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.style_musique TO web_project;


--
-- Name: SEQUENCE style_musique_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.style_musique_id_seq TO web_project;


--
-- Name: TABLE type_artiste; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.type_artiste TO web_project;


--
-- Name: SEQUENCE type_artiste_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.type_artiste_id_seq TO web_project;


--
-- Name: TABLE utilisateur; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.utilisateur TO web_project;


--
-- Name: SEQUENCE utilisateur_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.utilisateur_id_seq TO web_project;


--
-- PostgreSQL database dump complete
--

