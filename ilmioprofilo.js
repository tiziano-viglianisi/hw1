
function editPP(event) {
    const ppform=document.querySelector('.upload_propic');
    const editButton = event.currentTarget;
    if (ppform.classList.contains('hidden')) {
        ppform.classList.remove('hidden');
        editButton.classList.add('hidden');
        editButton.removeEventListener('click', editPP);
    }
}

function onresponse(response) {
    if (!response.ok) {
        throw new Error("Errore risposta " + response.statusText);
    }
    return response.json();
}   

function onjsonprofilepic(json) {
    const myprofile= document.querySelector("#profiliutente");
    const span= document.createElement("span");
    const profilePic = document.createElement("img");
    profilePic.src = "./uploads/" + json.profile_pic;
    profilePic.classList.add("propic");
    myprofile.appendChild(span);
    span.appendChild(profilePic);
}

fetch('getprofilepic.php').then(onresponse).then(onjsonprofilepic);

fetch('getmyprofile.php').then(onresponse).then(onjsonprofile);


function onjsonprofile(json) {
    const nome= json.nome;
    const cognome= json.cognome;
    const h2=document.querySelector(".dipartimenti_nav h2");
    const propicinterna= document.querySelector("#propicinterna");

    h2.textContent = "Benvenuto, "+ nome + " " + cognome;
    const datiutente = document.querySelectorAll(".datiutente");
    for (const dato of datiutente) {
        for (const elemento in json) {
            if (dato.id === elemento) {
                if (elemento === "cover") {
                    dato.src=json[elemento];
                    if(dato.classList.contains("hidden")) {
                        dato.classList.remove("hidden");
                    }
                    remove= document.querySelector("#removelibro");
                    if(remove.classList.contains("hidden")) {
                        remove.classList.remove("hidden");
                    }
                    remove.addEventListener("click",rimuoviLibro);
                    rimuoviDiv=document.querySelector("#rimuovilibro");
                    if (rimuoviDiv.classList.contains("hidden")) {
                        rimuoviDiv.classList.remove("hidden");
                    }
                    continue;
                }
                dato.textContent = json[elemento];
            }
        }
    }
    propicinterna.src= "./uploads/" + json.profile_pic;

}

function rimuoviLibro(event) {
    const removeButton = event.currentTarget;
    const cover = document.querySelector("#cover");
    const libroDiv = removeButton.closest("#libro");
    titolo= libroDiv.querySelector("#titolo");
    autore= libroDiv.querySelector("#autore");
    cover.src = "";
    cover.classList.add("hidden");
    removeButton.classList.add("hidden");
    
    fetch(`removefavoritelibro.php?title=${encodeURIComponent(titolo.textContent)}&author=${encodeURIComponent(autore.textContent)}`)
    autore.textContent = "";
    titolo.textContent = "";
    rimuoviDiv=libroDiv.querySelector("#rimuovilibro");
    if (rimuoviDiv) {
        rimuoviDiv.classList.add("hidden");
    }
}

const edit = document.querySelector("#edit");
if(edit) {
        edit.addEventListener("click", editPP);
}