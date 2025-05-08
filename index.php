<?php
    include('config/config.php');
?>
<!DOCTYPE>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="src/public/default-image/favincon.jpeg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/componet.css">
        <link rel="stylesheet" href="assets/icone/font/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/icone/font/bootstrap-icons.min.css">
        <title>Accueil - Amazone Optique  </title>

    </head>
    <body>
        <div id = "message" class="hide"></div>
        <header id="header" class = "header">
            <div class="top-contact-info d-flex">
                <div class="mail d-flex">
                    <i id = "cloud" class = "icone bi-envelope"></i>
                    <label for=""><a class= "mail" href="mailto:amazoneoptiques@gmail.com">amazoneoptiques@gmail.com</a></label>
                </div>
                <div class="tel d-flef">
                    <i id = "" class = "icone bi-telephone"></i>
                    <label for=""> 01 96687276</label>
                </div>
            </div>
            
            <div class="nav-bar">
                <i id = "menue" class="bi bi-list menu-burger"></i>
                <a href = "index.php" class="siteName">
                    AMAZONE OPTIQUE
                </a>
                
                <div class="nav-link">
                    <ul class = "nav-link_items">
                        <li class = "nav-link-item"><a href="#">Accueil</a></li>
                        <li class = "nav-link-item"><a href="#products">A propos</a></li>
                        <li class = "nav-link-item"><a href="#programme">Rendez-vous</a></li>
                        <li class = "nav-link-item"><a href="#contact">Contact</a></li>
                    </ul>                
                </div>
                
            </div>
        </header>

        <section class="hero">
            <video autoplay muted loop playsinline class="hero-video">
                <source src="https://videos.pexels.com/video-files/8134892/8134892-uhd_2732_1440_25fps.mp4" type="video/mp4">
                Votre navigateur ne supporte pas la lecture vidéo.
            </video>
            <div class="hero-overlay">
                <h1 style = "font-size:3rem;">Bienvenue chez Amazone Optique</h1>
                <p style = "font-size:2rem;padding:10px" >Nouveautés exclusives, services personnalisés - votre regard mérite l’excellence.</p>
                <div class="bouton-info" style = "gap:10px; padding:20px;">
                    <a href = "#contact"><button class="btn btn-personalized ac-btn"><i class="icone bi bi-arrow-left-circle-fill"></i> Nous Contacter</button></a>
                    <a href = "#programme"><button class="btn btn-personalized ac-btn">Prendre rendez-vous <i class="icone bi bi-arrow-right-circle-fill"></i></button></a>
                </div>
            </div>
        </section>          
        <section id="products" class = "products">
            <h2 id = "" class = "section-title">Nos valeurs</h2>

            <p class = "section-description">
                Chez Amazone Optique, nous croyons que vos lunettes doivent faire bien plus que corriger votre vision.
                Elles doivent s’adapter à votre quotidien, souligner votre personnalité, et surtout, prendre soin de vos yeux.

                👓 Verres de qualité médicale – pour une correction précise et un confort visuel optimal.
                💡 Montures légères & design – pensées pour vous accompagner toute la journée, sans compromis sur le style.
                🌿 Matériaux durables – pour une paire fiable, respectueuse de votre bien-être et de l’environnement.
            </p>

            <div class="row">

                <div class="col-lg-8 p-3 nindo">
                    <div class="article">
                        <img class="img-fluid" src="src/public/default-image/article1.jpg" alt="" srcset="">
                        <div class="details">
                            <strong>👓 Chez Amazone Optique</strong>, 
                            nous savons que bien voir, c’est essentiel. Mais bien choisir ses lunettes, c’est tout aussi important.
                            <p class="surplus">
                                C’est pourquoi nous prenons le temps de vous écouter, de vous conseiller, et de vous orienter vers la paire qui répond à vos besoins visuels, mais aussi à votre style. Grâce à une sélection rigoureuse de                                   montures, des verres de qualité médicale, et un accompagnement sur mesure, nous faisons de votre confort une priorité — et de votre look, un atout.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 p-3">
                    <div class="article">
                        <img class="img-fluid" src="src/public/default-image/article2.jpg" alt="" srcset="">
                        <div class="details">
                        💎 <strong>Technique & Luxe.</strong>
                        Technologie de précision et design sophistiqué. Les verres médicaux qui allient performance et élégance.
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 p-3">
                    <div class="article">
                        <img class="img-fluid" src="src/public/default-image/article4.jpg" alt="" srcset="">
                        <div class="details">
                            <strong>🛡️ Protégez vos yeux, préservez votre énergie</strong>
                            Nos verres sont conçus pour filtrer la lumière bleue, réduire les reflets et soulager la tension oculaire.

                            <p class="surplus">
                                En protégeant vos yeux, vous gagnez en confort, en énergie et en clarté tout au long de la journée.
                                Offrez à votre regard la protection qu’il mérite, et profitez d’une vision plus douce, plus reposée, plus durable.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 p-3">
                    <div class="article">
                        <img class="img-fluid" src="src/public/default-image/article3.jpg" alt="" srcset="">
                        <div class="details">
                        🌿 <strong> "Une vision paisible, un esprit tranquille"</strong>
                            

                            <p class="surplus">
                                Avec nos verres, vous ne portez pas simplement une correction…
                                Vous adoptez une sensation de confort, de clarté, de légèreté.
                                Chaque verre est conçu pour soulager vos yeux, adoucir la lumière, et effacer la fatigue du quotidien.
                                Que ce soit pour lire, travailler ou simplement regarder le monde, nos verres vous offrent une vision stable et apaisée, comme une fenêtre ouverte sur la sérénité.
                                Parce que bien voir, c’est aussi se sentir bien.
                            </p>
                        </div>
                    </div>
                </div>
                
                
                                
            </div>

        </section>

        <section class = "programme " id="programme">

            <div class="container">
                <h2 style = "color:#fff" class = "section-title">✨ Prêt·e à réserver votre rendez-vous ?</h2>

                <p class = "programme-description" style = "color:#fff; text-align:center">
                    Choisissez la 📅 date qui vous convient, sélectionnez l'🕒 horaire idéal, puis remplissez notre ✍️ petit formulaire en quelques secondes.

                    Une fois votre demande envoyée, notre équipe vous recontactera pour confirmer le créneau.

                    🚀 Rapide, facile et efficace — on a hâte de vous accueillir ! 😄
                </p>

                <form id="programForm">
                    <div class="row">
                        <div class="col-lg-5 p-3">

                            <div class="calendar">

                                <div class=" d-flex justify-content-between p-3">
                                    <i id="prevBtn" class = "icone-cal bi bi-arrow-left-circle-fill"></i>
                                    <span class ="month-year" id="titreMois"></span>
                                    <i id="nextBtn" class = "icone-cal bi bi-arrow-right-circle-fill"></i>
                                </div>
                                    
                                <div class="">
                                    <table class = "date">
                                        <thead class = "days">
                                            <th class="day-item">L</th>
                                            <th class="day-item">M</th>
                                            <th class="day-item">M</th>
                                            <th class="day-item">J</th>
                                            <th class="day-item">V</th>
                                            <th class="day-item">S</th>
                                            <th class="day-item">D</th>
                                        </thead>
                                        <tbody id = "calendrier" class = "dates">

                                        <!-- MON CALENDRIER GENERER  -->

                                        </tbody>
                                    </table>

                                    <div class="">
                                        <div class="crenneau d-flex justify-content-between">
                                            <div class="emm"><input type="text" id="dateChoisie" placeholder="Cliquez sur une date" required />
                                        </div>
                                        <!-- <input type="time" name="" id="" class = "form-control p-2"> -->
                                            <select name="" id="horaire" class = "select-control">
                                                <option  value="08: 00">08: 00</option>
                                                <option  value="08: 00">08: 30</option>

                                                <option  value="09: 00">09: 00</option>
                                                <option  value="09: 00">09: 30</option>

                                                <option  value="10: 00">10: 00</option>
                                                <option  value="10: 00">10: 30</option>

                                                <option  value="11: 00">11: 00</option>
                                                <option  value="11: 00">11: 30</option>

                                                <option  value="14: 00">14: 00</option>
                                                <option  value="14: 00">14: 30</option>

                                                <option  value="15: 00">15: 00</option>
                                                <option  value="15: 00">15: 30</option>

                                                <option  value="16: 00">16: 00</option>
                                                <option  value="16: 00">16: 30</option>
                                                
                                                <option  value="17: 00">17: 00</option>
                                                <option  value="17: 00">17: 30</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-5">
                            <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="" id="nom" class="form-control" placeholder = "Nom" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="" id="prenom" class="form-control" placeholder = "Prénom" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="tel" name="" id="telephone" class="form-control" placeholder = "Tel: (ex: 229 96687276)" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="" id="email" class="form-control" placeholder = "Email" required>
                            </div>
                            <div class="col-lg-12">
                                <textarea class = "form-control message-box w-100 p-3" name="" id="raison" rows="14" placeholder = "La raison de votre demande de Rendez-vous"></textarea>
                            </div> 
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-lg-12 text-center">
                        <button class="btn btn-succes ac-btn w-50 p-2">
                            <div id="spin" class="hide">
                                <img src="assets/spinner/3-dots-fade.svg" alt="Envoie en cours..." class="spinner" />
                            </div>

                            <div id="wrd" class="show">
                                <p>Envoyer</p>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <section id="contact" class="contact p-2">
            <h2 class = "section-title p-2">Nous contacter</h2>

            <p class = "section-description" style = "color:444">
                Une question, un souci ou une demande particulière ? Remplissez le formulaire ci-dessous et notre équipe vous répondra dans les plus brefs délais.
                Votre satisfaction est notre priorité, et nous mettons tout en œuvre pour vous accompagner au mieux. 💼✨
            </p>

            <div class=" contact-form col-lg-8">

                <form id="contact_form" class="card p-3">
                    <div class="contact-title text-center">Formulaire de contact</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="nom" id="name" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="prenom" id="surname" class="form-control" placeholder="Prénom">
                        </div>
                        <div class="col-lg-6">
                            <input type="email" name="email" id="e-mail" class="form-control" placeholder="Adresse mail">
                        </div>
                        <div class="col-lg-6">
                            <input type="tel" name="telephone" id="tel" class="form-control" placeholder="Numéro de téléphone">
                        </div>
                    </div>
                    <div class="p-1">
                        <input type="text" name="objet" id="objet" class="form-control" placeholder="Objet">
                    </div>
                    
                    <div class="p-1">
                        <textarea class="form-control w-100" name="text" id="text_message" rows="10" placeholder="Votre message ici" required></textarea>
                    </div>
                    <div class="p-2 text-center">
                        <button class="btn btn-personalized ac-btn w-50 p-2">
                            <div id="spin" class="hide">
                                <img src="assets/spinner/3-dots-fade.svg" alt="Envoie en cours..." class="spinner" />
                            </div>

                            <div id="wrd" class="show">
                                <p>Envoyer</p>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            <style>
                .spinner{
                    width: 20px;
                    color:#fff;
                    position:absolute:top:50px
                }
                .maker{
                    text-decoration:none;
                    font-size:15px;
                    color:rgb(0, 0, 110);
                    font-weight:bold;
                }
            </style>
             
        </section>

        <footer class = "footer row">
            <div class="col-lg-6">
                <div style="margin-bottom: 10px;font-size:17px">
                    © 2025 Amazone Optique. Tous droits réservés.
                </div>
                <div>
                    <a href="" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="" class="social-link"><i class="bi bi-whatsapp"></i></a>
                    <a href="" class="social-link"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class = "col-lg-6" style="font-size:17px">
               Entièrement réaliser par <a class = "maker" href="mailto:rodolphojudichaelz@gmail.com">Zirod-Judi</a>
            </div>
        </footer>
    </body>
    <script src="assets/javascrip/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Contact(); 
        });

        document.addEventListener('DOMContentLoaded', () => {
        const burger = document.querySelector('.menu-burger');
        const nav = document.querySelector('.nav-link');
        const menue = document.getElementById('menue'); // conteneur de ton menu complet

        // Ouvre / ferme le menu au clic sur le burger
        burger.addEventListener('click', (e) => {
            e.stopPropagation(); // Empêche que le clic se propage au document
            nav.classList.toggle('active');
        });

        // Ferme le menu si on clique ailleurs
        document.addEventListener('click', function(event) {
            if (!menue.contains(event.target)) {
            nav.classList.remove('active');
            }
        });
        });
    </script>
</html>