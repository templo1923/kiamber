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
    <div id="right-panel" class="right-panel">
     <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('PWA Settings')); ?></h1>
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
                           <form action="<?php echo e(route('admin.pwa-settings')); ?>" method="post" id="checkout_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                          <label for="site_title" class="control-label mb-1"><?php echo e(__('App Name')); ?> <span class="require">*</span></label>
                                           <input id="app_name" name="app_name" type="text" class="form-control noscroll_textarea" value="<?php echo e($additional->app_name); ?>" data-bvalidator="required">
                                           </div>
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Background Color')); ?> <span class="require">*</span></label>
                                                <input id="background_color" name="background_color" type="text" class="form-control noscroll_textarea" value="<?php echo e($additional->background_color); ?>" data-bvalidator="required"><small>Example : #ffffff</small></div>
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Short Name')); ?> <span class="require">*</span></label>
                                                <input id="short_name" name="short_name" type="text" class="form-control noscroll_textarea" value="<?php echo e($additional->short_name); ?>" data-bvalidator="required"></div>
                                                <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Theme Color')); ?> <span class="require">*</span></label>
                                                <input id="theme_color" name="theme_color" type="text" class="form-control noscroll_textarea" value="<?php echo e($additional->theme_color); ?>" data-bvalidator="required"><small>Example : #ffffff</small></div>
                             </div>
                                </div>
                              </div>
                             </div>
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Upload Icons')); ?> - (<?php echo e(__('PNG Format Only')); ?>)</h4></div></div>
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Icon')); ?> (72x72)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_icon1" name="pwa_icon1" class="form-control-file" <?php if($additional->pwa_icon1 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_icon1 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_icon1); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Icon')); ?> (96x96)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_icon2" name="pwa_icon2" class="form-control-file" <?php if($additional->pwa_icon2 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_icon2 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_icon2); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Icon')); ?> (128x128)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_icon3" name="pwa_icon3" class="form-control-file" <?php if($additional->pwa_icon3 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_icon3 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_icon3); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Icon')); ?> (144x144)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_icon4" name="pwa_icon4" class="form-control-file" <?php if($additional->pwa_icon4 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_icon4 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_icon4); ?>" />
                                                <?php endif; ?>
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
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Icon')); ?> (152x152)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_icon5" name="pwa_icon5" class="form-control-file" <?php if($additional->pwa_icon5 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_icon5 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_icon5); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Icon')); ?> (192x192)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_icon6" name="pwa_icon6" class="form-control-file" <?php if($additional->pwa_icon6 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_icon6 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_icon6); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Icon')); ?> (384x384)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_icon7" name="pwa_icon7" class="form-control-file" <?php if($additional->pwa_icon7 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_icon7 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_icon7); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Icon')); ?> (512x512)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_icon8" name="pwa_icon8" class="form-control-file" <?php if($additional->pwa_icon8 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_icon8 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_icon8); ?>" />
                                                <?php endif; ?>
                                            </div>
                                                
                                                
                                                
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Splash Screen')); ?> - (<?php echo e(__('PNG Format Only')); ?>)</h4></div></div>
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (640x1136)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash1" name="pwa_splash1" class="form-control-file" <?php if($additional->pwa_splash1 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash1 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash1); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (750x1334)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash2" name="pwa_splash2" class="form-control-file" <?php if($additional->pwa_splash2 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash2 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash2); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (828x1792)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash3" name="pwa_splash3" class="form-control-file" <?php if($additional->pwa_splash3 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash3 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash3); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (1125x2436)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash4" name="pwa_splash4" class="form-control-file" <?php if($additional->pwa_splash4 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash4 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash4); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                             
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (1242x2208)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash5" name="pwa_splash5" class="form-control-file" <?php if($additional->pwa_splash5 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash5 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash5); ?>" />
                                                <?php endif; ?>
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
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (1242x2688)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash6" name="pwa_splash6" class="form-control-file" <?php if($additional->pwa_splash6 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash6 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash6); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (1536x2048)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash7" name="pwa_splash7" class="form-control-file" <?php if($additional->pwa_splash7 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash7 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash7); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (1668x2224)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash8" name="pwa_splash8" class="form-control-file" <?php if($additional->pwa_splash8 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash8 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash8); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (1668x2388)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash9" name="pwa_splash9" class="form-control-file" <?php if($additional->pwa_splash9 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash9 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash9); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Screen')); ?> (2048x2732)<span class="require">*</span></label>
                                                
                                            <input type="file" id="pwa_splash10" name="pwa_splash10" class="form-control-file" <?php if($additional->pwa_splash10 == ''): ?> required <?php endif; ?>>
                                            <?php if($additional->pwa_splash10 != ''): ?>
                                                <img height="50" src="<?php echo e(url('/')); ?>/images/icons/<?php echo e($additional->pwa_splash10); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                             <input type="hidden" name="sid" value="1">
                             <input type="hidden" name="save_pwa_icon1" value="<?php echo e($additional->pwa_icon1); ?>">
                             <input type="hidden" name="save_pwa_icon2" value="<?php echo e($additional->pwa_icon2); ?>">
                             <input type="hidden" name="save_pwa_icon3" value="<?php echo e($additional->pwa_icon3); ?>">
                             <input type="hidden" name="save_pwa_icon4" value="<?php echo e($additional->pwa_icon4); ?>">
                             <input type="hidden" name="save_pwa_icon5" value="<?php echo e($additional->pwa_icon5); ?>">
                             <input type="hidden" name="save_pwa_icon6" value="<?php echo e($additional->pwa_icon6); ?>">
                             <input type="hidden" name="save_pwa_icon7" value="<?php echo e($additional->pwa_icon7); ?>">
                             <input type="hidden" name="save_pwa_icon8" value="<?php echo e($additional->pwa_icon8); ?>">
                             
                             <input type="hidden" name="save_pwa_splash1" value="<?php echo e($additional->pwa_splash1); ?>">
                             <input type="hidden" name="save_pwa_splash2" value="<?php echo e($additional->pwa_splash2); ?>">
                             <input type="hidden" name="save_pwa_splash3" value="<?php echo e($additional->pwa_splash3); ?>">
                             <input type="hidden" name="save_pwa_splash4" value="<?php echo e($additional->pwa_splash4); ?>">
                             <input type="hidden" name="save_pwa_splash5" value="<?php echo e($additional->pwa_splash5); ?>">
                             <input type="hidden" name="save_pwa_splash6" value="<?php echo e($additional->pwa_splash6); ?>">
                             <input type="hidden" name="save_pwa_splash7" value="<?php echo e($additional->pwa_splash7); ?>">
                             <input type="hidden" name="save_pwa_splash8" value="<?php echo e($additional->pwa_splash8); ?>">
                             <input type="hidden" name="save_pwa_splash9" value="<?php echo e($additional->pwa_splash9); ?>">
                             <input type="hidden" name="save_pwa_splash10" value="<?php echo e($additional->pwa_splash10); ?>">
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> <?php echo e(__('Submit')); ?>

                                                        </button>
                                                        <button type="reset" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-ban"></i> <?php echo e(__('Reset')); ?>

                                                        </button>
                                                    </div>
                            </div>
                           </form>
                         </div> 
                     </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->
   <?php echo $__env->make('admin.javascript', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH /home/catalogo/public_html/resources/views/admin/pwa-settings.blade.php ENDPATH**/ ?>