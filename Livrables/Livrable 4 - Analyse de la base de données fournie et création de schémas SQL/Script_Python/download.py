import requests
import wget
import gzip
import shutil
from bs4 import BeautifulSoup

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
