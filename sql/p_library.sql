create table p_library(
	num int not null auto_increment,
	id varchar(50) not null,
	name varchar(50) not null,
    subject text not null,
    content text not null,
    registday char(20) not null,
    count int not null,
    ufile text,
    ufile_name text,
	primary key(num));
