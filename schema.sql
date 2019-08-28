﻿CREATE DATABASE proffurkom CHARACTER SET 'utf8';

CREATE TABLE main_service (
	id INT AUTO_INCREMENT PRIMARY KEY,
	typeService VARCHAR(48),
	descriptionService TEXT(32768)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE articles (
	id INT AUTO_INCREMENT PRIMARY KEY,
	date_create DATE,
	time_create TIME,
	title VARCHAR(32),
	miniDescription TEXT(128),
	fullDescription TEXT(32768),
	image_file VARCHAR(255)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;