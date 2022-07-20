<h1>Cocktails Page</h1>

<?php if ($user = Session::getLogged()) : ?>
    <?= $user['name'] . ' a accès aux fonctionnalités d\'ajout de cocktails : ' ?>
    <a href="index.php?page=add_cocktail" class="btn btn-info">Ajouter un cocktail</a>
<?php endif; ?>

<!-- Afficher la liste des cocktails présent en bdd -->
<div class="card-group">
    <!-- Faire la boucle ici pour afficher les cocktails -->
    <?php foreach ($params as $cocktail) : ?>
        <div class="card w-25 p-3">
            <img src="templates/www/img/<?= $cocktail['picture'] ?>" class="card-img-top img-thumbnail" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $cocktail['name'] ?> <small>{<?= ucfirst($cocktail['alcool']) ?>}</small></h5>
                <p class="card-text"><?= $this->limitText($cocktail['content'], 50)  ?></p>
            </div>
            <div class="card-body">
                <a href="index.php?page=show&id=<?= $cocktail['id'] ?>" class="btn btn-primary">Show more</a>
                <?php if (Session::isAdmin()) : ?>
                    <a href="index.php?page=edit&id=<?= $cocktail['id'] ?>" class="btn btn-success">Edit</a>
                <?php endif; ?>

            </div>
        </div>
    <?php endforeach; ?>
</div>