<?php

include '../auth.php';
include '../../includes/header.php';
include '../admin_navbar.php';
include '../../includes/db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $expert_name = trim($_POST['expert_name']);
    $specialization = trim($_POST['specialization']);
    $experience = (int) $_POST['experience'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $bio = trim($_POST['bio']);

    if (
        $expert_name != "" &&
        $specialization != "" &&
        $experience >= 0 &&
        $email != "" &&
        $phone != "" &&
        $bio != ""
    ) {

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO experts
            (expert_name, specialization, experience, email, phone, bio)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssisss",
            $expert_name,
            $specialization,
            $experience,
            $email,
            $phone,
            $bio
        );

        mysqli_stmt_execute($stmt);

        header("Location: index.php");
        exit;

    } else {
        $message = "Please fill all fields correctly.";
    }
}

include '../../includes/header.php';
include '../../includes/navbar.php';

?>

<section class="section-padding">

    <div class="container">

        <h1 class="fw-bold mb-4">Add Expert</h1>

        <?php if ($message) { ?>
            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>
        <?php } ?>

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
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Specialization</label>
                            <input
                                type="text"
                                name="specialization"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Experience (Years)</label>
                            <input
                                type="number"
                                name="experience"
                                class="form-control"
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
                                required
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Phone</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control"
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
                            ></textarea>
                        </div>

                    </div>

                    <button class="btn btn-dark">
                        Add Expert
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