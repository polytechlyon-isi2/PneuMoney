drop table if exists t_pneu;

create table t_pneu (
    pneu_id integer not null primary key auto_increment,
    pneu_marque varchar(100) not null,
    pneu_taille varchar(100) not null,
    pneu_type varchar(100) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;
