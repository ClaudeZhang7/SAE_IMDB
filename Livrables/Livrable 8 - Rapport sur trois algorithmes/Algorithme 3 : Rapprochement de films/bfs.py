from collections import deque
#import sys

def bfs(graph, debut, fin):
    queue = deque([debut])
    ancien = set([debut])
    estPasser = {debut: None}
    while queue:
        sommet = queue.popleft()
        for voisin in graph[sommet]:
            if voisin not in ancien:
                ancien.add(voisin)
                estPasser[voisin] = sommet
                queue.append(voisin)
                if voisin == fin:
                    chemin = []
                    actu = fin
                    while actu != debut:
                        chemin.append(actu)
                        actu = estPasser[actu]
                    chemin.append(debut)
                    return chemin[::-1]
    return None

fichier = open("graphe.txt", "r")
graph = fichier.read()
fichier.close()
plus_cours = bfs(graph, "Titanic", "Labyrinthe")
print(plus_cours)
#sys.exit(plus_cours)