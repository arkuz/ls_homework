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

<?php
// Расшифровка кодов ошибок для вывода пользователю.

if (!isset($email)) {
    $email = '';
}

$errors_text = [
    1 => 'name is empty',
    2 => 'email is empty',
    3 => 'password is empty',
    4 => 'password must be more than 4 characters',
    5 => 'passwords don\'t match',
    6 => "user with email '$email' is alredy exist",
    7 => 'email is empty',
    8 => 'password is empty',
    9 => 'user with this username / password was not found',
];

?>
<?php
// Вывод ошибок
/** @var array $error */ ?>
<?php if (isset($error)): ?>
    <ul style="color: red;">
        <?php foreach ($errors_text as $key => $value): ?>
            <?php if (in_array($key, $error)): ?>
                <li>
                    <?= $value ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>