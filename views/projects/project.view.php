<?php require("auth.php"); ?>
<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php'); ?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>
<?php $db = new Db('localhost', 'root', 'root', 'projectsms'); ?>
<?php $pid = trim($_GET['id']); ?>
<?php require 'functions.php'; ?>
<?php if (!$pid) {
    echo "<br>" . "<div class=' w-50 text-center text-dark'><img class='icon' src='views/imgs/icons/animatedX.gif'> No Project To view </div>";
    die();
} ?>

<?php
$project = $db->read('projects', 'id = ?', array($pid));
foreach ($project as $row) {  ?>

    <?php $disable =  authBtns($_SESSION['uid'], $row['author'], $_SESSION['role']); ?>
    <main class="container">
        <div>
            <a href="tasknew?id=<?= $pid ?>" class="btn btn-success btn-md">New Task</a>
            <a title="Copy" onclick="return confirm('Are you sure you want to Copy?')" href="projectcopy?pid=<?= $pid ?>"><img class="icon" src="views/imgs/icons/copy.png"></a>
            <a title="Delete" onclick="return confirm('Are you sure you want to Delete?')" href="projectdelete?id=<?= $pid ?>" class="<?= $disable ?>"><img class="icon" src="views/imgs/icons/delete.png"></a>
        </div>
        <div class="container mt-2">
            <div class="d-inline-block">
                <div class="card mb-2 w-auto">
                    <div class="card-header h5 d-flex flex-row justify-content-between">
                        <div> Project Details </div>
                        <div class=""><a title="Edit" href="projectupdate?id=<?= $pid ?>" class="<?= $disable ?>">
                                <img class="icon" src="views/imgs/icons/edit.png"></a></div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-borderless rounded rounded-5 w-auto">
                            <tr>
                                <th class="text-dark rounded">Title</th>
                                <td class="h5 text-wrap" style="width: 20rem;"><?= $row['title']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">TOL</th>
                                <td><?= $row['tol']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">PTS</th>
                                <td><?= $row['pts']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Category</th>
                                <td><?= $row['category']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Status</th>
                                <td><?= ($row['archived'] == "0") ? "On-going" : "Archived"; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Created On</th>
                                <td><?= $row['cdate']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Author</th>
                                <td><?= user($row['author']); ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Contractor</th>
                                <td><?= $row['contractor']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Contract No.</th>
                                <td><?= $row['contractno']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Primary Assigned Eng.</th>
                                <td><?php user($row['primaryassigneng']); ?></td>
                            </tr>
                        </table>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <div class="d-inline-block">
                <div class="card mb-2 w-auto ml-2">
                    <div class="card-header h5 d-flex flex-row justify-content-between">
                        <div>Project Statistics</div>
                        <img class="icon" src="views/imgs/icons/statistics.png">
                    </div>
                    <div class="card-body">
                        <?php $pendingt = $db->read('tasks', 'project = ? AND progress=?', array($pid, '0')); ?>
                        <?php $completedt = $db->read('tasks', 'project = ? AND progress=?', array($pid, '100')); ?>
                        <table class="table table-hover table-borderless rounded rounded-5 w-auto">
                            <tr>
                                <th>Pending Tasks</th>
                                <td><?= count($pendingt); ?></td>
                            </tr>
                            <tr>
                                <th>Completed Tasks</th>
                                <td><?= count($completedt); ?></td>
                            </tr>
                        </table>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load("current", {
                                packages: ["corechart"]
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Task', 'Number'],
                                    ['Pending', <?= count($pendingt); ?>],
                                    ['Completed', <?= count($completedt); ?>]
                                ]);

                                var options = {
                                    title: 'Tasks',
                                    is3D: true,
                                    colors: ['#FA693E', '#198754'],
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('projectstats'));
                                chart.draw(data, options);
                            }
                        </script>
                        <div id="projectstats" class="scale" style="width: 400px; height: 200px;"></div>
                    </div>
                </div>
            </div>

            <!-- projects users !-->

            <div class="d-inline-block">
                <div class="card mb-2 w-auto ml-2">
                    <div class="card-header h5 d-flex flex-row justify-content-between">
                        <div>Project Users</div>
                        <img class="icon" src="views/imgs/icons/employees.png">
                    </div>
                    <div class="card-body">
                        <?php
                        $pusers = $db->read('projects_users', 'project_id = ?', array($pid));
                        foreach ($pusers as $userid) {
                            user($userid['userid']); ?>

                            <a title="Delete" onclick="return confirm(' Are you sure you want to delete <?= user($userid['userid']) ?> from this project?')" href="projectuserDel?uid=<?= $userid['userid'] ?>&pid=<?= $pid ?>" class="<?= $disable ?>"><img class="icon25" src="views/imgs/icons/delete.png"></a>
                            <br>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Project's Tasks  -->

            <div class="h4">Tasks</div>
            <?php
            $valid = new validate();
            $search = ($_POST['search']) ?? "";
            $valid->str($search);
            $limit = ($_POST['limit']) ?? 100;
            $progress = $_POST['progress'] ?? "all";
            $counttasks = $db->read('tasks', 'project=?', array($pid));
            ?>
            <div class="text-end">
                <form action="project?id=<?= $pid ?>" method="POST">
                    <input type="text" id="search" name="search" title="Enter any part of the title" value="<?= $search ?>">
                    <select name="progress">
                        <option value="0" <?= ($progress == '0') ? "SELECTED" : "" ?>>Pending</option>
                        <option value="100" <?= ($progress == '100') ? "SELECTED" : "" ?>>Completed</option>
                        <option value="all" <?= ($progress == 'all') ? "SELECTED" : "" ?>>All</option>
                    </select>
                    <select name="limit">
                        <option value="100" <?= ($limit == '100') ? "SELECTED" : "" ?>>100</option>
                        <option value="200" <?= ($limit == '200') ? "SELECTED" : "" ?>>200</option>
                        <option value="300" <?= ($limit == '300') ? "SELECTED" : "" ?>>300</option>
                        <option value="400" <?= ($limit == '400') ? "SELECTED" : "" ?>>400</option>
                        <option value="500" <?= ($limit == '500') ? "SELECTED" : "" ?>>500</option>
                        <option value="1000" <?= ($limit == '1000') ? "SELECTED" : "" ?>>1000</option>
                        <option value="<?= count($counttasks) ?>" <?= ($limit == count($counttasks)) ? "SELECTED" : "" ?>>
                            All</option>
                    </select>
                    <button type="submit" name="searchbtn" class="removebtnstyle"><img src="/views/imgs/icons/search.png" class="icon"></button>
                </form>
            </div>
            <table class="table table-striped rounded rounded-5 overflow-hidden">
                <thead class="bg-success text-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Received Date</th>
                        <th>Assigned Eng.</th>
                        <th>Progress</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                $where = "";
                $params = array();

                if ($search) {
                    $where .= "title LIKE ?";
                    $params[] = "%$search%";
                }

                if ($pid) {
                    if ($where) {
                        $where .= " AND ";
                    }
                    $where .= "project = ?";
                    $params[] = $pid;
                }

                if ($progress == "all" && !$search) {
                    // If "all" progress is selected and no search term is provided,
                    // no need to add any additional conditions for progress.
                } elseif ($progress !== "all") {
                    if ($where) {
                        $where .= " AND ";
                    }
                    $where .= "progress = ?";
                    $params[] = $progress;
                }
                $tasks = $db->read('tasks', $where, $params, $limit, null, 'id');
                foreach ($tasks as $row) {

                ?>

                    <?php
                    $uid = $_SESSION['uid'];
                    $role = $_SESSION['role'];
                    $tid = $row['id'];

                    $disabled = (!isAssigned('tasks', $tid, $uid) && !isAdmin($role) && !isAuthor('tasks', $tid, $uid)) ? "disabled" : "";
                    ?>

                    <?php if ($row['progress'] == "100") {
                        $class = "linethru";
                    } else {
                        $class = "";
                    } ?>
                    <tr class="<?= $class ?>">
                        <td><?= $row['id']; ?></td>
                        <td><a href="task?id=<?php echo $row['id'] ?>"><?= $row['title']; ?></a></td>
                        <td><?= $row['category']; ?></td>
                        <td><?= $row['recedate']; ?></td>
                        <td><?= user($row['assignuser']); ?></td>
                        <td><?= ($row['progress'] == 100) ? 'Completed' : 'Pending'; ?></td>
                        <td>
                            <a title="Copy" onclick="return confirm('Are you sure you want to Copy <?= $row['title']; ?> ?')" href="taskcopy?tid=<?= $row['id'] ?>">
                                <img class="icon" src="views/imgs/icons/copy.png"></a>
                            <a title="Edit" href="taskupdate?tid=<?= $row['id'] ?>&pid=<?= $pid ?>" class="<?= $disabled ?>">
                                <img class="icon" src="views/imgs/icons/edit.png"></a>
                            <a title="Delete" onclick="return confirm('Are you sure you want to Delete <?= $row['title']; ?> ?')" href="taskdelete?tid=<?= $row['id'] ?>&pid=<?= $pid ?>" class="<?= $disabled ?>">
                                <img class="icon" src="views/imgs/icons/delete.png"></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>

    <?php require($base . 'partials/footer.php'); ?>