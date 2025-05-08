<?php
    include_once('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/componet.css">
        <link rel="stylesheet" href="../assets/icone/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../assets/icone/font/bootstrap-icons.min.css">
        <title>AO * Index </title>
    </head>
    <body class = "admin-index">

        <div class="row">
            <div class="col-lg-8">
                <div class="card p-5">

                    <div class="row">
                        <div class="col-lg-6">
                                <img class = "img-fluid"src="../src/public/default-image/log-img.jpg" alt="">
                        </div>
                        <div class="col-lg-6 container">
                        <div class = "log-title p-3">Amazone Optique</div>

                        <div id = "message" class="hide"></div>

                        <!-- La modale pour afficher les alertes -->
                        <!-- <div id="modal" class="modal">
                            <div class="modal-content">
                            <span id="closeBtn" class="close">&times;</span>
                            <p class = "text-center" id="message"></p>
                            </div>
                        </div> -->
                        
                        
                           <div class="contain">
                                
                                <form id = "loginForm">

                                    <div class="p-1">
                                        <input type = "email" id= "email" type="text" name="" id="" class="form-control" placeholder = "Adresse Email: " required>
                                    </div>
                                    <div class="p-1">
                                        <input type = "password" id = "password" type="password" name="" id="" class="form-control" placeholder = "Mot de passe: " required>
                                    </div>
                                    <div class="p-1">
                                        <button onclick="login()" class="btn btn-primary" id = "openModalBtn">Se connecter</button>
                                        <a class = "log-link" href="#">Mot de passe oublier</a>
                                    </div>

                                </form>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
    <script src="../assets/javascrip/main.js"></script>
</html>