<?php 
require_once 'CocktailController.php' 
?>

<h1>Cocktails Page d'ajout</h1>

<?php if ($user = Session::getLogged()) : ?>
    <?= $user['name'] . ' peut ajouter un cocktail' ?>
<?php endif; ?>

<!-- Afficher la liste des cocktails présent en bdd -->
Formulaire d'ajout de Cocktail

<!-- un nom, un alcohol, 2-3 ingrédients -->
<form action="index.php?page=add_cocktail" method='post'>

    <label for="name">Cocktail name: </label>
    <input type="text" name='name'>

    <label for="content">Description: </label>
    <textarea name="content" id="content" cols="20" rows="10"></textarea>

    <label for="ingredients">Choose ingredients: </label>
    <input type="checkbox" id="ingredients" name="ingredients">

    <label for="alcohol">Choose alcohol :</label>
    <select name="alcohol" id="alcohol-select">
        <option value="">--Please choose an option--</option>
        <? foreach ($alcohols as $alcohol): ?>
            <option value="alcohol" name="alcohol"></option>
        <? endforeach; ?>
    </select>
    

    <input type="submit" class='btn btn-primary' value="Ajout">
</form>