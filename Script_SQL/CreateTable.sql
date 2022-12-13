drop table if exists title_principals;
drop table if exists title_ratings;
drop table if exists title_episode;
drop table if exists title_crew;
drop table if exists name_basics;
drop table if exists title_akas;
drop table if exists title_basics;

create table title_basics(
    tconst text  NOT NULL,
    titleType text,
    primaryTitle text,
    originalTitle text,
    isAdult boolean ,
    startYear int, -- peut-etre remplacer par integer NULL
    endYear int,   -- Idem
    runtimeMinutes int,
    genres text[] 
);

create table title_ratings(
    tconst text  NOT NULL,
    averageRating float,
    numVotes int
);

create table title_akas(
    tconst text NOT NULL,
    ordering INTEGER NOT NULL, 
    title text, 
    region text, 
    language text, 
    types text[], 
    attributes text[],
    isOriginalTitle boolean 
);

create table title_episode(
    tconst text  NOT NULL,
    parentTconst text NOT NULL, 
    seasonNumber int, -- peu-etre changer par integer NULL
    episodeNumber int -- Idem
);


create table name_basics(
    nconst text NOT NULL, 
    primaryName text , 
    birthYear int,   -- Idem 
    deathYear int,   -- Idem
    primaryProfession text[],
    knownForTitles text[]
);

create table title_crew(
    tconst text NOT NULL,
    directors text[],
    writers text[]

);

create table title_principals(
    tconst text NOT NULL, 
    ordering int NOT NULL, 
    nconst text NOT NULL, 
    category text, 
    job text, 
    characters text
    
);









