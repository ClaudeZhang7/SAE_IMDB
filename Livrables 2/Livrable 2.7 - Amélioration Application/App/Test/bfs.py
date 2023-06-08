# Programme développé par Samuel Dorismond avec l'aide Fatih Fidan (Le frérot)

import json
from collections import deque
import os
import psycopg2
from tqdm import tqdm
import time
import sys

timeProgram = time.time()
hostname = 'localhost'
database = 'postgres'
username = 'saeroot'
pwd = 'root'
port_id = 8080

conn = psycopg2.connect(
    host=hostname,
    dbname=database,
    user=username,
    password=pwd,
    port=port_id
)


def bfs(graph, start, end):
    queue = deque([start])
    visited = set([start])
    came_from = {start: None}

    # print("Recherche du chemin le plus court...")
    while queue:
        current = queue.popleft()

        # Si le sommet n'existe pas dans le graph, on lève une exception
        if current not in graph:
            return f"Le sommet {current} n'existe pas dans le graph"

        # Si on a trouvé le sommet final, on construit le chemin et on le retourne
        if current == end:
            path = []
            while current is not None:
                path.append(current)
                current = came_from[current]
            return path[::-1]

        # Sinon, on explore les voisins
        for neighbor in graph[current]:
            if neighbor not in visited:
                visited.add(neighbor)
                came_from[neighbor] = current
                queue.append(neighbor)

    # Si on a parcouru tout le graph sans trouver le sommet final, on retourne None
    return None


def find_shortest_path(start, end):

    # Charger le graphe depuis le fichier JSON
    # print("Chargement du graphe depuis le fichier JSON...")
    with open(os.path.join(os.path.dirname(__file__), "graphe.json"), "r") as f:
        graph = json.load(f)

    # Vérifier que les sommets de départ et d'arrivée existent dans le graphe
    if start not in graph and start not in graph:
        return f"Le sommet de départ {start} n'existe pas dans le graphe"
    if end not in graph and end not in graph:
        return f"Le sommet d'arrivée {end} n'existe pas dans le graphe"

    # Lancer la recherche de chemin
    try:
        path = bfs(graph, start, end)
        if path is None:
            return f"Aucun chemin entre {start} et {end}"
        elif len(path) >= 1:
            # print(f"Conversion des sommets en noms...")
            path = replaceConstByName(path)
            path = ' -> '.join(path)
        return path
    except ValueError as e:
        print(f"Erreur : {e}")


def replaceConstByName(path):
    new_tab = []
    pbar = tqdm(total=len(path))
    for elem in path:
        pbar.update(1)
        # si le sommet est un film
        if elem[0] == "t":
            # on remplace le sommet par son nom
            new_tab.append(getMovieName(elem))
        # si le sommet est un acteur
        else:
            # on remplace le sommet par son nom
            new_tab.append(getActorName(elem))
    pbar.close()
    return new_tab


def getMovieName(id):
    cur = conn.cursor()
    cur.execute("SELECT primaryTitle FROM title_basics WHERE tconst = %s", (id,))
    for title in cur:
        return title[0]
    cur.close()


def getActorName(id):
    cur = conn.cursor()
    cur.execute("SELECT primaryName FROM name_basics WHERE nconst = %s", (id,))
    for name in cur:
        return name[0]
    cur.close()


# Test
if len(sys.argv) > 1:
    arg1 = sys.argv[1]
    arg2 = sys.argv[2]
else:
    arg1 = "nm0000148"
    arg2 = "nm0000151"
path = find_shortest_path(arg1, arg2)
print(path)