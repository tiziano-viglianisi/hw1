//apre il menu a tendina quando clicco sul burger
function aprimenu(event) {
    const burger = event.currentTarget;
    const menutendina = document.querySelector("#menutendina");
    const header=document.querySelector("#header")
    const group = document.querySelector(".group").cloneNode(true);
    
    document.body.classList.add("no_scroll");
    menutendina.classList.remove("hidden");
    menutendina.innerHTML = "";
    menutendina.appendChild(group);
    burger.classList.add("hidden");
    //se non lo faccio, scomparendo il burger, home si sposta a sinistra
    header.style.justifyContent="right";
    event.stopPropagation();
    //menu a tendina si chiude se clicco fuori
    document.addEventListener("click", chiudiMenu);
}

function chiudiMenu(event){
    const menu = document.querySelector("#menutendina");
        if (!menu.contains(event.target)) {
            const burger = document.querySelector("#burger");
            const header = document.querySelector("#header")
            menutendina.classList.add("hidden");
            burger.classList.remove("hidden");
            header.style.justifyContent="space-between";
            document.body.classList.remove("no_scroll");
            event.stopPropagation();
        }
}

// Apre la barra di ricerca quando clicco sulla lente
function opensearchbar(event) {
    //search è la lente che ho cliccato
    const search = event.currentTarget
    search.removeEventListener("click", opensearchbar);
    //aggiungo un event listener per chiudere la searchbar
    search.addEventListener("click", closeSearchbar);
    //searchbar sarà la barra di ricerca vera e propria
    const searchbar = document.createElement("input");
    // searching è la barra in cui si trovano lente e searchbar
    const searching= search.parentElement;
    searchbar.id = "searchbar";
    searchbar.type = "text";
    searchbar.placeholder = "Cerca...";
    searching.appendChild(searchbar);
    //se è la barra di ricerca dei dipartimenti, va bene avere una ricerca dinamica, se è quella dei libri no perché si fanno troppe richieste
    // e quindi si fa una ricerca solo quando si preme invio
    if(searching.parentNode.id === "dipartimenti" ){
        searchbar.addEventListener("input", ricerca);
    } else if (searching.parentNode.id === "libriuniversitari") {
        searchbar.addEventListener("keydown", invio);
    }
}

function invio(event){
    if (event.key === "Enter") {
        ricerca2(event);
    }
}

function closeSearchbar(event) {
    const searchbar = document.querySelector("#searchbar");
    const search= event.currentTarget;
    if (searchbar && search) {
        searchbar.remove();
        search.addEventListener("click", opensearchbar);
        search.removeEventListener("click", closeSearchbar);
    }
}

function ricerca(event) {
    const searchbar = event.currentTarget;
    const query = searchbar.value.toLowerCase();
    const items = document.querySelectorAll(".listd1");
    for (const item of items) {
        //prendo il testo dentro ogni dipartimento e porto il text content in minuscolo per confrontarlo con la query
        const textContent = item.textContent.toLowerCase();
        // Controllo se quello che sto scrivendo si trova dentro l'abbreviazione di un dipartimento
        // oppure se si trova nel nome del dipartimento (specificato nei dataset)
        if (textContent.includes(query) || (item.dataset.facolta && item.dataset.facolta.toLowerCase().includes(query))) {
            item.classList.remove("hidden");
        } else {
            item.classList.add("hidden");
        }
    }
}

function ricerca2(event) {
    const searchbar = event.currentTarget;
    const query = searchbar.value;
    if(query=== ""){
        fetch('getlibri.php').then(onresponse).then(onjsonlibriiniziali);
    }
    else{
        fetch("https://openlibrary.org/search.json?q=" + encodeURIComponent(query)).then(onresponse).then(onjsonlibri);  
    }
   
}

