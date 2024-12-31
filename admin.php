<?php
include "partials/admin/admin_header.php";
include "partials/admin/admin_navbar.php";
$user = new User();
$article = new Article();



$userID = $_SESSION['user_id'];

// Get user's articles
$userArticles = $article->get_by_user_id($userID);


?>

<!-- Main Content -->
<main class="container my-5">
    <h2 class="mb-4">Welcome <?php echo $_SESSION['username']; ?> to Admin Dashboard</h2>

    <!-- Articles Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Excerpt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($userArticles)): ?>
                    <?php foreach ($userArticles as $articleItem): ?>
                        <!-- Example Article Row -->
                        <tr>
                            <td><?php echo $articleItem->id ?></td>
                            <td><?php echo $articleItem->title ?></td>
                            <td><?php echo $_SESSION['username'] ?></td>
                            <td><?php echo format_date($articleItem->created_at); ?></td>
                            <td>
                                <?php echo $article->get_Excerpt($articleItem->content) ?>
                            </td>
                            <td class="d-flex align-items-center">
                                
                                <!-- Edit button -->
                                <a href="edit-article.php?id=<?php echo $articleItem->id ?>" class="btn btn-sm btn-primary me-1">Edit</a>

                                <!-- Delet button -->
                                <form method="post" action="<?php echo base_url('delete_article.php') ?>">
                                    <input name="article_id" value="<?php echo $articleItem->id ?>" type="hidden">
                                    <!-- <button class="btn btn-sm btn-danger" onclick="confirmDelete(1)">Delete</button> -->
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?php echo $articleItem->id ?>)">Delete</button>

                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php
include "partials/admin/admin_footer.php";
?>