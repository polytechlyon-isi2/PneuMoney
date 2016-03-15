create database if not exists pneumoney character set utf8 collate utf8_unicode_ci;


grant all privileges on pneumoney.* to 'pneumoney_user'@'localhost' identified by 'secret';
