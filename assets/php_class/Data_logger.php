<?php

    class Data_logger{

        private $pdo;

        public function __construct($dbname, $host, $user, $pass) {
            try {
                $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die(json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données']));
            }
        }
    
        public function getPDO() {
            return $this->pdo;
        }
    }


    

    