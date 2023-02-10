
//import $ from "jquery";

const byId = (id) => document.getElementById(id);
var resultreturn =[];
//base de donnée
function ajaxRequest(url) {
    
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            resultreturn.push(xhr.responseText);
        }
    };
    xhr.send();
}

function selectSql(requetes){
    const server = document.referrer.replace(window.location.pathname, "")
    resultreturn =[];
    // doit peut etre etre passer en global pour que ça fonctionne ou alors retirer la fonction de callback pour mettre une variable a la place
    for (let i = 0; i < requetes.length; i++) {
        let trueRequete ="http://www.localhost:8000/pourBDD.php?requeteSQL="+requetes.replaceAll(' ','|');
        ajaxRequest(trueRequete);
}}
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
        byId("overRecherche").push(elem);

    }
}

function recherche(){
    //recherche de la donnée
    var expression = removeAccents(byId("recherche").value).toLowerCase();
    var newExpre =["%"+expression+"%"];
    var catego = byId("category").value
    //création des approximations
    for (let i = 0; i < expression.length; i++) {
        let newTemp = expression.replace(expression[i], "%");
        if(i === 0 || i===expression.length-1){
            newTemp = expression.replace(expression[i], "");
        }
        let newChaine = "%"+newTemp+"%";

        newExpre.push(newChaine);

    }

    //création des requetes sql : 
    let requetes = [];
    for (let y = 0; y < newExpre.length; y++) {
        requetes.push("SELECT primaryTitle from VUE_FOR_RECHERCHE WHERE (primaryTitle LIKE '"+ newExpre[y] + "' OR originalTitle LIKE '"+ newExpre[y]+ "' OR primaryName LIKE '"+ newExpre[y]+"') AND category like '"+catego+"';")
    }
    //
    var resultSql = selectSql(requetes);
    document.querySelector(".underRecherche").remove();

    byId("overRecherche").append(resultSql);
    document.byId("overRecherche").querySelector("ul").classList.add("underRecherche");

}
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
    let resultSql = [[],[]];
    let affiche = document.createElement("ul");
    let requetes;
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
            requetes = "select primaryTitle from VUE_FOR_RECHERCHE where primaryName LIKE '"+v2[i]+"';"
            resultSql[i].push(selectSql(requetes))

        }
    }else{
        for(let i = 0; i < 2; i++){
            requetes = "select primaryName from VUE_FOR_RECHERCHE where primaryTitle LIKE '"+v2[i]+"' OR originalTitle LIKE '"+v2[i]+"';"
            resultSql[i].push(selectSql(requetes))
        }
    }
    //vérification de résult
    for(let i = 0; i < resultSql; i++){
        test =resultSql[0].querySelectorAll("li");
        if (test[i] in resultSql[1].querySelectorAll("li")){
            affiche.append(test[i]);
        }
    }
    if(test.length == 0){
        affiche = document.createElement("p")
        affiche.textContent = "il n'y a aucun point commun"
    }
    //affichage
    byId("resultatComparaison").append(affiche);
}

//event listener
byId("lanceRecherche").addEventListener("click",morethan5)
byId("lanceComparaison").addEventListener("click",comparaison)