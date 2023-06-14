from flask import Flask
import movieposters as mp
import psycopg2

def get_link(cursor, id):
    cursor.execute("SELECT url FROM ajax WHERE tconst=%s", (id,))
    row = cursor.fetchone()
    return row[0] if row else None

def check_and_insert_link(cursor, id):
    if get_link(cursor, id) is None:
        link = mp.get_poster(id=id)
        cursor.execute("INSERT INTO ajax (tconst, url) VALUES (%s, %s)", (id, link))

app = Flask(__name__)

@app.route('/')
def welcome():
    return "Welcome to the movie poster API!"

@app.route('/<id>', methods=['GET'])
def get_poster(id):
    hostname = 'localhost'
    database ='postgres'
    username='saeroot'
    pwd ='root'
    port_id=8080

    try:
        conn=psycopg2.connect(host=hostname, dbname=database, user=username, password=pwd, port=port_id)

        with conn, conn.cursor() as cur:
            check_and_insert_link(cur, id)
            link = get_link(cur, id)
            if link is None:
                link = "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=1380&t=st=1686588171~exp=1686588771~hmac=a8c2c6bd457d4c4193f1f98c3d7cf32dca5e7b117a9f77ff35cdbacdcaf89524"
            return link

    except Exception as e:
        return "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=1380&t=st=1686588171~exp=1686588771~hmac=a8c2c6bd457d4c4193f1f98c3d7cf32dca5e7b117a9f77ff35cdbacdcaf89524"

if __name__ == "__main__":
    app.run(port=5000)
