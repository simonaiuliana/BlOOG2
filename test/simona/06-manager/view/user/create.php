
<form action="routerController.php?action=create" method="POST">
    <label for="user_login">Login:</label>
    <input type="text" id="user_login" name="user_login" required><br><br>

    <label for="user_password">Password:</label>
    <input type="password" id="user_password" name="user_password" required><br><br>

    <label for="user_full_name">Full Name:</label>
    <input type="text" id="user_full_name" name="user_full_name"><br><br>

    <label for="user_mail">Email:</label>
    <input type="email" id="user_mail" name="user_mail"><br><br>

    <label for="user_status">Status:</label>
    <select id="user_status" name="user_status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select><br><br>

    <button type="submit">Create User</button>
</form>
