CREATE TABLE users(
  id int unsigned PRIMARY key AUTO_INCREMENT,
  name varchar(255),
  email varchar(255),
  pass varchar(255),
  photo varchar(255),
  gender enum('male','female'),
  address varchar(255),
  contact varchar(30),
  bio text,
  INDEX(name)
);

CREATE TABLE images(
  id int unsigned PRIMARY key AUTO_INCREMENT,
  image varchar(255),
  title varchar(255),
  description text,
  user_id int unsigned,
  FOREIGN KEY(user_id) REFERENCES users(id) ON UPDATE CASCADE on DELETE CASCADE  ,
  INDEX(title)
);

ALTER TABLE `users` CHANGE `photo` `photo` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'default_photo.png';