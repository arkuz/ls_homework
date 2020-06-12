<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Данные формы</title>
</head>
<a href="/user/logout/">Logout</a>
<h2>Admin panel</h2>
<body>

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
                <a href="/admin/posts/delete?id=<?= "{$value['id']}" ?>">Удалить</a>
            </p>
            <?= "{$value['message']}" ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


</body>
</html>