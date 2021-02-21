-- SQL for group assignment W07

DROP TABLE IF EXISTS W07_users;
CREATE TABLE W07_users(
  id SERIAL PRIMARY KEY NOT NULL,
  username varchar(255) UNIQUE NOT NULL,
  password varchar(255) NOT NULL,
  createdon timestamp NOT NULL,
  modifiedon timestamp NOT NULL default NOW()
);