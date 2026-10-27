<?php
include '../auth.php';
include '../../includes/header.php';
include '../admin_navbar.php';
include '../../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid career ID.");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM careers WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$career = mysqli_fetch_assoc($result);

if (!$career) {
    die("Career not found.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $career_name = trim($_POST['career_name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $skills = trim($_POST['skills']);
    $scope = trim($_POST['scope']);

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE careers
         SET career_name=?, category=?, description=?, skills=?, scope=?
         WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $career_name,
        $category,
        $description,
        $skills,
        $scope,
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

        <h1 class="fw-bold mb-4">Edit Career</h1>

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Career Name</label>
                        <input
                            type="text"
                            name="career_name"
                            class="form-control"
                            value="<?php echo htmlspecialchars($career['career_name']); ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input
                            type="text"
                            name="category"
                            class="form-control"
                            value="<?php echo htmlspecialchars($career['category']); ?>"
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
                        ><?php echo htmlspecialchars($career['description']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Required Skills</label>
                        <textarea
                            name="skills"
                            class="form-control"
                            rows="3"
                            required
                        ><?php echo htmlspecialchars($career['skills']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Career Scope</label>
                        <textarea
                            name="scope"
                            class="form-control"
                            rows="3"
                            required
                        ><?php echo htmlspecialchars($career['scope']); ?></textarea>
                    </div>

                    <button class="btn btn-dark">
                        Update Career
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