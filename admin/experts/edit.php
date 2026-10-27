<?php

include '../auth.php';
include '../../includes/header.php';
include '../admin_navbar.php';
include '../../includes/db.php';
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $expert_name = trim($_POST['expert_name']);
    $specialization = trim($_POST['specialization']);
    $experience = (int) $_POST['experience'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $bio = trim($_POST['bio']);

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE experts
         SET expert_name=?, specialization=?, experience=?,
             email=?, phone=?, bio=?
         WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssisssi",
        $expert_name,
        $specialization,
        $experience,
        $email,
        $phone,
        $bio,
        $id
    );

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

include '../../includes/header.php';
include '../../includes/navbar.php';

?>

<section class="section-padding">

    <div class="container">

        <h1 class="fw-bold mb-4">Edit Expert</h1>

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <form method="POST">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Expert Name</label>
                            <input
                                type="text"
                                name="expert_name"
                                class="form-control"
                                value="<?php echo htmlspecialchars($expert['expert_name']); ?>"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Specialization</label>
                            <input
                                type="text"
                                name="specialization"
                                class="form-control"
                                value="<?php echo htmlspecialchars($expert['specialization']); ?>"
                                required
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Experience</label>
                            <input
                                type="number"
                                name="experience"
                                class="form-control"
                                value="<?php echo $expert['experience']; ?>"
                                min="0"
                                required
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?php echo htmlspecialchars($expert['email']); ?>"
                                required
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Phone</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="<?php echo htmlspecialchars($expert['phone']); ?>"
                                required
                            >
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Bio</label>
                            <textarea
                                name="bio"
                                class="form-control"
                                rows="4"
                                required
                            ><?php echo htmlspecialchars($expert['bio']); ?></textarea>
                        </div>

                    </div>

                    <button class="btn btn-dark">
                        Update Expert
                    </button>

                    <a href="index.php" class="btn btn-outline-secondary">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>

</section>

<?php include '../../includes/footer.php'; ?>