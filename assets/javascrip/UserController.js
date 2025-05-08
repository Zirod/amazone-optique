// Ma class js pour le control de l'utilisateur de façon asynchrone 

class UserController{

    constructor(){
        //init
    }

    UserLogin(){
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
    }

    UserLogOut(){

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
                  window.location.href = 'http://localhost/amazone-optique/admin/';
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

}