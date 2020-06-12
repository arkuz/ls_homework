<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Данные формы</title>
</head>
<a href="/user/logout/">Logout</a>
<body>
<h2>Posts</h2>
<form action="/posts/send/" method="post">
    <p>
        Message<br>
        <textarea name="message">Привет, как дела?</textarea>
    </p>
    <p><input type="submit" value="Send"></p>
</form>

<br>
<br>

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


<?php /** @var array $posts */ ?>
<?php if (isset($posts)): ?>
    <?php foreach ($posts as $value): ?>
        <div>
            <p>
                <b><?= "{$value['name']}  {$value['datetime']}" ?></b>
            </p>
            <?= "{$value['message']}" ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


</body>
</html>