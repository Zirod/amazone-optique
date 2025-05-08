<?php
    session_start();
    header('Content-Type: application/json; charset=utf-8');
    header("Content-Type: application/json");

    class UserController {

        private $pdo;
        private $action;
        private $data;

        public function __construct() {
            $jsonData = file_get_contents("php://input");
            
            if ($jsonData) {
                $this->data = json_decode($jsonData, true);
            } else {
                $this->data = [];
            }

            $this->action = $this->data['action'] ?? null;

            try {
                $this->pdo = new PDO("mysql:host=localhost;dbname=amazone_host;charset=utf8", "root", "");
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die(json_encode(['success' => false, 'message' => 'Erreur BDD : ' . $e->getMessage()]));
            }
        }

        public function UserLogin() {
            if (!isset($this->data['email']) || !isset($this->data['password'])) {
                echo json_encode(['success' => false, 'message' => $this->alertMessage('empty')]);
                exit;
            }

            $email = trim($this->data['email']);
            $password = trim($this->data['password']);

            try {
                $stmt = $this->pdo->prepare("SELECT * FROM admin_users WHERE email = :email AND pasword = :password");
                $stmt->execute(['email' => $email, 'password' => $password]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_name'] = $user['prenom'] . " " . $user['nom'];
                    $_SESSION['user_password'] = $user['pasword'];
                    $_SESSION['user_ID'] = $user['ID'];

                    echo json_encode(['success' => true, 'message' => $this->alertMessage('Connected')]);
                } else {
                    echo json_encode(['success' => false, 'message' => $this->alertMessage('identifier_error')]);
                }

            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => $this->alertMessage('error_serv')]);
            }
        }

        public function LogOut(){

            session_unset();
            session_destroy();
            echo json_encode(['success' => true, 'message' =>$this->alertMessage('log_out') ]);

        }

        public function Action_verification() {
            if ($this->action && method_exists($this, $this->action)) {
                return $this->{$this->action}();
                exit;
            } else {
                return ['success' => false, 'message' => $this->alertMessage('no_action')];
                exit;
            }
        }

        // LES DIFFERENTES REPONSES QUE RENVOI LE BACKEND
        private function alertMessage($result) {
            if ($result == 'Connected') {
                return '<div id="loader"><div class="loader-text">Connexion en cours...</div></div>';
            } elseif ($result == 'empty') {
                return '
                    <div class="PopUp">
                        <i class="log-icon bi bi-exclamation-circle-fill"> Champs manquants</i>
                        <div class="p-3">
                            <div class="">Veuillez vous assurer de remplir tous les champs avant de valider ce formulaire.</div>
                        </div>
                        <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
                    </div>
                ';
                exit;
            } elseif ($result == 'identifier_error') {
                return '
                    <div class="PopUp">
                        <i class="log-icon bi bi-exclamation-circle-fill"> Indentifiant incorrect</i>
                        <div class="p-3">
                            <div class="">Merci de vérifier vos identifiant de connexion, et réésayer.</div>
                        </div>
                        <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
                    </div>
                ';
                exit;
            } elseif ($result == 'error_serv') {
                return '
                    <div class="PopUp">
                        <i class="log-icon bi bi-exclamation-circle-fill"> Erreur</i>
                        <div class="p-3">
                            <div class="">Erreur serveur. Essayez de réessayer plus tard.</div>
                        </div>
                        <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
                    </div>
                ';
                exit;
            } elseif ($result == 'no_action') {
                return '
                    <div class="PopUp">
                        <i class="log-icon bi bi-exclamation-circle-fill"> Action invalide</i>
                        <div class="p-3">
                            <div class="">Désolé, l\'action que vous essayez d\'effectuer n\'existe pas.</div>
                        </div>
                        <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
                    </div>
                ';
                exit;
            }elseif($result == 'log_out') {
                return '<div id="loaderLogOut"><div class="loader-text">Déconnexion en cours...</div></div>';

            }
        }
    }

// Initialisation du contrôleur
$controller = new UserController();
$response = $controller->Action_verification();
