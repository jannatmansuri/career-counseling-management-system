<?php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';

$result = mysqli_query($conn, "SELECT * FROM careers ORDER BY id DESC");
?>

<section class="section-padding">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <p class="text-secondary fw-bold mb-1">CAREER DIRECTORY</p>
                <h1 class="fw-bold">Explore Career Paths</h1>
                <p class="text-muted">
                    Explore different career opportunities and required skills.
                </p>
            </div>
        </div>

        <div class="row g-4">

            <?php while ($career = mysqli_fetch_assoc($result)) { ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card career-card shadow-sm h-100">

                        <div class="card-body p-4">

                            <span class="badge text-bg-light mb-3">
                                <?php echo htmlspecialchars($career['category']); ?>
                            </span>

                            <h4 class="fw-bold">
                                <?php echo htmlspecialchars($career['career_name']); ?>
                            </h4>

                            <p class="text-muted">
                                <?php echo htmlspecialchars($career['description']); ?>
                            </p>

                            <a
                                href="details.php?id=<?php echo $career['id']; ?>"
                                class="btn btn-dark"
                            >
                                View Details
                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>

<?php include '../includes/footer.php'; ?>