function onjsonlibri(json) {
    const libribox = document.querySelector("#libri_box");
    libribox.innerHTML = "";
    if (json.docs && json.docs.length > 0) {
        let numResults= json.numFound;
        if( numResults > 10) {
            numResults = 10; // Limito a 10 risultati per evitare troppi elementi
        }
        for (let i = 0; i < numResults; i++) {
            const libro = json.docs[i];
            const libroDiv = document.createElement("div");
            const coverImage = document.createElement("img");
            const bookInfo= document.createElement("div");
            const coverId = libro.cover_i ? libro.cover_i : "no_cover";
            const bookTitle = document.createElement("div");
            bookTitle.textContent = libro.title ? libro.title : "Titolo non disponibile";
            const bookAuthor = document.createElement("div");
            bookAuthor.textContent = libro.author_name;

            bookTitle.classList.add("book_title");
            bookAuthor.classList.add("book_author");
            bookInfo.classList.add("book_info");
            coverImage.classList.add("book_cover");
            if (coverId === "no_cover") {
                coverImage.src = "./img/no_cover.png"; // Immagine predefinita
            }
            else{
                coverImage.src = `https://covers.openlibrary.org/b/id/${coverId}-M.jpg`;
            }
            libroDiv.classList.add("book", "listl1");
            libribox.appendChild(libroDiv);
            libroDiv.appendChild(coverImage);
            libroDiv.appendChild(bookInfo);
            bookInfo.appendChild(bookTitle);
            bookInfo.appendChild(bookAuthor);
            const prefIcon = document.createElement("img");
            prefIcon.classList.add("pref", "book_pref_icon");
            libroDiv.appendChild(prefIcon);
            fetch(`checklibropreferito.php?title=${encodeURIComponent(bookTitle.textContent)}&author=${encodeURIComponent(bookAuthor.textContent)}`)
                .then(onresponse)
                .then(onjsonlibropref(prefIcon));
        }
    } else {
        const noResults = document.createElement("div");
        noResults.textContent = "Nessun risultato trovato.";
        noResults.classList.add("listl1");
        libribox.appendChild(noResults);
    }
}

function onjsonlibropref(prefIcon) {
    return function(json) {
        onjsonchecklibropref(json, prefIcon);  
    }
}

function onjsonchecklibropref(json, prefIcon) {
    if (json.success === "true" && json.favorite === "true") {
        prefIcon.src = "img/pref2.png";
        prefIcon.addEventListener("click", removefavoriteLibro);
    } else if (json.success === "true" && json.favorite === "false") {
        prefIcon.src = "img/pref.png";
        prefIcon.addEventListener("click", addfavoriteLibro);
    } else {
    prefIcon.classList.add("hidden");
    }
}

function addfavoriteLibro(event) {
    const prefIcon = event.currentTarget;
    prefIcon.removeEventListener("click", addfavoriteLibro);
    const libroDiv = prefIcon.closest('.book');
    fetch(`addfavoritelibro.php?title=${encodeURIComponent(libroDiv.querySelector(".book_title").textContent)}&author=${encodeURIComponent(libroDiv.querySelector(".book_author").textContent)}&cover=${encodeURIComponent(libroDiv.querySelector(".book_cover").src)}`)
        .then(onresponse)
        .then(onjsonaggiuntalibroprefpass(prefIcon));
}

function onjsonaggiuntalibroprefpass(prefIcon) {
    return function(json) {
        onjsonaggiuntaibropref(json, prefIcon);
    }
}

function onjsonaggiuntaibropref(json, prefIcon) {
    if (json.success === "true") {
        prefIcon.src = "img/pref2.png";
        prefIcon.addEventListener("click", removefavoriteLibro);
    }
    if (json.success === "false") {
        erroreDiv= document.createElement("div");
        erroreDiv.textContent = "Hai già un libro preferito";
        erroreDiv.classList.add("erroreaggiuntalibri");
        content= document.querySelector("#content_with_menu");
        content.appendChild(erroreDiv);
        setTimeout(timeout, 5000);
        prefIcon.addEventListener("click", addfavoriteLibro);
    }
}

function timeout() {
    const erroreDiv = document.querySelector(".erroreaggiuntalibri");
    erroreDiv.remove();
}

function removefavoriteLibro(event) {
    const prefIcon = event.currentTarget;
    const libroDiv = prefIcon.closest('.book');
    fetch(`removefavoritelibro.php?title=${encodeURIComponent(libroDiv.querySelector(".book_title").textContent)}&author=${encodeURIComponent(libroDiv.querySelector(".book_author").textContent)}`);
    prefIcon.removeEventListener("click", removefavoriteLibro);
    prefIcon.src = "img/pref.png";
    prefIcon.addEventListener("click", addfavoriteLibro);
}

function browsedipartimenti(event) {
    const dipartimenti = document.querySelector("#dipartimenti");
    const sceltamininav= document.querySelector("#sceltamininav");
    const dipartimentibox= document.querySelector("#dipartimenti_box");
    const back=document.createElement("img");
    const welcome= document.querySelector("#welcome");
  

    back.src="img/back.png";
    back.classList.add("backbutton");
    // nascondo il minimenu con la sceltra tra browse libri e dipartimenti
    sceltamininav.classList.add("hidden");
    welcome.classList.add("hidden");
    if(dipartimenti && dipartimenti.classList.contains("hidden")){
        dipartimenti.classList.remove("hidden");
    }
    if(dipartimentibox && dipartimentibox.classList.contains("hidden")){
        dipartimentibox.classList.remove("hidden");
    }
    fetch(`givedip.php?`).then(onresponse).then(onjsondipartimenti);
    event.stopPropagation();
    dipartimenti.prepend(back);
    back.addEventListener("click", gobackdipartimenti);
}

