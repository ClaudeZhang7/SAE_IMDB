

CREATE TABLE new_table_crew AS
SELECT title_basics.*, title_crew.directors,title_crew.writers FROM title_basics
JOIN title_crew ON title_basics.tconst = title_crew.tconst;

-- On vide la table 
TRUNCATE TABLE title_crew;
INSERT INTO title_crew (tconst, directors, writers) 
SELECT tconst, directors, writers FROM new_table_crew;


CREATE TABLE new_table_episode AS
SELECT title_basics.*, title_episode.parentTconst,title_episode.seasonNumber,title_episode.episodeNumber FROM title_basics
JOIN title_episode ON title_basics.tconst = title_episode.tconst;


TRUNCATE TABLE title_episode;
INSERT INTO title_episode (tconst, parentTconst, seasonNumber, episodeNumber) 
SELECT tconst, parentTconst, seasonNumber,episodeNumber FROM new_table_episode;


CREATE TABLE new_table_ratings AS
SELECT title_basics.*, title_ratings.averageRatings,title_ratings.numVotes  FROM title_basics
JOIN title_ratings ON title_basics.tconst = title_ratings.tconst;


TRUNCATE TABLE title_ratings;
INSERT INTO title_ratings (tconst, averageRating, numVotes) 
SELECT tconst, averageRatings, numVotes FROM new_table_ratings;


CREATE TABLE new_table_akas AS
SELECT title_basics.*, title_ratings.averageRatings,title_ratings.numVotes  FROM title_basics
JOIN title_akas ON title_basics.tconst = title_akas.tconst;


TRUNCATE TABLE title_akas;
INSERT INTO title_akas (tconst,ordering,title,region,language,types,attributes,isOriginalTitle) 
SELECT tconst, ordering, title, region, language, types, attributes, isOriginalTitle FROM new_table_akas;


CREATE TABLE new_table_principals AS
SELECT title_akas.*,nconst, category, job, characters  FROM title_akas
JOIN title_principals ON title_akas.tconst = title_principals.tconst 
where title_akas.ordering = title_principals.ordering
;


TRUNCATE TABLE title_principals;
INSERT INTO title_principals (tconst,ordering,nconst,category,job,characters) 
SELECT tconst, ordering, nconst, category, job, characters FROM new_table_principals;


drop table new_table_crew ;
drop table new_table_episode;
drop table new_table_ratings;
drop table new_table_akas;
drop table new_table_principals;


-- delete from title_crew where tconst 
-- NOT IN (select tconst from title_basics);

-- delete from title_episode where tconst 
-- NOT IN (select tconst from title_basics);

-- delete from title_ratings where tconst 
-- NOT IN (select tconst from title_basics);

-- delete from title_akas where tconst 
-- NOT IN (select tconst from title_basics);

-- delete from title_principals where 
-- tconst NOT IN(select tconst from  title_akas
-- where ordering IN (select ordering from title_akas));