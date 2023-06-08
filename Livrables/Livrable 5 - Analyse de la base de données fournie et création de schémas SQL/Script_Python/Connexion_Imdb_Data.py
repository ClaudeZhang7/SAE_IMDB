import psycopg2 

hostname = '' # accepte la connexion à distance 
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
    create_script = ''' SELECT * from title_ratings
                        FETCH FIRST 10 ROWS ONLY; '''
    cur.execute(create_script)
    print(cur.fetchall())
# Si vous faites des modifs create/insert/alter... décommenter la ligne en desous
# conn.commit()


    
except Exception as error:
    print(error) # si vous avez un saut de ligne et ensuite Programme Fini 
                 # c'est que vous avez pas réussi à vous connecter à la base de donnée 
    
finally:
    if cur is not None:
        
        cur.close()
    if conn is not None:
        
        conn.close()
print("Programme Fini ")