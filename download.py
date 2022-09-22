import requests

link = input("Quelle est le lien pour télécharger les fichier ?\n")
html = requests.get(link).text

start = html.find("</a>")

count = html.count('href=', start)

print(count)

first = html.find("href=")
