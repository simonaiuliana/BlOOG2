<?php
namespace manager\controller;

use model\Manager\UserManager;
use Exception;

class UserController
{
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function view($userId)
    {
        try {
            $user = $this->userManager->getById($userId);
            include 'view/user/view.php';
        } catch (Exception $e) {
            echo 'Eroare la afișarea utilizatorului: ' . $e->getMessage();
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_login' => $_POST['user_login'],
                'user_password' => $_POST['user_password'],
                'user_full_name' => $_POST['user_full_name'],
                'user_mail' => $_POST['user_mail'],
                'user_status' => $_POST['user_status'],
                'user_secret_key' => $_POST['user_secret_key'],
                'permission_permission_id' => $_POST['permission_permission_id'],
            ];

            try {
                $this->userManager->create($data);
                header('Location: routerController.php?route=user&action=view&user_id=' . $data['user_id']);
                exit;
            } catch (Exception $e) {
                echo 'Eroare la crearea utilizatorului: ' . $e->getMessage();
            }
        } else {
            include 'view/user/create.php';
        }
    }

    public function update($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $userId,
                'user_login' => $_POST['user_login'],
                'user_password' => $_POST['user_password'],
                'user_full_name' => $_POST['user_full_name'],
                'user_mail' => $_POST['user_mail'],
                'user_status' => $_POST['user_status'],
                'user_secret_key' => $_POST['user_secret_key'],
                'permission_permission_id' => $_POST['permission_permission_id'],
            ];

            try {
                $this->userManager->update($data);
                header('Location: routerController.php?route=user&action=view&user_id=' . $userId);
                exit;
            } catch (Exception $e) {
                echo 'Eroare la actualizarea utilizatorului: ' . $e->getMessage();
            }
        } else {
            try {
                $user = $this->userManager->getById($userId);
                include 'view/user/update.php';
            } catch (Exception $e) {
                echo 'Eroare la afișarea formularului de actualizare: ' . $e->getMessage();
            }
        }
    }

    public function delete($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->userManager->delete($userId);
                header('Location: routerController.php?route=user');
                exit;
            } catch (Exception $e) {
                echo 'Eroare la ștergerea utilizatorului: ' . $e->getMessage();
            }
        } else {
            try {
                $user = $this->userManager->getById($userId);
                include 'view/user/delete.php';
            } catch (Exception $e) {
                echo 'Eroare la afișarea paginii de confirmare a ștergerii: ' . $e->getMessage();
            }
        }
    }
}
