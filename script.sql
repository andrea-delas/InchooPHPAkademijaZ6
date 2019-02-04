DROP DATABASE IF EXISTS polaznik01_mvc;
CREATE DATABASE polaznik01_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use polaznik01_mvc;

create table post(
id int not null primary key auto_increment,
content text,
post_create_date timestamp DEFAULT CURRENT_TIMESTAMP
)engine=InnoDB;

insert into post (content)
values ('Evo danas pada kiša opet :('),
        ('Jedem jagode.');
