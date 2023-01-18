-- table title_basics : 
<<<<<<< HEAD
COPY title_basics FROM '/usr/lib/postgresql/14/scripts/title.basics.tsv' csv DELIMITER E'\t' null '\N' header 
where startyear >0 or startyear is null and endyear > startyear or endyear is null and runtimeminutes >0 or runtimeminutes is null ;

-- table name_basics : 
COPY name_basics FROM '/usr/lib/postgresql/14/scripts/name.basics.tsv' csv DELIMITER E'\t' null '\N' header
where birthyear >0 or birthyear is null and deathyear > birthyear or deathyear is null ;

-- table title_crew :
COPY title_crew FROM '/usr/lib/postgresql/14/scripts/title.crew.tsv' csv DELIMITER E'\t' null '\N' header ;

-- table title_akas :
COPY title_akas FROM '/usr/lib/postgresql/14/scripts/title.akas.tsv' csv DELIMITER E'\t' null '\N' header
=======
COPY title_basics FROM 'C:\Program Files\PostgreSQL\13\scripts\data_title_basics.tsv' csv DELIMITER E'\t' null '\N' header 
where startyear >0 or startyear is null and endyear > startyear or endyear is null and runtimeminutes >0 or runtimeminutes is null ;

-- table name_basics : 
COPY name_basics FROM 'C:\Program Files\PostgreSQL\13\scripts\data_name_basics.tsv' csv DELIMITER E'\t' null '\N' header
where birthyear >0 or birthyear is null and deathyear > birthyear or deathyear is null ;

-- table title_crew :
COPY title_crew FROM 'C:\Program Files\PostgreSQL\13\scripts\data_title_crew.tsv' csv DELIMITER E'\t' null '\N' header ;

-- table title_akas :
COPY title_akas FROM 'C:\Program Files\PostgreSQL\13\scripts\data_title_akas.tsv' csv DELIMITER E'\t' null '\N' header
>>>>>>> 94f8a1127604350efa5ff819481f94998caf979d
where isoriginaltitle =true or isoriginaltitle =false  ;

-- table title_episode :
COPY title_episode FROM '/usr/lib/postgresql/14/scripts/title.episode.tsv' csv DELIMITER E'\t' null '\N' header
where seasonnumber >0 or seasonnumber is null and episodenumber >0 and episodenumber is null ;

-- table title_ratings:
COPY title_ratings FROM '/usr/lib/postgresql/14/scripts/title.ratings.tsv' csv DELIMITER E'\t' null '\N' header  ;

