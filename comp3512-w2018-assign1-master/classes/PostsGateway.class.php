<?php
class PostsGateway extends TableDataGateway {
    
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT Posts.PostID, MainPostImage, Posts.UserID, CONCAT(Users.FirstName,' ',Users.LastName) AS FullName, Posts.Title, Posts.Message, PostTime, ImageDetails.Path
        FROM Posts 
        INNER JOIN PostImages ON  PostImages.PostID = Posts.PostID
        INNER JOIN ImageDetails ON PostImages.ImageID = ImageDetails.ImageID
        AND ImageDetails.ImageID = Posts.MainPostImage
        INNER JOIN Users ON Users.UserID = Posts.UserID";
    }
    
    protected function getOrderFields() {
        return 'PostTime';
    }
    
    protected function getPrimaryKeyName() {
        return "PostID";
    }
    
    protected function getForeignKey() {
        return "PostID";
    }
    
    protected function getPageName() {
        return "single-post.php?id=";
    }
    
    protected function getLabel() {
        return "Title";
    }
}
?>