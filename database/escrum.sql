toc.dat                                                                                             0000600 0004000 0002000 00000070361 13744306354 0014457 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP           -            	    x           escrum    12.2    12.2 _    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false         �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false         �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false         �           1262    16893    escrum    DATABASE     �   CREATE DATABASE escrum WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'French_France.1252' LC_CTYPE = 'French_France.1252';
    DROP DATABASE escrum;
                postgres    false                     3079    16384 	   adminpack 	   EXTENSION     A   CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;
    DROP EXTENSION adminpack;
                   false         �           0    0    EXTENSION adminpack    COMMENT     M   COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';
                        false    1         �            1259    16945    product_backlog    TABLE     s   CREATE TABLE public.product_backlog (
    idx integer NOT NULL,
    name text,
    project_idx integer NOT NULL
);
 #   DROP TABLE public.product_backlog;
       public         heap    postgres    false         �            1259    16943    product_backlog_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.product_backlog_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.product_backlog_idx_seq;
       public          postgres    false    213         �           0    0    product_backlog_idx_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.product_backlog_idx_seq OWNED BY public.product_backlog.idx;
          public          postgres    false    212         �            1259    16918    project    TABLE     �   CREATE TABLE public.project (
    idx integer NOT NULL,
    name text NOT NULL,
    description text,
    creation_date date
);
    DROP TABLE public.project;
       public         heap    postgres    false         �            1259    16916    project_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.project_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.project_idx_seq;
       public          postgres    false    208         �           0    0    project_idx_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.project_idx_seq OWNED BY public.project.idx;
          public          postgres    false    207         �            1259    16929    project_role    TABLE     _   CREATE TABLE public.project_role (
    idx smallint NOT NULL,
    description text NOT NULL
);
     DROP TABLE public.project_role;
       public         heap    postgres    false         �            1259    16927    project_role_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.project_role_idx_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.project_role_idx_seq;
       public          postgres    false    210         �           0    0    project_role_idx_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.project_role_idx_seq OWNED BY public.project_role.idx;
          public          postgres    false    209         �            1259    16938    project_role_member    TABLE     �   CREATE TABLE public.project_role_member (
    project_idx integer NOT NULL,
    member_idx integer NOT NULL,
    project_role_idx integer NOT NULL
);
 '   DROP TABLE public.project_role_member;
       public         heap    postgres    false         �            1259    16907    role    TABLE     W   CREATE TABLE public.role (
    idx smallint NOT NULL,
    description text NOT NULL
);
    DROP TABLE public.role;
       public         heap    postgres    false         �            1259    16905    role_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.role_idx_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.role_idx_seq;
       public          postgres    false    206         �           0    0    role_idx_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.role_idx_seq OWNED BY public.role.idx;
          public          postgres    false    205         �            1259    16956    sprint    TABLE     �   CREATE TABLE public.sprint (
    idx integer NOT NULL,
    objectif text NOT NULL,
    name text,
    project_idx integer NOT NULL,
    duree integer NOT NULL,
    creation_date date NOT NULL
);
    DROP TABLE public.sprint;
       public         heap    postgres    false         �            1259    16967    sprint_backlog    TABLE     q   CREATE TABLE public.sprint_backlog (
    idx integer NOT NULL,
    sprint_idx integer NOT NULL,
    name text
);
 "   DROP TABLE public.sprint_backlog;
       public         heap    postgres    false         �            1259    16965    sprint_backlog_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.sprint_backlog_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.sprint_backlog_idx_seq;
       public          postgres    false    217         �           0    0    sprint_backlog_idx_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.sprint_backlog_idx_seq OWNED BY public.sprint_backlog.idx;
          public          postgres    false    216         �            1259    17004    sprint_backlog_user_stories    TABLE     �   CREATE TABLE public.sprint_backlog_user_stories (
    sprint_backlog_idx integer NOT NULL,
    user_story_idx integer NOT NULL
);
 /   DROP TABLE public.sprint_backlog_user_stories;
       public         heap    postgres    false         �            1259    16954    sprint_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.sprint_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.sprint_idx_seq;
       public          postgres    false    215         �           0    0    sprint_idx_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.sprint_idx_seq OWNED BY public.sprint.idx;
          public          postgres    false    214         �            1259    16999    task_developement    TABLE     p   CREATE TABLE public.task_developement (
    task_idx integer NOT NULL,
    user_account_idx integer NOT NULL
);
 %   DROP TABLE public.task_developement;
       public         heap    postgres    false         �            1259    16990    tasks    TABLE     �   CREATE TABLE public.tasks (
    idx integer NOT NULL,
    name text NOT NULL,
    description text,
    priority integer,
    user_story_idx integer NOT NULL,
    state integer DEFAULT 0
);
    DROP TABLE public.tasks;
       public         heap    postgres    false         �            1259    16988    tasks_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.tasks_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.tasks_idx_seq;
       public          postgres    false    221         �           0    0    tasks_idx_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.tasks_idx_seq OWNED BY public.tasks.idx;
          public          postgres    false    220         �            1259    16896    user_account    TABLE     �   CREATE TABLE public.user_account (
    idx integer NOT NULL,
    firstname text NOT NULL,
    lastname text NOT NULL,
    email text NOT NULL,
    password text NOT NULL,
    age smallint,
    role_idx integer NOT NULL
);
     DROP TABLE public.user_account;
       public         heap    postgres    false         �            1259    16894    user_account_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.user_account_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.user_account_idx_seq;
       public          postgres    false    204         �           0    0    user_account_idx_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.user_account_idx_seq OWNED BY public.user_account.idx;
          public          postgres    false    203         �            1259    16978    user_stories    TABLE       CREATE TABLE public.user_stories (
    idx integer NOT NULL,
    name text NOT NULL,
    description text NOT NULL,
    "position" integer NOT NULL,
    complexity integer,
    product_backlog_idx integer,
    is_completed boolean DEFAULT false NOT NULL
);
     DROP TABLE public.user_stories;
       public         heap    postgres    false         �            1259    16976    user_stories_idx_seq    SEQUENCE     �   CREATE SEQUENCE public.user_stories_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.user_stories_idx_seq;
       public          postgres    false    219         �           0    0    user_stories_idx_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.user_stories_idx_seq OWNED BY public.user_stories.idx;
          public          postgres    false    218         �
           2604    16948    product_backlog idx    DEFAULT     z   ALTER TABLE ONLY public.product_backlog ALTER COLUMN idx SET DEFAULT nextval('public.product_backlog_idx_seq'::regclass);
 B   ALTER TABLE public.product_backlog ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    212    213    213         �
           2604    16921    project idx    DEFAULT     j   ALTER TABLE ONLY public.project ALTER COLUMN idx SET DEFAULT nextval('public.project_idx_seq'::regclass);
 :   ALTER TABLE public.project ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    208    207    208         �
           2604    16932    project_role idx    DEFAULT     t   ALTER TABLE ONLY public.project_role ALTER COLUMN idx SET DEFAULT nextval('public.project_role_idx_seq'::regclass);
 ?   ALTER TABLE public.project_role ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    209    210    210         �
           2604    16910    role idx    DEFAULT     d   ALTER TABLE ONLY public.role ALTER COLUMN idx SET DEFAULT nextval('public.role_idx_seq'::regclass);
 7   ALTER TABLE public.role ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    206    205    206         �
           2604    16959 
   sprint idx    DEFAULT     h   ALTER TABLE ONLY public.sprint ALTER COLUMN idx SET DEFAULT nextval('public.sprint_idx_seq'::regclass);
 9   ALTER TABLE public.sprint ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    215    214    215         �
           2604    16970    sprint_backlog idx    DEFAULT     x   ALTER TABLE ONLY public.sprint_backlog ALTER COLUMN idx SET DEFAULT nextval('public.sprint_backlog_idx_seq'::regclass);
 A   ALTER TABLE public.sprint_backlog ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    216    217    217         �
           2604    16993 	   tasks idx    DEFAULT     f   ALTER TABLE ONLY public.tasks ALTER COLUMN idx SET DEFAULT nextval('public.tasks_idx_seq'::regclass);
 8   ALTER TABLE public.tasks ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    221    220    221         �
           2604    16899    user_account idx    DEFAULT     t   ALTER TABLE ONLY public.user_account ALTER COLUMN idx SET DEFAULT nextval('public.user_account_idx_seq'::regclass);
 ?   ALTER TABLE public.user_account ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    204    203    204         �
           2604    16981    user_stories idx    DEFAULT     t   ALTER TABLE ONLY public.user_stories ALTER COLUMN idx SET DEFAULT nextval('public.user_stories_idx_seq'::regclass);
 ?   ALTER TABLE public.user_stories ALTER COLUMN idx DROP DEFAULT;
       public          postgres    false    218    219    219         �          0    16945    product_backlog 
   TABLE DATA           A   COPY public.product_backlog (idx, name, project_idx) FROM stdin;
    public          postgres    false    213       2948.dat           0    16918    project 
   TABLE DATA           H   COPY public.project (idx, name, description, creation_date) FROM stdin;
    public          postgres    false    208       2943.dat �          0    16929    project_role 
   TABLE DATA           8   COPY public.project_role (idx, description) FROM stdin;
    public          postgres    false    210       2945.dat �          0    16938    project_role_member 
   TABLE DATA           X   COPY public.project_role_member (project_idx, member_idx, project_role_idx) FROM stdin;
    public          postgres    false    211       2946.dat }          0    16907    role 
   TABLE DATA           0   COPY public.role (idx, description) FROM stdin;
    public          postgres    false    206       2941.dat �          0    16956    sprint 
   TABLE DATA           X   COPY public.sprint (idx, objectif, name, project_idx, duree, creation_date) FROM stdin;
    public          postgres    false    215       2950.dat �          0    16967    sprint_backlog 
   TABLE DATA           ?   COPY public.sprint_backlog (idx, sprint_idx, name) FROM stdin;
    public          postgres    false    217       2952.dat �          0    17004    sprint_backlog_user_stories 
   TABLE DATA           Y   COPY public.sprint_backlog_user_stories (sprint_backlog_idx, user_story_idx) FROM stdin;
    public          postgres    false    223       2958.dat �          0    16999    task_developement 
   TABLE DATA           G   COPY public.task_developement (task_idx, user_account_idx) FROM stdin;
    public          postgres    false    222       2957.dat �          0    16990    tasks 
   TABLE DATA           X   COPY public.tasks (idx, name, description, priority, user_story_idx, state) FROM stdin;
    public          postgres    false    221       2956.dat {          0    16896    user_account 
   TABLE DATA           `   COPY public.user_account (idx, firstname, lastname, email, password, age, role_idx) FROM stdin;
    public          postgres    false    204       2939.dat �          0    16978    user_stories 
   TABLE DATA           y   COPY public.user_stories (idx, name, description, "position", complexity, product_backlog_idx, is_completed) FROM stdin;
    public          postgres    false    219       2954.dat �           0    0    product_backlog_idx_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.product_backlog_idx_seq', 1, false);
          public          postgres    false    212         �           0    0    project_idx_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.project_idx_seq', 1, false);
          public          postgres    false    207         �           0    0    project_role_idx_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.project_role_idx_seq', 3, true);
          public          postgres    false    209         �           0    0    role_idx_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.role_idx_seq', 2, true);
          public          postgres    false    205         �           0    0    sprint_backlog_idx_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.sprint_backlog_idx_seq', 1, false);
          public          postgres    false    216         �           0    0    sprint_idx_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.sprint_idx_seq', 1, false);
          public          postgres    false    214         �           0    0    tasks_idx_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.tasks_idx_seq', 1, false);
          public          postgres    false    220         �           0    0    user_account_idx_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.user_account_idx_seq', 1, true);
          public          postgres    false    203         �           0    0    user_stories_idx_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.user_stories_idx_seq', 1, false);
          public          postgres    false    218         �
           2606    16964    sprint Sprint_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.sprint
    ADD CONSTRAINT "Sprint_pkey" PRIMARY KEY (idx);
 >   ALTER TABLE ONLY public.sprint DROP CONSTRAINT "Sprint_pkey";
       public            postgres    false    215         �
           2606    17045 :   sprint_backlog_user_stories pk_sprint_backlog_user_stories 
   CONSTRAINT     �   ALTER TABLE ONLY public.sprint_backlog_user_stories
    ADD CONSTRAINT pk_sprint_backlog_user_stories PRIMARY KEY (sprint_backlog_idx, user_story_idx);
 d   ALTER TABLE ONLY public.sprint_backlog_user_stories DROP CONSTRAINT pk_sprint_backlog_user_stories;
       public            postgres    false    223    223         �
           2606    16953 $   product_backlog product_backlog_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.product_backlog
    ADD CONSTRAINT product_backlog_pkey PRIMARY KEY (idx);
 N   ALTER TABLE ONLY public.product_backlog DROP CONSTRAINT product_backlog_pkey;
       public            postgres    false    213         �
           2606    16926    project project_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.project
    ADD CONSTRAINT project_pkey PRIMARY KEY (idx);
 >   ALTER TABLE ONLY public.project DROP CONSTRAINT project_pkey;
       public            postgres    false    208         �
           2606    16942 ,   project_role_member project_role_member_pkey 
   CONSTRAINT        ALTER TABLE ONLY public.project_role_member
    ADD CONSTRAINT project_role_member_pkey PRIMARY KEY (project_idx, member_idx);
 V   ALTER TABLE ONLY public.project_role_member DROP CONSTRAINT project_role_member_pkey;
       public            postgres    false    211    211         �
           2606    16937    project_role project_role_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.project_role
    ADD CONSTRAINT project_role_pkey PRIMARY KEY (idx);
 H   ALTER TABLE ONLY public.project_role DROP CONSTRAINT project_role_pkey;
       public            postgres    false    210         �
           2606    16915    role role_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (idx);
 8   ALTER TABLE ONLY public.role DROP CONSTRAINT role_pkey;
       public            postgres    false    206         �
           2606    16975 "   sprint_backlog sprint_backlog_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.sprint_backlog
    ADD CONSTRAINT sprint_backlog_pkey PRIMARY KEY (idx);
 L   ALTER TABLE ONLY public.sprint_backlog DROP CONSTRAINT sprint_backlog_pkey;
       public            postgres    false    217         �
           2606    17003 (   task_developement task_developement_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.task_developement
    ADD CONSTRAINT task_developement_pkey PRIMARY KEY (task_idx, user_account_idx);
 R   ALTER TABLE ONLY public.task_developement DROP CONSTRAINT task_developement_pkey;
       public            postgres    false    222    222         �
           2606    16998    tasks tasks_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.tasks
    ADD CONSTRAINT tasks_pkey PRIMARY KEY (idx);
 :   ALTER TABLE ONLY public.tasks DROP CONSTRAINT tasks_pkey;
       public            postgres    false    221         �
           2606    17021    product_backlog uc_project_idx 
   CONSTRAINT     `   ALTER TABLE ONLY public.product_backlog
    ADD CONSTRAINT uc_project_idx UNIQUE (project_idx);
 H   ALTER TABLE ONLY public.product_backlog DROP CONSTRAINT uc_project_idx;
       public            postgres    false    213         �
           2606    17043 +   sprint_backlog uc_sprint_backlog_sprint_idx 
   CONSTRAINT     l   ALTER TABLE ONLY public.sprint_backlog
    ADD CONSTRAINT uc_sprint_backlog_sprint_idx UNIQUE (sprint_idx);
 U   ALTER TABLE ONLY public.sprint_backlog DROP CONSTRAINT uc_sprint_backlog_sprint_idx;
       public            postgres    false    217         �
           2606    17072 "   user_account uc_user_account_email 
   CONSTRAINT     ^   ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT uc_user_account_email UNIQUE (email);
 L   ALTER TABLE ONLY public.user_account DROP CONSTRAINT uc_user_account_email;
       public            postgres    false    204         �
           2606    16904    user_account user_account_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_pkey PRIMARY KEY (idx);
 H   ALTER TABLE ONLY public.user_account DROP CONSTRAINT user_account_pkey;
       public            postgres    false    204         �
           2606    16986    user_stories user_stories_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.user_stories
    ADD CONSTRAINT user_stories_pkey PRIMARY KEY (idx);
 H   ALTER TABLE ONLY public.user_stories DROP CONSTRAINT user_stories_pkey;
       public            postgres    false    219         �
           1259    17014    fki_fk_sprint_project_idx    INDEX     S   CREATE INDEX fki_fk_sprint_project_idx ON public.sprint USING btree (project_idx);
 -   DROP INDEX public.fki_fk_sprint_project_idx;
       public            postgres    false    215         �
           2606    17015 .   product_backlog fk_product_backlog_project_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.product_backlog
    ADD CONSTRAINT fk_product_backlog_project_idx FOREIGN KEY (project_idx) REFERENCES public.project(idx) ON DELETE CASCADE;
 X   ALTER TABLE ONLY public.product_backlog DROP CONSTRAINT fk_product_backlog_project_idx;
       public          postgres    false    213    208    2775         �
           2606    17027 5   project_role_member fk_project_role_member_member_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.project_role_member
    ADD CONSTRAINT fk_project_role_member_member_idx FOREIGN KEY (member_idx) REFERENCES public.user_account(idx) ON DELETE CASCADE;
 _   ALTER TABLE ONLY public.project_role_member DROP CONSTRAINT fk_project_role_member_member_idx;
       public          postgres    false    211    204    2771         �
           2606    17022 6   project_role_member fk_project_role_member_project_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.project_role_member
    ADD CONSTRAINT fk_project_role_member_project_idx FOREIGN KEY (project_idx) REFERENCES public.project(idx) ON DELETE CASCADE;
 `   ALTER TABLE ONLY public.project_role_member DROP CONSTRAINT fk_project_role_member_project_idx;
       public          postgres    false    211    208    2775         �
           2606    17032 3   project_role_member fk_project_role_member_role_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.project_role_member
    ADD CONSTRAINT fk_project_role_member_role_idx FOREIGN KEY (project_role_idx) REFERENCES public.project_role(idx) ON DELETE CASCADE;
 ]   ALTER TABLE ONLY public.project_role_member DROP CONSTRAINT fk_project_role_member_role_idx;
       public          postgres    false    210    211    2777         �
           2606    17037 +   sprint_backlog fk_sprint_backlog_sprint_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.sprint_backlog
    ADD CONSTRAINT fk_sprint_backlog_sprint_idx FOREIGN KEY (sprint_idx) REFERENCES public.sprint(idx) ON DELETE CASCADE;
 U   ALTER TABLE ONLY public.sprint_backlog DROP CONSTRAINT fk_sprint_backlog_sprint_idx;
       public          postgres    false    215    217    2785         �
           2606    17046 M   sprint_backlog_user_stories fk_sprint_backlog_user_stories_sprint_backlog_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.sprint_backlog_user_stories
    ADD CONSTRAINT fk_sprint_backlog_user_stories_sprint_backlog_idx FOREIGN KEY (sprint_backlog_idx) REFERENCES public.sprint_backlog(idx) ON DELETE CASCADE;
 w   ALTER TABLE ONLY public.sprint_backlog_user_stories DROP CONSTRAINT fk_sprint_backlog_user_stories_sprint_backlog_idx;
       public          postgres    false    223    2788    217         �
           2606    17051 I   sprint_backlog_user_stories fk_sprint_backlog_user_stories_user_story_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.sprint_backlog_user_stories
    ADD CONSTRAINT fk_sprint_backlog_user_stories_user_story_idx FOREIGN KEY (user_story_idx) REFERENCES public.user_stories(idx) ON DELETE CASCADE;
 s   ALTER TABLE ONLY public.sprint_backlog_user_stories DROP CONSTRAINT fk_sprint_backlog_user_stories_user_story_idx;
       public          postgres    false    223    219    2792         �
           2606    17096    sprint fk_sprint_project_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.sprint
    ADD CONSTRAINT fk_sprint_project_idx FOREIGN KEY (project_idx) REFERENCES public.project(idx) ON DELETE CASCADE;
 F   ALTER TABLE ONLY public.sprint DROP CONSTRAINT fk_sprint_project_idx;
       public          postgres    false    2775    208    215         �
           2606    17056 /   task_developement fk_task_developement_task_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.task_developement
    ADD CONSTRAINT fk_task_developement_task_idx FOREIGN KEY (task_idx) REFERENCES public.tasks(idx) ON DELETE CASCADE;
 Y   ALTER TABLE ONLY public.task_developement DROP CONSTRAINT fk_task_developement_task_idx;
       public          postgres    false    2794    222    221         �
           2606    17061 7   task_developement fk_task_developement_user_account_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.task_developement
    ADD CONSTRAINT fk_task_developement_user_account_idx FOREIGN KEY (user_account_idx) REFERENCES public.user_account(idx) ON DELETE CASCADE;
 a   ALTER TABLE ONLY public.task_developement DROP CONSTRAINT fk_task_developement_user_account_idx;
       public          postgres    false    222    204    2771         �
           2606    17073 %   user_account fk_user_account_role_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT fk_user_account_role_idx FOREIGN KEY (role_idx) REFERENCES public.role(idx) ON DELETE SET NULL;
 O   ALTER TABLE ONLY public.user_account DROP CONSTRAINT fk_user_account_role_idx;
       public          postgres    false    204    2773    206         �
           2606    17078 0   user_stories fk_user_stories_product_backlog_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.user_stories
    ADD CONSTRAINT fk_user_stories_product_backlog_idx FOREIGN KEY (product_backlog_idx) REFERENCES public.product_backlog(idx) ON DELETE CASCADE;
 Z   ALTER TABLE ONLY public.user_stories DROP CONSTRAINT fk_user_stories_product_backlog_idx;
       public          postgres    false    213    219    2781         �
           2606    17066    tasks pk_tasks_user_story_idx    FK CONSTRAINT     �   ALTER TABLE ONLY public.tasks
    ADD CONSTRAINT pk_tasks_user_story_idx FOREIGN KEY (user_story_idx) REFERENCES public.user_stories(idx) ON DELETE CASCADE;
 G   ALTER TABLE ONLY public.tasks DROP CONSTRAINT pk_tasks_user_story_idx;
       public          postgres    false    2792    221    219                                                                                                                                                                                                                                                                                       2948.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014264 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2943.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014257 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2945.dat                                                                                            0000600 0004000 0002000 00000000061 13744306354 0014263 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Product Owner
2	Scrum Master
3	Developper
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                               2946.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014262 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2941.dat                                                                                            0000600 0004000 0002000 00000000037 13744306354 0014262 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	administrateur
2	membre
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 2950.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014255 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2952.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014257 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2958.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014265 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2957.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014264 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2956.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014263 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2939.dat                                                                                            0000600 0004000 0002000 00000000144 13744306354 0014270 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	admin	admin	admin@admin.com	$2y$10$JIQUleIV8/bsZyknwxDtGuE.8sSBgF7ISXDFpSAtHkUiacNcc257a	0	2
\.


                                                                                                                                                                                                                                                                                                                                                                                                                            2954.dat                                                                                            0000600 0004000 0002000 00000000005 13744306354 0014261 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           restore.sql                                                                                         0000600 0004000 0002000 00000053522 13744306354 0015404 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE escrum;
--
-- Name: escrum; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE escrum WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'French_France.1252' LC_CTYPE = 'French_France.1252';


ALTER DATABASE escrum OWNER TO postgres;

\connect escrum

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: product_backlog; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_backlog (
    idx integer NOT NULL,
    name text,
    project_idx integer NOT NULL
);


ALTER TABLE public.product_backlog OWNER TO postgres;

--
-- Name: product_backlog_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_backlog_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_backlog_idx_seq OWNER TO postgres;

--
-- Name: product_backlog_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.product_backlog_idx_seq OWNED BY public.product_backlog.idx;


--
-- Name: project; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.project (
    idx integer NOT NULL,
    name text NOT NULL,
    description text,
    creation_date date
);


ALTER TABLE public.project OWNER TO postgres;

--
-- Name: project_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.project_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.project_idx_seq OWNER TO postgres;

--
-- Name: project_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.project_idx_seq OWNED BY public.project.idx;


--
-- Name: project_role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.project_role (
    idx smallint NOT NULL,
    description text NOT NULL
);


ALTER TABLE public.project_role OWNER TO postgres;

--
-- Name: project_role_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.project_role_idx_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.project_role_idx_seq OWNER TO postgres;

--
-- Name: project_role_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.project_role_idx_seq OWNED BY public.project_role.idx;


--
-- Name: project_role_member; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.project_role_member (
    project_idx integer NOT NULL,
    member_idx integer NOT NULL,
    project_role_idx integer NOT NULL
);


ALTER TABLE public.project_role_member OWNER TO postgres;

--
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role (
    idx smallint NOT NULL,
    description text NOT NULL
);


ALTER TABLE public.role OWNER TO postgres;

--
-- Name: role_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.role_idx_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_idx_seq OWNER TO postgres;

--
-- Name: role_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.role_idx_seq OWNED BY public.role.idx;


--
-- Name: sprint; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sprint (
    idx integer NOT NULL,
    objectif text NOT NULL,
    name text,
    project_idx integer NOT NULL,
    duree integer NOT NULL,
    creation_date date NOT NULL
);


ALTER TABLE public.sprint OWNER TO postgres;

--
-- Name: sprint_backlog; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sprint_backlog (
    idx integer NOT NULL,
    sprint_idx integer NOT NULL,
    name text
);


ALTER TABLE public.sprint_backlog OWNER TO postgres;

--
-- Name: sprint_backlog_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sprint_backlog_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sprint_backlog_idx_seq OWNER TO postgres;

--
-- Name: sprint_backlog_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sprint_backlog_idx_seq OWNED BY public.sprint_backlog.idx;


--
-- Name: sprint_backlog_user_stories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sprint_backlog_user_stories (
    sprint_backlog_idx integer NOT NULL,
    user_story_idx integer NOT NULL
);


ALTER TABLE public.sprint_backlog_user_stories OWNER TO postgres;

--
-- Name: sprint_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sprint_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sprint_idx_seq OWNER TO postgres;

--
-- Name: sprint_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sprint_idx_seq OWNED BY public.sprint.idx;


--
-- Name: task_developement; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.task_developement (
    task_idx integer NOT NULL,
    user_account_idx integer NOT NULL
);


ALTER TABLE public.task_developement OWNER TO postgres;

--
-- Name: tasks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tasks (
    idx integer NOT NULL,
    name text NOT NULL,
    description text,
    priority integer,
    user_story_idx integer NOT NULL,
    state integer DEFAULT 0
);


ALTER TABLE public.tasks OWNER TO postgres;

--
-- Name: tasks_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tasks_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tasks_idx_seq OWNER TO postgres;

--
-- Name: tasks_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tasks_idx_seq OWNED BY public.tasks.idx;


--
-- Name: user_account; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_account (
    idx integer NOT NULL,
    firstname text NOT NULL,
    lastname text NOT NULL,
    email text NOT NULL,
    password text NOT NULL,
    age smallint,
    role_idx integer NOT NULL
);


ALTER TABLE public.user_account OWNER TO postgres;

--
-- Name: user_account_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_account_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_account_idx_seq OWNER TO postgres;

--
-- Name: user_account_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_account_idx_seq OWNED BY public.user_account.idx;


--
-- Name: user_stories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_stories (
    idx integer NOT NULL,
    name text NOT NULL,
    description text NOT NULL,
    "position" integer NOT NULL,
    complexity integer,
    product_backlog_idx integer,
    is_completed boolean DEFAULT false NOT NULL
);


ALTER TABLE public.user_stories OWNER TO postgres;

--
-- Name: user_stories_idx_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_stories_idx_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_stories_idx_seq OWNER TO postgres;

--
-- Name: user_stories_idx_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_stories_idx_seq OWNED BY public.user_stories.idx;


--
-- Name: product_backlog idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_backlog ALTER COLUMN idx SET DEFAULT nextval('public.product_backlog_idx_seq'::regclass);


--
-- Name: project idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project ALTER COLUMN idx SET DEFAULT nextval('public.project_idx_seq'::regclass);


--
-- Name: project_role idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_role ALTER COLUMN idx SET DEFAULT nextval('public.project_role_idx_seq'::regclass);


--
-- Name: role idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role ALTER COLUMN idx SET DEFAULT nextval('public.role_idx_seq'::regclass);


--
-- Name: sprint idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint ALTER COLUMN idx SET DEFAULT nextval('public.sprint_idx_seq'::regclass);


--
-- Name: sprint_backlog idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_backlog ALTER COLUMN idx SET DEFAULT nextval('public.sprint_backlog_idx_seq'::regclass);


--
-- Name: tasks idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tasks ALTER COLUMN idx SET DEFAULT nextval('public.tasks_idx_seq'::regclass);


--
-- Name: user_account idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account ALTER COLUMN idx SET DEFAULT nextval('public.user_account_idx_seq'::regclass);


--
-- Name: user_stories idx; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_stories ALTER COLUMN idx SET DEFAULT nextval('public.user_stories_idx_seq'::regclass);


--
-- Data for Name: product_backlog; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product_backlog (idx, name, project_idx) FROM stdin;
\.
COPY public.product_backlog (idx, name, project_idx) FROM '$$PATH$$/2948.dat';

--
-- Data for Name: project; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.project (idx, name, description, creation_date) FROM stdin;
\.
COPY public.project (idx, name, description, creation_date) FROM '$$PATH$$/2943.dat';

--
-- Data for Name: project_role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.project_role (idx, description) FROM stdin;
\.
COPY public.project_role (idx, description) FROM '$$PATH$$/2945.dat';

--
-- Data for Name: project_role_member; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.project_role_member (project_idx, member_idx, project_role_idx) FROM stdin;
\.
COPY public.project_role_member (project_idx, member_idx, project_role_idx) FROM '$$PATH$$/2946.dat';

--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role (idx, description) FROM stdin;
\.
COPY public.role (idx, description) FROM '$$PATH$$/2941.dat';

--
-- Data for Name: sprint; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sprint (idx, objectif, name, project_idx, duree, creation_date) FROM stdin;
\.
COPY public.sprint (idx, objectif, name, project_idx, duree, creation_date) FROM '$$PATH$$/2950.dat';

--
-- Data for Name: sprint_backlog; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sprint_backlog (idx, sprint_idx, name) FROM stdin;
\.
COPY public.sprint_backlog (idx, sprint_idx, name) FROM '$$PATH$$/2952.dat';

--
-- Data for Name: sprint_backlog_user_stories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sprint_backlog_user_stories (sprint_backlog_idx, user_story_idx) FROM stdin;
\.
COPY public.sprint_backlog_user_stories (sprint_backlog_idx, user_story_idx) FROM '$$PATH$$/2958.dat';

--
-- Data for Name: task_developement; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.task_developement (task_idx, user_account_idx) FROM stdin;
\.
COPY public.task_developement (task_idx, user_account_idx) FROM '$$PATH$$/2957.dat';

--
-- Data for Name: tasks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tasks (idx, name, description, priority, user_story_idx, state) FROM stdin;
\.
COPY public.tasks (idx, name, description, priority, user_story_idx, state) FROM '$$PATH$$/2956.dat';

--
-- Data for Name: user_account; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_account (idx, firstname, lastname, email, password, age, role_idx) FROM stdin;
\.
COPY public.user_account (idx, firstname, lastname, email, password, age, role_idx) FROM '$$PATH$$/2939.dat';

--
-- Data for Name: user_stories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_stories (idx, name, description, "position", complexity, product_backlog_idx, is_completed) FROM stdin;
\.
COPY public.user_stories (idx, name, description, "position", complexity, product_backlog_idx, is_completed) FROM '$$PATH$$/2954.dat';

--
-- Name: product_backlog_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_backlog_idx_seq', 1, false);


--
-- Name: project_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.project_idx_seq', 1, false);


--
-- Name: project_role_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.project_role_idx_seq', 3, true);


--
-- Name: role_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.role_idx_seq', 2, true);


--
-- Name: sprint_backlog_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sprint_backlog_idx_seq', 1, false);


--
-- Name: sprint_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sprint_idx_seq', 1, false);


--
-- Name: tasks_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tasks_idx_seq', 1, false);


--
-- Name: user_account_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_account_idx_seq', 1, true);


--
-- Name: user_stories_idx_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_stories_idx_seq', 1, false);


--
-- Name: sprint Sprint_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint
    ADD CONSTRAINT "Sprint_pkey" PRIMARY KEY (idx);


--
-- Name: sprint_backlog_user_stories pk_sprint_backlog_user_stories; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_backlog_user_stories
    ADD CONSTRAINT pk_sprint_backlog_user_stories PRIMARY KEY (sprint_backlog_idx, user_story_idx);


--
-- Name: product_backlog product_backlog_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_backlog
    ADD CONSTRAINT product_backlog_pkey PRIMARY KEY (idx);


--
-- Name: project project_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project
    ADD CONSTRAINT project_pkey PRIMARY KEY (idx);


--
-- Name: project_role_member project_role_member_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_role_member
    ADD CONSTRAINT project_role_member_pkey PRIMARY KEY (project_idx, member_idx);


--
-- Name: project_role project_role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_role
    ADD CONSTRAINT project_role_pkey PRIMARY KEY (idx);


--
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (idx);


--
-- Name: sprint_backlog sprint_backlog_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_backlog
    ADD CONSTRAINT sprint_backlog_pkey PRIMARY KEY (idx);


--
-- Name: task_developement task_developement_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.task_developement
    ADD CONSTRAINT task_developement_pkey PRIMARY KEY (task_idx, user_account_idx);


--
-- Name: tasks tasks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tasks
    ADD CONSTRAINT tasks_pkey PRIMARY KEY (idx);


--
-- Name: product_backlog uc_project_idx; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_backlog
    ADD CONSTRAINT uc_project_idx UNIQUE (project_idx);


--
-- Name: sprint_backlog uc_sprint_backlog_sprint_idx; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_backlog
    ADD CONSTRAINT uc_sprint_backlog_sprint_idx UNIQUE (sprint_idx);


--
-- Name: user_account uc_user_account_email; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT uc_user_account_email UNIQUE (email);


--
-- Name: user_account user_account_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_pkey PRIMARY KEY (idx);


--
-- Name: user_stories user_stories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_stories
    ADD CONSTRAINT user_stories_pkey PRIMARY KEY (idx);


--
-- Name: fki_fk_sprint_project_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_fk_sprint_project_idx ON public.sprint USING btree (project_idx);


--
-- Name: product_backlog fk_product_backlog_project_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_backlog
    ADD CONSTRAINT fk_product_backlog_project_idx FOREIGN KEY (project_idx) REFERENCES public.project(idx) ON DELETE CASCADE;


--
-- Name: project_role_member fk_project_role_member_member_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_role_member
    ADD CONSTRAINT fk_project_role_member_member_idx FOREIGN KEY (member_idx) REFERENCES public.user_account(idx) ON DELETE CASCADE;


--
-- Name: project_role_member fk_project_role_member_project_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_role_member
    ADD CONSTRAINT fk_project_role_member_project_idx FOREIGN KEY (project_idx) REFERENCES public.project(idx) ON DELETE CASCADE;


--
-- Name: project_role_member fk_project_role_member_role_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_role_member
    ADD CONSTRAINT fk_project_role_member_role_idx FOREIGN KEY (project_role_idx) REFERENCES public.project_role(idx) ON DELETE CASCADE;


--
-- Name: sprint_backlog fk_sprint_backlog_sprint_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_backlog
    ADD CONSTRAINT fk_sprint_backlog_sprint_idx FOREIGN KEY (sprint_idx) REFERENCES public.sprint(idx) ON DELETE CASCADE;


--
-- Name: sprint_backlog_user_stories fk_sprint_backlog_user_stories_sprint_backlog_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_backlog_user_stories
    ADD CONSTRAINT fk_sprint_backlog_user_stories_sprint_backlog_idx FOREIGN KEY (sprint_backlog_idx) REFERENCES public.sprint_backlog(idx) ON DELETE CASCADE;


--
-- Name: sprint_backlog_user_stories fk_sprint_backlog_user_stories_user_story_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_backlog_user_stories
    ADD CONSTRAINT fk_sprint_backlog_user_stories_user_story_idx FOREIGN KEY (user_story_idx) REFERENCES public.user_stories(idx) ON DELETE CASCADE;


--
-- Name: sprint fk_sprint_project_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint
    ADD CONSTRAINT fk_sprint_project_idx FOREIGN KEY (project_idx) REFERENCES public.project(idx) ON DELETE CASCADE;


--
-- Name: task_developement fk_task_developement_task_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.task_developement
    ADD CONSTRAINT fk_task_developement_task_idx FOREIGN KEY (task_idx) REFERENCES public.tasks(idx) ON DELETE CASCADE;


--
-- Name: task_developement fk_task_developement_user_account_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.task_developement
    ADD CONSTRAINT fk_task_developement_user_account_idx FOREIGN KEY (user_account_idx) REFERENCES public.user_account(idx) ON DELETE CASCADE;


--
-- Name: user_account fk_user_account_role_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT fk_user_account_role_idx FOREIGN KEY (role_idx) REFERENCES public.role(idx) ON DELETE SET NULL;


--
-- Name: user_stories fk_user_stories_product_backlog_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_stories
    ADD CONSTRAINT fk_user_stories_product_backlog_idx FOREIGN KEY (product_backlog_idx) REFERENCES public.product_backlog(idx) ON DELETE CASCADE;


--
-- Name: tasks pk_tasks_user_story_idx; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tasks
    ADD CONSTRAINT pk_tasks_user_story_idx FOREIGN KEY (user_story_idx) REFERENCES public.user_stories(idx) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              