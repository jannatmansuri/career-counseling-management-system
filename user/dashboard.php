<?php

include 'auth.php';
include '../includes/header.php';
include '../includes/navbar.php';

?>

<section class="section-padding">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-5">

            <div>

                <p class="text-secondary fw-bold mb-1">
                    STUDENT AREA
                </p>

                <h1 class="fw-bold">
                    Welcome,
                    <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                </h1>

            </div>

            <a
                href="logout.php"
                class="btn btn-outline-danger"
            >
                Logout
            </a>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Explore Careers
                        </h4>

                        <p class="text-muted">
                            Browse available career paths.
                        </p>

                        <a
                            href="../careers/"
                            class="btn btn-dark"
                        >
                            View Careers
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Find Experts
                        </h4>

                        <p class="text-muted">
                            Explore career counselors.
                        </p>

                        <a
                            href="../experts/"
                            class="btn btn-dark"
                        >
                            View Experts
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        <h4 class="fw-bold">
                            Get Consultation
                        </h4>

                        <p class="text-muted">
                            Request career guidance.
                        </p>

                        <a
                            href="../consultations/"
                            class="btn btn-dark"
                        >
                            Request Guidance
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include '../includes/footer.php'; ?>