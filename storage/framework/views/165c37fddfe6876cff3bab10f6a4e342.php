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
                        <h1><?php echo e(__('Email Settings')); ?></h1>
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
                           <form action="<?php echo e(route('admin.email-settings')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Sender Name')); ?> <span class="require">*</span></label>
                                                <input id="sender_name" name="sender_name" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->sender_name); ?>" data-bvalidator="required">
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Sender Email')); ?> <span class="require">*</span></label>
                                                <input id="sender_email" name="sender_email" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->sender_email); ?>" data-bvalidator="required,email">
                                            </div>
                                                
                                                
                                                <input type="hidden" name="sid" value="1">
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Mail Configuration')); ?></h4></div></div>
                             
                             
                             <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                             
                             
                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mail Driver')); ?> <span class="require">*</span></label>
                                                <input id="mail_driver" name="mail_driver" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_driver); ?>" data-bvalidator="required"> <small>Example : mail</small>
                                            </div>
                                                
                                                
                                  <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mail Port')); ?> <span class="require">*</span></label>
                                                <input id="mail_port" name="mail_port" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_port); ?>" data-bvalidator="required"> <small>Example : 25</small>
                                            </div>   
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mail Password')); ?></label>
                                                <input id="mail_password" name="mail_password" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_password); ?>"> <small>Example : test123</small>
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mail Host')); ?> <span class="require">*</span></label>
                                                <input id="mail_host" name="mail_host" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_host); ?>" data-bvalidator="required"> <small>Example : mail.mailtrap.io</small>
                                            </div>
                                                
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mail Username')); ?> </label>
                                                <input id="mail_username" name="mail_username" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_username); ?>"> <small>Example : sample@sample.com</small>
                                            </div>  
                                            
                                            
                                            
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mail Encryption')); ?> </label>
                                                <input id="mail_encryption" name="mail_encryption" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->mail_encryption); ?>"> <small>Example : tls or ssl</small>
                                            </div>                  
                                               
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
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
    <?php else: ?>
    <?php echo $__env->make('admin.denied', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


   <?php echo $__env->make('admin.javascript', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


</body>

</html>
<?php /**PATH /home/catalogo/public_html/resources/views/admin/email-settings.blade.php ENDPATH**/ ?>