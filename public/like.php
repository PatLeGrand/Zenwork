<?php
    require_once __DIR__ . "/../app/controllers/LikeController.php";

    session_start();

    if(!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo "Non autorisé";
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] !== "POST") {
        http_response_code(405);
        echo "Unsupported request method.";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $postId = $_POST['post_id'] ?? null;

    if(!$postId) {
        http_response_code(400);
        echo "Missing postId";
        exit();
    }



    $controller = new LikeController();

    $likeCount = $controller->likeToggle($user_id, $postId);



    echo $likeCount . "👍 j'aime" . ($likeCount > 1 ? "s" : "");
?>
