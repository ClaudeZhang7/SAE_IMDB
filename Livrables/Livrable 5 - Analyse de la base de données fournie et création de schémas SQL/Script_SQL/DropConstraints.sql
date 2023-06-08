-- L'ordre est très importants !


ALTER TABLE title_ratings
DROP CONSTRAINT IF EXISTS ratings_pri_key;

ALTER TABLE title_ratings
DROP CONSTRAINT IF EXISTS ratings_tconst_fkey ;

ALTER TABLE title_principals
DROP CONSTRAINT IF EXISTS principals_pri_key ;

ALTER TABLE title_principals
DROP CONSTRAINT IF EXISTS principals_nconst_fkey ;

ALTER TABLE title_principals
DROP CONSTRAINT IF EXISTS principals_tconst_fkey ;

ALTER TABLE title_episode
DROP CONSTRAINT IF EXISTS episode_pri_key ;

ALTER TABLE title_episode
DROP CONSTRAINT IF EXISTS episode_tconst_fkey ;

ALTER TABLE title_crew
DROP CONSTRAINT IF EXISTS crew_pri_key ;

ALTER TABLE title_crew
DROP CONSTRAINT IF EXISTS crew_tconst_fkey ;

ALTER TABLE title_akas
DROP CONSTRAINT IF EXISTS akas_pri_key ;

ALTER TABLE title_akas
DROP CONSTRAINT IF EXISTS akas_title_id_fkey ;


ALTER TABLE title_basics
DROP CONSTRAINT IF EXISTS title_pri_key ;

ALTER TABLE name_basics
DROP CONSTRAINT IF EXISTS basics_pri_key ;



