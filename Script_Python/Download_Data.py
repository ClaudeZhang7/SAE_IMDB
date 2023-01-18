import subprocess
import requests
import wget
import gzip
import shutil
<<<<<<< HEAD
from bs4 import BeautifulSoup
import pandas as pd
=======
import pandas as pd # règle le pb de data missing for column
import subprocess
>>>>>>> 94f8a1127604350efa5ff819481f94998caf979d
import os

link = "https://datasets.imdbws.com"
soup = BeautifulSoup(requests.get(link).content, "html.parser")

for link in soup.findAll('ul'):
    href = link.find('a').get('href')
    name = link.text
    response = wget.download(href, "./download/"+name)

    namenogz = name[:-3]

    with gzip.open("./download/"+name, 'rb') as f_in:
        with open("./download/"+namenogz, 'wb') as f_out:
            shutil.copyfileobj(f_in, f_out)


df = pd.read_csv('./download/title.basics.tsv', delimiter='\t')
df = df.dropna(subset=['genres'])
df.to_csv('./download/title.basics.tsv', sep='\t', index=False) # chemin à mettre poto 

<<<<<<< HEAD
df = pd.read_csv('./download/title.akas.tsv', delimiter='\t')
df = df.dropna(subset=['title'])
df.to_csv('./download/title.akas.tsv', sep='\t', index=False) # chemin à mettre poto 

# on donne toutes les permissions aux != fichiers
permissions = os.stat("./download/title.basics.tsv").st_mode
print(permissions)
os.chmod("./download/title.basics.tsv", 0o777)
permissions = os.stat("./download/title.basics.tsv").st_mode
print(permissions)

permissions = os.stat("./download/title.basics.tsv").st_mode

os.chmod("./download/title.crew.tsv", 0o777)
os.chmod("./download/title.akas.tsv", 0o777)
os.chmod("./download/title.episode.tsv", 0o777)
os.chmod("./download/title.principals.tsv", 0o777)
os.chmod("./download/title.ratings.tsv", 0o777)
os.chmod("./download/name.basics.tsv", 0o777)

# execute le fichier python
# subprocess.run(["python", "Execute_Sql_Scripts.py"])
=======
	start += 28
	y+=1

df = pd.read_csv('title.basics.tsv', delimiter='\t')
df = df.dropna(subset=['genres'])
df.to_csv('title.basics.tsv', sep='\t', index=False) # chemin à mettre poto 

# on donne toutes les permissions aux != fichiers
permissions = os.stat("title.basics.tsv").st_mode
print(permissions)
os.chmod("title.basics.tsv", 0o777)
permissions = os.stat("title.basics.tsv").st_mode
print(permissions)

permissions = os.stat("title.basics.tsv").st_mode

os.chmod("title.akas.tsv", 0o777)
os.chmod("title.crew.tsv", 0o777)
os.chmod("title.episode.tsv", 0o777)
os.chmod("title.principals.tsv", 0o777)
os.chmod("title.ratings.tsv", 0o777)
os.chmod("name.basics.tsv", 0o777)

# execute le fichier python
subprocess.run(["python", "Execute_Sql_Scripts.py"])


>>>>>>> 94f8a1127604350efa5ff819481f94998caf979d
