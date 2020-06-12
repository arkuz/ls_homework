<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Данные формы</title>
</head>

<body>
<h2>Login</h2>
<form action="/user/login/" method="post">
    <p>Email <input name="email" value="art@example.com"></p>
    <p>Pass<input name="password" value="1234"></p>
    <p><input type="submit" value="Login"></p>
</form>

<br>
<br>

<h2>Register</h2>
<form action="/user/register/" method="post">
    <p>Name <input name="name" value="Artem"></p>
    <p>Email <input name="email" value="art@example.com"></p>
    <p>Pass<input name="password" value="1234"></p>
    <p>Confirm pass<input name="password2" value="1234"></p>
    <p><input type="submit" value="Register"></p>
</form>

<?php /** @var array $error */ ?>
<?php if (isset($error) ): ?>
    <ul style="color: red;">
        <?php foreach ($error as $value): ?>
            <li>
                <?= $value ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>