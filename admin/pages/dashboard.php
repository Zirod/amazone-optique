<?php
    include_once('../../config/config.php');
    if(isset($_SESSION['user_ID']) == false){
        header("Location:http://localhost/amazone-optique/admin/");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/componet.css">
    <link rel="stylesheet" href="../../assets/icone/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/icone/font/bootstrap-icons.min.css">
    <title>Dashboard | Amazone Optique </title>
</head>
<body class = "admin-body">
    <div id = "message" class="hide"></div>
        
    <div class="admin-header">
        <a href = "http://localhost/amazone-optique/admin/pages/dashboard.php" class="siteName">
            AMAZONE OPTIQUE
        </a>

            <!-- <div class="burger" id="burger"></div> -->


        <div class="my-user d-flex" onclick = "toggle_drop_down()">
            <i class="user-icon-default bi bi-person-workspace"></i>
            <div class="myUserName">
                <i class="bi bi-chevron-down" style = "font-size:7px;margin-left:5px"></i>
            </div>
            <div class="dropdown-content p-2 hide" id="dropdownContent"> 
                <div class="dropUserName">
                    <?php echo $_SESSION['user_name']; ?>
                    <div class="grad">Développeur web</div>
                </div>
                
                <li class = "drop-item d-flex">
                    <i class="bi bi-person"></i>
                    <div class="drop_word">Mon Profil</div>
                </li>
                <li class = "drop-item d-flex">
                    <i class="bi bi-gear"></i>
                    <div class="drop_word">Paramètres</div>
                </li>
                <button id = "logOutbtn" onclick = "logOut()" class = "drop-item drop-btn btn-danger">
                    <i class="bi bi-box-arrow-right"></i>
                    <div class="drop_word">Se déconnecter</div>
                </button>
            </div>
        </div>
    </div>

    <div class="main">


        <!-- LA BARRE LATERAL DE NAVIGATION -->
        <div id = "menu" class="lateral-barre p-3">
            <div class="nav-items">
                <li class="admin_nav_link">
                    <i class="admin-nav-icon bi bi-grid"></i>
                    <div class="nav-word">Dashbord</div>
                </li>
                <!-- <li class="admin_nav_link">
                    <i class="admin-nav-icon bi bi-chat"></i>
                    <div class="nav-word">Messages</div>
                </li> -->
                <li class="admin_nav_link">
                    <i class="admin-nav-icon bi bi-calendar2-week"></i>
                    <div class="nav-word">Rendez-vous</div>
                </li>
                <li class="admin_nav_link">
                    <i class="admin-nav-icon bi bi-gear"></i>
                    <div class="nav-word">Paramètres</div>
                </li>
            </div>
        </div>



        <!-- LE CONTENEUR PRINCIPAL -->

        <div class="admin-container">

            <strong> - DASHBOARD ADMIN</strong>
            <button class = "card-head-btn btn-primary" onclick = "openModal()"> Nouvel article</button>

            <div class="min-dash-card">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="min-dash card p-2">
                            <div class="min-card-title">
                                <i class = "bi bi-flower3"> - Utilisateurs</i>
                                <i class = "bi bi-three-dots-vertical"></i>
                            </div>
                            <div class="context d-flex">
                                <i class="cart-context-icon bi bi-person-fill"style = "background-color: rgba(237, 150, 20, 0.21);color:orange"></i>
                                <div class="article-counter" style = "color:orange">00 <label class="ee">utilisateurs total</label></div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="min-dash card p-2">
                            <div class="min-card-title">
                                <i class = "bi bi-calendar2-week"> - Mes Rendez-vous</i>
                                <i class = "bi bi-three-dots-vertical"></i>
                            </div>
                            <div class="context d-flex">
                                <i class="cart-context-icon bi bi-calendar-week" style = "background-color: rgba(20, 237, 103, 0.21);color:green"></i>
                                <div class="article-counter" style = "color:green">00 <label class="ee">rendez-vous</label></div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-4">
                        <div class="min-dash card p-2">
                            <div class="min-card-title">
                                <i class = "bi bi-chat-fill"> - Mes mail</i>
                                <i class = "bi bi-three-dots-vertical"></i>
                            </div>
                            <div class="context d-flex">
                                <i class="cart-context-icon bi bi-envelope" style = "background-color: rgba(20, 99, 237, 0.21);color:blue"></i>
                                <div class="article-counter" style = "color:blue">23 <label class="ee">messages</label></div>
                                
                            </div>
                        </div>
                    </div> -->

                </div>

                <div class="col-lg-12 recent-article">
                    <div class="card p-2">
                        <div class="min-card-title">
                            <i class = "bi bi-calendar2-week-fill"> - Mes Rendez-vous</i>
                        </div>
                        <!-- <div class = "p-2 text-center"> <strong>Mes rendez-vous du jour ( <?php echo date('d/m/y'); ?> )</strong></div> -->
                        <div class="p-3">
                           
                            <table class = "rdv_table">
                                <thead>
                                    <th>Nom & Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Adresse mail</th>
                                    <th>Date du rdv</th>
                                    <th class = "text-center">Action</th>
                                </thead>
                                <tbody id = "data_rdv"></tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-12 recent-article">
                    <div class="card p-2">
                        <div class="min-card-title">
                            <i class = "bi bi-chat-fill"> - Mails non lu</i>
                        </div> 
                    </div>
                </div> -->
    
            </div>

        </div>
        

    </div>
    <script src="../../assets/javascrip/main.js" defer></script>
    <script>
        function toggle_drop_down(){

            event.stopPropagation();
            const drop = document.getElementById("dropdownContent");

            if (drop.classList.contains("hide")) {
                drop.classList.replace("hide", "show");
            }
        }
        document.addEventListener('click', function(event) {
            const element = document.getElementById('dropdownContent');
            if (!element.contains(event.target)) {
                element.classList.replace("show", "hide");
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.getElementById('logOutbtn');
            if (logoutButton) {
                logoutButton.addEventListener('click', async function() {
                    await LogOut();
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Une fois la page chargée, appelle la fonction fetch de ton fichier JS externe
            getRdv(); // Par exemple, si tu as une fonction dans mon_fichier.js
        });
        
        
    </script>
</body>
</html>
