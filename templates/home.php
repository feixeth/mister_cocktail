<h1>Home Page</h1>
<?php if ($user = Session::getLogged()) : ?>
    <?= 'Hey ! Mon pti nom c\'est ' . $user['name'] ?>
    <?php //echo 'Hey ! Mon pti nom c\'est ' . $session->getUserName()
    ?>
<?php endif; ?>