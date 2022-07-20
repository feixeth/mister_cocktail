<h2>Signin</h2>
<form action="index.php?page=signin" method="post">
    <?php if (isset($params) && isset($params['error'])) : ?>
        <p class="alert alert-danger">
            <?= $params['error'] ?>
        </p>
    <?php endif; ?>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input type="text" class="form-control" name='name' id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Email address</label>
        <input type="email" class="form-control" name='email' id="exampleFormControlInput2" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput3" class="form-label">Password</label>
        <input type="password" class="form-control" name='password' id="exampleFormControlInput3">
    </div>
    <button class="btn btn-primary">Enregistrer</button>
</form>