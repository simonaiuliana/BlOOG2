
<?php
// Utiliser $user (objet User) récupéré du contrôleur pour afficher les détails
?>

<h1>Details de l'utilisitaeur</h1>
<p>User ID: <?php echo $user->getId(); ?></p>
<p>Login: <?php echo $user->getLogin(); ?></p>
<p>Nom: <?php echo $user->getFullName(); ?></p>
<p>Email: <?php echo $user->getEmail(); ?></p>
<p>Status: <?php echo $user->getStatus(); ?></p>

<a href="routerController.php?action=update&user_id=<?php echo $user->getId(); ?>">Update User</a>
<a href="routerController.php?action=delete&user_id=<?php echo $user->getId(); ?>">Delete User</a>
