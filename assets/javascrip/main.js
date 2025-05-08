// Masquer le loader quand la page est chargée
window.addEventListener('load', function () {
    const loader = document.getElementById('loader');
    loader.classList.add('hide-loader');

    // Supprimer totalement après la transition
    setTimeout(() => {
      loader.style.display = 'none';
    }, 600);
});


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function toggleDropdown() {
    document.getElementById("dropdown").classList.toggle("show");
}

// Fermer la dropdown si on clique ailleurs
window.onclick = function(e) {
    if (!e.target.matches('.dropdown-button')) {
        const dropdowns = document.getElementsByClassName("dropdown");
        for (let i = 0; i < dropdowns.length; i++) {
        let openDropdown = dropdowns[i];
        openDropdown.classList.remove('show');
        }
    }

}

// apparition au scroll

    const articles = document.querySelectorAll('.article');

    const observer = new IntersectionObserver((entries) => {
        let delay = 0;

        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
            const element = entry.target;
            setTimeout(() => {
                element.classList.add('visible');
            }, delay);
            delay += 550; // décalage de 200ms entre chaque élément
            observer.unobserve(element);
            }
        });
    }, {
      threshold: 0.1
    });

    articles.forEach(article => {
        observer.observe(article);
    });



    
//  CALENDRIER 


    

const today = new Date();
let currentIndex = 0;
const moisLimite = 12;
const moisEtAnnees = [];

for (let i = 0; i <= moisLimite; i++) {
    const date = new Date(today.getFullYear(), today.getMonth() + i, 1);
    moisEtAnnees.push({ mois: date.getMonth() + 1, annee: date.getFullYear() });
}

const moisNoms = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

function genererCalendrier(index) {
    const { mois, annee } = moisEtAnnees[index];
    const calendrier = document.getElementById('calendrier');
    const titre = document.getElementById('titreMois');
    const date = new Date(annee, mois - 1, 1);
    const premierJour = date.getDay() === 0 ? 6 : date.getDay() - 1;
    const dernierJour = new Date(annee, mois, 0).getDate();

    titre.textContent = ` ${moisNoms[mois - 1]} ${annee}`;

    let table = '<table><tr>';

    for (let i = 0; i < premierJour; i++) {
        table += '<td class="empty"></td>';
    }

    for (let jour = 1; jour <= dernierJour; jour++) {
        const jourActuel = (premierJour + jour - 1) % 7;
        const dateValue = `${annee}-${String(mois).padStart(2, '0')}-${String(jour).padStart(2, '0')}`;
        table += `<td onclick="selectionnerJour('${dateValue}')">${jour}</td>`;
        if (jourActuel === 6 && jour !== dernierJour) table += '</tr><tr>';
    }

    const fin = (premierJour + dernierJour) % 7;
    if (fin !== 0) {
        for (let i = fin; i < 7; i++) {
        table += '<td class="empty"></td>';
        }
    }

    table += '</tr></table>';
    calendrier.innerHTML = table;

    document.getElementById('prevBtn').disabled = index === 0;
    document.getElementById('nextBtn').disabled = index === moisLimite;
}

function selectionnerJour(dateStr) {
    document.getElementById('dateChoisie').value = dateStr;
}

document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        genererCalendrier(currentIndex);
    }
});

document.getElementById('nextBtn').addEventListener('click', () => {
    if (currentIndex < moisLimite) {
        currentIndex++;
        genererCalendrier(currentIndex);
    }
});

genererCalendrier(currentIndex);



// GESTION DE L'ADMMINSTRATEUR 

// Affiche un message dans la div "message"
function showMessage(message) {
    const messageBox = document.getElementById("message");
    messageBox.classList.replace('hide', 'PopUpContainer');
    messageBox.innerHTML = message;
}

function PopUp_hide() {
    const messageBox = document.getElementById("message");
    messageBox.classList.replace('PopUpContainer', 'hide');
}

function afficheSpinner(show) {
    const spin = document.getElementById('spin');
    const wrd = document.getElementById('wrd');

    if (spin && wrd) {
        if (show) {
            spin.classList.replace('hide', 'show');
            wrd.classList.replace('show', 'hide');
        } else {
            spin.classList.replace('show', 'hide');
            wrd.classList.replace('hide', 'show');
        }
    }
}
//lire les rende-vous


function getRdv(){

    fetch('http://localhost/amazone-optique/config/API/API_RdvControl.php?action=Get_All_Rdv')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Sélectionner le tbody par son ID
            const tbody = document.getElementById('data_rdv');
            if (tbody) {
                // Insérer le contenu HTML brut dans le tbody
                tbody.innerHTML = data.data;
            } else {
                console.error("Élément avec l'ID 'data_rdv' introuvable.");
            }
        } else {
            console.error('Erreur lors du chargement des rendez-vous :', data.message);
        }
    })
    .catch(error => {
        console.error('Erreur AJAX :', error);
    });

}
getRdv();

// prendre un rendez-vous

