create database mvc;

use mvc;

create table pages(
  id tinyint(3) unsigned not null auto_increment,
  alias varchar(100) not null ,
  title varchar(100) not null ,
  content text default null,
  is_published tinyint(1) unsigned default 0,
  primary key (id)

)engine = InnoDB default charset = utf8;

insert into pages (id, alias, title, content, is_published)
values (1,'about','About Us','Test content',1),
       (2,'test','Test Page','Another test content',1);

create table users(
  id tinyint(3) unsigned not null auto_increment,
  login varchar(100) not null ,
  email varchar(100) not null ,
  role char(100) not null default 'admin',
  password varchar(100) not null ,
  is_active tinyint(1) unsigned default 1,
  primary key (id)
)engine = InnoDB default charset = utf8;

create table messages(
  id tinyint(3) unsigned not null auto_increment,
  name varchar(100) not null,
  email varchar(100) not null ,
  message text default null,
  primary key (id)
)engine = InnoDB default charset = utf8;