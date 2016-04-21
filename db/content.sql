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

  truncate table t_taille;
insert into t_taille values
  ('petit');
insert into t_taille values
  ('standard');
insert into t_taille values
  ('large');

  truncate table t_user;
  insert into t_user values
    ('batman@hotmail.com', 'man', 'bat', '+qLA3F8wJCJc9pLBt1ARsLZypzhKFQFJaMsKZkiXfiyq1xXO3oY594r55PCnwbkiCXHXMpK/cmZMd37ElxdGkA==', 'ba951994555417e6dfea165', 'ROLE_USER');
#vrai mot de passe : batman
