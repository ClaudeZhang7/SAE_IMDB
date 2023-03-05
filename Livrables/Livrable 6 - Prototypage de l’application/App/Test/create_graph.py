#!/usr/bin/env python
# -*- coding: utf-8 -*-

import psycopg2
import json
from tqdm import tqdm
import os
import time

def create_graph():
    hostname = 'localhost'
    database = 'postgres'
    username = 'saeroot'
    pwd = 'root'
    port_id = 8080

    start_time = time.time()

    print("Connexion à la base de données...")
    conn = psycopg2.connect(
        host=hostname,
        dbname=database,
        user=username,
        password=pwd,
        port=port_id
    )

    dico={}
    
    print("Lancement de la récupération des tconst...")
    cur = conn.cursor()
    cur.execute("SELECT tconst FROM title_basics")
    for tconst in tqdm(cur):
        dico[tconst[0]] = []
    cur.close()

    print("Lancement de la récupération des nconst...")
    cur = conn.cursor()
    cur.execute("SELECT nconst FROM name_basics")
    for nconst in tqdm(cur):
        dico[nconst[0]] = []
    cur.close()

    print("Lancement de la récupération des relations...")
    cur = conn.cursor()
    cur.execute("SELECT tconst, nconst FROM title_principals where category='actor' or category='actress';")
    for données in tqdm(cur):
        tconst = données[0]
        nconst = données[1]
        if tconst not in dico:
            dico[tconst] = []
        else:
            dico[tconst].append(nconst)
        if nconst not in dico:
            dico[nconst] = []
        else:
            dico[nconst].append(tconst)
    cur.close()

    print("Ecriture du graphe dans un fichier JSON...")
    with open(os.path.join(os.path.dirname(__file__), "graphe.json"), "w") as f:
        json.dump(dico, f)
        
    print("Fermeture de la connexion à la base de données...")
    conn.close()

    print("Temps d'execution du programme: %s minutes" % round((time.time() - start_time) / 60, 2))
    return True

if __name__ == '__main__':
    create_graph()