create table p_mainboard(
	num int not null auto_increment,
	id varchar(50) not null,
	name varchar(50) not null,
    content text,
    registday char(20) not null,
    hit int not null,
    image text,
    image_name text,
	primary key(num));
