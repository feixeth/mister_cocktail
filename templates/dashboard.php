<!-- Suggestion d'évolution :
    1 - Refaire le dashboard avec des form traditionnel en php
    2 - Refaire le dashboard avec vue.js
-->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total cocktail's recipes</div>
                            <div id='recipes_count' class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo count($params['cocktails']) ?>
                                <?php // usage de getNbCocktails
                                // echo $params['cocktails']['nb']
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-martini-glass-citrus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nb Ingredients</div>
                            <div id='ingredients_count' class="h5 mb-0 font-weight-bold text-gray-800"><?= count($params['ingredients']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alcohols
                            </div>
                            <div id='alcohols_count' class="h5 mb-0 font-weight-bold text-gray-800"><?= count($params['alcohols']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-wine-bottle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Users</div>
                            <div id='users_count' class="h5 mb-0 font-weight-bold text-gray-800"><?= count($params['users']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Cocktail's recipes</h6>
            </div>
            <div class="card-body">
                <div class="main-card mb-3 card">
                    <div class="table-responsive">
                        <table id='cocktail_crud' class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Alcohol</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($params['cocktails'] as $cocktail) : ?>
                                    <tr>
                                        <td class="text-center text-muted"><?= $cocktail['id'] ?></td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class=""><?= $cocktail['name'] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-muted"><?= ucfirst($cocktail['alcool']) ?></div>
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?page=edit_cocktail?id=<?= $cocktail['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <button id='del_<?= $cocktail['id'] ?>' data-id='<?= $cocktail['id'] ?>' class="btn btn-danger btn-sm">Del</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ingredients List </h6>
                    <!-- Version écoute en js -> traitement en ajax -->
                    <button id='add_ingredient' class="btn btn-info btn-sm">Ajouter</button>
                    <!-- Version écoute en php -> avec refresh -->
                    <!-- <a href="index.php?page=add_ingredient" id='add_alcohol' class="btn btn-info btn-sm">Ajouter</a> -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id='form_ingredient' class="hide">
                            <label for="name">Nom : </label>
                            <input type="text" name='name'>
                            <button class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id='ingredient_crud' class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($params['ingredients'] as $ingredient) : ?>
                                    <tr>
                                        <td class="text-center text-muted"><?= $ingredient['id'] ?></td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class=""><?= ucfirst($ingredient['name']) ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?page=edit_ingredient?id=<?= $ingredient['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="#" id='del_<?= $ingredient['id'] ?>' data-id='<?= $ingredient['id'] ?>' class="btn btn-danger btn-sm">Del</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Alcohols list</h6>
                    <!-- Version écoute en js -> traitement en ajax -->
                    <button id='add_alcohol' class="btn btn-info btn-sm">Ajouter</button>
                    <!-- Version écoute en php -> avec refresh -->
                    <!-- <a href="index.php?page=add_alcohol" id='add_alcohol' class="btn btn-info btn-sm">Ajouter</a> -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id='form_alcohol' class="hide">
                            <label for="name">Nom : </label>
                            <input type="text" name='name'>
                            <button class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                    <div class="chart-pie pt-1 pb-2">
                        <div class="table-responsive">
                            <table id='alcohol_crud' class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Name</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($params['alcohols'] as $alcohol) : ?>
                                        <tr>
                                            <td class="text-center text-muted"><?= $alcohol['id'] ?></td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class=""><?= ucfirst($alcohol['name']) ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a href="index.php?page=edit_alcohol?id=<?= $alcohol['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="#" id='del_<?= $alcohol['id'] ?>' data-id='<?= $alcohol['id'] ?>' class="btn btn-danger btn-sm">Del</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>