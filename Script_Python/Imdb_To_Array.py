import pandas as pd
# PENSEZ à avoir les bons chemins (le github n'a pas les bons chemins(et c fait exprès)) !
# Attention avec la fonction title_akas_or_crew()

def name_basics():

    df = pd.read_csv('name_basics.tsv', sep="\t",encoding="utf-8",low_memory=False)
    i=0 # la colonne primaryProfession pense être de type float on la force à être de type str pour pouvoir utiliser le replace
    df["primaryProfession"]= df["primaryProfession"].astype(str) 
    while i < len(df['primaryProfession']): 
        df.loc[i,'primaryProfession']=df.loc[i,'primaryProfession'].replace(df['primaryProfession'][i],'{'+df['primaryProfession'][i]+'}')
        df.loc[i,'knownForTitles']=df.loc[i,'knownForTitles'].replace(df['knownForTitles'][i],'{'+df['knownForTitles'][i]+'}')
        i+=1
    df.to_csv('data_name_basics.tsv',encoding="utf-8", index=False) # écrit/crée sur le fichier data_name_basics.tsv
    print("Fin du programme")


def title_basics():

    df = pd.read_csv('title_basics.tsv', sep="\t",encoding="utf-8", low_memory=False)

    i=0
    df["genres"] = df["genres"].astype(str)
    df["isAdult"] = df["isAdult"].astype(bool) # certaines données sont manquantes/décalés et cela fausse le type 

    for valeur in df['genres']:
        df.loc[i,'genres']=df.loc[i,'genres'].replace(valeur,'{'+valeur+'}')

        i=i+1 # on utilise i pour donnée lindex à df.loc[]
        
    df.to_csv('data_title_basics.tsv',encoding="utf-8", index=False) 

    print('Fin du programme')


def title_akas_or_crew(fileName,colo1,colo2): # ne pas se tromper sur le nom du fichier et sur les colonnes de type array

    if '.tsv' not in fileName:
        fileName = fileName+'.tsv'
    df = pd.read_csv(fileName, sep="\t", encoding="utf-8", low_memory=False)
    i=0
    while i < len(df[colo1]):
        df.loc[i,colo1]=df.loc[i,colo1].replace(df[colo1][i],'{'+df[colo1][i]+'}')
        df.loc[i,colo2]=df.loc[i,colo2].replace(df[colo2][i],'{'+df[colo2][i]+'}')
        i+=1
    df.to_csv('data_'+fileName,encoding="utf-8", index=False) 
    print("Fin du programme")




# vous pouvez mettre le .tsv à la fin des noms des fichiers si vous voulez
name_basics()
title_basics()
title_akas_or_crew('title_akas','types','attributes')   # correspond aux données de la table title_akas
title_akas_or_crew('title_crew','directors','writers')  # correspond aux données de la table title_crew

print('Script de conversion terminé Bravo !')           # je pense que y'en a pour en tout 5-8h facile