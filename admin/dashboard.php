
<?php

include 'auth.php';
include '../includes/header.php';
include 'admin_navbar.php';
include '../includes/db.php';

$career_count = (int) mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM careers")
)['total'];

$expert_count = (int) mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM experts")
)['total'];

$consultation_count = (int) mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM consultations")
)['total'];

$pending_count = (int) mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM consultations
         WHERE status = 'Pending'"
    )
)['total'];
$status_query = mysqli_query(
    $conn,
    "SELECT status, COUNT(*) AS total
     FROM consultations
     GROUP BY status"
);

$status_counts = [
    'Pending' => 0,
    'Accepted' => 0,
    'Rejected' => 0
];

while ($row = mysqli_fetch_assoc($status_query)) {

    if (isset($status_counts[$row['status']])) {
        $status_counts[$row['status']] = (int) $row['total'];
    }

}

?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="section-padding">

    <div class="container">

       

        <div class="mb-5">

            <p class="text-secondary fw-bold mb-1">
                ADMIN PANEL
            </p>

            <h1 class="dashboard-heading">
                Dashboard
            </h1>

            <p class="text-muted">
                Welcome,
                <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
            </p>

        </div>


        <div class="row g-4 mb-5">

            <div class="col-md-6 col-lg-3">

                <div class="card admin-stat-card shadow-sm h-100">

                    <div class="card-body p-4">

                        <p class="text-muted mb-2">Careers</p>

                        <h2 class="fw-bold">
                            <?php echo $career_count; ?>
                        </h2>

                        <a href="careers/" class="text-decoration-none">
                            Manage Careers →
                        </a>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="card admin-stat-card shadow-sm h-100">

                    <div class="card-body p-4">

                        <p class="text-muted mb-2">Experts</p>

                        <h2 class="fw-bold">
                            <?php echo $expert_count; ?>
                        </h2>

                        <a href="experts/" class="text-decoration-none">
                            Manage Experts →
                        </a>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="card admin-stat-card shadow-sm h-100">

                    <div class="card-body p-4">

                        <p class="text-muted mb-2">Consultations</p>

                        <h2 class="fw-bold">
                            <?php echo $consultation_count; ?>
                        </h2>

                        <a href="consultations/" class="text-decoration-none">
                            View Requests →
                        </a>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="card admin-stat-card shadow-sm h-100">

                    <div class="card-body p-4">

                        <p class="text-muted mb-2">Pending</p>

                        <h2 class="fw-bold">
                            <?php echo $pending_count; ?>
                        </h2>

                        <a href="consultations/" class="text-decoration-none">
                            Review Requests →
                        </a>

                    </div>

                </div>

            </div>

        </div>


      

        <div class="row g-4 mb-5">

     
            <div class="col-lg-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-1">
                            Consultation Status
                        </h4>

                        <p class="text-muted mb-4">
                            Overview of consultation requests
                        </p>

                        <div style="height: 300px; position: relative;">

                            <canvas id="consultationChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>



            <div class="col-lg-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-1">
                            System Overview
                        </h4>

                        <p class="text-muted mb-4">
                            Compare records across the system
                        </p>

                        <div style="height: 300px; position: relative;">

                            <canvas id="systemChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">
                    Management
                </h4>

                <div class="row g-3">

                    <div class="col-md-4">

                        <a
                            href="careers/"
                            class="btn btn-dark w-100 py-3"
                        >
                            Manage Careers
                        </a>

                    </div>

                    <div class="col-md-4">

                        <a
                            href="experts/"
                            class="btn btn-dark w-100 py-3"
                        >
                            Manage Experts
                        </a>

                    </div>

                    <div class="col-md-4">

                        <a
                            href="consultations/"
                            class="btn btn-dark w-100 py-3"
                        >
                            Manage Consultations
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<script>

    
    const consultationCanvas = document.getElementById('consultationChart');

    new Chart(consultationCanvas, {

        type: 'doughnut',

        data: {

            labels: ['Pending', 'Accepted', 'Rejected'],

            datasets: [{

                data: [
                    <?php echo $status_counts['Pending']; ?>,
                    <?php echo $status_counts['Accepted']; ?>,
                    <?php echo $status_counts['Rejected']; ?>
                ],

                backgroundColor: [
                    '#f0ad4e',
                    '#198754',
                    '#dc3545'
                ],

                borderWidth: 2,
                borderColor: '#ffffff'

            }]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            plugins: {

                legend: {
                    position: 'bottom'
                },

                tooltip: {
                    enabled: true
                }

            }

        }

    });


    // System Overview Bar Chart

    const systemCanvas = document.getElementById('systemChart');

    new Chart(systemCanvas, {

        type: 'bar',

        data: {

            labels: ['Careers', 'Experts', 'Consultations'],

            datasets: [{

                label: 'Total Records',

                data: [
                    <?php echo $career_count; ?>,
                    <?php echo $expert_count; ?>,
                    <?php echo $consultation_count; ?>
                ],

                backgroundColor: [
                    '#176b63',
                    '#d97732',
                    '#64748b'
                ],

                borderRadius: 7

            }]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    }

                }

            },

            plugins: {

                legend: {
                    display: false
                }

            }

        }

    });

</script>


<?php include '../includes/footer.php'; ?>
```
