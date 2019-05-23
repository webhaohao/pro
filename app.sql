set names utf8;
drop database  if exists pro;
create database pro charset=utf8;
use pro;
create table admin(
    id int primary key auto_increment,
    username varchar(20),
    password varchar(100)    
);
insert into admin values(null,'admin','e10adc3949ba59abbe56e057f20f883e');

create table storeman(
    id int primary key auto_increment,
    sname varchar(50),
    pwd varchar(50)    
);
create table storeinfo(
    id int primary key auto_increment,
    uname varchar(20),
    stusno varchar(30),
    path varchar(50)
);

create table partinfo(
   id int primary key auto_increment,
   serialnum varchar(30),
   serialdes varchar(100),
   partIntr varchar(50),
   count varchar(30),
   remarks varchar(50),
   sid int 
);