CREATE DATABASE burgers
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE burgers;

CREATE TABLE users (
id             INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
us_name        CHAR(128) NOT NULL,
us_email       CHAR(128) NOT NULL,
us_phone       CHAR(128) NOT NULL,
create_date    DATETIME
);

CREATE TABLE orders (
  id              INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  create_date     DATETIME,
  street          CHAR(128) NOT NULL,
  house           CHAR(128) NOT NULL,
  building        CHAR(128),
  appartment      CHAR(128),
  floor           INT,
  description     TEXT,
  payment_type    BOOL,
  callback        BOOL,
  user_id         INT
);
