<h1>Home Page</h1>
<?php if ($user = Session::getUser()) : ?>
    <?= 'Hey ! Mon pti nom c\'est ' . $user['name'] ?>
<?php endif; ?>