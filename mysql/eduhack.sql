

create database if not exists eduhack;

use eduhack;

create table if not exists author (
	author_id integer not null auto_increment,
	name varchar(64) not null,
	authid varchar(256) unique,
	primary key (author_id)
);

create table if not exists lesson (
	lesson_id integer not null auto_increment,
	subject varchar(64) not null,
	title varchar(64) not null,
	grade varchar(20),
	duration integer,
	duration_type varchar(20),
	purpose text,
	instruction text,
	materials text,
	assessment text,
	author_id integer,
	last_updated timestamp on update current_timestamp,
	foreign key (author_id) references author(author_id),
	primary key (lesson_id)
);

create table if not exists lessonitem (
	lessonitem_id integer not null auto_increment,
	lesson_id integer not null,
	title varchar(128),
	url text,
	lrdocid varchar(128),
	notes text,
	orderby smallint default 10,
	foreign key (lesson_id) references lesson(lesson_id),
	primary key (lessonitem_id)
);

