import psycopg2 

hostname = 'localhost' # accepte la connexion à distance 
database ='postgres'
username='saeroot'
pwd ='root' # demander le mot de passe à Claude
port_id=5432        # demander le port à Claude
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
    with open('title_principals.tsv','r',encoding='utf-8')as f: # on ouvre le fichier 
        next(f) # on skip les lignes headers
        cur.copy_from(f,'title_principals',sep='\t')  #on le copy à la table correspondante
        
    cur.execute(open("Str_To_Array.sql", "r").read())
    cur.execute(open("Constraints.sql", "r").read())
    cur.execute(open("DeleteFrom.sql", "r").read())
    cur.execute(open("ValidateConstraints.sql", "r").read())
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