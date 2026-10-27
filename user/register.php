<?php
session_start();
include '../includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $name,
        $email,
        $hashed_password
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Email already registered.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>

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
                        Create Account
                    </h2>

                    <?php if ($error) { ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>

                    <form method="POST">

                        <input
                            type="text"
                            name="name"
                            class="form-control mb-3"
                            placeholder="Full Name"
                            required
                        >

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
                            Register
                        </button>

                    </form>

                    <p class="text-center mt-3">
                        Already have an account?
                        <a href="login.php">Login</a>
                    </p>

                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>