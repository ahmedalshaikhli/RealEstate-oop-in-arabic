<?php require_once 'inc/topHeader.php'; ?>
<title>ﻟﻮﺣﺔ اﻟﺘﺤﻜﻢ - <?php echo SITENAME ?></title>
<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/navbar.php'; ?>

<div class="container-fluid">
  <div class="row">
    <?php require_once 'inc/sidebar.php'; ?>
      
           <?php
            if($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['delete-reply'])){
                $id = (int)$_GET['delete-reply'];
                if($post->deletePostReply($id) == FALSE){
                    header("Location: index.php");
                }else{
                    echo '<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">';
                    echo Messages::setMsg('ﺗﻢ', 'ﺣﺬﻑ اﻟﺘﻌﻠﻴﻖ ﺑﻨﺠﺎﺡ', 'success') . Messages::getMsg();
                    echo '</div>';
                }
            }
            if($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['delete-post'])){
                $id = (int)$_GET['delete-post'];
                echo '<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">';
                $post->deletePost($id , $_SERVER['PHP_SELF']);
                echo '</div>';
            }
          ?>
          
      
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1 class="page-header"><i class="glyphicon glyphicon-dashboard"></i> ﻟﻮﺣﺔ اﻟﺘﺤﻜﻢ</h1>
      <div class="col-md-12">
          <div class="row">
          <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0">
                    <ul class="list-group" style="margin-bottom: 0">
                        <li class="list-group-item">اﻹﺳﻢ : <?php echo $_SESSION['user']['fname'] .' ' . $_SESSION['user']['lname'];?></li>
                        <li class="list-group-item">اﻟﺒﺮﻳﺪ : <?php echo $_SESSION['user']['email']?></li>
                        <li class="list-group-item">اﻟﺮﺗﺒﺔ : ﻣﺪﻳﺮ اﻟﻤﻮﻗﻊ</li>
                  </ul>
              </div>
                <div class="panel-footer">
                    <a href="edit-user.php?id=<?php echo $_SESSION['user']['id']?>" class="pull-left btn btn-warning btn-sm">ﺗﻌﺪﻳﻞ اﻟﺒﻴﺎﻧﺎﺕ</a>
                    <a href="../index.php?logout=true" class="pull-right btn btn-danger btn-sm">ﺗﺴﺠﻴﻞ اﻟﺨﺮﻭﺝ</a>
                    <div class="clearfix"></div>
                </div>
            </div>
          </div>
         <div class="col-md-8">
          <div class="col-md-4">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title text-center">اﻻﻋﻀﺎء اﻟﻤﺴﺠﻠﻴﻦ</h3>
              </div>
              <div class="panel-body">
                  <h1 class="pull-right" style="color: #204d74"><i class="glyphicon glyphicon-user"></i> </h1>
                  <p class="pull-left" style="font-size: 24px; color: #122b40"><?php echo $users->usersCount(); ?></p>
                  <div class="clearfix"></div>
              </div>
                <div class="panel-footer text-center">
                    <i class="glyphicon glyphicon-eye-open"></i> <a href="users.php"> ﻣﺸﺎﻫﺪﺓ</a>
                </div>
            </div>
          </div>
              <div class="col-md-4">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title text-center">اﻟﺘﻌﻠﻴﻘﺎﺕ</h3>
              </div>
              <div class="panel-body">
                  <h1 class="pull-right" style="color: #204d74"><i class="glyphicon glyphicon-comment"></i> </h1>
                  <p class="pull-left" style="font-size: 24px; color: #122b40"><?php echo $post->replysCount(); ?></p>
                  <div class="clearfix"></div>
              </div>
              <div class="panel-footer text-center">
                  <i class="glyphicon glyphicon-eye-open"></i> <a href="comments.php"> ﻣﺸﺎﻫﺪﺓ</a>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title text-center">العقارات</h3>
              </div>
              <div class="panel-body">
                  <h1 class="pull-right" style="color: #204d74"><i class="glyphicon glyphicon-home"></i> </h1>
                  <p class="pull-left" style="font-size: 24px; color: #122b40"><?php echo $post->postsCount(); ?></p>
                  <div class="clearfix"></div>
              </div>
                <div class="panel-footer text-center">
                    <i class="glyphicon glyphicon-eye-open"></i> <a href="tubes.php"> ﻣﺸﺎﻫﺪﺓ</a>
                </div>
            </div>
          </div>
          </div>
              
         <div class="clearfix"></div>
         <hr/>
         
         <div class="panel panel-info">
             <div class="panel-heading">
                 <div class="panel-title"><i class="glyphicon glyphicon-film"></i> ﺟﺪﻳﺪ  اﻟﻌﻘﺎﺭاﺕ</div>
             </div>
             <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">اﻟﺼﻮﺭﺓ</th>
                      <th class="text-center">اﻟﻌﻨﻮاﻥ</th>
                      <th class="text-center">اﻟﻘﺴﻢ</th>
                      <th class="text-center">ﻣﺸﺎﻫﺪﺓ</th>
                      <th class="text-center">ﺗﻌﺪﻳﻞ</th>
                      <th class="text-center">ﺣﺬﻑ</th>
                  </tr>
              </thead>
              <tbody>
              <?php 
              $rows = $post->displayPost("ORDER BY `id` DESC LIMIT 10"); 
              $i=1;
                  if($rows != null):
                      foreach ($rows as $row):
              ?>
                  <tr class="text-center">
                      <td><?php echo $i++;?></td>
                      <td><img src="../libs/uplaod/<?php echo $row['image'] ?>" width="52px" height="42px"/></td>
                      <td><?php echo $row['title'] ?></td>
                      <td><?php echo $category->getCateNameById($row['category']) ?></td>
                      <td><a href="../video.php?v=<?php echo $row['link'] ?>" class="btn btn-sm btn-info">ﻣﺸﺎﻫﺪﻩ</a></td>
                      <td><a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-warning">ﺗﻌﺪﻳﻞ</a></td>
                      <td><a href="index.php?delete-post=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">ﺣﺬﻑ</a></td>
                  </tr>
              <?php endforeach;
                  else:
              ?>
                  <tr class="text-center">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>ﻻ ﻳﻮﺟﺪ اﻳﺔ ﻣﻮاﺿﻴﻊ ﺑﻌﺪ</td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
              <?php endif; ?>
              </tbody>
          </table>
        </div>
              
             </div>
         </div>
         
