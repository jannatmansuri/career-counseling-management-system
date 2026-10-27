<?php
session_start();
include '../includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, name, password FROM users WHERE email=?"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: dashboard.php");
            exit;

        }
    }

    $error = "Invalid email or password.";
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>User Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-md-5">

            <div class="card shadow border-0">

                <div class="card-body p-5">

                    <h2 class="fw-bold mb-4">
                        User Login
                    </h2>

                    <?php if ($error) { ?>

                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>

                    <?php } ?>

                    <form method="POST">

                        <input
                            type="email"
                            name="email"
                            class="form-control mb-3"
                            placeholder="Email"
                            required
                        >

                        <input
                            type="password"
                            name="password"
                            class="form-control mb-4"
                            placeholder="Password"
                            required
                        >

                        <button
                            type="submit"
                            class="btn btn-dark w-100"
                        >
                            Login
                        </button>

                    </form>

                    <p class="text-center mt-3">
                        Don't have an account?
                        <a href="register.php">Register</a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>