<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if($allsettings->site_favicon != ''): ?>
    <link rel="apple-touch-icon" href="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>">
    <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>">
    <?php endif; ?>
    <title><?php echo e($allsettings->m_mode_title); ?> - <?php echo e($allsettings->site_title); ?></title>
    <link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/assets/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/assets/css/bd-coming-soon.css')); ?>">
    <?php if($allsettings->m_mode_background == "image"): ?>
	<style type="text/css">
	body {
	  background-image: url("<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->m_mode_bgimage); ?>");
	  background-size: cover;
	  background-repeat: no-repeat;
	  background-position: center;
	  color: #ffffff;
	  padding-bottom: 75px; 
	  }
  </style>
  <?php else: ?>
  <style type="text/css">
	body {
	  
	  background-size: cover;
	  background-color:<?php echo e($allsettings->m_mode_bgcolor); ?>;
	  background-repeat: no-repeat;
	  background-position: center;
	  color: #ffffff;
	  padding-bottom: 75px; 
	  }
  </style>
  <?php endif; ?>
</head>

<body class="min-vh-100 d-flex flex-column">

    <header>
        <div class="container">
            <nav class="navbar navbar-dark bg-transparenet">
                <a class="navbar-brand" href="<?php echo e(URL::to('/')); ?>">
                    <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="<?php echo e($allsettings->site_title); ?>">
                </a>
                <?php if($allsettings->office_phone != ""): ?>
                <span class="navbar-text ml-auto d-none d-sm-inline-block"><?php echo e($allsettings->office_phone); ?></span>
                <?php endif; ?>
                <?php if($allsettings->office_email != ""): ?>
                <span class="navbar-text d-none d-sm-inline-block"><?php echo e($allsettings->office_email); ?></span>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="my-auto">
        <div class="container">
            <?php if($allsettings->m_mode_title != ""): ?>
            <h1 class="page-title"><?php echo e($allsettings->m_mode_title); ?></h1>
            <?php endif; ?>
            <?php if($allsettings->m_mode_content != ""): ?>
            <p class="page-description"><?php echo html_entity_decode($allsettings->m_mode_content); ?>
            </p>
            <?php endif; ?>
            <?php if($allsettings->m_mode_social_label != ""): ?>
            <p><?php echo e($allsettings->m_mode_social_label); ?></p>
            <?php endif; ?>
            <nav class="footer-social-links">
                <?php if($allsettings->facebook_url != ''): ?>
                <a href="<?php echo e($allsettings->facebook_url); ?>" class="social-link" target="_blank"><i class="mdi mdi-facebook-box"></i></a>
                <?php endif; ?>
                <?php if($allsettings->twitter_url != ''): ?>
                <a href="<?php echo e($allsettings->twitter_url); ?>" class="social-link" target="_blank"><i class="mdi mdi-twitter"></i></a>
                <?php endif; ?>
                <?php if($allsettings->pinterest_url != ''): ?>
                <a href="<?php echo e($allsettings->pinterest_url); ?>" class="social-link" target="_blank"><i class="mdi mdi-pinterest"></i></a>
                <?php endif; ?>
                <?php if($allsettings->gplus_url != ''): ?>
                <a href="<?php echo e($allsettings->gplus_url); ?>" class="social-link" target="_blank"><i class="mdi mdi-linkedin"></i></a>
                <?php endif; ?>
                <?php if($allsettings->instagram_url != ''): ?>
                <a href="<?php echo e($allsettings->instagram_url); ?>" class="social-link" target="_blank"><i class="mdi mdi-instagram"></i></a>
                <?php endif; ?>
            </nav>
        </div>
    </main>
</body>
</html><?php /**PATH /home/catalogo/public_html/resources/views/503.blade.php ENDPATH**/ ?>