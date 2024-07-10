<?php $base = __DIR__ . '/../'; ?>
<?php require("auth.php"); ?>
<?php require(dirname(dirname(__DIR__)) . "/functions.php"); ?>
<?php $db = new Db('localhost', 'root1', 'root', 'projectsms'); ?>
<?php $val = new validate(); ?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="" href="views/css/style.css">

<div class="container w-auto">
    <form action="taskextcopyContrl" method="POST" class="row">
        <div class="form-group mt-3">
            <label for="pid">Project *</label>
            <select id="pid" name="pid" class="custom-select" required>
                <?php $projects = $db->read('projects');
                foreach ($projects as $project) : ?>
                    <option value="<?= $project['id'] ?>"><?= $project['title'] ?></option>
                <?php endforeach; ?>
            </select>

        </div>
        <input type="hidden" name="tid" value="<?= $_GET['tid']; ?>">
        <div class="form-group mt-3">
            <button name="submit" type="submit" class="btn btn-primary w-25 offset-5">Copy</button>
            <a href="#" onclick="window.close();" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>