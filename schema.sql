CREATE DATABASE proffurkom CHARACTER SET 'utf8';


-- NOTE: for main page --------------------------------------------------------

CREATE TABLE main_service (
	id INT AUTO_INCREMENT PRIMARY KEY,
	typeService VARCHAR(48),
	descriptionService TEXT
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE articles (
	id INT AUTO_INCREMENT PRIMARY KEY,
	date_create DATE,
	time_create TIME,
	title VARCHAR(32),
	miniDescription TEXT,
	fullDescription TEXT,
	image_file VARCHAR(255)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE events (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(32),
	miniDescription TEXT,
	fullDescription TEXT,
	image_file VARCHAR(255),
	active tinyint(8) DEFAULT 0,
	redirect TEXT
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- NOTE: for mail send --------------------------------------------------------

CREATE TABLE alert_errors (
	id INT AUTO_INCREMENT PRIMARY KEY,
	errorType VARCHAR(32),
	errorTitle VARCHAR(64),
	errorCaption VARCHAR(128),
	errorDescription TEXT
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- NOTE: users ----------------------------------------------------------------

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(256) NOT NULL,
	password VARCHAR(256) NOT NULL,
	name TEXT,
	surname TEXT,
	patronymic TEXT,
	address VARCHAR(256),
	phone INT(11)
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