function onjsondipartimenti(json) {
    const dipartimentibox = document.querySelector("#dipartimenti_box");  
    dipartimentibox.innerHTML = "";
    for (const dipartimento of json) {
        const dipartimentoDiv = document.createElement("div");
        dipartimentoDiv.classList.add("listd1");
        dipartimentoDiv.textContent = dipartimento.abbreviazione;
        const imgdip = document.createElement("img");
        imgdip.src = "./img/" + dipartimento.abbreviazione + ".png";
        dipartimentoDiv.dataset.facolta = dipartimento.nome;
        dipartimentibox.appendChild(dipartimentoDiv);
        dipartimentoDiv.addEventListener("click", browsefacolta);
        dipartimentoDiv.style.cursor = "pointer";
        const br = document.createElement("br");
        dipartimentoDiv.prepend(br);
        dipartimentoDiv.prepend(imgdip);
    }
}

function gobackdipartimenti(event){
    const dipartimenti = document.querySelector("#dipartimenti");
    const sceltamininav= document.querySelector("#sceltamininav");
    const dipartimentibox= document.querySelector("#dipartimenti_box");
    const welcome= document.querySelector("#welcome");

    dipartimenti.classList.add("hidden");

    dipartimentibox.classList.add("hidden");
    while (dipartimentibox.firstChild) {
        dipartimentibox.removeChild(dipartimentibox.firstChild);
    }
    if(sceltamininav && sceltamininav.classList.contains("hidden")){
        sceltamininav.classList.remove("hidden");
    }
    if(welcome && welcome.classList.contains("hidden")){
        welcome.classList.remove("hidden");
    }
    event.currentTarget.remove();
}


function onresponse(response) {
    if (response.ok) {
        return response.json();
    } else {
        throw new Error("PROBLEMA");
    }
}

function browselibri(event) {
    const libriuniversitari = document.querySelector("#libriuniversitari");
    const sceltamininav= document.querySelector("#sceltamininav");
    const libribox= document.querySelector("#libri_box");
    const back=document.createElement("img");
    const items = document.querySelectorAll(".listl1");
    const welcome= document.querySelector("#welcome");
    welcome.classList.add("hidden");

    // potrebbero esserci elementi nascosti da una precedente ricerca
    for (const item of items) {
        item.classList.remove("hidden");
    }
    back.classList.add("backbutton")
    back.src="img/back.png";

    sceltamininav.classList.add("hidden");
    if(libriuniversitari && libriuniversitari.classList.contains("hidden")){
        libriuniversitari.classList.remove("hidden");
    }
    if(libribox && libribox.classList.contains("hidden")){
        libribox.classList.remove("hidden");
    }
    event.stopPropagation();
    libriuniversitari.prepend(back);
    back.addEventListener("click", gobacklibri);
}

function gobacklibri(event){
    const libriuniversitari = document.querySelector("#libriuniversitari");
    const sceltamininav= document.querySelector("#sceltamininav");
    const libribox= document.querySelector("#libri_box");
    const welcome= document.querySelector("#welcome");

    libriuniversitari.classList.add("hidden");
    libribox.classList.add("hidden");

    if(sceltamininav && sceltamininav.classList.contains("hidden")){
        sceltamininav.classList.remove("hidden");
    }

    if(welcome && welcome.classList.contains("hidden")){
        welcome.classList.remove("hidden");
    }
    event.currentTarget.remove();
}

function browsefacolta(event) {
    const box = event.currentTarget;
    const sbar = document.querySelector(".searching");
    const bar= document.querySelector("#dipartimentinav");
    const content=document.querySelector("#content_with_menu");
    const back=document.querySelector(".backbutton");
    const memo=document.createElement("p");
    const html=document.querySelector("html");
    memo.classList.add("hidden");

    //faccio si che in alto sia scritto il nome del dipartimento
    bar.textContent=event.currentTarget.textContent;
    //aggiungo un memo per ricordare il dipartimento
    memo.textContent=bar.textContent;
    memo.id="memo";
    html.appendChild(memo);
    //nascondo tutto il flexbox dei dipartimnenti
    box.parentElement.classList.add("hidden");
    sbar.classList.add("hidden");
    const flexContainer = document.createElement("div");
    flexContainer.id = "flexContainerFacolta";
    flexContainer.classList.add("flexcontainer");
    content.appendChild(flexContainer);
    const dipartimento = box.textContent;
    fetch(`facfromdip.php?dipartimento=${encodeURIComponent(dipartimento)}`)
        .then(onresponse)
        .then(onjsonfacolta);
    back.removeEventListener("click", gobackdipartimenti);
    back.addEventListener("click", gobackfacolta);
}

