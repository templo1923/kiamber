<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    <?php echo $__env->make('admin.stylesheet', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body>
    
    <?php echo $__env->make('admin.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Right Panel -->
    <?php if(in_array('settings',$avilable)): ?>
    <div id="right-panel" class="right-panel">

       
                       <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('Ads')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        
        <?php echo $__env->make('admin.warning', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                       
                        
                        
                      
                        <div class="card">
                           <?php if($demo_mode == 'on'): ?>
                           <?php echo $__env->make('admin.demo-mode', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                           <?php else: ?>
                           <form action="<?php echo e(route('admin.ads')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          <div class="col-md-12 mt-3"><h5><?php echo e(__('Top Ads')); ?></h5></div>
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                           
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><strong><?php echo e(__('Pages')); ?></strong> </label><br/>
                                                <?php $__currentLoopData = $ads_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input id="top_ads_pages" name="top_ads_pages[]" type="checkbox" class="noscroll_textarea" value="<?php echo e($key); ?>" <?php if(in_array($key,$top_ads_pages)): ?> checked <?php endif; ?>> <?php echo e($value); ?> <?php if($key == 'pages'): ?> (ex: about us, faq,...ect) <?php endif; ?><br/>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>  
                                            
                                            
                                            
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                             <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                                                
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Example Code')); ?> </label>
                                                <br> <img src="<?php echo e(url('/')); ?>/resources/views/admin/template/images/ins.png">
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Ads Code')); ?></label>
                                                <textarea name="top_ads" id="top_ads" rows="6" class="form-control noscroll_textarea"><?php echo e($setting['setting']->top_ads); ?></textarea>
                                            </div> 
                                            
                                           
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             <div class="col-md-12 mt-3"><h5><?php echo e(__('Sidebar Ads')); ?></h5></div>
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                           
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><strong><?php echo e(__('Pages')); ?></strong> </label><br/>
                                                <?php $__currentLoopData = $ads_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span <?php if($key == 'shop' || $key == 'item-details' || $key == 'blog' || $key == 'post-details'): ?>  <?php else: ?> style="display:none;" <?php endif; ?>>
                                                <input id="sidebar_ads_pages" name="sidebar_ads_pages[]" type="checkbox" class="noscroll_textarea"  value="<?php echo e($key); ?>" <?php if(in_array($key,$sidebar_ads_pages)): ?> checked <?php endif; ?>> <?php echo e($value); ?> <?php if($key == 'pages'): ?> (ex: about us, faq,...ect) <?php endif; ?> <br/></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>  
                                            
                                            
                                            
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                                                
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Example Code')); ?> </label>
                                                <br> <img src="<?php echo e(url('/')); ?>/resources/views/admin/template/images/ins.png">
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Ads Code')); ?> </label>
                                                <textarea name="sidebar_ads" id="sidebar_ads" rows="6" class="form-control noscroll_textarea"><?php echo e($setting['setting']->sidebar_ads); ?></textarea>
                                            </div> 
                                            
                                           
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             <div class="col-md-12 mt-3"><h5><?php echo e(__('Bottom Ads')); ?></h5></div>
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                           
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><strong><?php echo e(__('Pages')); ?></strong> </label><br/>
                                                <?php $__currentLoopData = $ads_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input id="bottom_ads_pages" name="bottom_ads_pages[]" type="checkbox" class="noscroll_textarea" value="<?php echo e($key); ?>" <?php if(in_array($key,$bottom_ads_pages)): ?> checked <?php endif; ?>> <?php echo e($value); ?> <?php if($key == 'pages'): ?> (ex: about us, faq,...ect) <?php endif; ?><br/>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>  
                                            
                                            
                                            
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                                                
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Example Code')); ?> </label>
                                                <br> <img src="<?php echo e(url('/')); ?>/resources/views/admin/template/images/ins.png">
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Ads Code')); ?></label>
                                                <textarea name="bottom_ads" id="bottom_ads" rows="6" class="form-control noscroll_textarea"><?php echo e($setting['setting']->bottom_ads); ?></textarea>
                                            </div> 
                                            
                                           
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             <input type="hidden" name="sid" value="1">
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> <?php echo e(__('Submit')); ?></button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> <?php echo e(__('Reset')); ?> </button>
                             </div>
                             
                             </div>
                             
                            
                            </form>
                            
                                                    
                                                    
                                                 
                            
                        </div> 

                     
                    
                    
                    </div>
                    

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


   <?php echo $__env->make('admin.javascript', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


</body>

</html>
<?php /**PATH /home/catalogo/public_html/resources/views/admin/ads.blade.php ENDPATH**/ ?>