document.getElementById('programForm').addEventListener('submit', function(e){

    e.preventDefault();

    const date = document.getElementById('dateChoisie').value.trim();
    const heure = document.getElementById('horaire').value.trim();
    const nom = document.getElementById('nom').value.trim();
    const prenom = document.getElementById('prenom').value.trim();
    const telephone = document.getElementById('telephone').value.trim();
    const email = document.getElementById('email').value.trim();
    const raison = document.getElementById('raison').value.trim();

    const wrd = document.getElementById('wrd');
    const spin = document.getElementById('spin');

    // console.log({ nom, prenom, email, telephone, raison, date, heure });

    afficheSpinner(true);

    fetch('http://localhost/amazone-optique/config/API/API_RdvControl.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ date, heure, nom, prenom, telephone, email, raison, action: 'Take_Rdv' })
    })
    .then(response => {
        if (!response.ok) {
          throw new Error('Erreur serveur');
        }
        return response.text();
      })
      .then(text => {
        console.log("Réponse brute:", text);
        const cleanedText = text.trim();
        const data = JSON.parse(cleanedText);

        showMessage(data.message);

        if (data.success) {
            document.getElementById('programForm').reset();
            afficheSpinner(false);
        }

    })
    .catch(error => {
        console.error("Erreur AJAX:", error);
        showMessage(`
          <div class="PopUp">
            <i class="log-icon bi bi-exclamation-circle-fill"> Erreur serveur</i>
            <div class="p-3">
              <div class="">Nous rencontrons une erreur lors de la connexion au serveur.</div>
              <div class="">Merci de patienter pendant que nous réglons ce problème.</div>
            </div>
            <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
          </div>
        `, false);
    });
    

});


function login() {
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      e.preventDefault();
  
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const messageBox = document.getElementById('message');
  
    //   console.log('Données envoyées:', { email, password });
  
      fetch('http://localhost/amazone-optique/assets/php_class/UserController.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password, action: 'UserLogin' })
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Erreur serveur');
          }
          return response.text();
        })
        .then(text => {
        //   console.log("Réponse brute:", text);
          const cleanedText = text.trim();
          const data = JSON.parse(cleanedText);
  
          showMessage(data.message);
  
          if (data.success) {
            setTimeout(() => {
              window.location.href = 'http://localhost/amazone-optique/admin/pages/dashboard.php';
            }, 5000);
          }
        })
        .catch(error => {
          console.error("Erreur AJAX:", error);
          showMessage(`
            <div class="PopUp">
              <i class="log-icon bi bi-exclamation-circle-fill"> Erreur serveur</i>
              <div class="p-3">
                <div class="">Nous rencontrons une erreur lors de la connexion au serveur.</div>
                <div class="">Merci de patienter pendant que nous réglons ce problème.</div>
              </div>
              <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
            </div>
          `, false);
        });
    });
}login();


// LA FONCTION DE DECONNEXION

function LogOut(){

    fetch('http://localhost/amazone-optique/assets/php_class/UserController.php', {

        method: 'POST',
        headers:{'Content-Type': 'application/json'},
        body: JSON.stringify({action: 'logout'})
    })
    .then(response =>{
        if(!response.ok){
            throw new error ('Erreur Server')
        }
        return response.text();
    })
    .then(text => {
        const rewriteText = text.trim();
        const data = JSON.parse(rewriteText);

        showMessage(data.message);

        if (data.success) {
            setTimeout(() => {
              window.location.href = 'http://localhost/amazone-optique/admin/index.php';
            }, 5000);
        }
    })
    .catch(error => {
        console.error("Erreur AJAX:", error);
        showMessage(`
          <div class="PopUp">
            <i class="log-icon bi bi-exclamation-circle-fill"> Erreur serveur</i>
            <div class="p-3">
              <div class="">Nous rencontrons une erreur lors de la connexion au serveur.</div>
              <div class="">Merci de patienter pendant que nous réglons ce problème.</div>
            </div>
            <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
          </div>
        `, false);
    });
    
}

// FUNCTION DE CONTACT 
function Contact() {
    document.getElementById('contact_form').addEventListener('submit', function(e) {
        e.preventDefault();

        const nom = document.getElementById('name').value.trim();
        const prenom = document.getElementById('surname').value.trim();
        const email = document.getElementById('e-mail').value.trim();
        const telephone = document.getElementById('tel').value.trim();
        const objet = document.getElementById('objet').value.trim();
        const text = document.getElementById('text_message').value.trim();

        // Vérification si les champs sont vides
        if (!nom || !prenom || !email || !telephone || !text || !objet) {
            console.log('Erreur: Un ou plusieurs champs sont vides');
            showMessage(`
                <div class="PopUp">
                    <i class="log-icon bi bi-exclamation-circle-fill"> Formulaire incomplet</i>
                    <div class="p-3">
                        <div class="">Tous les champs sont obligatoires.</div>
                    </div>
                    <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
                </div>
            `);
            return; // Ne pas envoyer la requête si un champ est vide
        }

        afficheSpinner(true);

        // Si tous les champs sont remplis, envoie la requête
        fetch('http://localhost/amazone-optique/config/API/API_MailControl.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ nom, prenom, email, telephone, objet, text, action: 'Send_mail' })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur, message non envoyé');
            }
            return response.text();
        })
        .then(text => {
            const rewriteWithoutSpace = text.trim();
            const data = JSON.parse(rewriteWithoutSpace);

            showMessage(data.message);

            if (data.success) {
                document.getElementById('contact_form').reset();
                afficheSpinner(false);
            }
            
        })
        .catch(error => {
            console.error("Erreur AJAX:", error);
            showMessage(`
                <div class="PopUp">
                    <i class="log-icon bi bi-exclamation-circle-fill"> Erreur serveur</i>
                    <div class="p-3">
                    <div class="">Nous rencontrons une erreur lors de la connexion au serveur.</div>
                    <div class="">Merci de patienter pendant que nous réglons ce problème.</div>
                    </div>
                    <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
                </div>
            `, false);
            afficheSpinner(false);
        });
    });
}
