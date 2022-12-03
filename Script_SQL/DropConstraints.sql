-- L'ordre est très importants !

-- Primary Keys




ALTER TABLE title_ratings
DROP CONSTRAINT ratings_pri_key;

ALTER TABLE title_principals
DROP CONSTRAINT principals_pri_key ;

ALTER TABLE title_episode
DROP CONSTRAINT episode_pri_key ;

ALTER TABLE title_crew
DROP CONSTRAINT crew_pri_key ;

ALTER TABLE title_akas
DROP CONSTRAINT akas_pri_key ;

ALTER TABLE title_basics
DROP CONSTRAINT title_pri_key ;

ALTER TABLE name_basics
DROP CONSTRAINT basics_pri_key ;



-- Foreign Keys

ALTER TABLE title_ratings
DROP CONSTRAINT ratings_tconst_fkey ;

ALTER TABLE title_principals
DROP CONSTRAINT principals_nconst_fkey ;

ALTER TABLE title_principals
DROP CONSTRAINT principals_tconst_fkey ;

ALTER TABLE title_episode
DROP CONSTRAINT episode_tconst_fkey ;

ALTER TABLE title_crew
DROP CONSTRAINT crew_tconst_fkey ;

ALTER TABLE title_akas
DROP CONSTRAINT akas_title_id_fkey ;


