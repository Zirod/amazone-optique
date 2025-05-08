<?php
    // Lire les données JSON brutes envoyées par fetch()
    $rawData = file_get_contents("php://input");

    // Les décoder en tableau associatif
    $data = json_decode($rawData, true);

    // Vérification basique
    if (!is_array($data) || empty($data)) {
        echo json_encode([
            'success' => false,
            'message' => 'Aucune donnée reçue.'
        ]);
        exit;
    }

    // Vérifier l'action
    if (!isset($data['action']) || $data['action'] !== 'Send_mail') {
        echo json_encode([
            'success' => false,
            'message' => 'Action non reconnue.'
        ]);
        exit;
    }

    // Inclure ta classe MailController (adapte le chemin si besoin)
    require_once '../../assets/php_class/MailController.php';

    // Créer une instance et envoyer le mail
    $mail = new MailController($data);
    $mail->Send_mail(); // cette méthode fait déjà un echo json_encode()
