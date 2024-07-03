<?php

use manager\controller\UserController;

// Exemple de configuration basique des routes
$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'view':
                $controller->view($_GET['user_id']);
                break;
            case 'update':
                $controller->update($_GET['user_id']);
                break;
            case 'delete':
                $controller->delete($_GET['user_id']);
                break;
            default:
                // Gestion d'une action non reconnue
                break;
        }
    } else {
        // Gestion de la requête GET sans action spécifiée
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $controller->create();
                break;
            default:
                // Gestion d'une action POST non reconnue
                break;
        }
    } else {
        // Gestion de la requête POST sans action spécifiée
    }
}
