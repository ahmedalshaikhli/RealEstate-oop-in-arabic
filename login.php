<?php require_once 'inc/topHeader.php'; ?>
<title>تسجيل الدخول - <?php echo SITENAME;?></title>
<?php require_once 'inc/header.php'; ?>
<!-- NAVBAR START -->
<?php require_once 'inc/navbar.php'; ?>
<!-- NAVBAR END ---->
<!-- INDEX MAIN -->

<main class="container" style="padding-top:50px">
  <div class="row">
      <article class="col-xs-12 col-md-12">
          <div class="col-md-6 col-md-offset-3" style="padding: 0">
              <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['login'])){
                    $login = new Login;
                    $login->setInput($_POST['email'], $_POST['password']);
                    $login->DisplayError();
                }
              ?>
          </div>
          <div class="col-md-6 col-md-offset-3" style="background: #eeeeee;border: solid 1px #dadada;margin-bottom: 20px;">
            <div class="page-header">
                <h1 style="font-size: 32px;"><i class="glyphicon glyphicon-log-in"></i> تسجيل الدخول</h1>
            </div>
              <?php
              if(isset($_SESSION['is_logged']) and $_SESSION['is_logged'] == TRUE){
                  Messages::setMsg('تنبية', 'انت مسجيل دخويل بالفعل يا ' . $_SESSION['user']['fname'] .' '.$_SESSION['user']['lname'], 'warning');
                  echo Messages::getMsg();
              }else{
                  require_once 'inc/forms/login.php';
              }
              ?>
  </div>
      </article>
  </div>

</main>
  <footer class="container-fluid" style="background: #f8f8f8 ; border-top: solid 1px #e7e7e7; padding: 20px; position:fixed;bottom:0;width:100%;">
    <div class="container">
        <div class="row">
            <div class="text-center">جميع الحقوق محفوظة  &copy; <?php echo date('Y');?></div>
        </div>
    </div>
</footer>
<!-- END INDEX MAIN -->
<!-- FOOTER START -->
