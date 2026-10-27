<?php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';

$result = mysqli_query($conn, "SELECT * FROM experts ORDER BY id DESC");
?>

<section class="section-padding">

    <div class="container">

        <div class="mb-5">
            <p class="text-secondary fw-bold mb-1">CAREER EXPERTS</p>

            <h1 class="fw-bold">
                Connect With Career Experts
            </h1>

            <p class="text-muted">
                Explore professionals who can help you make better career decisions.
            </p>
        </div>

        <div class="row g-4">

            <?php while ($expert = mysqli_fetch_assoc($result)) { ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body p-4">

                            <div class="mb-3">
                                <div class="rounded-circle bg-dark text-white
                                            d-inline-flex align-items-center
                                            justify-content-center"
                                     style="width:60px;height:60px;">
                                    <?php echo strtoupper(substr($expert['expert_name'], 0, 1)); ?>
                                </div>
                            </div>

                            <h4 class="fw-bold">
                                <?php echo htmlspecialchars($expert['expert_name']); ?>
                            </h4>

                            <p class="text-secondary">
                                <?php echo htmlspecialchars($expert['specialization']); ?>
                            </p>

                            <p class="text-muted">
                                <?php echo htmlspecialchars($expert['bio']); ?>
                            </p>

                            <p>
                                <strong>
                                    <?php echo $expert['experience']; ?>
                                </strong>
                                Years Experience
                            </p>

                            <a
                                href="details.php?id=<?php echo $expert['id']; ?>"
                                class="btn btn-dark"
                            >
                                View Expert
                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>

<?php include '../includes/footer.php'; ?>