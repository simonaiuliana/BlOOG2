<?php
namespace model\Manager;

use model\Interface\InterfaceSlugManager;
use model\Abstract\AbstractMapping;
use PDO;
use Exception;

class UserManager {
    private $db;

    public function __construct()
    {
        // Conectare la baza de date (presupunem că $db este un obiect PDO)
        $this->db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (user_login, user_password, user_full_name, user_mail, user_status, user_secret_key, permission_permission_id) VALUES (:login, :password, :full_name, :mail, :status, :secret_key, :permission_id)");
        $stmt->bindParam(':login', $data['user_login']);
        $stmt->bindParam(':password', $data['user_password']);
        $stmt->bindParam(':full_name', $data['user_full_name']);
        $stmt->bindParam(':mail', $data['user_mail']);
        $stmt->bindParam(':status', $data['user_status']);
        $stmt->bindParam(':secret_key', $data['user_secret_key']);
        $stmt->bindParam(':permission_id', $data['permission_permission_id']);
        $stmt->execute();
    }

    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user) {
            return new User($user->user_id, $user->user_login, $user->user_password, $user->user_full_name, $user->user_mail, $user->user_status, $user->user_secret_key, $user->permission_permission_id);
        } else {
            throw new Exception('Utilizatorul nu a fost găsit.');
        }
    }

    public function getBySlug(string $slug)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_slug = :slug");
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user) {
            return new User($user->user_id, $user->user_login, $user->user_password, $user->user_full_name, $user->user_mail, $user->user_status, $user->user_secret_key, $user->permission_permission_id);
        } else {
            throw new Exception('Utilizatorul nu a fost găsit.');
        }
    }

    public function update(array $data)
    {
        $stmt = $this->db->prepare("UPDATE users SET user_login = :login, user_password = :password, user_full_name = :full_name, user_mail = :mail, user_status = :status, user_secret_key = :secret_key, permission_permission_id = :permission_id WHERE user_id = :id");
        $stmt->bindParam(':login', $data['user_login']);
        $stmt->bindParam(':password', $data['user_password']);
        $stmt->bindParam(':full_name', $data['user_full_name']);
        $stmt->bindParam(':mail', $data['user_mail']);
        $stmt->bindParam(':status', $data['user_status']);
        $stmt->bindParam(':secret_key', $data['user_secret_key']);
        $stmt->bindParam(':permission_id', $data['permission_permission_id']);
        $stmt->bindParam(':id', $data['user_id'], PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'model\Mapping\User');
        $user = $stmt->fetch();

        if (!$user) {
            throw new Exception('Utilizatorul nu a fost găsit.');
        }

        return $user;
    }
}
