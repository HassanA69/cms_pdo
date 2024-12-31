<?php
require_once 'init.php';
chechUserLoggedIn();
if (isPostRequest()) {

    $id = $_POST['article_id'];
    $article = new Article();
    if (!$article->deleteArticleWithImage($id)) {
        echo "Failed to delete article";
    } else {
        redirect('admin.php');
    }
}
