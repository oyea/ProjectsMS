<?php require("auth.php"); ?>
<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php'); ?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>
<?php require 'functions.php'; ?>
<!-- 
    colors codes
    Dark green : #198754
    Dark Gold : #f2b707
    Dark Red :  #db4437 
-->
<main>

    <div class="container">
        <h2 class="text-center mb-5">Projects Dashboard</h2>
        <div class="d-flex flex-row">
            <div class="p-2">
                <div class="h5">Projects</div>
                <table class="table table-striped table-hover shadow">
                    <tr class="bg-success text-light">
                        <th>Active Projects</th>
                        <th>Archived Projects</th>
                        <th class="bg-warning text-dark">Total</th>
                    </tr>
                    <tr>
                        <td><?= count($actproj) ?></td>
                        <td><?= count($archproj) ?></td>
                        <td><?= count($actproj) + count($archproj) ?></td>
                    </tr>
                </table>
                <canvas id="projstat" class="scale" style="width: 200px; height: 100px;"></canvas>
            </div>

            <div class="p-2">
                <div class="h5">Projects Categories Stats</div>
                <table class="table table-striped table-hover shadow">
                    <tr class="bg-success text-light">
                        <th>Status</th>
                        <th>HV</th>
                        <th>EHV</th>
                        <th>Maintenance</th>
                        <th class="bg-warning text-dark">Total</th>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td><?= count($hvProjects) ?></td>
                        <td><?= count($ehvProjects) ?></td>
                        <td><?= count($maintenanceProjects) ?></td>
                        <td><?= count($hvProjects)  + count($ehvProjects) + count($maintenanceProjects) ?>
                    </tr>
                    <tr>
                        <td>Archived</td>
                        <td><?= count($archhvProjects) ?></td>
                        <td><?= count($archehvProjects) ?></td>
                        <td><?= count($archmaintenanceProjects) ?></td>
                        <td><?= count($archhvProjects)  + count($archehvProjects) + count($archmaintenanceProjects) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-warning text-dark">Total</td>
                        <td><?= $tothv = count($archhvProjects) + count($hvProjects) ?></td>
                        <td><?= $totehv = count($archehvProjects) + count($ehvProjects) ?></td>
                        <td><?= $totmain = count($archmaintenanceProjects) + count($maintenanceProjects)  ?></td>
                        <td><?= $tothv + $totehv + $totmain ?>
                        </td>
                    </tr>
                </table>
                <canvas id="actarchprojcat" class="scale" style="width: 400px; height: 200px;"></canvas>
            </div>

            <div class="p-2">
                <div class="h5">Projects Stats in <span class="text-danger"><?= $curryear ?></span>
                </div>
                <table class="table table-striped table-hover shadow">
                    <tr class="bg-success text-light">
                        <th>Active Projects</th>
                        <th>Archived Projects</th>
                        <th class="bg-warning text-dark">Total</th>
                    </tr>
                    <tr>
                        <td><?= count($currYearActProj) ?></td>
                        <td><?= count($currYearArchProj) ?></td>
                        <td><?= count($currYearActProj) + count($currYearArchProj) ?></td>
                    </tr>
                </table>
                <canvas id="curryearProjStat" class="scale" style="width: 200px; height: 100px;"></canvas>
            </div>
        </div>

        <div class="d-flex flex-row">
            <div class="p-2">
                <div class="h5">Tasks</div>
                <table class="table table-striped table-hover shadow">
                    <thead class="bg-success text-light">
                        <tr>
                            <th class="bg-warning text-dark">Period</th>
                            <th>Pending</th>
                            <th>Replied</th>
                            <th class="bg-warning text-dark">Total</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>All Time</td>
                        <td><?= count($pendTasks) ?></td>
                        <td><?= count($compTasks) ?></td>
                        <td><?= count($pendTasks) + count($compTasks) ?></td>
                    </tr>
                    <tr>
                        <?php $tenDaysAgo = date('Y-m-d', strtotime(date('Y-m-d') . ' - 10 days')); ?>
                        <td>More than 10 Days <span class="text-danger ">(<?= $tenDaysAgo ?>)</span></td>
                        <td><?= count($penTasks10) ?></td>
                        <td><?= count($compTasks10) ?></td>
                        <td><?= count($penTasks10) + count($compTasks10) ?></td>
                    </tr>
                    <tr>
                        <?php $fiftenDaysAgo = date('Y-m-d', strtotime(date('Y-m-d') . ' - 15 days')); ?>
                        <td>More than 15 Days <span class="text-danger">(<?= $fiftenDaysAgo ?>)</span></td>
                        <td><?= count($penTasks15) ?></td>
                        <td><?= count($compTasks15) ?></td>
                        <td><?= count($penTasks15) + count($compTasks15) ?></td>
                    </tr>
                </table>
                <canvas id="taskschart" class="scale" style="width: 700px; height: 280px;"></canvas>
            </div>
            <div class="p-2">
                <div class="h5">Today's Tasks Stats</div>
                <table class="table table-striped mb-5 table-hover shadow">
                    <thead class="bg-success text-light">
                        <tr>
                            <th>Received</th>
                            <th>Replied</th>
                            <th class="bg-warning text-dark">Total</th>
                        </tr>
                    </thead>
                    <tr>
                        <td><?= count($todayPenTasks) ?></td>
                        <td><?= count($todayCompTasks) ?></td>
                        <td><?= count($todayPenTasks) + count($todayCompTasks) ?></td>
                    </tr>
                </table>
                <canvas id="todaystaskschart" class="scale" style="width: 400px; height: 280px;"></canvas>
            </div>
        </div>
        <div class="d-flex flex-row">
            <div class="p-2">
                <div class="h5">Tasks Categories Stats</div>
                <table class="table table-striped mb-5 text-center table-hover shadow">
                    <thead class="bg-success text-light">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Total No. of Tasks</th>
                            <th>Total No. of Days</th>
                            <th>Avg. Review Days</th>
                        </tr>
                    </thead>
                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= taskcateg($i) ?></td>
                            <td><?= $categoryTasksCountarr[$i] ?></td>
                            <td><?= $categoriesDaysCount[$i]; ?></td>
                            <td><?= number_format($categoriesAverageDaysCount[$i], 1)  ?></td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
        <div class="d-flex flex-row">
            <div class="p-2">
                <canvas class="scale" id="tasksCategoriesChart" width="1200" height="600"></canvas>
            </div>
        </div>


    </div>
    <?php require($base . 'partials/footer.php'); ?>
