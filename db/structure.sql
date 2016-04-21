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


drop table if exists t_user;
create table t_user (
  `usr_mail` varchar(50) not null primary key,
  `usr_prenom` varchar(50) not null,
  `usr_nom` varchar(50) not null,
  `usr_password` varchar(88) not null,
  `usr_salt` varchar(23) not null,
  `usr_role` varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

drop table if exists t_panier;
create table t_panier (
  `pa_idPneu` integer not null,
  `pa_mailUser` varchar(50) not null,
  `pa_quantite` integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;
