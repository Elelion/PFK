﻿CREATE DATABASE PFK CHARACTER SET 'utf8';

CREATE TABLE main_service (
	id INT AUTO_INCREMENT PRIMARY KEY,
	type VARCHAR(12),
	description TEXT(32768)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;