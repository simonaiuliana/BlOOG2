<?php

namespace manager\controller;

use model\Manager\UserManager;

class UserController
{
    protected UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function create()
    {
        // Implementează logica pentru crearea unui nou utilizator
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesează datele din formular
            $userData = [
                'user_login' => $_POST['user_login'],
                'user_password' => $_POST['user_password'],
                'user_full_name' => $_POST['user_full_name'],
                'user_mail' => $_POST['user_mail'],
                'user_status' => $_POST['user_status']
                // Adaugă și alte câmpuri necesare pentru crearea utilizatorului
            ];

            try {
                $this->userManager->create($userData);
                // Redirect către pagina de listare a utilizatorilor sau altă acțiune după creare
                header('Location: index.php'); // Exemplu de redirecționare
                exit;
            } catch (Exception $e) {
                // Gestionează eroarea de creare utilizator
                echo 'Eroare la crearea utilizatorului: ' . $e->getMessage();
            }
        } else {
            // Afișează formularul de creare utilizator
            include 'view/user/create.php';
        }
    }

    public function view(int $userId)
    {
        // Implementează logica pentru afișarea detaliilor utilizatorului
        try {
            $user = $this->userManager->getById($userId);
            // Afisează pagina cu detaliile utilizatorului
            include 'view/user/view.php';
        } catch (Exception $e) {
            // Gestionează eroarea de afișare a utilizatorului
            echo 'Eroare la afișarea utilizatorului: ' . $e->getMessage();
        }
    }

    public function update(int $userId)
    {
        // Implementează logica pentru actualizarea utilizatorului
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesează datele din formular
            $userData = [
                'user_id' => $userId,
                'user_login' => $_POST['user_login'],
                'user_password' => $_POST['user_password'],
                'user_full_name' => $_POST['user_full_name'],
                'user_mail' => $_POST['user_mail'],
                'user_status' => $_POST['user_status']
                // Adaugă și alte câmpuri necesare pentru actualizarea utilizatorului
            ];

            try {
                $this->userManager->update($userData);
                // Redirect către pagina de detaliu a utilizatorului sau altă acțiune după actualizare
                header('Location: index.php?action=view&user_id=' . $userId); // Exemplu de redirecționare
                exit;
            } catch (Exception $e) {
                // Gestionează eroarea de actualizare a utilizatorului
                echo 'Eroare la actualizarea utilizatorului: ' . $e->getMessage();
            }
        } else {
            // Afisează formularul de actualizare a utilizatorului
            try {
                $user = $this->userManager->getById($userId);
                // Afisează formularul cu datele utilizatorului de actualizat
                include 'view/user/update.php';
            } catch (Exception $e) {
                // Gestionează eroarea de afișare a formularului de actualizare
                echo 'Eroare la afișarea formularului de actualizare: ' . $e->getMessage();
            }
        }
    }

    public function delete(int $userId)
    {
        // Implementează logica pentru ștergerea utilizatorului
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesează ștergerea utilizatorului
            try {
                $this->userManager->delete($userId);
                // Redirect către pagina de listare a utilizatorilor sau altă acțiune după ștergere
                header('Location: index.php'); // Exemplu de redirecționare
                exit;
            } catch (Exception $e) {
                // Gestionează eroarea de ștergere a utilizatorului
                echo 'Eroare la ștergerea utilizatorului: ' . $e->getMessage();
            }
        } else {
            // Afisează pagina de confirmare a ștergerii utilizatorului
            try {
                $user = $this->userManager->getById($userId);
                // Afisează pagina cu confirmarea ștergerii utilizatorului
                include 'view/user/delete.php';
            } catch (Exception $e) {
                // Gestionează eroarea de afișare a paginii de confirmare a ștergerii
                echo 'Eroare la afișarea paginii de confirmare a ștergerii: ' . $e->getMessage();
            }
        }
    }
}
