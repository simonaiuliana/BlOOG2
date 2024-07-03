<?php
 namespace manager\controller;
 define('PROJECT_DIRECTORY',__DIR__);
// si le paramètre route est défini dans l'url,
// on le récupère, sinon on le définit à 'home'
$controller = new UserController();
$route = $_GET['route'] ?? 'home';

switch ($route) {

    case 'home':
        # affichage de la page d'accueil (vue)
        include_once PROJECT_DIRECTORY.'/view/homepage.view.php';
        break;
    case 'article':
        # todo
        echo 'article à gérer';
        break;
    case 'category':
        echo 'category à gérer';
        break;
    # controller déjà présent
    case 'comment':
        # c'est lui qui va gérer les actions sur les commentaires
        # et afficher les vues associées
        require 'commentController.php';
        break;
    case 'permission':
        # todo
        echo 'permission à gérer';
        break;
    case 'user':
        class UserController extends routerController {
            public function execute(){
            $this->view = new view('user');
            $action = $_GET['action'] ?? 'list';
    
            switch ($action) {
                case 'view':
                    $controller->view($_GET['user_id']);
                    break;
                case 'create':
                    $controller->create();
                    break;
                case 'update':
                    $controller->update($_GET['user_id']);
                    break;
                case 'delete':
                    $controller->delete($_GET['user_id']);
                    break;
                default:
                    echo 'Acction inconue';
                    break;
            }
        public function create(){
            $user_full_name = $_POST['user_full_name'];
            $user_mail = $_POST['user_mail'];
            $user_password = $_POST['user_password']; 
         if (empty($user_full_name) || empty($user_mail) || empty($user_password)){
            echo 'Veuillez remplir tous les champs';
            return;
         }
         $user = new User();
         $user->setUsername($user_full_name);
         $user->setEmail($user_mail);
         $user->setPassword(password_hash($user_password, PASSWORD_BCRYPT));

         $userDao = new userDao();
         $userDao->create($user);
        }
        public function update($userId){
          $user_full_name = $_POST['user_full_name'];
          $user_mail = $_POST['user_mail'];
          $user_password = $_POST['user_password']; 
          $user = new User();
          $user->setId($userId);
          $user->setUsername($user_full_name);
          $user->setEmail($user_mail);
          if (!empty($user_password)) {
                      $user->setPassword(password_hash($user_password, PASSWORD_BCRYPT));
                  }
          $userDao = new userDao();
          $userDao->update($user);        
        }
        public function delete($userId){
                        $userDao = new UserDao();
                        $userDao->delete($userId);
                    }
                    public function view($userId){
                        $userDao = new UserDao();
                        $user = $userDao->get($userId);
                        // afficher les détails de l'utilisateur
                    }
                }
                $controller = new UserController();
                $controller->execute();
                break;

    case 'file':
        # todo
        echo 'file à gérer';
        break;
    case 'tag':
        # todo
        echo 'tag à gérer';
        break;
    default:
        # affichage de la page 404
        require PROJECT_DIRECTORY.'/view/404.view.php';
        break;
}}
 /*if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['route']) && $_GET['route'] === 'user') {
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
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $controller->create();
                break;
            case 'delete':
                $controller->delete($_POST['user_id']);
                break;
            default:
                // Gestion d'une action POST non reconnue
                break;
        }
    } else {
        // Gestion de la requête POST sans action spécifiée
    }
}*/