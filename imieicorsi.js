function removefavorite(event) {
    const pref = event.currentTarget;
    const materia=pref.parentNode;
    const materie=materia.parentNode;
    const group=materie.parentNode;
    const maxigroup=group.parentNode;
    const facolta= group.querySelector("h2").textContent;
    const anno_accademico = maxigroup.querySelector("strong").textContent;

    fetch(`removefavorite.php?materia=${encodeURIComponent(materia.textContent.trim())}&facolta=${encodeURIComponent(facolta)}&anno_accademico=${encodeURIComponent(anno_accademico)}`);
    pref.removeEventListener("click", removefavorite);
    materia.remove();
    if (materie.querySelectorAll("div").length === 0) {
        group.remove();
    }
    if (maxigroup.querySelectorAll("div").length === 0) {
        maxigroup.remove();
    }

}

function showfacolta(event){
    h2=event.currentTarget;
    fac=h2.parentNode;
    corsi=fac.querySelector('.corsi');
    fold=h2.querySelector('.facolta_fold');
    h2.removeEventListener('click', showfacolta);
    h2.addEventListener('click',notshowfacolta);
    fold.src= './img/fold.png';

    if(corsi.classList.contains('hidden')){
        corsi.classList.remove('hidden');
    }
}
function notshowfacolta(event){
    h2=event.currentTarget;
    fac=h2.parentNode;
    corsi=fac.querySelector('.corsi');
    fold=h2.querySelector('.facolta_fold');
    h2.removeEventListener('click', notshowfacolta);
    h2.addEventListener('click',showfacolta);
    fold.src= './img/unfold.png';

    if(!corsi.classList.contains('hidden')){
        corsi.classList.add('hidden');
    }
}



fetch('getimieicorsi.php').then(onresponse).then(onjson);

function onresponse(response) {
    if (!response.ok) {
        throw new Error("Errore risposta " + response.statusText);
    }
    return response.json();
}

function onjson(json) {
    const container = document.querySelector('.dipartimenti_nav');
    for (const annokey in json) {
        const annoData = json[annokey];
        const facolta = annoData['facolta'];

        const facoltas = document.createElement('div');
        const p = document.createElement('p');
        const annostrong = document.createElement('strong');

        annostrong.textContent = "Anno Accademico: " + annokey;
        facoltas.classList.add('facolta');
        facoltas.classList.add(annokey);
        container.appendChild(facoltas);
        facoltas.appendChild(p);
        p.appendChild(annostrong);

        for (const facoltaId in facolta) {
            const facoltaData = facolta[facoltaId];
            const corsi = facoltaData['corsi'];
            const h2 = document.createElement('h2');
            const fold = document.createElement('img');
            fold.classList.add('facolta_fold');
            fold.src = './img/unfold.png';

            const facoltaDiv = document.createElement('div');
            const corsiDiv = document.createElement('ul');

            facoltaDiv.classList.add('facolta');
            facoltaDiv.classList.add(facoltaId);
            facoltas.appendChild(facoltaDiv);

            facoltaDiv.appendChild(h2);
            h2.textContent = facoltaData['facolta_nome'];
            h2.appendChild(fold);


            corsiDiv.classList.add('corsi');
            corsiDiv.classList.add('hidden');
            facoltaDiv.appendChild(corsiDiv);

            for (const corso of corsi) {
                const corsoDiv = document.createElement('div');
                const pref = document.createElement('img');
                const br = document.createElement('br');
                pref.classList.add('preferiti');
                pref.src = './img/bookmark.png';
                corsiDiv.appendChild(corsoDiv);
                corsoDiv.textContent= corso;
                corsoDiv.appendChild(pref);
                corsoDiv.appendChild(br);
            }
        }

    }
    favs=document.querySelectorAll('.preferiti');
    for (let fav of favs) {
        fav.addEventListener('click', removefavorite);
    }

    folds=document.querySelectorAll('.facolta_fold');
    for(fold of folds){
        h2=fold.parentNode;
        h2.addEventListener('click',showfacolta);
    }
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

fetch('getprofilepic.php').then(onresponse).then(onjsonprofile);


