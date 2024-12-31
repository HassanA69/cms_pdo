<?php
require_once "partials/header.php";
include base_path("partials/navbar.php");
include base_path("partials/hero.php");

$articleID = isset($_GET['id']) ? (int)$_GET['id'] : null;

// check if the article is already exists
if ($articleID) {
    $article = new Article();


    $articleData = $article->get_owner($articleID);
} else {
    echo "Article not found";
    exit;
}

?>


<!-- Main Content -->
<main class="container my-5">


    <!-- Featured Image -->
    <div class="col-md-6 mx-auto text-center my-4">
        <?php if (!empty($articleData->image)): ?>
            <img
                src="<?php echo htmlspecialchars($articleData->image); ?>"
                class="img-fluid rounded shadow-lg border"
                alt="Featured Image"
                style="max-height: 400px; object-fit: cover;">
        <?php else: ?>
            <img
                src="https://placehold.co/1000x500"
                class="img-fluid rounded shadow-lg border"
                alt="Placeholder Image"
                style="max-height: 400px; object-fit: cover;">
        <?php endif; ?>
    </div>



    </section>




    <!-- Article Content -->
    <article class="container my-5 p-4 bg-light rounded shadow-sm">
        <h1 class="text-center display-4 "><?php echo $articleData->title ?></h1>
        <p> <?php echo nl2br(htmlspecialchars($articleData->content)) ?></p>
    </article>
    <section>
        <div class="container">

            <small>
                By <a href=""><?php echo trim($articleData->author, " ") ?></a>
                <span>
                    Published on <?php echo $article->format_date($articleData->created_at) ?>
                </span>
            </small>
        </div>


        <!-- Comments Section Placeholder -->
        <section class=" mt-5">
            <h3>Comments</h3>
            <p>
                <!-- Placeholder for comments -->
                Comments functionality will be implemented here.
            </p>
        </section>

        <!-- Back to Home Button -->
        <div class="mt-4">
            <a href="index.php" class="btn btn-secondary">← Back to Home</a>
        </div>
</main>


<?php
include "partials/footer.php";

?>