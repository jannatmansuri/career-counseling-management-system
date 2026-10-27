<?php

include '../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid career ID.");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM careers WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$career = mysqli_fetch_assoc($result);

if (!$career) {
    die("Career not found.");
}

include '../includes/header.php';
include '../includes/navbar.php';

?>

<section class="section-padding">

    <div class="container">

        <a href="index.php" class="btn btn-outline-dark mb-4">
            ← Back to Careers
        </a>

        <div class="row">

            <div class="col-lg-8">

                <span class="badge text-bg-light mb-3">
                    <?php echo htmlspecialchars($career['category']); ?>
                </span>

                <h1 class="fw-bold">
                    <?php echo htmlspecialchars($career['career_name']); ?>
                </h1>

                <p class="text-muted mt-3">
                    <?php echo htmlspecialchars($career['description']); ?>
                </p>

                <hr class="my-4">

                <h4 class="fw-bold">Required Skills</h4>

                <p class="text-muted">
                    <?php echo htmlspecialchars($career['skills']); ?>
                </p>

                <h4 class="fw-bold mt-4">Career Scope</h4>

                <p class="text-muted">
                    <?php echo htmlspecialchars($career['scope']); ?>
                </p>

            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h5 class="fw-bold">Career Information</h5>

                        <hr>

                        <p>
                            <strong>Category:</strong><br>
                            <?php echo htmlspecialchars($career['category']); ?>
                        </p>

                        <a
                            href="../consultations/"
                            class="btn btn-dark w-100"
                        >
                            Get Career Guidance
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include '../includes/footer.php'; ?>