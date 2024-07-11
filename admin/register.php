<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="../includes/admin/register_inc.php" method="POST">
        <div>
            <input type="text" name="email" placeholder="Email">
        </div>
        <div>
            <input type="text" name="full_name" placeholder="Full name">
        </div>
        <div>
            <input type="text" name="password" placeholder="Password">
        </div>
        <div>
            <button type="submit" name="register_btn">Register</button>
        </div>
    </form>
</body>
</html>