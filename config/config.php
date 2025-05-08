<?php
    session_start();
    
    function Connexion(){
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=amazone_host;charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die(json_encode(['success' => false, 'message' => 'Erreur BDD : ' . $e->getMessage()]));
        }
        return $pdo;
    }

    // password: yzrH1Y5c20 / username :  if0_38873289! // mail pass :: amazoneoptique@2025 //  date :: zirod date // 