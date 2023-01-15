import requests
import wget 
import gzip
import shutil
import pandas as pd # règle le pb de data missing for column
import subprocess
import os

link = input("Quelle est le lien pour télécharger les fichier ?\n")
html = requests.get(link).text

start = html.find("</a>")
count = html.count('href=', start)

def find_link(html, start) :
	i = html.find("href=", start)
	i+=5
	dllink = ""
	while html[i] != '>' :
		dllink += html[i]
		i+=1
	return dllink

def get_name(dllink, gz) :
	i = 28
	name = ""
	if gz == 1 :
		while i<len(dllink):
			name += dllink[i]
			i+=1
	else :
		while i<len(dllink)-3:
			name += dllink[i]
			i+=1
	return name

y=0
while y<count :
	dllink = find_link(html, start)
	namegz = get_name(dllink, 1)
	namenogz = get_name(dllink, 0)
	response = wget.download(dllink, "./download/"+namegz)

	with gzip.open("./download/"+namegz, 'rb') as f_in:
		with open("./download/"+namenogz, 'wb') as f_out:
		    shutil.copyfileobj(f_in, f_out)

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


