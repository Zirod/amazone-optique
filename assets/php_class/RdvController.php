    <?php

    header('Content-Type: application/json');
    // Inclure les fichiers nécessaires depuis le dossier PHPMailer
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    require 'PHPMailer-master/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    class RdvController {

        private $pdo;
        private $data;
        private $mail;

        // Constructeur qui accepte les données provenant de l'API
        public function __construct($data = []) {
            $this->data = $data;
            $this->mail = new PHPMailer(true); 

            try {
                $this->pdo = new PDO("mysql:host=localhost;dbname=amazone_host;charset=utf8", "root", "");
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die(json_encode(['success' => false, 'message' => 'Erreur BDD : ' . $e->getMessage()]));
            }
        }

        // Méthode pour prendre un rendez-vous
        public function Take_Rdv() {
            // Vérifier si tous les champs nécessaires sont présents
            if(!isset($this->data['nom']) || !isset($this->data['prenom']) || !isset($this->data['telephone']) || !isset($this->data['email']) || !isset($this->data['raison']) || !isset($this->data['date']) || !isset($this->data['heure'])) {
                echo json_encode(['success' => false, 'message' => $this->Alert_Message('empty')]);
                exit;
            }

            // Sécuriser les données
            $nom = htmlspecialchars(trim($this->data['nom']));
            $prenom = htmlspecialchars(trim($this->data['prenom']));
            $telephone = htmlspecialchars(trim($this->data['telephone']));
            $email = htmlspecialchars(trim($this->data['email']));
            $raison = htmlspecialchars(trim($this->data['raison']));
            $date = htmlspecialchars(trim($this->data['date']));
            $heure = htmlspecialchars(trim($this->data['heure']));

            // Créer un objet DateTime à partir de la date
            $dateObj = new DateTime($date);

            // Créer un formateur de date avec la locale française
            $formatter = new IntlDateFormatter(
                'fr_FR',  // Langue et pays (ici, français de France)
                IntlDateFormatter::FULL,  // Format complet
                IntlDateFormatter::NONE,  // Pas de format pour l'heure
                null,  // Utiliser le fuseau horaire par défaut
                IntlDateFormatter::GREGORIAN // Calendrier Grégorien
            );

            // Formater la date
            $formattedDate = htmlspecialchars($formatter->format($dateObj));

            $message = '
                <!DOCTYPE html>
                <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Message client</title>
                    </head>
                    <body style="margin:0; padding:0; text-align:center;font-size: 17px">
                        <header style="background:linear-gradient(36deg,rgb(43, 247, 217),rgb(16, 246, 135));
                                    border-radius:20px; font-weight: bold; font-size: larger;
                                    color: #444; text-align: center; padding: 20px;">
                            DEMANDE DE RENDEZ-VOUS
                        </header>

                        <section style="padding: 15px; text-align: left;padding:10px">
                            <div style = "font-weight:500;text-align:center"> Rendez-vous chez Amazone Optique ce <strong style = "color:rgb(45, 94, 253)"> '.$formattedDate.' à '.$heure.'</strong> ?</div>
                            ' . nl2br(htmlspecialchars($raison)) . '<br /><br />
                            <div
                        </section>

                        <section style="text-align:left; color: rgb(60, 58, 58);">
                            <div style="font-weight: bold;">' . htmlspecialchars($prenom) . ' ' . htmlspecialchars($nom) . '</div>
                            <div class="numero">' . htmlspecialchars($telephone) . '</div>
                            <div class="email">' . htmlspecialchars($email) . '</div>
                        </section>
                    </body>
                </html>
            ';

            try {
                // Préparer la requête SQL pour insérer le rendez-vous
                $requette = $this->pdo->prepare("INSERT INTO rdv_table (Nom, prenom, email, telephone, raison, date, heure) VALUES (?,?,?,?,?,?,?)");
                $requette->execute([$nom, $prenom, $telephone, $email, $raison, $formattedDate, $heure]);

                // Retourner un message de succès
                $rdv_sent = '
                    <div class="PopUp">
                        <i class="log-icon-succes bi bi-check-circle-fill"> Demande Envoyé </i>
                        <div class="p-3">
                            <div class="">Votre demande de Rendez-vous a bien été envoyée. Vous recevrez un email pour la confirmation.</div>
                        </div>
                        <button class="popup-btn btn-succes" onclick="PopUp_hide()">OK</button>
                    </div>
                ';



                $this->mail->isSMTP();
                $this->mail->Host       = 'smtp.gmail.com';  // Serveur SMTP
                $this->mail->SMTPAuth   = true;
                $this->mail->Username   = 'amazoneoptiques@gmail.com';     // Ton adresse email
                $this->mail->Password   = 'ptaa fqxl xqfl lhvv';          // Ton mot de passe ou mot de passe d'application
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                    // ou 'tls' selon ton serveur
                $this->mail->Port       = 587;                      // Port SMTP
            

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Adresse e-mail invalide ou manquante.'
                    ]);
                    return;
                }

                // Destinataires
                $this->mail->setFrom($email, $nom);
                $this->mail->addAddress('amazoneoptiques@gmail.com', 'Amazone Optique' );
                $this->mail->addReplyTo($email, $email);
                
                // Contenu
                $this->mail->isHTML(true);
                $this->mail->Subject = 'DEMANDE DE RENDEZ-VOUS';
                $this->mail->Body    = $message;

                // $this->mail->AltBody = 'Ceci est la version texte pour les clients email HTML.';
            
                $this->mail->send();


                echo json_encode(['success' => true, 'message' => $rdv_sent]);
            } catch(PDOException $e) {
                // Retourner une erreur en cas de problème avec la base de données
                echo json_encode(['success' => false, 'message' => 'Erreur de connexion: ' . $e->getMessage()]);
            }
        }

        public function Get_All_Rdv() {
            try {
                $stmt = $this->pdo->query("SELECT * FROM rdv_table ORDER BY ID DESC");
                $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                if($reponse){
                    $rdvs = '';
                    foreach ($reponse as $row) {
                        $rdvs .= '
                            <tr class="rdv_table_line">
                                <td class="dashTd"> <i class="table_icon bi bi-person-fill"></i>  ' . htmlspecialchars($row['Nom']) . ' '. htmlspecialchars($row['prenom']) .'</td>
                                <td class="dashTd">' . htmlspecialchars($row['email']) . '</td>
                                <td class="dashTd">' . htmlspecialchars($row['telephone']) . '</td>
                                <td class="dashTd">' . htmlspecialchars($row['date']).' à '.htmlspecialchars($row['heure']).'</td>
                                <td class="dashTd">
                                    <div class="d-flex">
                                        <button class = "action-btn btn-info"><i class="bi bi-eye-fill"></i></button>
                                        <button class = "action-btn btn-succes"><i class="bi bi-calendar2-check-fill"></i></button>
                                        <button class = "action-btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
                        ';
                    }
                
                    echo json_encode([
                        'success' => true,
                        'data' => $rdvs
                    ]);
                }else{

                    $any_rdv = '<td colspan="5" class="dashTd text-center">Aucun rendez-vous disponible</td>';
                    echo json_encode([
                        'success' => true,
                        'data' => $any_rdv
                    ]);
                }
            
            } catch (PDOException $e) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Erreur lors de la récupération des rendez-vous : ' . $e->getMessage()
                ]);
            }
        }

        public function Remove_Rdv($rdvId){

            $remove_request = $this->pdo->query("DELETE  * FROM rdv_table WHERE ID=".intval($rdvId));
            echo json_encode([
                'success' => true,
                'message' => '
                    <div class="PopUp">
                        <i class="log-icon-succes bi bi-check-circle-fill"> Demande RDV réjeter </i>
                        <div class="p-3">
                            <div class="">Cette demande de rendez-vous a été rejeter avec succès</div>
                        </div>
                        <button class="popup-btn btn-succes" onclick="PopUp_hide()">OK</button>
                    </div>
                '
            ]);

        }

        // Fonction pour afficher des messages d'alerte
        private function Alert_Message($alert_type) {
            if ($alert_type == 'empty') {
                return '
                    <div class="PopUp">
                        <i class="log-icon bi bi-exclamation-circle-fill"> Champs manquants</i>
                        <div class="p-3">
                            <div class="">Veuillez vous assurer de remplir tous les champs avant de valider ce formulaire.</div>
                        </div>
                        <button class="popup-btn btn-danger" onclick="PopUp_hide()">OK</button>
                    </div>
                ';
            }
        }
    }