function gobackfacolta (event) {
    const back=event.currentTarget;
    const flexContainer = document.querySelector("#flexContainerFacolta");
    const dipartimentiBox = document.querySelector("#dipartimenti_box");
    const sbar = document.querySelector(".searching");
    const bar=document.querySelector("#dipartimentinav");

    flexContainer.remove();
    dipartimentiBox.classList.remove("hidden");
    sbar.classList.remove("hidden");
    bar.textContent = "Dipartimenti";
    back.removeEventListener("click", gobackfacolta);
    back.addEventListener("click", gobackdipartimenti);
    //rimuovo il memo che avevo creato per ricordare il dipartimento
    // se esiste
    if(memo= document.querySelector("#memo")) {
        memo.remove();
    }
}

function onjsonfacolta(json) {
    const flexContainer = document.querySelector("#flexContainerFacolta");
    flexContainer.innerHTML = "";
    for (const facolta of json) {
        const facoltaDiv = document.createElement("div");
        facoltaDiv.classList.add("facoltadivstyle");
        facoltaDiv.textContent = facolta.codice_facolta + " - " + facolta.nomefacolta;
        facoltaDiv.dataset.id= facolta.id;
        flexContainer.appendChild(facoltaDiv);
        facoltaDiv.addEventListener("click", browsematerie);
        facoltaDiv.style.cursor = "pointer";
    }
}

function browsematerie(event){
    const box = event.currentTarget;
    const facoltabox= box.parentElement;
    const bar= document.querySelector("#dipartimentinav");
    const content=document.querySelector("#content_with_menu");
    const back=document.querySelector(".backbutton");
    bar.textContent=event.currentTarget.textContent;
    
    //svuoto le facoltà e l'evento associato al back
    facoltabox.remove();
    back.removeEventListener("click", gobackfacolta);

    const flexContainerMaterie = document.createElement("div");
    flexContainerMaterie.id = "flexContainerMaterie";
    flexContainerMaterie.classList.add("flexcontainer");
    content.appendChild(flexContainerMaterie);
    const facolta = box.dataset.id;
    fetch(`subfromfac.php?facolta=${encodeURIComponent(facolta)}`)
        .then(onresponse)
        .then(onjsonmaterie);
    back.removeEventListener("click", gobackdipartimenti);
    back.addEventListener("click", gobackmaterie);
}

function gobackmaterie(event){
    const back=event.currentTarget;
    const flexContainerMaterie = document.querySelector("#flexContainerMaterie");
    //cerco memo per il dipartimento
    const memo= document.querySelector("#memo");
    const dipartimenti=document.querySelectorAll("#dipartimenti_box .listd1");

    flexContainerMaterie.remove();
    if (gobackmaterie && back.removeEventListener) {
        back.removeEventListener("click", gobackmaterie);
    }
    //trovo il dipartimento di appartenenza
    for (const dipartimento of dipartimenti) {
        if(dipartimento.textContent === memo.textContent) {
            //rimuovo il memo (che verrà riaggiunto)
            memo.remove();
            //simulo il click sul dipartimento così da tornare indietro alle facoltà
            dipartimento.click();
            break;
        }
    }
};

function onjsonmaterie(json) {
    const flexContainer = document.querySelector("#flexContainerMaterie");
    const facolta= document.querySelector("#dipartimentinav").textContent;
    let i = 0;
    flexContainer.innerHTML = "";
    for (const materia of json) {
        const materiaSpan = document.createElement("span");
        materiaSpan.dataset.index = i;
        materiaSpan.classList.add("facoltadivstyle");
        const nomemateria= materia.nomemateria;
        materiaSpan.textContent = nomemateria;
        const pref = document.createElement("img");
        pref.classList.add("pref");
        materiaSpan.appendChild(pref);
        flexContainer.appendChild(materiaSpan);
        fetch(`checkfavorite.php?materia=${encodeURIComponent(nomemateria)}&facolta=${encodeURIComponent(facolta)}`)
            .then(onresponse)
            .then(onjsoncheckWithPref(pref));
        i = i + 1;
    }
}

function onjsoncheckWithPref(pref) {
    return function(json) {
        onjsoncheck(json, pref);
    }
}


