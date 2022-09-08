<h2>Login</h2>

<form action="index.php?page=login" method="post">
    <?php if (isset($params) && isset($params['error'])) : ?>
        <p class="alert alert-danger">
            <?= $params['error'] ?>
        </p>
    <?php endif; ?>
    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Email address</label>
        <input type="email" name='email' class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" autofocus>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput3" class="form-label">Password</label>
        <input type="password" name='password' class="form-control" id="exampleFormControlInput3">
    </div>
    <button class="btn btn-primary">Se connecter</button>
</form>