
<?php
// Utiliser $user (objet User) récupéré du contrôleur pour afficher les informations de confirmation
?>

<h1>Confirmer la suppression</h1>
<p>Êtes-vous sûr de vouloir supprimer l'utilisateur avec ID ?<?php echo $user->getId(); ?>?</p>

<form action="routerController.php?action=delete" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
    <button type="submit">Delete User</button>
    <a href="routerController.php?action=view&user_id=<?php echo $user->getId(); ?>">Cancel</a>
</form>
