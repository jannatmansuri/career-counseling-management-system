<?php
include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../includes/db.php';
include '../auth.php';
$sql = "
    SELECT consultations.*, experts.expert_name
    FROM consultations
    LEFT JOIN experts
    ON consultations.expert_id = experts.id
    ORDER BY consultations.id DESC
";

$result = mysqli_query($conn, $sql);
?>

<section class="section-padding">

    <div class="container">

        <div class="mb-4">
            <p class="text-secondary fw-bold mb-1">
                ADMINISTRATION
            </p>

            <h1 class="fw-bold">
                Consultation Requests
            </h1>

            <p class="text-muted">
                Manage student consultation requests.
            </p>
        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">

                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Expert</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                                <tr>

                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['student_name']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['email']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['phone']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['expert_name'] ?? 'N/A'); ?>
                                    </td>

                                    <td style="max-width: 250px;">
                                        <?php echo htmlspecialchars($row['message']); ?>
                                    </td>

                                    <td>

                                        <?php if ($row['status'] == 'Pending') { ?>

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        <?php } elseif ($row['status'] == 'Accepted') { ?>

                                            <span class="badge bg-success">
                                                Accepted
                                            </span>

                                        <?php } else { ?>

                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>

                                        <?php } ?>

                                    </td>

                                    <td>

                                        <a
                                            href="update_status.php?id=<?php echo $row['id']; ?>&status=Accepted"
                                            class="btn btn-sm btn-success mb-1"
                                        >
                                            Accept
                                        </a>

                                        <a
                                            href="update_status.php?id=<?php echo $row['id']; ?>&status=Rejected"
                                            class="btn btn-sm btn-warning mb-1"
                                        >
                                            Reject
                                        </a>

                                        <a
                                            href="delete.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-danger mb-1"
                                            onclick="return confirm('Delete this consultation?');"
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