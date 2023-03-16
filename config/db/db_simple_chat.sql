CREATE DATABASE simple_chat_db;

CREATE TABLE get_date (
	id INT NOT NULL AUTO_INCREMENT,
    name_user VARCHAR(255) NOT NULL,
    key_code VARCHAR(255) NULL,
    PRIMARY KEY (id)
);

ALTER TABLE get_date 
	ADD type_user INT NOT NULL;
ALTER TABLE get_date
	ADD id_status INT NOT NULL;

CREATE TABLE user (
	id INT NOT NULL AUTO_INCREMENT,
    nickname VARCHAR(255) NOT NULL,
    url_avatar VARCHAR(255) NULL,
    type_user INT NOT NULL,
    id_status INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE chat (
	id INT NOT NULL AUTO_INCREMENT,
    id_user INT NOT NULL,
    data_time DATETIME NULL,
    name_user VARCHAR(255) NOT NULL,
    type_room INT NULL,
    message VARCHAR(255) NULL,
    PRIMARY KEY (id)
);

CREATE TABLE chat_room (
	id INT NOT NULL AUTO_INCREMENT,
    key_code VARCHAR(255) NULL,
    type_room INT NULL,
    create_by INT NULL,
    PRIMARY KEY (id)
);