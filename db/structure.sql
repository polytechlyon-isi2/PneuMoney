drop table if exists t_pneu;
create table t_pneu (
    pneu_id integer not null primary key auto_increment,
    pneu_marque varchar(100) not null,
    pneu_taille varchar(100) not null,
    pneu_type varchar(100) not null,
    pneu_prix double not null,
    pneu_image varchar(1000) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

drop table if exists t_marque;
create table t_marque (
  `marque_id` integer not null primary key auto_increment,
  `marque_nom` varchar(20) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

drop table if exists t_taille;
create table t_taille (
  `taille_nom` varchar(20) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

drop table if exists t_client;
create table t_client (
  `client_mail` varchar(30) not null primary key,
  `client_prenom` varchar(20) not null,
  `client_nom` varchar(20) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;
