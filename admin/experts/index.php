<?php
include '../../includes/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';
include '../auth.php';
$result = mysqli_query($conn, "SELECT * FROM experts ORDER BY id DESC");
?>

<section class="section-padding">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-bold">Manage Experts</h1>
                <p class="text-muted">
                    Add, edit and delete career experts.
                </p>
            </div>

            <a href="add.php" class="btn btn-dark">
                + Add Expert
            </a>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Specialization</th>
                                <th>Experience</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php while ($expert = mysqli_fetch_assoc($result)) { ?>

                                <tr>

                                    <td>
                                        <?php echo $expert['id']; ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($expert['expert_name']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($expert['specialization']); ?>
                                    </td>

                                    <td>
                                        <?php echo $expert['experience']; ?> Years
                                    </td>

                                    <td>

                                        <a
                                            href="edit.php?id=<?php echo $expert['id']; ?>"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Edit
                                        </a>

                                        <a
                                            href="delete.php?id=<?php echo $expert['id']; ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this expert?');"
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