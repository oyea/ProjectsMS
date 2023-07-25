<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php'); ?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>

<div class="container mt-3">
    <div class="d-inline-block w-50">
        <form action="userlogin" method="POST" class="w-50 ms-5">
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <input type="text" class="form-control" id="user" name="user">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-success">Login</button>
        </form>
    </div>
    <div class="d-inline-block">
        <video width="520" height="240" loop autoplay muted>
            <source src="/views/videos/PimsPm.mp4" type=" video/mp4">
        </video>
    </div>
</div>

<?php require($base . 'partials/footer.php'); ?>