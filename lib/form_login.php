<?php
require("lib/config.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$webname;?> - Login</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href='<?=$favicon;?>' rel='icon' type='image/x-icon'/>
    <link href='<?=$favicon;?>' rel='icon' sizes='32x32'/>
    <link href='<?=$favicon;?>' rel='icon' sizes='100x100'/>
    <link href='<?=$favicon;?>' rel='apple-touch-icon'/>
    <meta content='<?=$favicon;?>' name='msapplication-TileImage'/>
  </head>

  <body class="login" style="background-image: url(images/logo_perkebunan.jpg);background-size:cover;background-repeat:no-repeat;">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
            <h1 class="text-dark"><?=$webname;?></h1>
              <div>
                <input type="text" class="form-control" name="username" placeholder="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-secondary w-100 submit" name="submit">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  
                  <p class="text-dark">©<?=date('Y');?> All Rights Reserved By <?=$developer;?></p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>