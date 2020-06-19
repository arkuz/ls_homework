<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Данные формы</title>
</head>
<a href="/user/logout/">Logout</a>
<a href="/posts/">Posts</a>
<h2>Admin panel</h2>
<body>

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
                <a href="/admin/posts/delete?post_id=<?= "{$value['id']}" ?>">Удалить</a>
            </p>
            <?= "{$value['message']}" ?>
        </div>
        <br>
    <?php endforeach; ?>
<?php endif; ?>


</body>
</html>