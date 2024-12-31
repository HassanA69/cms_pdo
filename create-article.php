<?php
include "partials/admin/admin_header.php";
include "partials/admin/admin_navbar.php";


if (isPostRequest()) {
    $title = getRequestData('title');
    $content = getRequestData('content');
    $created_at = getRequestData('date');
    $image = getRequestData('image');
    $author_id = $_SESSION['user_id'];


    $imagePath = '';
    $targetDir = 'uploads/';
    $erorr = '';

    if (!file_exists($targetDir)) {

        mkdir($targetDir, 777, true);
    }


    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === 0) {

        $targetFile = $targetDir . basename($_FILES['featured_image']['name']);

        $imageFileType =  strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $allowedImageTypes = ['jpg', 'png', 'jepg', 'gif'];



        if (in_array($imageFileType, $allowedImageTypes)) {

            $uniqueImage = uniqid() . "_" . time() . "." . $imageFileType;
            $targetFile = $targetFile . "_" . $uniqueImage;



            if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $targetFile)) {


                $imagePath = $targetFile;
                var_dump($imagePath);
            } else {

                $erorr = 'Failed to upload image';
            }
        } else {

            $erorr = 'Invalid file type. Only JPG, PNG, JPEG, GIF are allowed.';
        }
    }


    $article = new Article();

    if ($article->create($title, $content, $author_id, $created_at, $imagePath)) {

        redirect('admin.php');
        exit;
    } else {
        echo "failed to create article";
    }
}












?>

<!-- Main Content -->
<main class="container my-5">
    <h2>Create New Article</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Article Title *</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter article title" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author *</label>
            <input type="text" class="form-control" id="author" value="<?php echo $_SESSION['username'] ?>" disabled required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Published Date *</label>
            <input name="date" type="text" class="form-control" id="date" value="<?php echo date('j-n-Y', time()) ?>" disabled required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content *</label>
            <textarea name="content" class="form-control" id="content" rows="10" placeholder="Enter article content" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Featured Image URL</label>
            <input name="featured_image" type="file" class="form-control" id="image" placeholder="Enter image URL">
        </div>
        <button type="submit" class="btn btn-success">Publish Article</button>
        <a href="admin.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</main>
<?php
include "partials/admin/admin_footer.php";
?>