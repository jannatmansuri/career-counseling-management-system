<?php
include '../auth.php';
include '../../includes/header.php';
include '../admin_navbar.php';
include '../../includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $career_name = trim($_POST['career_name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $skills = trim($_POST['skills']);
    $scope = trim($_POST['scope']);

    if (
        $career_name != "" &&
        $category != "" &&
        $description != "" &&
        $skills != "" &&
        $scope != ""
    ) {

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO careers
            (career_name, category, description, skills, scope)
            VALUES (?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $career_name,
            $category,
            $description,
            $skills,
            $scope
        );

        mysqli_stmt_execute($stmt);

        header("Location: index.php");
        exit;

    } else {
        $message = "Please fill all fields.";
    }
}

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<section class="section-padding">

    <div class="container">

        <h1 class="fw-bold mb-4">Add Career</h1>

        <?php if ($message) { ?>
            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Career Name</label>
                        <input
                            type="text"
                            name="career_name"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input
                            type="text"
                            name="category"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                            required
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Required Skills</label>
                        <textarea
                            name="skills"
                            class="form-control"
                            rows="3"
                            required
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Career Scope</label>
                        <textarea
                            name="scope"
                            class="form-control"
                            rows="3"
                            required
                        ></textarea>
                    </div>

                    <button class="btn btn-dark">
                        Add Career
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