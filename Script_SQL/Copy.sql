-- table title_basics : 
COPY title_basics FROM '/usr/lib/postgresql/14/scripts/title.basics.tsv' csv DELIMITER ',' null '\N' header 
where startyear >0 or startyear is null and endyear > startyear or endyear is null and runtimeminutes >0 or runtimeminutes is null ;

-- table name_basics : 
COPY name_basics FROM '/usr/lib/postgresql/14/scripts/name.basics.tsv' csv DELIMITER ',' null '\N' header
where birthyear >0 or birthyear is null and deathyear > birthyear or deathyear is null ;

-- table title_crew :
COPY title_crew FROM '/usr/lib/postgresql/14/scripts/title.crew.tsv' csv DELIMITER ',' null '\N' header ;

-- table title_akas :
COPY title_akas FROM '/usr/lib/postgresql/14/scripts/title.akas.tsv' csv DELIMITER ',' null '\N' header
where isoriginaltitle =true or isoriginaltitle =false  ;

-- table title_episode :
COPY title_episode FROM '/usr/lib/postgresql/14/scripts/title.episode.tsv' csv DELIMITER E'\t' null '\N' header
where seasonnumber >0 or seasonnumber is null and episodenumber >0 and episodenumber is null ;

-- table title_ratings:
COPY title_ratings FROM '/usr/lib/postgresql/14/scripts/title.ratings.tsv' csv DELIMITER E'\t' null '\N' header  ;

