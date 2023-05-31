create table p_members(
	num int not null auto_increment,
	id varchar(50) not null,
    pw varchar(60) not null,
	name varchar(50) not null,
    school_id varchar(20),
    email char(100) not null,
    joinday char(20) not null,
    admin int(1),
	primary key(num));