</main>



<!-- Projects Pie Chart -->
<script>
    const projData = {
        labels: ['On-going', 'Archived'],
        datasets: [{
            label: 'Projects',
            data: [<?= count($actproj) ?>, <?= count($archproj) ?>],
            backgroundColor: ['#db4437', '#198754'],
            hoverOffset: 4
        }]
    };

    const projConfig = {
        type: 'pie',
        data: projData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Projects'
                }
            }
        },
    };

    new Chart(document.getElementById('projstat'), projConfig);
</script>

<!-- Projects Categories Bar Chart -->
<script>
    const actarchProjCatData = {
        labels: ['Active', 'Archived'],
        datasets: [{
            label: 'HV',
            data: [<?= count($hvProjects) ?>, <?= count($archhvProjects) ?>],
            backgroundColor: '#198754',
        }, {
            label: 'EHV',
            data: [<?= count($ehvProjects) ?>, <?= count($archehvProjects) ?>],
            backgroundColor: '#f2b707',
        }, {
            label: 'Maintenance',
            data: [<?= count($maintenanceProjects) ?>, <?= count($archmaintenanceProjects) ?>],
            backgroundColor: '#db4437',
        }]
    };

    const actarchProjCatConfig = {
        type: 'bar',
        data: actarchProjCatData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Projects Categories'
                }
            }
        },
    };

    new Chart(document.getElementById('actarchprojcat'), actarchProjCatConfig);
</script>

<!-- Current Year Projects Pie Chart -->
<script>
    const currYearProjData = {
        labels: ['On-going', 'Archived'],
        datasets: [{
            label: 'Projects',
            data: [<?= count($currYearActProj) ?>, <?= count($currYearArchProj) ?>],
            backgroundColor: ['#db4437', '#198754'],
            hoverOffset: 4
        }]
    };

    const currYearProjConfig = {
        type: 'pie',
        data: currYearProjData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Projects (<?= $curryear ?>)'
                }
            }
        },
    };

    new Chart(document.getElementById('curryearProjStat'), currYearProjConfig);
</script>

<!-- Tasks Chart -->
<script>
    const tasksData = {
        labels: ['All Time', 'More than 10 Days', 'More than 15 Days'],
        datasets: [{
            label: 'Pending',
            data: [<?= count($pendTasks) ?>, <?= count($penTasks10) ?>, <?= count($penTasks15) ?>],
            backgroundColor: '#db4437',
        }, {
            label: 'Completed',
            data: [<?= count($compTasks) ?>, <?= count($compTasks10) ?>, <?= count($compTasks15) ?>],
            backgroundColor: '#198754',
        }]
    };

    const tasksConfig = {
        type: 'bar',
        data: tasksData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Tasks'
                }
            }
        },
    };

    new Chart(document.getElementById('taskschart'), tasksConfig);
</script>

<!-- Today's Tasks Chart -->
<script>
    const todaysTasksData = {
        labels: ['Today'],
        datasets: [{
            label: 'Pending',
            data: [<?= count($todayPenTasks) ?>],
            backgroundColor: '#db4437',
        }, {
            label: 'Completed',
            data: [<?= count($todayCompTasks) ?>],
            backgroundColor: '#198754',
        }]
    };

    const todaysTasksConfig = {
        type: 'bar',
        data: todaysTasksData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: "Today's Tasks"
                }
            }
        },
    };

    new Chart(document.getElementById('todaystaskschart'), todaysTasksConfig);
</script>

<!-- Tasks Categories Chart-->
<script>
    var colors = ["#198754", "#f2b707"];
    const tasksCategoriesData = {
        labels: [
            <?php for ($i = 1; $i <= 24; $i++) { ?> '<?= taskcateg($i) ?>',
            <?php } ?>
        ],
        datasets: [{
            label: 'Tasks Count',
            data: [
                <?php for ($i = 1; $i <= 24; $i++) { ?>
                    <?= $categoryTasksCountarr[$i] ?>,
                <?php } ?>
            ],
            backgroundColor: Array.from(colors, (v, i) => colors[i % colors.length]),
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    };

    const tasksCategoriesConfig = {
        type: 'bar',
        data: tasksCategoriesData,
        options: {
            responsive: false, // Set to false to respect fixed dimensions
            maintainAspectRatio: false, // Set to false to allow fixed height
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Tasks Categories',
                    font: {
                        size: 20
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Categories'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Tasks'
                    }
                }
            }
        }
    };

    // Create the chart
    new Chart(document.getElementById('tasksCategoriesChart'), tasksCategoriesConfig);
</script>