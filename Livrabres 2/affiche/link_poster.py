import movieposters as mp
import sys
import psycopg2

ids = sys.argv[1]

# vérifie si le lien existe déjà dans la base de données
def check_link(link):
    cur = conn.cursor()
    cur.execute("SELECT * FROM ajax WHERE tconst=%s", (link,))
    rows = cur.fetchall()
    if len(rows) == 0:
        return False
    else:
        return True

# Connexion à la base de données
hostname = 'localhost'
database ='postgres'
username='saeroot'
pwd ='root'
port_id=8080
conn = None
cur = None

conn=psycopg2.connect(

    host = hostname,
    dbname = database,
    user = username,
    password = pwd,
    port = port_id)

# Si le lien n'existe pas dans la base de données, on l'ajoute
if check_link(ids) == False:
    try:
        link = mp.get_poster(id=ids)
    except:
        link = q
    link = mp.get_poster(id=ids)
    cur = conn.cursor()
    cur.execute("INSERT INTO ajax (tconst, url) VALUES (%s, %s)", (ids, link))
    conn.commit()

# récupère le lien de l'image
cur = conn.cursor()
cur.execute("SELECT url FROM ajax WHERE tconst=%s", (ids,))
rows = cur.fetchall()
for row in rows:
    print(row[0])
