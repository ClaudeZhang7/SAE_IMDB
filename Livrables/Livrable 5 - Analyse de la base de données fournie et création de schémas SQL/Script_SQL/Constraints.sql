-- Contient les contraintes des clés primaires && étrangères 

ALTER TABLE name_basics
ADD CONSTRAINT Basics_pri_key PRIMARY KEY (nconst);

ALTER TABLE title_basics
ADD CONSTRAINT Title_pri_key PRIMARY KEY (tconst);

ALTER TABLE title_akas 
ADD CONSTRAINT Akas_pri_key PRIMARY KEY (tconst,ordering);

ALTER TABLE title_crew
ADD CONSTRAINT Crew_pri_key PRIMARY KEY (tconst);

ALTER TABLE title_crew -- WITH NOCHECK sur un autre type de logiciel  
ADD CONSTRAINT Crew_tconst_fkey FOREIGN KEY (tconst) REFERENCES title_basics(tconst)
NOT VALID; -- pb

ALTER TABLE title_episode
ADD CONSTRAINT Episode_pri_key PRIMARY KEY (tconst);

ALTER TABLE title_episode
ADD CONSTRAINT Episode_tconst_fkey FOREIGN KEY (tconst) REFERENCES title_basics(tconst)
NOT VALID; --pb


ALTER TABLE title_principals
ADD CONSTRAINT Principals_pri_key PRIMARY KEY (tconst,ordering);

ALTER TABLE title_ratings
ADD CONSTRAINT Ratings_pri_key PRIMARY KEY (tconst);

ALTER TABLE title_ratings
ADD CONSTRAINT Ratings_tconst_fkey FOREIGN KEY (tconst) REFERENCES title_basics(tconst)
NOT VALID; -- pb

ALTER TABLE title_akas
ADD CONSTRAINT Akas_title_id_fkey FOREIGN KEY (tconst) REFERENCES title_basics(tconst)
NOT VALID;

ALTER TABLE title_principals
ADD CONSTRAINT Principals_tconst_fkey FOREIGN KEY (tconst,ordering) REFERENCES title_akas(tconst,ordering)
NOT VALID;

-- ALTER TABLE title_principals
-- ADD CONSTRAINT Principals_nconst_fkey FOREIGN KEY (nconst) REFERENCES name_basics(nconst)
-- NOT VALID;

-- ALTER TABLE title_principals
-- ADD CONSTRAINT Principals_tconst_fkey FOREIGN KEY (tconst) REFERENCES title_basics(tconst)
-- NOT VALID;



