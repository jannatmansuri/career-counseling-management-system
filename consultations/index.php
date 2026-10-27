<?php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';

$experts = mysqli_query($conn, "SELECT id, expert_name, specialization FROM experts ORDER BY expert_name");

$message = "";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit;
}
$user_name = "";
$user_email = "";

if (isset($_SESSION['user_id'])) {

    $user_name = $_SESSION['user_name'];

    $stmt_user = mysqli_prepare(
        $conn,
        "SELECT email FROM users WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt_user,
        "i",
        $_SESSION['user_id']
    );

    mysqli_stmt_execute($stmt_user);

    $user_result = mysqli_stmt_get_result($stmt_user);

    if ($user = mysqli_fetch_assoc($user_result)) {
        $user_email = $user['email'];
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_name = trim($_POST['student_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $expert_id = intval($_POST['expert_id']);
    $user_message = trim($_POST['message']);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO consultations
        (student_name, email, phone, expert_id, message)
        VALUES (?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssis",
        $student_name,
        $email,
        $phone,
        $expert_id,
        $user_message
    );

    mysqli_stmt_execute($stmt);

    $message = "Consultation request submitted successfully!";
}
?>

<section class="section-padding">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="text-center mb-5">
                    <p class="text-secondary fw-bold mb-1">
                        CAREER GUIDANCE
                    </p>

                    <h1 class="fw-bold">
                        Request a Consultation
                    </h1>

                    <p class="text-muted">
                        Connect with a career expert and get personalized guidance.
                    </p>
                </div>

                <?php if ($message != "") { ?>

                    <div class="alert alert-success">
                        <?php echo $message; ?>
                    </div>

                <?php } ?>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">

                        <form method="POST">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Your Name
                                </label>

                               <input
    type="text"
    name="student_name"
    class="form-control"
    value="<?php echo htmlspecialchars($user_name); ?>"
    required
>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Email
                                    </label>

                                  <input
    type="email"
    name="email"
    class="form-control"
    value="<?php echo htmlspecialchars($user_email); ?>"
    required
>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Phone
                                    </label>

                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control"
                                        required
                                    >
                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Select Career Expert
                                </label>

                                <select
                                    name="expert_id"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        -- Select Expert --
                                    </option>

                                    <?php while ($expert = mysqli_fetch_assoc($experts)) { ?>

                                        <option value="<?php echo $expert['id']; ?>">
                                            <?php
                                            echo htmlspecialchars(
                                                $expert['expert_name']
                                                . " - "
                                                . $expert['specialization']
                                            );
                                            ?>
                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Message
                                </label>

                                <textarea
                                    name="message"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Tell us about your career goals..."
                                    required
                                ></textarea>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-dark px-4"
                            >
                                Submit Consultation Request
                            </button>

                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

<?php include '../includes/footer.php'; ?>