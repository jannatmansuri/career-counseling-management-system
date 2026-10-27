<?php

include '../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid expert ID.");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM experts WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$expert = mysqli_fetch_assoc($result);

if (!$expert) {
    die("Expert not found.");
}

include '../includes/header.php';
include '../includes/navbar.php';

?>

<section class="section-padding">

    <div class="container">

        <a href="index.php" class="btn btn-outline-dark mb-4">
            ← Back to Experts
        </a>

        <div class="card border-0 shadow-sm">

            <div class="card-body p-5">

                <div class="row">

                    <div class="col-lg-8">

                        <p class="text-secondary fw-bold">
                            CAREER EXPERT
                        </p>

                        <h1 class="fw-bold">
                            <?php echo htmlspecialchars($expert['expert_name']); ?>
                        </h1>

                        <h5 class="text-secondary mt-3">
                            <?php echo htmlspecialchars($expert['specialization']); ?>
                        </h5>

                        <p class="text-muted mt-4">
                            <?php echo htmlspecialchars($expert['bio']); ?>
                        </p>

                        <hr>

                        <h5 class="fw-bold">
                            Experience
                        </h5>

                        <p>
                            <?php echo $expert['experience']; ?> Years
                        </p>

                    </div>

                    <div class="col-lg-4">

                        <div class="bg-light rounded p-4">

                            <h5 class="fw-bold">
                                Contact Information
                            </h5>

                            <p class="mt-3">
                                <strong>Email</strong><br>
                                <?php echo htmlspecialchars($expert['email']); ?>
                            </p>

                            <p>
                                <strong>Phone</strong><br>
                                <?php echo htmlspecialchars($expert['phone']); ?>
                            </p>

                            <a
                                href="../consultations/"
                                class="btn btn-dark w-100"
                            >
                                Request Consultation
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include '../includes/footer.php'; ?>