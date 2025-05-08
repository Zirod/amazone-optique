<?php
    header('Content-Type: application/json');
    // Inclure les fichiers nécessaires depuis le dossier PHPMailer
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    require 'PHPMailer-master/src/Exception.php';

    require_once '../../config/config.php';

    

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class MailController{

        private $data;
        private $mail;

        public function __construct($data = []) {

            $this->mail = new PHPMailer(true); 
            $this->data = $data; 
            // $this->connexion = Connexion();

        }

        public function Send_mail(){

            $receiver_name = $this->data['prenom']. ' '.$this->data['nom'];

            $message = '
                <!DOCTYPE html>
                <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Message client</title>
                    </head>
                    <body style="margin:0; padding:0; text-align:center;">
                        <header style="background:linear-gradient(36deg,rgb(135, 76, 245),rgb(52, 135, 244));
                                    border-radius:20px; font-weight: bold; font-size: larger;
                                    color: #fff; text-align: center; padding: 20px;">
                            Contact : ' . htmlspecialchars($this->data['prenom']) . ' ' . htmlspecialchars($this->data['nom']) . '
                        </header>

                        <section style="padding: 15px; text-align: left;">
                            ' . nl2br(htmlspecialchars($this->data['text'])) . '
                        </section>

                        <section style="text-align:left; padding: 10px; color: rgb(60, 58, 58);">
                            <div style="font-weight: bold;">' . htmlspecialchars($this->data['prenom']) . ' ' . htmlspecialchars($this->data['nom']) . '</div>
                            <div class="numero">' . htmlspecialchars($this->data['telephone']) . '</div>
                            <div class="email">' . htmlspecialchars($this->data['email']) . '</div>
                        </section>
                    </body>
                </html>
            ';

            try {
                
                // Configuration SMTP
                $this->mail->isSMTP();
                $this->mail->Host       = 'smtp.gmail.com';  // Serveur SMTP
                $this->mail->SMTPAuth   = true;
                $this->mail->Username   = 'amazoneoptiques@gmail.com';     // Ton adresse email
                $this->mail->Password   = 'ptaa fqxl xqfl lhvv';          // Ton mot de passe ou mot de passe d'application
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                    // ou 'tls' selon ton serveur
                $this->mail->Port       = 587;                      // Port SMTP
            

                if (empty($this->data['email']) || !filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Adresse e-mail invalide ou manquante.'
                    ]);
                    return;
                }

                // Destinataires
                $this->mail->setFrom($this->data['email'], $this->data['nom']);
                $this->mail->addAddress('amazoneoptiques@gmail.com', 'Amazone Optique' );
                $this->mail->addReplyTo($this->data['email'], $this->data['nom']);
                
                // Contenu
                $this->mail->isHTML(true);
                $this->mail->Subject = htmlspecialchars($this->data['objet']);
                $this->mail->Body    = $message;

                // $this->mail->AltBody = 'Ceci est la version texte pour les clients email HTML.';
            
                $this->mail->send();

                echo json_encode([
                    'success' => true,
                    'message' => '
                        <div class="PopUp">
                            <i class="log-icon-succes bi bi-check-circle-fill"> Mail Envoyé </i>
                            <div class="p-3">
                                <div class="">Votre demande a bien été envoyée. Vous recevrez un retour par mail dans les plus brefs délais.</div>
                            </div>
                            <button class="popup-btn btn-succes" onclick="PopUp_hide()">OK</button>
                        </div>
                    '
                ]);

                // $requette = "INSERT INTO message_table (nom, prenom, email, telephone, contenue, date, lu) VALUE(?,?,?,?,?,?,?)";
                // $save_message = $this->connexion->prepare($requette);
                // $save_message->execute(array(
                //     htmlspecialchars($this->data['nom']),
                //     htmlspecialchars($this->data['prenom']),
                //     htmlspecialchars($this->data['email']),
                //     htmlspecialchars($this->data['objet']),
                //     htmlspecialchars($this->data['telephone']),
                //     htmlspecialchars($this->data['contenue']),
                //     date('d/m/Y'),
                //     0
                // ));



            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => $this->mail->ErrorInfo
                ]);
            }

        }
    }