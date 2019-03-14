<?php

class Post extends MysqliConnect{
    private $title ,$location,$price, $land_size, $videoLink , $description , $image , $category , $type , $id;
    
    public function setPostValue($title , $location , $price , $land_size, $videoLink , $description , $image , $category , $type , $id = null){
        $this->title        = trim($this->html($this->esc($title)));
		$this->location     = trim($this->html($this->esc($location)));
		$this->price        = (int)$price;
		$this->land_size         = (int)$land_size;
        $this->videoLink    = trim($this->html($this->esc($videoLink)));
        $this->description  = $this->esc($description);
        $this->image        = $image;
        $this->category     = (int)$category;
        $this->type         = $type;
        $this->id           = (int)$id;
    }
    
    private function checkPostInput(){
        if(empty($this->title)){
            Messages::setMsg('خطأ', "الرجاء ادخال عنوان الموضوع", 'danger');
            echo Messages::getMsg();
        }if(empty($this->location)){
            Messages::setMsg('خطأ', "location عنوان الموضوع", 'danger');
            echo Messages::getMsg();
        }if(empty($this->price)){
            Messages::setMsg('خطأ', "price عنوان الموضوع", 'danger');
            echo Messages::getMsg();
        }if(empty($this->land_size)){
            Messages::setMsg('خطأ', "land_size عنوان الموضوع", 'danger');
            echo Messages::getMsg();
        }else if(empty ($this->videoLink)){
            Messages::setMsg('خطأ', "الرجاء ادخال رابط اليوتيوب", 'danger');
            echo Messages::getMsg();
        }elseif(!preg_match("/^https:\/\/(?:www\.)?(?:youtube.com)\/(?:watch\?(?=.*v=([\w\-]+))(?:\S+)?|([\w\-]+))$/", $this->videoLink)){
            Messages::setMsg('خطأ', "الرجاء ادخال رابط يوتيوب صحيح", 'danger');
            echo Messages::getMsg();
        }else if(empty ($this->description)){
            Messages::setMsg('خطأ', "الرجاء ادخال الوصف البسيط للفيديو", 'danger');
            echo Messages::getMsg();
        }else if($this->image === null and $this->type == "add"){
            Messages::setMsg('خطأ', "الرجاء اختيار الصورة", 'danger');
            echo Messages::getMsg();
        }else if(empty ($this->category)){
            Messages::setMsg('خطأ', "الرجاء اختيار القسم", 'danger');
            echo Messages::getMsg();
        }else{
            if($this->type == 'add'){
                $image = new Image($this->image);
                if($image->Image()){
                    $this->image = $image->uploadImage;
                    return TRUE;
                }
            }else if($this->type != 'add' and $this->image !== NULL){
                $image = new Image($this->image);
                if($image->Image()){
                    $this->image = $image->uploadImage;
                    return TRUE;
                }
            }else{
                return TRUE;
            }
            return FALSE;
        }
    }
    
    public function DisplayError(){
        if($this->checkPostInput()){
            $this->checkType();
        }
    }
    
    private function checkType(){
        if($this->type == "add"){
            $this->addNewPost();
        }else{
            $this->editPost();
        }
    }
    
    private function addNewPost(){
        $link = base_convert(microtime(FALSE), 10, 36);
        $user_id = $_SESSION['user']['id'];
        $this->insert("post", "`user_id`, `title`, `location`,`price`, `land_size`,`video`, `desc`, `image`, `category` ,`link`",
                    "'$user_id','$this->title','$this->location','$this->price', '$this->land_size', '$this->videoLink','$this->description','$this->image','$this->category' , '$link'"
                );
        if($this->execute()){
            echo Messages::setMsg('تم', 'اضافة الفيديو الجديد بنجاح', 'success') . Messages::getMsg();
        }
        return FALSE;
    }
    
    private function editPost(){
        if($this->image == NULL){
            $this->update('post', "`title`='$this->title',`location`='$this->location', `price`='$this->price',`land_size`='$this->land_size', `video`='$this->videoLink',`desc`='$this->description',`category`='$this->category'", 'id', $this->id);
            if($this->execute()){
                echo Messages::setMsg('تم', 'تحديث الفيديو بنجاح', 'success') . Messages::getMsg();
            }
        }else{
            $this->update('post', "`title`='$this->title',`location`='$this->location',`price`='$this->price',`land_size`='$this->land_size',`video`='$this->videoLink',`image`='$this->image',`desc`='$this->description',`category`='$this->category'", 'id', $this->id);
            if($this->execute()){
                echo Messages::setMsg('تم', 'تحديث الفيديو بنجاح', 'success') . Messages::getMsg();
            }
        }
    }
    
    public function displayPost($other = null){
        $this->query('*', 'post' , $other);
        $this->execute();
        if($this->rowCount() > 0){
            while ($rows = $this->fetch()){
                $post[] = $rows;
            }
            return $post;
        }else{
            return NULL;
        }
    }
    
    public function deletePost($id , $dir){
        $this->query('id , image', 'post', "WHERE `id` = '{$id}'");
        if($this->execute() and $this->rowCount() > 0){
            $img = $this->fetch();
            $img_path = __DIR__ . '/../libs/uplaod/' . $img['image'];
            if(file_exists($img_path)){
                unlink($img_path);
            }
            $this->delete('post', 'id', $id);
            if($this->execute()){
                $this->delete('reply', 'post_id', $id);
                if($this->execute()){
                    echo Messages::setMsg('تم', 'حذف الفيديو بنجاح', 'success') . Messages::getMsg();
                }
            }
        }else{
            header("Location: $dir");
        }
    }
    
