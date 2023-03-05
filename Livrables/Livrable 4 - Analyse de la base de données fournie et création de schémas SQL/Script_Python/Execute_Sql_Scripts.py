import psycopg2 

hostname = ''
database ='postgres'
username='Claude'
pwd ='mdpADemander' # demander le mot de passe à Claude
port_id=0000        # demander le port à Claude
conn = None
cur = None
try:
    
    conn=psycopg2.connect(
        
        host = hostname,
        dbname = database,
        user = username,
        password = pwd,
        port = port_id)
    
    cur = conn.cursor()
    cur.execute(open("DropConstraints.sql", "r").read())
    cur.execute(open("CreateTable.sql", "r").read())
    cur.execute(open("Copy.sql", "r").read())
    cur.execute(open("Constraints.sql", "r").read())
# On va pas utiliser les commandes ci-dessous car cela augmenterais de
# manière significatif le temps de chargement mais on montre ici qu'on
# à régler les problèmes liés aux "manques/mauvaises" données lié à IMDB
    # cur.execute(open("DeleteFrom.sql", "r").read())
    # cur.execute(open("ValidateConstraints.sql", "r").read())
    conn.commit()  

    
except Exception as error:
    print(error) # si vous avez un saut de ligne et ensuite Programme Fini 
                 # c'est que vous avez pas réussi à vous connecter à la base de donnée 
    
finally:
    if cur is not None:
        
        cur.close()
    if conn is not None:
        
        conn.close()
print("Programme Fini ")