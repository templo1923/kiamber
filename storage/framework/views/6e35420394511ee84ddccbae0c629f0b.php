<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<title><?php echo e($product_name); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!-- CSS Style -->
<link rel="stylesheet" href="<?php echo e(URL::to('resources/views/theme/preview/css/frame.css')); ?>">
<!-- Favicons -->
<link rel="canonical" href="<?php echo e($product_url); ?>" />
<?php if($allsettings->site_favicon != ''): ?>
<link rel="apple-touch-icon" href="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>">
<link rel="shortcut icon" href="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>">
<?php endif; ?>
<!-- JavaScript -->
<script type="text/javascript" src="<?php echo e(URL::to('resources/views/theme/preview/js/jquery-1.9.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::to('resources/views/theme/preview/js/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/theme/preview/js/custom.js')); ?>"></script>
</head>
<body>
<div id="switcher"  style="background-color: #000000" >
<div class="center">
    <div class="logo"> 
    <?php if($allsettings->site_logo != ''): ?>
    <a href="<?php echo e(URL::to('/')); ?>" class="navbar-brand m-r-lg" target="_blank"><img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="<?php echo e($allsettings->site_title); ?>"></a> 
    <?php endif; ?>
    </div>
    <ul>
      <li id="theme_list"><a id="theme_select" href="<?php echo e(URL::to('/shop')); ?>"><?php echo e(__('All Items')); ?></a>
        <ul id="test1a">
          <?php $__currentLoopData = $allproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="<?php echo e(URL::to('/preview')); ?>/<?php echo e($product->product_slug); ?>" ><?php echo e($product->product_name); ?></a></li>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
     </li>
  </ul>
<div class="responsive"><a href="#" class="desktop active" title="View Desktop Version"></a> <a href="#" class="tabletlandscape" title="View Tablet Landscape (1024x768)"></a> <a href="#" class="tabletportrait" title="View Tablet Portrait (768x1024)"></a> <a href="#" class="mobilelandscape" title="View Mobile Landscape (480x320)"></a> <a href="#" class="mobileportrait" title="View Mobile Portrait (320x480)"></a></div>
<ul class="links">
          <li class="purchase" rel=""> <a href="<?php echo e($product_url); ?>"><img src="<?php echo e(URL::to('resources/views/theme/preview/images/purchase.png')); ?>" alt="<?php echo e(__('Purchase')); ?>" /> <?php echo e(__('Purchase')); ?></a> </li>
          <li class="close" rel="<?php echo e($demo_url); ?>"> <a href="<?php echo e($demo_url); ?>"><img src="<?php echo e(URL::to('resources/views/theme/preview/images/cross.png')); ?>" alt="<?php echo e(__('Close')); ?>" /> <?php echo e(__('Close')); ?></a></li>
        </ul>
</div>
</div>
<iframe id="iframe" src="<?php echo e($demo_url); ?>" frameborder="0" width="100%" height="100%"></iframe>
</body>
</html><?php /**PATH /home/catalogo/public_html/resources/views/preview.blade.php ENDPATH**/ ?>