    public function checkPostUrl($id){
        $id = $this->esc($this->html($id));
        $this->query('id', 'post', "WHERE `link` = '{$id}'");
        if($this->execute() and $this->rowCount() > 0){
            $id = $this->fetch();
            return $id['id'];
        }else{
            header("Location: index.php");
        }
    }
    
    public function LikePost($title , $cat , $id){
        $this->query('id,title , link , image', 'post', "WHERE `title` LIKE '%$title%' AND `id` != '$id' ORDER BY RAND() LIMIT 6");
        if($this->execute() and $this->rowCount() > 0){
            while ($posts = $this->fetch()){
                $post[] = $posts;
            }
            return $post;
        }else{
            $this->query('title , link , image', 'post', "WHERE `category` = '$cat' ORDER BY RAND() LIMIT 6");
            if($this->execute() and $this->rowCount() > 0){
                while ($posts = $this->fetch()){
                    $post[] = $posts;
                }
            return $post;
            }
        }
    }
    
    public function updatePostView($id){
        $this->query('view', 'post', "WHERE `id` = '{$id}'");
        if($this->execute() and $this->rowCount() > 0){
            $view = $this->fetch();
            $newView = $view['view']+1;
            $this->update('post', "`view` = '$newView'", 'id', $id);
            $this->execute();
        }
    }
    
    public function addNewComment($id , $comment){
        $id = (int)$id;
        $comment = $this->esc($this->html($comment));
        $user = $_SESSION['user']['id'];
        $this->insert('reply', '`user_id`, `post_id`, `comment`', "'$user','$id','$comment'");
        if($this->execute()){
            $replyId = $this->lastId();
            $this->query('*', 'reply' , 'WHERE `id` = '.$replyId.'');
            if($this->execute()){
                $user = $this->fetch();
                
                echo '<div style="margin: 20px 0;">
                  <div style="background: #d2d2d2;padding: 5px;">
                      <div class="pull-right"><p><i class="glyphicon glyphicon-user"></i> 
                      <span>'.$this->getUserNameById($user['user_id']).'</span></p></div>
                      '; 
                        if(isset($_SESSION['is_logged']) and $_SESSION['is_logged'] == TRUE and $_SESSION['user']['id'] == $user['user_id']):?>
                      <?php echo '<div class="pull-left"><a id="deleteReply" rel="'.$user['id'].'" data-toggle="tooltip" data-placement="top" title="حذف التعليق">
                            <i class="glyphicon glyphicon-trash" style="color: #f56e6e"></i></a></div>';
                      endif;
                      echo '
                      <div class="clearfix"></div>
                      <div style="background: #fff;padding: 4px;border-radius: 4px;border: solid 1px #d0d0d0;">'.$user['comment'].'</div>
                  </div>
              </div>';
              ?>
                <script>
                    $("#deleteReply").on("click" , function(){
                       var comment = $(this);
                       var id = $(this).attr('rel');
                       if(confirm("هل انت متأكد من حذفك للتعليق؟")){
                           $.ajax({
                               url: 'inc/ajax/deleteComment.php',
                               type: 'post',
                               data: "id="+id,
                               success: function(){
                                   comment.parent().parent().fadeOut('slow');
                               }
                           });
                       }
                    });
                </script>
            <?php
            }
        }
    }
    
    public function getPostreply($id){
        $id = (int)$id;
        $this->query("comment , id , user_id", 'reply', "WHERE `post_id` = '$id' ORDER BY `id` DESC");
        if($this->execute() and $this->rowCount() > 0){
            while ($comments = $this->fetch()){
                $comment[] = $comments;
            }
            return $comment;
        }else{
            return NULL;
        }
    }
    
    public function getUserNameById($id){
        $this->query('farstname , lastname', 'users', "WHERE `id` = '$id'");
        if($this->execute() and $this->rowCount() > 0){
            $user = $this->fetch();
            return $user['farstname'] . ' ' . $user['lastname'];
        }
        return NULL;
    }
    public function getLinkPostById($id){
        $this->query('link', 'post', "WHERE `id` = '$id'");
        if($this->execute() and $this->rowCount() > 0){
            $post = $this->fetch();
            return $post['link'];
        }
        return NULL;
    }
    public function deletePostReply($id){
        $this->query('id', 'reply', "WHERE `id` = '{$id}'");
        if($this->execute() and $this->rowCount() > 0){
            $this->delete('reply', 'id', $id);
            if($this->execute()){
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public function viewCount($id){
        $this->query('view', "post" , "WHERE `id` = '{$id}'");
        if($this->execute() and $this->rowCount() > 0){
            $view = $this->fetch();
            return $view['view'];
        }else{
            return 0;
        }
    }
    
    public function replyCount($id){
        $this->query('id', "reply" , "WHERE `post_id` = '{$id}'");
        if($this->execute() and $this->rowCount() > 0){
            return $this->rowCount();
        }else{
            return 0;
        }
    }
    
    public function postsCount(){
        $this->query('id', 'post');
        $this->execute();
        return $this->rowCount();
    }
    
    public function replysCount(){
        $this->query('id', 'reply');
        $this->execute();
        return $this->rowCount();
    }
    
    public function displayreply($other = null){
        $this->query('*', 'reply' , $other);
        $this->execute();
        if($this->rowCount() > 0){
            while ($rows = $this->fetch()){
                $post[] = $rows;
            }
            return $post;
        }else{
            return NULL;
        }
    }
    
    public function getPostTotalReply($id){
        $this->query('id', 'reply', "WHERE `post_id` = '{$id}'");
        if($this->execute() and $this->rowCount() > 0){
            return $this->rowCount();
        }
        return 0;
    }
}
