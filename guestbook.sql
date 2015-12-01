
create database guestbook;

use guestbook;

drop table if exists user;

create table if not exists user(
id int(5) not null auto_increment,
name varchar(60) not null default ' ',
password varchar(16) not null,
email varchar(60) not null default ' ',
primary key(id),
unique(name),
unique(email)
);

insert into user(`name`, `password`, `email`) value('root', 'root', 'root@topwlzg.cn');

drop table if exists message;

create table if not exists message(
id int not null auto_increment,
author varchar(64) not null,
title   text not null,
content text not null,
createTime DATETIME   not null,
updateTime DATETIME   not null,
primary key(id)
);


