create table sessions(
	id int(11) auto_increment,
    user_id int(11) not null,
    created_at timestamp default current_timestamp,
    primary key(id),
    constraint fk_sessions_user foreign key(user_id) references users(id)
) engine InnoDB;