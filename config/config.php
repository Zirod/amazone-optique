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
