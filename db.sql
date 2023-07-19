create table if not exists users(
    id int(10) unsigned auto_increment primary key,
    name varchar(100) not null,
    lastname varchar(100),
    email varchar(200) not null unique,
    password varchar(200) not null,
    image varchar(200),
    token varchar(200),
    bio text
)engine=innodb;

create table if not exists movies(
    id int(10) unsigned auto_increment primary key,
    title varchar(100) not null,
    description text,
    image varchar(200),
    trailer varchar(150),
    length varchar(50),
    user_id int(10) unsigned,
    foreign key (user_id) references users (id)
)engine=innodb;

create table if not exists reviws(
    id int(10) unsigned auto_increment primary key,
    rating int,
    review text,
    user_id int(10) unsigned,
    movie_id int(10) unsigned,
    foreign key (user_id) references users (id),
    foreign key (movie_id) references movies (id)
)engine=innodb;