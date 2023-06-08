//import $ from "jquery";

const byId = (id) => document.getElementById(id);
var resultreturn =[];
var nbrRequete;
//base de donnée
function ajaxRequest(url) {
    
    const xhr = new XMLHttpRequest();
    // open the connection with cors
    xhr.open('GET', url, true);
    xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
    xhr.setRequestHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
    xhr.setRequestHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
    xhr.setRequestHeader('Access-Control-Allow-Credentials', true);
    // onreadystatechange
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            resultreturn.push(xhr.responseText);
        }
    };
    xhr.send();
}

function selectSql(chaine){
    const server = document.referrer.replace(window.location.pathname, "")
    resultreturn =[];
    let trueRequete ="http://localhost:8000/pourBDD.php?"+chaine;
        
    ajaxRequest(trueRequete);
}
//utile
const removeAccents = (s)=>{
    let r=s.toLowerCase();
    r = r.replace(new RegExp(/\s/g),"");
    r = r.replace(new RegExp(/[àáâãäå]/g),"%");
    r = r.replace(new RegExp(/æ/g),"ae");
    r = r.replace(new RegExp(/ç/g),"%");
    r = r.replace(new RegExp(/[èéêë]/g),"%");
    r = r.replace(new RegExp(/[ìíîï]/g),"%");
    r = r.replace(new RegExp(/ñ/g),"%");                
    r = r.replace(new RegExp(/[òóôõö]/g),"%");
    r = r.replace(new RegExp(/œ/g),"oe");
    r = r.replace(new RegExp(/[ùúûü]/g),"%");
    r = r.replace(new RegExp(/[ýÿ]/g),"%");
    r = r.replace(new RegExp(/\W/g),"");
    return r;
};

//algo 1
//fait en sorte de ne pas lancer la recherche tant que l'utilisateur n'a pas tapé au moins 5 caractères
const morethan5 =() =>{
    let temp = byId("recherche").value
    if (temp.length >= 5){recherche()}
    else{
        byId("underRecherche").remove()
        let elem =document.createElement("p");
        elem.classList.add("underRecherche");
        elem.textContent = "tappez au moins 5 caractères"
        byId("overRecherche").append(elem);

    }
}

function recherche(){
    //variable
    var expression = removeAccents(byId("recherche").value).toLowerCase();
    var catego = byId("category").value;
    let chaine;
    //met en place une nouvelle liste
    byId("underRecherche").remove();
    let newTab =document.createElement("ul");
    newTab.id="underRecherche";
    byId("overRecherche").append(newTab);
    //fait la requete au back et alimente la liste
    chaine = "inputUser="+expression+"&category="+catego+"&typeRequeteSQL=1";
    var resultSql = selectSql(chaine);
    try{
    resultSql.querySelectorAll("li").forEach(e => {
        byId("underRecherche").append(e)
    });
        
    }catch(e){
        console.log(e)
    };
}


//v1

    //recherche de la donnée
    





/*
//affichage des résultats
function actuTab(resultSql){
    
    let newTab =document.createElement("ul");
    newTab.classList.add("underRecherche");
    
    for (let i = 0; i < resultSql.length; i++) {
        let newLi =document.createElement("li");
        newLi.textContent = resultSql[i];
        document.querySelector(".underRecherche").append(newLi);
    }
}
*/
//gère les caractères spéciaux


//algo 2
function comparaison(){
    var compa = document.querySelectorAll(".comparaison");

    //
    let resultSql = [[],[]];
    let affiche = document.createElement("ul");
    let temp = [];
    let v2 =[];
    let test = [];
    for(let i = 0; i < 2; i++){
        temp.push(compa[i].value)  
        v2.push(removeAccents(temp[i].toLowerCase()))
    
    }
    //cheque si ce sont des acteurs ou des films et crée la requete
    if (document.querySelectorAll(".comparaison")[0].name === "acteur"){
        for(let i = 0; i < 2; i++){
            let chaine = "inputUser="+v2[i]+"&typeRequeteSQL=2";
            resultSql[i].push(selectSql(chaine))

        }
    }else{
        for(let i = 0; i < 2; i++){
            let chaine = "inputUser="+v2[i]+"&typeRequeteSQL=3";
            resultSql[i].push(selectSql(chaine))
        }
    }
    //vérification de résult
    for(let i = 0; i < resultSql; i++){
        test =resultSql[0].querySelectorAll("li");
        if (test[i] in resultSql[1].querySelectorAll("li")){
            try{
            affiche.append(test[i]);
            }catch(e){
                console.log(e)
        };}
    }
    if(test.length == 0){
        affiche = document.createElement("p")
        affiche.textContent = "il n'y a aucun point commun"
    }
    //affichage
    try{
    byId("resultatComparaison").append(affiche);
    }catch(e){console.log(e)}
}

//event listener
byId("lanceRecherche").addEventListener("click",morethan5)
byId("lanceComparaison").addEventListener("click",comparaison)