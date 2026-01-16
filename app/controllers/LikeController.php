<?php
    require_once __DIR__ . '/../models/Like.php';
    class LikeController {
    private Like $likeModel;

    public function __construct(){
        $this->likeModel = new Like();
    }

    public function likeToggle($userId, $postId) {
        if($this->likeModel->hasLiked($userId, $postId)) {
            $this->likeModel->removeLike($userId, $postId);
        } else {
            $this->likeModel->addLike($userId, $postId);
        }

        return $this->likeModel->getLikesCount($postId);
    }
}