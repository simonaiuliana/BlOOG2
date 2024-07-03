
<?php
// Utiliser $user (objet User) récupéré du contrôleur pour pré-remplir le formulaire
?>

<form action="routerController.php?action=update" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">

    <label for="user_login">Login:</label>
    <input type="text" id="user_login" name="user_login" value="<?php echo $user->getLogin(); ?>" required><br><br>

    <label for="user_password">Password:</label>
    <input type="password" id="user_password" name="user_password" required><br><br>

    <label for="user_full_name">Full Name:</label>
    <input type="text" id="user_full_name" name="user_full_name" value="<?php echo $user->getFullName(); ?>"><br><br>

    <label for="user_mail">Email:</label>
    <input type="email" id="user_mail" name="user_mail" value="<?php echo $user->getEmail(); ?>"><br><br>

    <label for="user_status">Status:</label>
    <select id="user_status" name="user_status">
        <option value="active" <?php if ($user->getStatus() == 'active') echo 'selected'; ?>>Active</option>
        <option value="inactive" <?php if ($user->getStatus() == 'inactive') echo 'selected'; ?>>Inactive</option>
    </select><br><br>

    <button type="submit">Update User</button>
</form>
