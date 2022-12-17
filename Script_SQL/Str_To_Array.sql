-- Optimisation du temps du script de conversion en tableau 

-- Table name_basics :

alter table name_basics 
      alter primaryprofession type text[] using string_to_array(primaryprofession, ',');

alter table name_basics 
      alter knownfortitles type text[] using string_to_array(knownfortitles, ',');


-- Table title_crew : 

alter table title_crew 
      alter directors type text[] using string_to_array(directors, ',');

alter table title_crew 
      alter writers type text[] using string_to_array(writers, ',');


-- Table title_basics : 

alter table title_basics 
      alter genres type text[] using string_to_array(genres, ',');


-- Table title_akas : 

alter table title_akas 
      alter types type text[] using string_to_array(types, ',');


alter table title_akas 
      alter attributes type text[] using string_to_array(attributes, ',');


