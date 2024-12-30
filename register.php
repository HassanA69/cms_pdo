<?php
include "partials/header.php";
include "partials/navbar.php";


// Check if user is already logged in
$user = new User();
if ($user->isLoggedIn()) {
    redirect('admin.php');
}


// Register form submission
if (isPostRequest()) {
    $username = getRequestData("username");
    $email = getRequestData("email");
    $password = getRequestData("password");


    $user = new User();
    if ($user->register($username, $email, $password)) {
        redirect("login.php");
    } else {
        echo "Registeration failed";
    }
}

?>

<!-- Main Content -->
<main class="container my-5">
    <h2 class="text-center mb-4">Register</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username *</label>
                    <input
                        name="username"
                        type="text"
                        class="form-control"
                        id="username"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address *</label>
                    <input
                        name="email"
                        type="email"
                        class="form-control"
                        id="email"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password *</label>
                    <input
                        name="password"
                        type="password"
                        class="form-control"
                        id="password"
                        required>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password *</label>
                    <input
                        name="confirm_password"
                        type="password"
                        class="form-control"
                        id="confirm-password"
                        required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <p class="mt-3 text-center">
                Already have an account? <a href="login.php">Login here</a>.
            </p>
        </div>
    </div>
</main>

<?php
include "partials/footer.php";

?>