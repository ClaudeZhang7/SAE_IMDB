-- On va pas utiliser ce fichier car ça prendrait trop de temps voir 
-- le script Execute_Sql_Scripts.py

ALTER TABLE title_crew VALIDATE CONSTRAINT Crew_tconst_fkey ;


ALTER TABLE title_episode VALIDATE CONSTRAINT Episode_tconst_fkey ;


ALTER TABLE title_ratings VALIDATE CONSTRAINT Ratings_tconst_fkey ;


ALTER TABLE title_akas VALIDATE CONSTRAINT Akas_title_id_fkey ;


ALTER TABLE title_principals VALIDATE CONSTRAINT Principals_tconst_fkey ;




