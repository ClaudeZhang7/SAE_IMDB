-- table title_basics : 
COPY title_basics FROM 'C:\Program Files\PostgreSQL\13\scripts\data_title_basics.tsv' csv DELIMITER ',' header  ;

-- table name_basics : 
COPY name_basics FROM 'C:\Program Files\PostgreSQL\13\scripts\data_name_basics.tsv' csv DELIMITER ',' header ;

-- table title_crew :
COPY title_crew FROM 'C:\Program Files\PostgreSQL\13\scripts\data_title_crew.tsv' csv DELIMITER ',' header ;

-- table title_akas :
COPY title_akas FROM 'C:\Program Files\PostgreSQL\13\scripts\data_title_akas.tsv' csv DELIMITER ',' header ;

-- table title_episode :
COPY title_episode FROM 'C:\Program Files\PostgreSQL\13\scripts\title_episode.tsv' csv DELIMITER E'\t' header  ;

-- table title_ratings:
COPY title_ratings FROM 'C:\Program Files\PostgreSQL\13\scripts\title_ratings.tsv' csv DELIMITER E'\t' header  ;

-- table title_principals:
COPY title_principals FROM 'C:\Program Files\PostgreSQL\13\scripts\title_principals.tsv' csv DELIMITER E'\t' header  ;