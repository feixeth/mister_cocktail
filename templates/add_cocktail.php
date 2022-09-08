<h1>Cocktails Page d'ajout</h1>

<!-- Afficher la liste des cocktails présent en bdd -->
<h2>Formulaire d'ajout de Cocktail</h2>
<!-- un nom, un alcohol, 2-3 ingrédients -->
<form action="index.php?page=add_cocktail" method='post' enctype="multipart/form-data">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-martini-glass-citrus"></i></span>
        <input type="text" class="form-control" placeholder="Username" name='name' aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name='content' rows="3"></textarea>
    </div>

    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name='picture'>
        <label class="input-group-text" for="inputGroupFile02">Photo</label>
    </div>

    <select class="form-select" aria-label="Default select example" name='alcohol_id'>
        <option selected>Choisir un alcool</option>
        <?php foreach ($params['alcools'] as $alcool) : ?>
            <option value="<?= $alcool['id'] ?>"><?= $alcool['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <fieldset>
        <legend>Liste des ingrédients disponibles</legend>
        <?php foreach ($params['ingredients'] as $ingredient) : ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name='ingredients[]' value="<?= $ingredient['id'] ?>" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault"><?= $ingredient['name'] ?></label>
            </div>
        <?php endforeach; ?>
    </fieldset>
    <br>
    <input type="submit" class='btn btn-primary' value="Ajout">
</form>