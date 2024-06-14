create database samueldb;

create table samueldb.`users`( 
    user_id int (12) not null auto_increment primary KEY,
    firstname varchar(30) not null,
    lastname VARCHAR(30) NOT null,
    address VARCHAR(150) not null,
    contact VARchar (20) not null);
