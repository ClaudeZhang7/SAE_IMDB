-- On va pas utiliser ce fichier car ça prendrait trop de temps voir 
-- le script Execute_Sql_Scripts.py

delete from title_crew where tconst 
NOT IN (select tconst from title_basics);

delete from title_episode where tconst 
NOT IN (select tconst from title_basics);

delete from title_ratings where tconst 
NOT IN (select tconst from title_basics);

delete from title_akas where tconst 
NOT IN (select tconst from title_basics);

delete from title_principals where 
tconst NOT IN(select tconst from  title_akas
where ordering IN (select ordering from title_akas));