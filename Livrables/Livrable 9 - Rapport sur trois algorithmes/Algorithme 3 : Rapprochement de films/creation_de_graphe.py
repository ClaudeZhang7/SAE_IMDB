#!/usr/bin/env python
# -- coding: utf-8 --

import psycopg2
import sys


def create_graph():
    hostname = 'localhost' # accepte la connexion à distance 
    database ='postgres'
    username='saeroot'
    pwd ='root' # demander le mot de passe à Claude
    port_id=8080
    conn = None
    cur = None

    conn=psycopg2.connect(

        host = hostname,
        dbname = database,
        user = username,
        password = pwd,
        port = port_id)

    #ouvre tout
    fichier = open("graphe.txt", "w")
    fichier.write("graphe {")
    cur = conn.cursor()
    create_script = ''' select primarytitle from title_basics natural join name_basics 
                        FETCH FIRST 10 ROWS ONLY;  ''' # Jai changé le truc 
    cur.execute(''' SELECT distinct(title) from FOR_GRAPH ''') #
    row = cur.fetchone()
    print(row)
    
    #cherche tout les acteurs et les films dans lesquels ils ont joués
    while(row != None):
        fichier.write(row[0] + ": {")
        actuFilm = "'"+row[0]+"'"

        cursor_actor = conn.cursor()
        cursor_actor.execute('''SELECT actor FROM FOR_GRAPH where film = '''+actuFilm+''';''') 
        actors = cursor_actor.fetchall()
        for actor in actors:
            fichier.write(actor + ",")
        fichier.write("},")
        row = cur.fetchone()

    #se prépare a faire la meme chose pour les films
    cur.close()
    cursor_actor = conn.cursor()
    cursor_actor.execute('''SELECT distinct(actor) from FOR_GRAPH''') 
    row = cursor_actor.fetchone()

    while(row != None):
        fichier.write(row[0] + ": {")
        actuactor = "'"+row[0]+"'"
        cur = conn.cursor()
        cur.execute('''SELECT film FROM FOR_GRAPH where actor = '''+actuactor+''';''') 
        films = cur.fetchall()
        for film in films:
            fichier.write(film[0] + ",")
        fichier.write("}")
        row = cursor_actor.fetchone()
    #ferme tout
    fichier.write("}")
    fichier.close()
    cur.close()
    cursor_actor.close()
    conn.close()


create_graph()

