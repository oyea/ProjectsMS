
<main class="container">
    <div> 
        <div class="text-end">
            <form action="/" method="POST">
                <input type="text" id="search" name="search" title="Enter any part of the title" value="<?=$search?>">
                <select name="archived">
                    <option value="all" <?=($archived == '') ? "SELECTED" : ""?>>All</option>
                    <option value="0" <?=($archived == '0') ? "SELECTED" : ""?>>Unrchived</option>
                    <option value="1" <?=($archived == '1') ? "SELECTED" : ""?>>Archived</option>
                </select>
                <select name="limit">
                    <option value="100" <?=($limit == '100') ? "SELECTED" : ""?>>100</option>
                    <option value="200" <?=($limit == '200') ? "SELECTED" : ""?>>200</option>
                    <option value="300" <?=($limit == '300') ? "SELECTED" : ""?>>300</option>
                    <option value="400" <?=($limit == '400') ? "SELECTED" : ""?>>400</option>
                    <option value="500" <?=($limit == '500') ? "SELECTED" : ""?>>500</option>
                    <option value="1000" <?=($limit == '1000') ? "SELECTED" : ""?>>1000</option>
                    <option value="<?=count($countproject)?>"
                        <?=($limit == count($countproject)) ? "SELECTED" : ""?>>All</option>
                </select>
                <button type="submit" name="searchbtn" class="removebtnstyle"><img src="/views/imgs/icons/search.png"
                        class="icon"></button>
            </form>
        </div>
        <form method="POST" name="multiactions" action="">
            <a href="/projectnew" class="btn btn-success btn-md">New Project</a>
            <input type="button" name="marchive" value="Archive" onClick="setArchiveAction();"
                class="btn btn-warning btn-sm ml-1">
            <input type="button" name="mdelete" value="Delete" onClick="setDeleteAction();"
                class="btn btn-danger btn-sm ml-1">

    </div>
    <div class="container mt-2">

        <table class="table table-striped rounded rounded-5 overflow-hidden">
            <thead class="bg-success text-light">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>PTS</th>
                    <th>TOL</th>
                    <th>Status</th>
                    <th>Primary Eng.</th>
                    <th>Created Date</th>
                    <th></th>
                </tr>
            </thead>
            <?php
$where = "";
$params = array();
if (!empty($search)) {

    $where .= 'title LIKE ?';
    $newsearch = "%" . $search . "%";
    $params[] = $newsearch;
}
if (isset($archived) && $archived != "all") {
    if ($where) {
        $where .= " AND ";
    }
    $where .= 'archived = ?';
    $params[] = $archived;
}
$data = $db->read('projects', $where, $params, $limit, null, 'id');
foreach ($data as $row) {
    ?>
            <!-- disabe if not author or admin -->
            <?php $disable = authBtns($_SESSION['uid'], $row['author'], $_SESSION['role']);?>

            <?php if ($row['archived'] == "1") {
        $class = "linethru";
    } else {
        $class = "";
    }?>
            <tr class="<?=$class?>">
                <td><input type="checkbox" id="chkbox" name="chkbox[]" value="<?php echo $row['id']; ?>"
                        <?=$disable?>></td>
                <td><?=$row['id'];?></td>
                <td><a href="project?id=<?php echo $row['id'] ?>"><?=$row['title'];?></a>
                </td>
                <td><?=$row['pts'];?></td>
                <td><?=$row['tol'];?></td>
                <td><?=($row['archived'] == "0") ? "On-going" : "Archived";?></td>
                <td><?=user($row['primaryassigneng']);?></td>
                <td><?=$row['cdate'];?></td>
                <td>
                    <a title="Copy" onclick="return confirm('Are you sure you want to Copy?')"
                        href="projectcopy?pid=<?=$row['id']?>"><img class="icon" src="views/imgs/icons/copy.png"></a>

                    <a title="Edit" href="projectupdate?id=<?=$row['id']?>" class="<?=$disable?>"><img class="icon"
                            src="views/imgs/icons/edit.png"></a>
                    <a title="Delete" onclick="return confirm('Are you sure you want to Delete?')"
                        href="projectdelete?id=<?=$row['id']?>" class="<?=$disable?>"><img class="icon"
                            src="views/imgs/icons/delete.png"></a>
                    <?php if ($row['archived'] == 0) {?>
                    <a title="Archived" onclick="return confirm('Are you sure you want to Archive?')"
                        href="projectarchive?id=<?=$row['id']?>" class="<?=$disable?>"><img class="icon"
                            src="views/imgs/icons/folder.png"></a>
                    <?php }?>
                </td>
            </tr>
            <?php }?>
        </table>
        </form>
    </div>
</main>

