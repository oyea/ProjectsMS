<?php if (!$tid) {
    echo "<br>" . "<div class=' w-50 text-center text-dark'><img class='icon' src='views/imgs/icons/animatedX.gif'> No Task To view </div>";
} ?>
<?php
$uid = $_SESSION['uid'];
$role = $_SESSION['role'];

$disabled = (!isAssigned('tasks', $tid, $uid) && !isAdmin($role) && !isAuthor('tasks', $tid, $uid)) ? "disabled" : "";
?>

<main class="container">
    <?php $tasks = $db->read('tasks', 'id = ?', array($tid));
    foreach ($tasks as $row) {  ?>
        <div>
            <a title="Copy" onclick="return confirm('Are you sure you want to Copy?')"
                href="taskcopy?tid=<?= $tid ?>&pid=<?= $row['project']; ?>">
                <img class="icon" src="views/imgs/icons/copy.png"></a>

            <a href="taskextcopyview?tid=<?= $tid ?>" class="btn btn-success"
                onclick="window.open(this.href, '_blank', 'width=600,height=200,top=190,left=350,menubar=no,toolbar=no,location=no,status=no'); return false;">External
                Copy</a>
            <form method="POST" action="taskdelete?tid=<?= $tid ?>&pid=<?= $row['project']; ?>" style="display: inline-block;">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"]; ?>">
                <button class="<?= $disabled ?>" title="Delete" onclick="return confirm('Are you sure you want to Delete?')"
                    href="taskdelete?tid=<?= $tid ?>&pid=<?= $row['project']; ?>">
                    <img class="icon \" src="views/imgs/icons/delete.png"></button>
            </form>
        </div>
        <div class="container mt-2">
            <div class="d-inline-block">
                <div class="card mb-2 w-auto">
                    <div class="card-header h5 d-flex flex-row justify-content-between">
                        <div> Task's Info </div>
                        <div class=""><a class="<?= $disabled ?>" title="Edit"
                                href="taskupdate?tid=<?= $tid ?>&pid=<?= $row['project']; ?>">
                                <img class="icon " src="views/imgs/icons/edit.png"></a></div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-borderless rounded rounded-5 w-auto">
                            <tr>
                                <th class="text-dark rounded">Title</th>
                                <td class="h5 text-wrap" style="width: 20rem;"><?= $row['title']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Project</th>
                                <td><a href="project?id=<?php echo $row['project'] ?>"><?= project($row['project']); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Category</th>
                                <td><?= taskcateg($row['category']); ?></td>
                            </tr>
                            <?php if ($row['subcat']) { ?>
                                <tr>
                                    <th class="text-dark rounded">Sub Category</th>
                                    <td><?= tasksubcateg($row['subcat']); ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th class="text-dark rounded">Revision No.</th>
                                <td><?= $row['revno']; ?></td>
                            </tr>
                            <?php if ($row['conshrs']) { ?>
                                <tr>
                                    <th class="text-dark rounded">Consumed Hours</th>
                                    <td><?= $row['conshrs']; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th class="text-dark rounded">Progress</th>
                                <td><?= ($row['progress'] == "100") ? "Completed" : "Pending"; ?></td>
                            </tr>
                            <?php if ($row['dayscount']) { ?>
                                <tr>
                                    <th class="text-dark rounded">Days Taken</th>
                                    <td><?= $row['dayscount']; ?></td>
                                </tr> <?php } ?>
                            <?php if ($row['weight']) { ?>
                                <tr>
                                    <th class="text-dark rounded">Weight</th>
                                    <td><?= $row['weight']; ?></td>
                                </tr><?php } ?>
                            <?php if ($row['score']) { ?>
                                <tr>
                                    <th class="text-dark rounded">Score</th>
                                    <td><?= $row['score']; ?></td>
                                </tr><?php } ?>

                        </table>

                    </div>
                </div>
            </div>
            <div class="d-inline-block">
                <div class="card mb-2 w-auto ml-2">
                    <div class="card-header h5 d-flex flex-row justify-content-between">
                        <div>Task's Dates</div>
                        <img class="icon" src="views/imgs/icons/calendar.png">
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-borderless rounded rounded-5 w-auto">
                            <tr>
                                <th class="text-dark rounded">Letter No</th>
                                <td><?= $row['letterno']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Letter Date</th>
                                <td><?= $row['letterdate']; ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Received Date</th>
                                <td><?= $row['recedate']; ?></td>
                            </tr>
                            <?php if ($row['replydate']) { ?>
                                <tr>
                                    <th class="text-dark rounded">Reply Date</th>
                                    <td><?= $row['replydate']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-dark rounded">Reply No</th>
                                    <td><?= $row['replyno']; ?></td>
                                </tr><?php } ?>
                            <tr>
                                <th class="text-dark rounded">Created on</th>
                                <td><?= $row['cdate']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Task users !-->

            <div class="d-block" style="width:30%;">
                <div class="card mb-2 w-auto ml-2">
                    <div class="card-header h5 d-flex flex-row justify-content-between">
                        <div>Responsible Users</div>
                        <img class="icon" src="views/imgs/icons/employees.png">
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-borderless rounded rounded-5 w-auto">
                            <tr>
                                <th class="text-dark rounded">Assigned To</th>
                                <td><?= user($row['assignuser']); ?></td>
                            </tr>
                            <tr>
                                <th class="text-dark rounded">Created By</th>
                                <td><?= user($row['author']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            // make the notifications read
            $link = substr($_SERVER['REQUEST_URI'], 1);
            readNotification($db, $_SESSION['uid'], $link);
            ?>


        <?php } ?>
        <!-- Task's user  -->

</main>