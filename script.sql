drop table if exists title_principals;

create table title_principals(
    tconst varchar(1000000), 
    ordering varchar(1000000), 
    nconst varchar(1000000), 
    category varchar(1000000), 
    job varchar(1000000), 
    characters varchar(1000000)
);

COPY title_principals FROM '/Users/samueldorismond/Downloads/data-7.tsv' DELIMITER E'\t';