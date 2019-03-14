<?php require_once 'inc/topHeader.php'; ?>
<title>ركن المنصور</title>
<?php require_once 'inc/header.php'; ?>
<!-- NAVBAR START -->
<?php require_once 'inc/navbar.php'; ?>
<!-- NAVBAR END ---->
<!-- HEADER START -->
<?php require_once 'inc/welcome.php'; ?>
<!-- HEADER END --->
<!-- INDEX MAIN -->

<main class="container" style="margin-bottom: 120px; ">
   <div class="row">
	 <div class="col-md-12 title-new">
	 <h2 class="call-us">  جديد العقارات <span class="call-us-text hidden-xs">تفقد اخر العقارات ستجد جميع انواع العقارات</span> </h2>
     <div class="hr-color"></div>
	 </div>
  </div>
  	
  <div class="row">
      <div class="col-xs-12 col-md-12">
          <?php $posts = $post->displayPost("ORDER BY RAND() , `id` DESC LIMIT 9");
            foreach ($posts as $postid):
          ?>
          <div class="col-md-4" style="position: relative;">
              <div style="position: absolute;left: 75px;top: 10px;color: #ffffff;font-size: 12px;background: rgba(0, 0, 0, 0.45);padding: 3px 8px;border-radius: 3px;" data-toggle="tooltip" data-placement="top" title="المشاهدات">
                  <i class="glyphicon glyphicon-eye-open" style="color: #c7c7c7;" ></i> <?php echo $post->viewCount($postid['id']); ?>
              </div>
              <div style="position: absolute;left: 25px;top: 10px;color: #ffffff;font-size: 12px;background: rgba(0, 0, 0, 0.45);padding: 3px 8px;border-radius: 3px;" data-toggle="tooltip" data-placement="top" title="التعليقات">
                  <i class="glyphicon glyphicon-comment" style="color: #d0c358;"></i> <?php echo $post->replyCount($postid['id']); ?>
              </div>
              <div style="background: #f6f5f7;margin-bottom: 20px;box-shadow: 18 0.125rem 6.25rem rgba(99,0,0,0.077)!important;padding-bottom: 12px; ">
                  <img src="libs/uplaod/<?php echo $postid['image'] ?>" class="img-responsive" style="width: 100%;height: 250px;" />
                <h5 style="padding:20px;margin: 5px 0;font-weight: bold;"><?php echo (mb_strlen($postid['title'] , 'utf8') > 40 ? mb_substr($postid['title'],0,40).' ...' : $postid['title']) ?></h5>
                <a href="category.php?cat=<?php echo $category->getCateLinkById($postid['category']); ?>"><h5 style="background: #fbd959;padding: 5px 12px;margin: 5px 0;border: solid 1px #fbd959;position: absolute;top: 30px;color: #233142; font-family: myFirstFont;"><?php echo $category->getCateNameById($postid['category'])?></h5></a>
  
				<table class="table table-bordered ">
				  <tbody>
					<tr>
					  <td>السعر</td>
					  <td> <?php echo $postid['price']?> </td>
					</tr>
					<tr>
					 <td>المساحة</td>
					 <td> <?php echo $postid['land_size']?> م </td>
					</tr>
					<tr>
					 <td>الموقع</td>
					 <td>  <?php echo $postid['location']?> </td>
					</tr>
				  </tbody>
				</table>

                <div class="text-center" ><a href="video.php?v=<?php echo $postid['link'] ?>" class="btn btn-danger">باقي التفاصيل</a></div>
              </div>
          </div>
          <?php endforeach; ?>
      </div>
  </div>
</main>
  
        <!-- Start Section Contact Us -->
        <?php require_once 'inc/contact-us.php'; ?>
        

<!-- END INDEX MAIN -->
<!-- FOOTER START -->
<?php require_once 'inc/footer.php'; ?>