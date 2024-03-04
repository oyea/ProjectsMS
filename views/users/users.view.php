
<main class="container">
    <div>
        <div class="text-end">
            <form action="users" method="POST">
                <input type="text" id="search" name="search" title="Enter any part of the name" value="<?= $search ?>">
                <select name="approved">
                    <option value="all" <?= ($approved == '') ? "SELECTED" : "" ?>>All</option>
                    <option value="0" <?= ($approved  == '0') ? "SELECTED" : "" ?>>unapproved</option>
                    <option value="1" <?= ($approved  == '1') ? "SELECTED" : "" ?>>approved</option>
                </select>
                <select name="limit">
                    <option value="100" <?= ($limit == '100') ? "SELECTED" : "" ?>>100</option>
                    <option value="200" <?= ($limit == '200') ? "SELECTED" : "" ?>>200</option>
                    <option value="300" <?= ($limit == '300') ? "SELECTED" : "" ?>>300</option>
                    <option value="400" <?= ($limit == '400') ? "SELECTED" : "" ?>>400</option>
                    <option value="500" <?= ($limit == '500') ? "SELECTED" : "" ?>>500</option>
                    <option value="1000" <?= ($limit == '1000') ? "SELECTED" : "" ?>>1000</option>
                    <option value="<?= count($countusers) ?>" <?= ($limit == count($countusers)) ? "SELECTED" : "" ?>>
                        All</option>
                </select>
                <button type="submit" name="searchbtn" class="removebtnstyle"><img src="/views/imgs/icons/search.png" class="icon"></button>
            </form>
        </div>
        <!-- <form method="POST" name="multiactions" action="">
            <a href="/projectnew" class="btn btn-success btn-md">New Project</a>
            <input type="button" name="marchive" value="Archive" onClick="setArchiveAction();"
                class="btn btn-warning btn-sm ml-1">
            <input type="button" name="mdelete" value="Delete" onClick="setDeleteAction();"
                class="btn btn-danger btn-sm ml-1"> -->

    </div>
    <div class="container mt-2">
        <div class="">
            <a class="btn btn-success mb-1 mx-1" href="usernew">Add User
                <img src="/views/imgs/icons/adduser.png" width="30" height="30">
            </a>
        </div>
        <table class="table table-striped rounded rounded-5 overflow-hidden text-center">
            <thead class="bg-success text-light">
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>User/Badge</th>
                    <th>Full Name</th>
                    <th>Approved</th>
                    <th>Joining Date</th>
                    <th>Vacation Balance</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            $where = "";
            $params = array();
            if (!empty($search)) {

                $where .= 'name LIKE ? OR user LIKE ?';
                $newsearch = "%" . $search . "%";
                $params[] = $newsearch;
                $params[] = $newsearch;
            }
            if (isset($approved) && $approved != "all") {
                if ($where) {
                    $where .= " AND ";
                }
                $where .= 'approved = ?';
                $params[] = $approved;
            }
            $users = $db->read('users', $where, $params, $limit, null, 'id');
            foreach ($users as $user) {
            ?>
                <!-- disabe if not author or admin -->
                <?php $disable =  authBtns($_SESSION['uid'], $user['id'], $_SESSION['role']); ?>
                <?php $adminDisable =  isadmin($_SESSION['role']); ?>

                <?php if ($user['approved'] == "0") {
                    $class = "linethru";
                } else {
                    $class = "";
                } ?>

                <tr class="<?= $class ?>">
                    <td><?= $user['id']; ?></td>
                    <td>
                        <img src="<?= ($user['image'] ?? "views/imgs/guest.png") ?>" alt="<?= $user['name']; ?>" class="userimg scale2">
                    </td>
                    <td><?= $user['user']; ?></td>
                    <td><a href="userview?id=<?= $user['id']; ?>"><?= $user['name']; ?></a></td>
                    <td><?= $user['approved'] == '1' ? 'Yes' : 'No'; ?></td>
                    <td><?= $user['joiningdate']; ?></td>
                    <td><?= $user['vacbalance']; ?></td>

                    <td>
                        <a title="Edit" href="userupdate?id=<?= $user['id'] ?>" class="<?= $disable ?>"><img class="icon" src="views/imgs/icons/edit.png"></a>
                        <a title="Delete" onclick="return confirm('Are you sure you want to Delete?')" href="userdelete?id=<?= $user['id'] ?>" class="<?= (!$adminDisable) ? "disabled" : "";  ?> "><img class="icon" src="views/imgs/icons/delete.png"></a>
                        <?php if ($user['approved'] == 1) { ?>
                            <a title="Block" onclick="return confirm('Are you sure you want to Block <?= $user['name'] ?> ?')" href="userblock?id=<?= $user['id'] ?>" class="<?= (!$adminDisable) ? "disabled" : "";  ?> "><img class="icon" src="views/imgs/icons/banuser.png"></a>
                        <?php } ?>
                    </td>
                </tr>

            <?php } ?>
        </table>
        <!-- </form> -->
    </div>
</main>