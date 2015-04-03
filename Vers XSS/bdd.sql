CREATE TABLE utilisateur (
	idutilisateur serial NOT NULL,
     pseudo varchar(255) NOT NULL,
	etat_actuel varchar(5000),
	CONSTRAINT utilisateur_pkey PRIMARY KEY (idutilisateur)
);

CREATE TABLE message (
	idmessage serial NOT NULL,
    contenu varchar(5000) NOT NULL,
	idutilisateur integer NOT NULL,
	CONSTRAINT message_pkey PRIMARY KEY (idmessage)
);

INSERT into utilisateur VALUES(default,'Admin',NULL);
INSERT into utilisateur VALUES(default,'Alice',NULL);
INSERT into utilisateur VALUES(default,'Romain',NULL);
INSERT into utilisateur VALUES(default,'Guillaume',NULL);

