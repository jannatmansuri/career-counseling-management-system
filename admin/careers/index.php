<?php
include '../auth.php';
include '../../includes/header.php';
include '../admin_navbar.php';
include '../../includes/db.php';
$result = mysqli_query($conn, "SELECT * FROM careers ORDER BY id DESC");
?>

<section class="section-padding">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-bold">Manage Careers</h1>
                <p class="text-muted">
                    Add, edit and delete career information.
                </p>
            </div>

            <a href="add.php" class="btn btn-dark">
                + Add Career
            </a>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Career</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php while ($career = mysqli_fetch_assoc($result)) { ?>

                                <tr>

                                    <td>
                                        <?php echo $career['id']; ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($career['career_name']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($career['category']); ?>
                                    </td>

                                    <td>

                                        <a
                                            href="edit.php?id=<?php echo $career['id']; ?>"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Edit
                                        </a>

                                        <a
                                            href="delete.php?id=<?php echo $career['id']; ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this career?');"
                                        >
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include '../../includes/footer.php'; ?>