<?php

    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);


    $json = file_get_contents("php://input");
    $data = json_decode($json, true) ?? [];

    $action = $data['action'] ?? $_GET['action'] ?? null;

    // Inclure la classe RdvController
    require_once('../../assets/php_class/RdvController.php');

    // Créer une instance du contrôleur en passant les données
    $RdvController = new RdvController($data);

    // Exécuter l'action appropriée en fonction de la valeur de 'action'
    switch($action) {
        case 'Take_Rdv':
            $RdvController->Take_Rdv();
            break;

        case 'Validate_Rdv':
            $RdvController->Validate_Rdv();
            break;

        case 'Remove_Rdv':
            $RdvController->Remove_Rdv();
            break;
        
        case 'Get_All_Rdv':
            $data = json_decode(file_get_contents("php://input"), true);
            $RdvController = new RdvController($data);
            $RdvController->Get_All_Rdv();
        break;

        default:
            echo json_encode([
                'success' => false,
                'message' => '<div class="PopUp">Action invalide</div>'
            ]);
        break;
    }