create table if not exists user
(

id int not null ,

name char(32) not null ,

firstName char(32) not null ,

password char(32) not null ,

email char(32) not null ,

role char(32) not null

, primary key (id)

)


create table if not exists aptitude

(

id_aptitude int not null ,

label char(32) not null ,

description char(32) null

, primary key (id_aptitude)

)

create table if not exists skill

(

id_skill int not null ,

id_is_made_of int not null ,

label char(32) not null ,

description text null

, primary key (id_skill)

)

create table if not exists formation

(

id_formation int not null ,

id_is_validating int not null ,

description text not null ,

level int not null

, primary key (id_formation)

)

create table if not exists student

(

id_student int not null ,

name char(32) not null ,

firstname char(32) not null ,

level int not null

, primary key (id_student)

)

create table if not exists completion

(

id_completion_1 int not null ,

id_completion_2 int not null ,

completed bool not null ,

aquired smallint not null

, primary key (id_completion_1,id_completion_2)

)

create table if not exists validation

(

id_valide_1 int not null ,

id_valide_2 int not null ,

validated bool not null  , 

primary key (id_valide_1,id_valide_2)

)

create table if not exists is_attending

(

id_attend_1 int not null ,

id_attend_2 int not null

, primary key (id_attend_1,id_attend_2)

)

create table if not exists is_assessing

(

id int not null ,

id_1 int not null

, primary key (id,id_1)

)

create table if not exists is_managing

(

id int not null ,

id_1 int) not null

, primary key (id,id_1)

)

alter table skill

add foreign key fk_skill_aptitude (id_is_made_of)

references aptitude (id_aptitude) ;



alter table formation

add foreign key fk_formation_skill (id_is_validating)

references skill (id_skill) ;



alter table completion

add foreign key fk_completion_student (id_completion_1)

references student (id_student) ;



alter table completion

add foreign key fk_completion_aptitude (id_completion_2)

references aptitude (id_aptitude) ;



alter table validation

add foreign key fk_validation_student (id_valide_1)

references student (id_student) ;



alter table validation

add foreign key fk_validation_skill (id_valide_2)

references skill (id_skill) ;



alter table is_attending

add foreign key fk_is_attending_formation (id_attend_1)

references formation (id_formation) ;



alter table is_attending

add foreign key fk_is_attending_student (id_attend_2)

references student (id_student) ;



alter table is_assessing

add foreign key fk_is_assessing_student (id)

references student (id_student) ;



alter table is_assessing

add foreign key fk_is_assessing_user (id_1)

references user (id) ;



alter table is_managing

add foreign key fk_is_managing_formation (id)

references formation (id_formation) ;



alter table is_managing

add foreign key fk_is_managing_user (id_1)

references user (id) ;


INSERT INTO `user` (`id`, `firstName`, `name`, `email`, `password`, `role`) VALUES

(1, 'admin', 'admin', 'admin', 'admin', 'admin');