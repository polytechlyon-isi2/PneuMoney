truncate table t_pneu;
insert into t_pneu values
(1, 'Michelin', 'standard', 'neige', 15.32, 'pneu-michelin.jpg');
insert into t_pneu values
(2, 'Firestone', 'petit', 'desert', 10.21, 'firestone1.jpg');
insert into t_pneu values
(3, 'GoodYear', 'large', 'plage', 13.99, 'goodyear_LARGE.jpg');


truncate table t_marque;
insert into t_marque values
  (1, 'Michelin');
insert into t_marque values
  (2, 'Firestone');
insert into t_marque values
  (3, 'GoodYear');

  truncate table t_client;
  insert into t_client values
    ('batman@batcave.bat', 'Bat', 'Man');
  insert into t_client values
    ('adrienromanet@hotmail.com', 'adrien', 'romanet');
  insert into t_client values
    ('johndoe@hotmail.com', 'john', 'doe');
