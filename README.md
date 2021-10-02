# WebLogin
Web Login for Assessment
 
 To create database:
 ```sh
CREATE TABLE users (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(50) NOT NULL UNIQUE,
email VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
name VARCHAR(50) NOT NULL,
surname VARCHAR(50) NOT NULL,
active VARCHAR(1) NOT NULL,
hash VARCHAR(255) NOT NULL,
admin VARCHAR(1) NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP 
);
CREATE TABLE `online_users` (
`session` char(100) NOT NULL default '',
`time` int(11) NOT NULL default '0'
);
CREATE TABLE taken_time (
time VARCHAR(100) NOT NULL,
day DATETIME DEFAULT CURRENT_TIMESTAMP 
);
