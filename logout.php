<?php
require_once 'init.php';


// Check if the user is logged in
if (isPostRequest()) {

    session_destroy();
    $_session = array(); // Stop the session
    redirect('index.php');
    exit;
} else {
    redirect('index.php');
    exit;
}
