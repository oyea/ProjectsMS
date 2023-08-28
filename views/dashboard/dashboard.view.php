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
                <div id="projstat" class="scale" style="width: 400px; height: 200px;"></div>
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
                <div id="actarchprojcat" class="scale" style="width: 400px; height: 200px;"></div>
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
                <div id="curryearProjStat" class="scale" style="width: 400px; height: 200px;"></div>
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
                <div class="scale" id="taskschart" style="width: 700px; height: 280px;"></div>
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
                <div class="scale" id="todaystaskschart" style="width: 400px; height: 280px;"></div>
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
                        <td><?= number_format($categoriesAverageDaysCount[$i], 2)  ?></td>
                    </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
        <div class="d-flex flex-row">
            <div class="p-2">
                <div class="h5">Tasks Categories Stats</div>
                <div class="" id="taskscategories" style="width: 1400px; height: 600px;"></div>
            </div>
        </div>

    </div>
</main>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- all projects pie chart -->
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
<!-- projects Categories chart -->
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
        bars: 'vertical', // Required for Material Bar Charts.
        colors: ['198754', 'f2b707', 'db4437']
    };

    var chart = new google.charts.Bar(document.getElementById('actarchprojcat'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>
<!-- current year projects chart -->
<script type="text/javascript">
google.charts.load("current", {
    packages: ["corechart"]
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Projects', 'Number'],
        ['On-going', <?= count($currYearActProj) ?>],
        ['Archived', <?= count($currYearArchProj) ?>]
    ]);

    var options = {
        title: 'Projects in <?= $curryear ?> Stats',
        is3D: true,
        colors: ['#db4437', '#198754'],
    };

    var chart = new google.visualization.PieChart(document.getElementById('curryearProjStat'));
    chart.draw(data, options);
}
</script>

<!-- //tasks chart -->

<script type="text/javascript">
google.charts.load('current', {
    'packages': ['bar']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Status', 'Pending', 'Completed'],
        ['All', <?= count($pendTasks) ?>, <?= count($compTasks) ?>],
        ['10 Days', <?= count($penTasks10) ?>, <?= count($compTasks10) ?>],
        ['15 Days', <?= count($penTasks15) ?>, <?= count($compTasks15) ?>]
    ]);

    var options = {
        chart: {
            title: '',
            subtitle: '',
        },
        bars: 'vertical', // Required for Material Bar Charts.
        colors: ['db4437', '198754']
    };

    var chart = new google.charts.Bar(document.getElementById('taskschart'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>

<!-- Todays Tasks chart -->

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
        ["Pending", <?= count($todayPenTasks) ?>, "#db4437"],
        ["Completed", <?= count($todayCompTasks) ?>, "color: #198754"]
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
        title: "Today's Tasks",
        width: 400,
        height: 280,
        bar: {
            groupWidth: "50%"
        },
        legend: {
            position: "none"
        },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("todaystaskschart"));
    chart.draw(view, options);
}
</script>

<!-- tasks Categories chart -->

<script type="text/javascript">
google.charts.load("current", {
    packages: ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ["category", "Number", {
            role: "style"
        }],
        ["Issuing a PR/TS (SOW)", <?= count($tCat1) ?>, "#198754"],
        ["Revise/Review a PR Ver. X", <?= count($tCat2) ?>, "color: #f2b707"],
        ["Review a bidder clarification (per bidder)", <?= count($tCat3) ?>, "#198754"],
        ["Review the relay list", <?= count($tCat4) ?>, "#f2b707"],
        ["Review the project base design", <?= count($tCat5) ?>, "#198754"],
        ["Review the project details design", <?= count($tCat6) ?>, "#f2b707"],
        ["Review of protection cross-related project submittals (TFR, SOE, LCC,...)", <?= count($tCat7) ?>,
            "#198754"
        ],
        ["Issuing the protection relay setting per equipment (TR, line, BB, Other)", <?= count($tCat8) ?>,
            "#f2b707"
        ],
        ["Issuing the protection relay setting per substation", <?= count($tCat9) ?>, "#198754"],
        ["Relay setting coordination study or setting at the interface point with 'Generation, DBU, Bulk customer' (per study)",
            <?= count($tCat10) ?>, "#f2b707"
        ],
        ["Nth version of any project submittals", <?= count($tCat11) ?>, "#198754"],
        ["Miscellaneous documents review", <?= count($tCat12) ?>, "#f2b707"],
        ["Review of irrelevant protection submittals (out of PED scope)", <?= count($tCat13) ?>, "#198754"],
        ["Prepare a base design for a special protection scheme (SPS)?>, per request", <?= count($tCat14) ?>,
            "#f2b707"
        ],
        ["Quick response to normalize the fault and give a quick response before the morning call (per incident)",
            <?= count($tCat15) ?>, "#198754"
        ],
        ["Fault analysis (per incident)", <?= count($tCat16) ?>, "#f2b707"],
        ["Review Standards, policies, procedures,...", <?= count($tCat17) ?>, "#198754"],
        ["Preparing WI, procedure,...", <?= count($tCat18) ?>, "#f2b707"],
        ["Protection relay pre-qualification", <?= count($tCat19) ?>, "#198754"],
        ["Review OPDS scheme as a team member", <?= count($tCat20) ?>, "#f2b707"],
        ["Conduct a wide-area coordination study", <?= count($tCat21) ?>, "#198754"],
        ["Review the project base design per equipment or voltage level", <?= count($tCat22) ?>, "#f2b707"],
        ["Review the project details design per equipment or voltage level", <?= count($tCat23) ?>, "#198754"],
        ["Peer Review of a project submittal", <?= count($tCat24) ?>, "#f2b707"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1, {
        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation"
    }, 2]);

    var options = {
        title: "Tasks Categories",
        width: 1400,
        height: 600,
        chartArea: {
            left: 50,
            top: 20,
            width: '80%',
            height: '80%'
        }, // Adjust these values as needed
        bar: {
            groupWidth: "80%"
        },
        legend: {
            position: "none"
        },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("taskscategories"));
    chart.draw(view, options);
}
</script>

<?php require($base . 'partials/footer.php'); ?>