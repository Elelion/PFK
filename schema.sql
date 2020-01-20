CREATE DATABASE proffurkom CHARACTER SET 'utf8';


-- NOTE: for main page --------------------------------------------------------

CREATE TABLE main_service (
	id INT AUTO_INCREMENT PRIMARY KEY,
	type_service VARCHAR(48),
	description_service TEXT
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE articles (
	id INT AUTO_INCREMENT PRIMARY KEY,
	date_create DATE,
	time_create TIME,
	title VARCHAR(32),
	mini_description TEXT,
	full_description TEXT,
	image_file VARCHAR(255)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE events (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(32),
	mini_description TEXT,
	full_description TEXT,
	image_file VARCHAR(255),
	active tinyint(8) DEFAULT 0,
	redirect TEXT
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- NOTE: for mail send --------------------------------------------------------

CREATE TABLE alert_errors (
	id INT AUTO_INCREMENT PRIMARY KEY,
	error_type VARCHAR(32),
	error_title VARCHAR(64),
	error_caption VARCHAR(128),
	error_description TEXT
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- NOTE: users ----------------------------------------------------------------

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(256) NOT NULL,
	password VARCHAR(256) NOT NULL,
	phone VARCHAR(11) NOT NULL,
	address VARCHAR(256) NOT NULL ,
	created DATETIME NOT NULL DEFAULT NOW(),
	active BOOLEAN NOT NULL DEFAULT false,
	token_value VARCHAR(256) NOT NULL,
	token_lifetime DATE NOT NULL,

    #physical
	name TEXT,
	surname TEXT,
	patronymic TEXT,

    #legal
    organization TEXT,
    inn INT(11),
    city TEXT,

	access_id INT NOT NULL DEFAULT 2
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE users_access (
	id INT AUTO_INCREMENT PRIMARY KEY,
	access VARCHAR(32) NOT NULL
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- NOTE: catalog --------------------------------------------------------------

CREATE TABLE catalog_1 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(256),
	price VARCHAR(8),
	description TEXT,
	image VARCHAR(255)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- **

ALTER TABLE users ADD FOREIGN KEY (access_id) REFERENCES users_access(id);