function onjsoncheck(json, pref) {
    if (json.success === "true" && json.favorite === "true") {
        pref.src = "img/pref2.png";
        pref.addEventListener("click", removefavorite);
    } else if (json.success === "true" && json.favorite === "false") {
        pref.src = "img/pref.png";
        pref.addEventListener("click", addfavorite);
    } else {
        pref.classList.add("hidden");
    }
}

function addfavorite(event) {
    const pref = event.currentTarget;
    const materiaSpan = pref.closest('.facoltadivstyle');
    const facolta = document.querySelector("#dipartimentinav").textContent;
    const materia = materiaSpan.textContent;
    
    fetch(`addfavorite.php?materia=${encodeURIComponent(materia)}&facolta=${encodeURIComponent(facolta)}`);
    pref.removeEventListener("click", addfavorite);
    pref.src = "img/pref2.png";
    pref.addEventListener("click", removefavorite);
}

function removefavorite(event) {
    const pref = event.currentTarget;
    const materiaSpan = pref.closest('.facoltadivstyle');
    const facolta = document.querySelector("#dipartimentinav").textContent;
    const materia = materiaSpan.textContent;

    fetch(`removefavorite.php?materia=${encodeURIComponent(materia)}&facolta=${encodeURIComponent(facolta)}`);
    pref.removeEventListener("click", removefavorite);
    pref.src = "img/pref.png";
    pref.addEventListener("click", addfavorite);
}

function onjsonprofile(json) {
    const myprofile= document.querySelector("#profiliutente");
    const span= document.createElement("span");
    const profilePic = document.createElement("img");
    profilePic.src = "./uploads/" + json.profile_pic;
    profilePic.classList.add("propic");
    myprofile.appendChild(span);
    span.appendChild(profilePic);
}

function onjsonlibriiniziali(json){
    const librobox=document.querySelector("#libri_box");
    let num_res=json.work_count;
    if (num_res > 10) {
        num_res = 10;
    }
    librobox.innerHTML = ""; // Svuoto il contenitore dei libri
    for (let i = 0; i < num_res; i++) {
        const libro = json.works[i];
        const libroDiv = document.createElement("div");
        const libroInfo= document.createElement("div");
        const libroAuthor = document.createElement("p");
        const libroTitle = document.createElement("h3");
        const libroCover = document.createElement("img");

        libroDiv.classList.add("book");
        libroDiv.classList.add("listl1");
        libroAuthor.classList.add("book_author");
        libroTitle.classList.add("book_title");
        libroInfo.classList.add("book_info");
        libroAuthor.textContent = libro.authors[0].name;
        libroTitle.textContent = libro.title;
        libroCover.classList.add("book_cover");

        libroCover.src = "https://covers.openlibrary.org/b/id/" + libro.cover_id + "-L.jpg";
        librobox.appendChild(libroDiv);
        libroDiv.appendChild(libroCover);
        libroDiv.appendChild(libroInfo);        
        libroInfo.appendChild(libroTitle);
        libroInfo.appendChild(libroAuthor);


        const prefIcon = document.createElement("img");
        prefIcon.classList.add("pref", "book_pref_icon");
        libroDiv.appendChild(prefIcon);
        fetch(`checklibropreferito.php?title=${encodeURIComponent(libroTitle.textContent)}&author=${encodeURIComponent(libroAuthor.textContent)}`)
            .then(onresponse)
            .then(onjsonlibropref(prefIcon));
    }
}

// Aggiungo un event listener che apre il menu a tendina
const burger = document.querySelector('#burger');
burger.addEventListener('click', aprimenu);

// aggiunge un event listener al click su qualsiasi "lente"
const searchall = document.querySelectorAll('.search');
for (const search of searchall) {
    search.addEventListener('click', opensearchbar);
}

//event listener che quando clicco sulla bussola apre i dipartimenti
const browsedip = document.querySelector("#browse");
browsedip.addEventListener("click", browsedipartimenti);

//event listener che quando clicco su libro apre i libri universitari
const libribrowse=document.querySelector("#libri");
libribrowse.addEventListener("click", browselibri);

//event listener che apre i dipartimenti e fa vedere le facoltà
const boxes=document.querySelectorAll(".listd1");
for(const box of boxes){
    box.addEventListener("click", browsefacolta);
    box.style.cursor="pointer";
}

if (document.querySelector("#profiliutente")) {
    fetch('getprofilepic.php').then(onresponse).then(onjsonprofile);
}

fetch('getlibri.php').then(onresponse).then(onjsonlibriiniziali);
