
export default class Rdv_controller{

    constructor(){
        // init
    }

    Take_Rdv () {
        
        const date = document.getElementById('dateChoisie').value.trim();
        const heure = document.getElementById('horaire').value.trim();
        const nom = document.getElementById('nom').value.trim();
        const prenom = document.getElementById('prenom').value.trim();
        const telephone = document.getElementById('telephone').value.trim();
        const email = document.getElementById('email').value.trim();
        const raison = document.getElementById('raison').value.trim();

        fetch('http://localhost/amazone-optique/config/API/API_RdvControl.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password, action: 'UserLogin' })
        })
    }
    

}
