import requests
<<<<<<< HEAD
from bs4 import BeautifulSoup

link = "https://datasets.imdbws.com"
soup = BeautifulSoup(requests.get(link).content, "html.parser")


for link in soup.findAll('ul'):
	href = link.find('a').get('href')
	name = link.text
	print(name, href)

# print(href)

# start = html.find("</a>")
# count = html.count('href=', start)

# def find_link(html, start) :
# 	i = html.find("href=", start)
# 	i+=5
# 	dllink = ""
# 	while html[i] != '>' :
# 		dllink += html[i]
# 		i+=1
# 	return dllink

# def get_name(dllink, gz) :
# 	i = 28
# 	name = ""
# 	if gz == 1 :
# 		while i<len(dllink):
# 			name += dllink[i]
# 			i+=1
# 	else :
# 		while i<len(dllink)-3:
# 			name += dllink[i]
# 			i+=1
# 	return name

# y=0
# while y<count :
# 	dllink = find_link(html, start)
# 	namegz = get_name(dllink, 1)
# 	namenogz = get_name(dllink, 0)
# 	response = wget.download(dllink, "./download/"+namegz)

# 	with gzip.open("./download/"+namegz, 'rb') as f_in:
# 		with open("./download/"+namenogz, 'wb') as f_out:
# 		    shutil.copyfileobj(f_in, f_out)

# 	start += 28
# 	y+=1
=======
import wget 
import gzip
import shutil

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
>>>>>>> bc87aa42d87548795454640612244297651e53e6
