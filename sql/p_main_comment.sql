create table p_main_comment(
	num int not null auto_increment,
	id varchar(50) not null,
	name varchar(50) not null,
    content text,
    registday char(20) not null,
    hit int not null,
    place_num varchar(30) not null,
	primary key(num));
