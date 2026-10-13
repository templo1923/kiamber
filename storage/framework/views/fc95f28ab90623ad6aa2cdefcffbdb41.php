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
                        <h1><?php echo e(__('Preferred Settings')); ?></h1>
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
                           <form action="<?php echo e(route('admin.preferred-settings')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                           
                                              
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Blog')); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="site_blog_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_blog_display == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_blog_display == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Newsletter')); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="site_newsletter_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_newsletter_display == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_newsletter_display == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Refund Request')); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="site_refund_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_refund_display == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_refund_display == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Withdrawal Request')); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="site_withdrawal_display" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_withdrawal_display == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_withdrawal_display == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                                
                                            </div>
                                             
                                            <div class="form-group">
                                                <label for="site_loader_display" class="control-label mb-1"><?php echo e(__('Product Sale Count')); ?> <span class="require">*</span></label><br/>
                                               
                                                <select name="product_sale_count" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($custom_settings->product_sale_count == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($custom_settings->product_sale_count == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                                
                                             </div> 
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Google 2FA')); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="google2fa_option" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($custom_settings->google2fa_option == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($custom_settings->google2fa_option == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Google Ads')); ?> <span class="require">*</span></label>
                                                <select name="google_ads" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->google_ads == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($setting['setting']->google_ads == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Multi Language')); ?> <span class="require">*</span></label>
                                                <select name="site_google_translate" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_google_translate == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_google_translate == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1"><?php echo e(__('Subscription')); ?> <span class="require">*</span></label><br/>
                                              <select name="subscription_mode" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($allsettings->subscription_mode == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                        <option value="0" <?php if($allsettings->subscription_mode == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                              </select>
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Verify Purchase')); ?> <span class="require">*</span></label>
                                                                                                
                                                <select name="verify_mode" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($custom_settings->verify_mode == 1): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($custom_settings->verify_mode == 0): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('View Source Code')); ?> <span class="require">*</span></label>
                                                
                                                <select name="disable_view_source" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($custom_settings->disable_view_source == "1"): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                                <option value="0" <?php if($custom_settings->disable_view_source == "0"): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                                </select>
                                            </div> 
                                            
                                           <input type="hidden" name="sid" value="1">
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> <?php echo e(__('Submit')); ?></button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> <?php echo e(__('Reset')); ?></button>
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
<?php /**PATH /home/catalogo/public_html/resources/views/admin/preferred-settings.blade.php ENDPATH**/ ?>