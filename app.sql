set names utf8;
drop database  if exists pro;
create database pro charset=utf8;
use pro;
create table admin(
    id int primary key auto_increment,
    username varchar(20),
    password varchar(100)    
);
insert into admin values(null,'pro','1a5e52a77e8c62a74190a5040c5ce97e');

create table storeman(
    id int primary key auto_increment,
    sname varchar(50),
    pwd varchar(50)    
);
create table storeinfo(
    id int primary key auto_increment,
    uname varchar(20),
    stusno varchar(30),
    serialnum varchar(30),
    serialdes varchar(100),
    remarks varchar(50)
);

create table partinfo(
   id int primary key auto_increment,
   partIntr varchar(50),
   count varchar(30),
   sid int 
);