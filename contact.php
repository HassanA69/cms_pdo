<?php
include "partials/header.php";
include "partials/navbar.php";

?>

<!-- Main Content -->
<main class="container my-5">
    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-6">
            <h2>Get in Touch</h2>
            <form action="mailto:hassan.abdelnaby69@gmail.com" method="post" enctype="text/plain">
                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message *</label>
                    <textarea
                        class="form-control"
                        id="message"
                        rows="5"
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
        <!-- Contact Information -->
        <div class="col-md-6">
            <h2>Contact Information</h2>
            <p>
                Feel free to reach out to us through any of the following methods.
            </p>
            <ul class="list-unstyled">
                <li>
                    <strong>Email:</strong> <a href="mailto:hassan.abdelnaby69@gmail.com">hassan.abdelnaby69@gmail.com</a>
                </li>
                <li>
                    <strong>Phone:</strong> (+20) 1033140374
                </li>
                <li>
                    <strong>Address:</strong> assiut, Egypt
                </li>
            </ul>
            <h2>Follow Us</h2>
            <a href="https://www.linkedin.com/in/hassan-abdelnaby-" class="text-decoration-none me-3">
                <img src="https://skillicons.dev/icons?i=linkedin&perline=3" alt="">
            </a>
            <a href="https://github.com/HassanA69" class="text-decoration-none me-3">
                <img src="https://skillicons.dev/icons?i=github&perline=3" alt="">
            </a>

        </div>
    </div>
</main>
<?php
include "partials/footer.php";

?>