<div class="clearfix"></div>
         <hr/>
         
         <div class="panel panel-default">
             <div class="panel-heading">
                 <div class="panel-title"><i class="glyphicon glyphicon-comment"></i> ﺟﺪﻳﺪ اﻟﺘﻌﻠﻴﻘﺎﺕ</div>
             </div>
             <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">اﻻﺳﻢ</th>
                                <th class="text-center">اﻟﺘﻌﻠﻴﻖ</th>
                                <th class="text-center">ﻣﺸﺎﻫﺪﺓ</th>
                                <th class="text-center">ﺣﺬﻑ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        $rows = $post->displayreply("ORDER BY `id` DESC LIMIT 5"); 
                        $i=1;
                            if($rows != null):
                                foreach ($rows as $row):
                        ?>
                            <tr class="text-center">
                                <td><?php echo $i++;?></td>
                                <td><?php echo $post->getUserNameById($row['user_id']); ?></td>
                                <td><?php echo (mb_strlen($row['comment'] , 'utf8') > 50 ? mb_substr($row['comment'],0,50) .' ...' : $row['comment']) ?></td>
                                <td><a href="../video.php?v=<?php echo $post->getLinkPostById($row['post_id']); ?>" class="btn btn-sm btn-info" target="_blank">ﻣﺸﺎﻫﺪﻩ</a></td>
                                <td><a href="index.php?delete-reply=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">ﺣﺬﻑ</a></td>
                            </tr>
                        <?php endforeach;
                            else:
                        ?>
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td>ﻻ ﻳﻮﺟﺪ اﻳﺔ ﺗﻌﻠﻴﻘﺎﺕ ﺑﻌﺪ</td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                  </div>
             </div>
         </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'inc/footer.php'; ?>


