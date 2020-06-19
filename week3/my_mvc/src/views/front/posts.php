<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Данные формы</title>
</head>
<a href="/user/logout/">Logout</a>
<a href="/admin/">Admin panel</a>

<body>
<h2>Posts</h2>
<form enctype="multipart/form-data" action="/posts/send/" method="post">
    <p>
        Message<br>
        <textarea name="message">Привет, как дела?</textarea><br>
        <input name="userfile" type="file">
    </p>
    <p><input type="submit" value="Send"></p>
</form>

<br>
<br>

<?php /** @var array $error */ ?>
<?php if (isset($error)): ?>
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
        <div style="border-style: solid;">
            <p>
                <b><?= "{$value['name']}  {$value['datetime']}" ?></b>
            </p>

            <?php if (!empty($value['img'])): ?>
                <img height="100" src='/img/<?= "{$value['img']}" ?>'><br>
            <?php endif; ?>

            <?= "{$value['message']}" ?>
        </div>
        <br>
    <?php endforeach; ?>
<?php endif; ?>


</body>
</html>