<?php

class Userpdo {
    private $db;

    public function __construct() {
        // Connexion à la base de données
        $host = "localhost";
        $dbname = "classes";
        $username = "root";
        $password = "";

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connexion échouée : " . $e->getMessage());
        }
    }

    // Méthode pour créer un nouvel utilisateur
    public function create($login, $email, $firstname, $lastname) {
        $sql = "INSERT INTO users (login, email, firstname, lastname) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$login, $email, $firstname, $lastname]);
            echo "Nouvel utilisateur créé avec succès.";
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Méthode pour lire les informations d'un utilisateur
    public function read($id) {
        $sql = "SELECT * FROM users WHERE id = ?";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                echo "ID: " . $user["id"]. " - Login: " . $user["login"]. " - Email: " . $user["email"]. " - Firstname: " . $user["firstname"]. " - Lastname: " . $user["lastname"];
            } else {
                echo "Aucun résultat trouvé.";
            }
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Méthode pour mettre à jour les informations d'un utilisateur
    public function update($id, $login, $email, $firstname, $lastname) {
        $sql = "UPDATE users SET login=?, email=?, firstname=?, lastname=? WHERE id=?";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$login, $email, $firstname, $lastname, $id]);
            echo "Informations utilisateur mises à jour avec succès.";
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Méthode pour supprimer un utilisateur
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id=?";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            echo "Utilisateur supprimé avec succès.";
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}

?>
