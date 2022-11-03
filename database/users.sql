create table users(
	id int(11) auto_increment,
    name varchar(255) not null,
    password varchar(255) not null,
    created_at timestamp default current_timestamp,
    primary key(id)
) engine InnoDB;