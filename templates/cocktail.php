<h1>Cocktail</h1>

<div class="card mb-3" style="max-width: 70vw;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="templates/www/img/<?= $params['cocktail']['picture'] ?>" class="rounded mx-auto d-block mt-4" alt="templates/www/img/<?= $params['cocktail']['picture'] ?>">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $params['cocktail']['name'] ?>
                    <?php if (Session::isAdmin()) : ?>
                        <p><a href="index.php?page=edit&id=<?= $params['cocktail']['id'] ?>" class='btn btn-info'>Edit</a></p>
                    <?php endif; ?>
                </h5>
                <p class="card-text"><?= htmlspecialchars_decode($params['cocktail']['content'])  ?></p>
                <p class="card-text">
                    Ingrédients
                <ul>
                    <?php foreach ($params['ingredients'] as $el) : ?>
                        <li><small class="text-muted"><?= $el['name'] ?></small></li>
                    <?php endforeach; ?>
                </ul>
                </p>
            </div>
        </div>
    </div>
</div>