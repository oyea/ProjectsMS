<?php require("auth.php"); ?>
<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php');
?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>
<?php $db = new Db('localhost', 'root', 'root', 'projectsms'); ?>
<?php require 'functions.php'; ?>

<?php
$actproj = $db->read('projects', 'archived=?', array(0));
$archproj = $db->read('projects', 'archived=?', array(1));

$hvProjects = array_filter($actproj, function ($project) {
    return $project['category'] === 'HV';
});
$ehvProjects = array_filter($actproj, function ($project) {
    return $project['category'] === 'EHV';
});
$maintenanceProjects = array_filter($actproj, function ($project) {
    return $project['category'] === 'Maintenance';
});

$archhvProjects = array_filter($archproj, function ($project) {
    return $project['category'] === 'HV';
});
$archehvProjects = array_filter($archproj, function ($project) {
    return $project['category'] === 'EHV';
});
$archmaintenanceProjects = array_filter($archproj, function ($project) {
    return $project['category'] === 'Maintenance';
});
?>
<main>
    <div class="container">
        <h2 class="text-center mb-5">Projects Dashboard</h2>
        <div class="d-flex flex-row">
            <div class="p-2">
                <div class="h5">Projects</div>
                <table class="table table-striped">
                    <tr class="bg-warning">
                        <th>Active Projects</th>
                        <th>Archived Projects</th>
                        <th class="bg-info">Total</th>
                    </tr>
                    <tr>
                        <td><?= count($actproj) ?></td>
                        <td><?= count($archproj) ?></td>
                        <td><?= count($actproj) + count($archproj) ?></td>
                    </tr>
                </table>
                <div id="projstat" class="scale" style="width: 400px; height: 200px;"></div>
            </div>




            <div class="p-2">
                <div class="h5">Projects Categories Stats</div>
                <table class="table table-striped">
                    <tr class="bg-warning">
                        <th>Status</th>
                        <th>HV</th>
                        <th>EHV</th>
                        <th>Maintenance</th>
                        <th class="bg-info">Total</th>
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
                        <td class="bg-info">Total</td>
                        <td><?= $tothv = count($archhvProjects) + count($hvProjects) ?></td>
                        <td><?= $totehv = count($archehvProjects) + count($ehvProjects) ?></td>
                        <td><?= $totmain = count($archmaintenanceProjects) + count($maintenanceProjects)  ?></td>
                        <td><?= $tothv + $totehv + $totmain ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="p-2">
                <div id="actarchprojcat" class="scale" style="width: 400px; height: 200px;"></div>
            </div>
        </div>

        <div class="d-flex flex-row">
            <div class="p-2">
                <div class="h5">Tasks</div>
                <table class="table table-striped">
                    <thead class="bg-warning text-dark">
                        <tr>
                            <th>Period</th>
                            <th>Pending</th>
                            <th>Completed</th>
                            <th class="bg-info">Total</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>All Time</td>
                        <td>50</td>
                        <td>70</td>
                        <td>120</td>
                    </tr>
                    <tr>
                        <td>More than 10 Days</td>
                        <td>40</td>
                        <td>60</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>More than 15 Days</td>
                        <td>20</td>
                        <td>40</td>
                        <td>60</td>
                    </tr>
                </table>
            </div>
            <div class="p-2">
                <div class="scale" id="taskschart" style="width: 400px; height: 280px;"></div>
            </div>
        </div>


    </div>
</main>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Projects', 'Number'],
            ['On-going', <?= count($actproj) ?>],
            ['Archived', <?= count($archproj) ?>]
        ]);

        var options = {
            title: 'Projects',
            is3D: true,
            colors: ['#db4437', '#198754'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('projstat'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Status', 'HV', 'EHV', 'Maintenace'],
            ['Active', <?= count($hvProjects) ?>, <?= count($ehvProjects) ?>, <?= count($maintenanceProjects) ?>],
            ['Archived', <?= count($archhvProjects) ?>, <?= count($archehvProjects) ?>,
                <?= count($archmaintenanceProjects) ?>
            ]
        ]);

        var options = {
            chart: {
                title: '',
                subtitle: '',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('actarchprojcat'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

<!-- //tasks chart -->

<script type="text/javascript">
    google.charts.load("current", {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Status", "Number", {
                role: "style"
            }],
            ["Pending", 19.30, "#db4437"],
            ["Completed", 21.45, "color: #198754"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2
        ]);

        var options = {
            title: "Pending & Completed Tasks",
            width: 400,
            height: 280,
            bar: {
                groupWidth: "50%"
            },
            legend: {
                position: "none"
            },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("taskschart"));
        chart.draw(view, options);
    }
</script>

<?php require($base . 'partials/footer.php'); ?>