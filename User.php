<?php

class User {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    // Méthode de connexion à la base de données
    private function connect() {
        $host = "localhost"; // Hôte MySQL
        $username = "root"; // Nom d'utilisateur MySQL
        $password = ""; // Mot de passe MySQL
        $database = "classes"; // Nom de la base de données

        $conn = new mysqli($host, $username, $password, $database);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connexion échouée : " . $conn->connect_error);
        }

        return $conn;
    }

    // Méthode pour créer un nouvel utilisateur
    public function create($login, $email, $firstname, $lastname) {
        $conn = $this->connect();

        $sql = "INSERT INTO users (login, email, firstname, lastname) VALUES ('$login', '$email', '$firstname', '$lastname')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Nouvel utilisateur créé avec succès.";
        } else {
            echo "Erreur : " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    // Méthode pour lire les informations d'un utilisateur
    public function read($id) {
        $conn = $this->connect();

        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "ID: " . $row["id"]. " - Login: " . $row["login"]. " - Email: " . $row["email"]. " - Firstname: " . $row["firstname"]. " - Lastname: " . $row["lastname"];
        } else {
            echo "Aucun résultat trouvé.";
        }

        $conn->close();
    }

    // Méthode pour mettre à jour les informations d'un utilisateur
    public function update($id, $login, $email, $firstname, $lastname) {
        $conn = $this->connect();

        $sql = "UPDATE users SET login='$login', email='$email', firstname='$firstname', lastname='$lastname' WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Informations utilisateur mises à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour : " . $conn->error;
        }

        $conn->close();
    }

    // Méthode pour supprimer un utilisateur
    public function delete($id) {
        $conn = $this->connect();

        $sql = "DELETE FROM users WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Utilisateur supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression : " . $conn->error;
        }

        $conn->close();
    }
}

?>