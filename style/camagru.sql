CREATE DATABASE IF NOT EXISTS camagru DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE camagru;
CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) CHARACTER SET latin1 NOT NULL,
    mail VARCHAR(255) CHARACTER SET latin1 NOT NULL,
    passwd VARCHAR(255) CHARACTER SET latin1 NOT NULL,
    token VARCHAR(255) CHARACTER SET latin1 NOT NULL
);

CREATE TABLE imgs (
	id_post SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id SMALLINT UNSIGNED NOT NULL,
    date_creation DATETIME,
    post_url VARCHAR(300) DEFAULT NULL
);

CREATE TABLE likes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uid INT NOT NULL,
    img_id INT NOT NULL
);
