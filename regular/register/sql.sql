CREATE TABLE user (
id INT UNSIGNED AUTO_INCREMENT ,
name CHAR(20) NOT NULL ,
password  CHAR(180)  NOT NULL ,
sex ENUM('man','woman') NOT NULL DEFAULT 'man',
hobbies CHAR(50) NOT NULL DEFAULT '',
addr  CHAR(20) NOT NULL DEFAULT '',
photo CHAR(80) NOT NULL DEFAULT '',
intro TEXT NOT NULL,
PRIMARY KEY (id)
);

INSERT INTO user(name,password,sex,hobbies,addr,photo,intro) VALUES (:username,:password,:sex,:hobbies,:addr,:photo,:intro)