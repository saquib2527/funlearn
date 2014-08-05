DROP DATABASE IF EXISTS funlearn;

CREATE DATABASE funlearn;

USE funlearn;

CREATE TABLE users(
	id				INTEGER(10) UNSIGNED		AUTO_INCREMENT		PRIMARY KEY,
	fname			VARCHAR(25),
	lname			VARCHAR(25),
	email			VARCHAR(30) UNIQUE,
	password		CHAR(60),
	type			CHAR(1),
	remember_token	CHAR(100),
	points			INTEGER(10)					DEFAULT 0
);

CREATE TABLE categories(
	id				INTEGER(10) UNSIGNED		AUTO_INCREMENT		PRIMARY KEY,
	name			CHAR(50),
	description		CHAR(255)
);

CREATE TABLE questions(
	id					INTEGER(10) UNSIGNED		AUTO_INCREMENT			PRIMARY KEY,
	category_id			INTEGER(10) UNSIGNED,
	question			VARCHAR(255),
	opt1				VARCHAR(50),
	opt2				VARCHAR(50),
	opt3				VARCHAR(50),
	opt4				VARCHAR(50),
	answer				TINYINT(1),
	FOREIGN KEY(category_id) REFERENCES categories(id)
) DEFAULT CHARSET=utf8;

CREATE TABLE seen(
	user_id			INTEGER(10) UNSIGNED,
	category_id		INTEGER(10) UNSIGNED,
	qids			TEXT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (category_id) REFERENCES categories(id),
	PRIMARY KEY (user_id, category_id)
) DEFAULT CHARSET=utf8;

-- database seeds --
INSERT INTO users VALUES(
	1,
	'Nazmus',
	'Saquib',
	'saquib2527@yahoo.com',
	'$2y$10$INpSUl4Jcy9AeNNITReUYO7nTShTN1grckzX58ytgh/i7rzE0gfta',
	'A',
	'',
	0
);
INSERT INTO users VALUES(
	2,
	'Ishtiyaque',
	'Ahmad',
	'ishtiyaque2197@yahoo.com',
	'$2y$10$INpSUl4Jcy9AeNNITReUYO7nTShTN1grckzX58ytgh/i7rzE0gfta',
	'M',
	'',
	0
);

INSERT INTO categories VALUES(
	1,
	'sports',
	'a few basics on sports and stuff'
);
INSERT INTO categories VALUES(
	2,
	'bangladesh',
	'things related to Bangladesh'
);
INSERT INTO categories VALUES(
	3,
	'current affairs',
	'what\'s happening around'
);
INSERT INTO categories VALUES(
	4,
	'geography',
	'know about the world'
);
INSERT INTO categories VALUES(
	5,
	'international',
	'know about world politics'
);


