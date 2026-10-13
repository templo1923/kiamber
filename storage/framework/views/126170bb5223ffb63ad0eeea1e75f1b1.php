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
                        <h1><?php echo e(__('Media Settings')); ?></h1>
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
                           <form action="<?php echo e(route('admin.media-settings')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Maximum Upload Image Size')); ?> (KB)<span class="require">*</span></label>
                                                <input id="site_max_image_size" name="site_max_image_size" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_max_image_size); ?>" data-bvalidator="required,digit,min[1]"> <small>Example : 1000</small>
                                            </div>
                                            
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Watermark')); ?>?<span class="require">*</span></label>
                                                <select name="watermark_option" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->watermark_option == "1"): ?> selected <?php endif; ?>>Yes</option>
                                                <option value="0" <?php if($setting['setting']->watermark_option == "0"): ?> selected <?php endif; ?>>No</option>
                                                </select>
                                                
                                                
                                            </div>
                                            
                                            <div id="ifwatermark" <?php if($setting['setting']->watermark_repeat == "0"): ?> class="force-block form-group" <?php else: ?> class="force-none form-group" <?php endif; ?>>
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Watermark Position')); ?>?<span class="require">*</span></label>
                                                <select name="watermark_position" class="form-control" required>
                                                <option value=""></option>
                                                <option value="top-left" <?php if($setting['setting']->watermark_position == "top-left"): ?> selected <?php endif; ?>><?php echo e(__('Top Left')); ?></option>
                                                <option value="top-right" <?php if($setting['setting']->watermark_position == "top-right"): ?> selected <?php endif; ?>><?php echo e(__('Top Right')); ?></option>
                                                <option value="bottom-left" <?php if($setting['setting']->watermark_position == "bottom-left"): ?> selected <?php endif; ?>><?php echo e(__('Bottom Left')); ?></option>
                                                <option value="bottom-right" <?php if($setting['setting']->watermark_position == "bottom-right"): ?> selected <?php endif; ?>><?php echo e(__('Bottom Right')); ?></option>
                                                <option value="center" <?php if($setting['setting']->watermark_position == "center"): ?> selected <?php endif; ?>><?php echo e(__('Center')); ?></option>
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Maximum Upload Zip File Size')); ?> (KB)<span class="require">*</span></label>
                                                <input id="site_max_zip_size" name="site_max_zip_size" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_max_zip_size); ?>" data-bvalidator="required,digit,min[1]"> <small>Example : 1000</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Watermark Repeat')); ?>?<span class="require">*</span></label>
                                                <select name="watermark_repeat" id="watermark_repeat" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->watermark_repeat == "1"): ?> selected <?php endif; ?>>Yes</option>
                                                <option value="0" <?php if($setting['setting']->watermark_repeat == "0"): ?> selected <?php endif; ?>>No</option>
                                                </select>
                                                
                                                
                                            </div>
                             
                                     <div class="form-group">
                                                <label for="site_logo" class="control-label mb-1"><?php echo e(__('Watermark Image')); ?></label>
                                                
                                            <input type="file" id="site_watermark" name="site_watermark" class="form-control-file">
                                            <?php if($setting['setting']->site_watermark != ''): ?>
                                                <img width="150" height="150" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_watermark); ?>" class="img-border" />
                                                <?php endif; ?>
                                            </div>
                             
                             </div>
                                </div>

                            </div>
                             
                             <input type="hidden" name="sid" value="1">
                             <input type="hidden" name="save_watermark" value="<?php echo e($setting['setting']->site_watermark); ?>">
                             </div>
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                         <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Large File Storage')); ?></label>
                                                <select name="site_s3_storage" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="0" <?php if($setting['setting']->site_s3_storage == 0): ?> selected <?php endif; ?>><?php echo e(__('My Server')); ?></option>
                                                <option value="1" <?php if($setting['setting']->site_s3_storage == 1): ?> selected <?php endif; ?>><?php echo e(__('Wasabi Storage')); ?></option>
                                                <option value="4" <?php if($setting['setting']->site_s3_storage == 4): ?> selected <?php endif; ?>><?php echo e(__('Amazon S3 Storage')); ?></option>
                                                <?php if(View::exists('backblaze::backblaze-settings')): ?>
                                                <option value="5" <?php if($setting['setting']->site_s3_storage == 5): ?> selected <?php endif; ?>><?php echo e(__('Backblaze B2 Storage')); ?></option>
                                                <?php endif; ?>
                                                <?php if(View::exists('idrive::idrive-settings')): ?>
                                                <option value="6" <?php if($setting['setting']->site_s3_storage == 6): ?> selected <?php endif; ?>><?php echo e(__('iDrive E2 Storage')); ?></option>
                                                <?php endif; ?>
                                                <?php if(View::exists('storj::storj-settings')): ?>
                                                <option value="7" <?php if($setting['setting']->site_s3_storage == 7): ?> selected <?php endif; ?>><?php echo e(__('Storj Storage')); ?></option>
                                                <?php endif; ?>
                                                </select>
                                                
                                                
                                            </div>   
                                           
                                            
                                           
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                             <div class="col-md-12"><h5><?php echo e(__('Wasabi Storage Configuration (If wasabi storage selected)')); ?></h5></div>
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('WASABI ACCESS KEY ID')); ?></label>
                                                <input id="wasabi_access_key_id" name="wasabi_access_key_id" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->wasabi_access_key_id); ?>">
                                            </div>
                                        
                                         <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('WASABI SECRET ACCESS KEY')); ?></label>
                                                <input id="wasabi_secret_access_key" name="wasabi_secret_access_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->wasabi_secret_access_key); ?>"> 
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('WASABI DEFAULT REGION')); ?></label>
                                                <input id="wasabi_default_region" name="wasabi_default_region" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->wasabi_default_region); ?>">
                                                <small>Example : us-east-2</small>
                                            </div>
                                        
                                         <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('WASABI BUCKET')); ?></label>
                                                <input id="wasabi_bucket" name="wasabi_bucket" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->wasabi_bucket); ?>"> <small>Example : yourbucketname</small>
                                            </div>
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-12"><h5><?php echo e(__('S3 Storage Configuration (If amazon s3 storage selected)')); ?></h5></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('AWS ACCESS KEY ID')); ?></label>
                                                <input id="aws_access_key_id" name="aws_access_key_id" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->aws_access_key_id); ?>">
                                            </div>
                                        
                                         <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('AWS SECRET ACCESS KEY')); ?></label>
                                                <input id="aws_secret_access_key" name="aws_secret_access_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->aws_secret_access_key); ?>"> 
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('AWS DEFAULT REGION')); ?></label>
                                                <input id="aws_default_region" name="aws_default_region" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->aws_default_region); ?>">
                                                <small><?php echo e(__('example')); ?> : us-east-2</small>
                                            </div>
                                        
                                         <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('AWS BUCKET')); ?></label>
                                                <input id="aws_bucket" name="aws_bucket" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->aws_bucket); ?>"> <small><?php echo e(__('example')); ?> : <?php echo e(__('yourbucketname')); ?></small>
                                            </div>
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                             <?php /* ?><div class="col-md-12"><h5>{{ __('Dropbox Storage Configuration (If dropbox storage selected)') }}</h5></div>
                            <div class="col-md-6">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ __('DROPBOX API') }}</label>
                                                <input id="dropbox_api" name="dropbox_api" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->dropbox_api }}">
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
                                                <label for="site_title" class="control-label mb-1">{{ __('DROPBOX TOKEN') }}</label>
                                                <input id="dropbox_token" name="dropbox_token" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->dropbox_token }}">
                                            </div>
                                        </div>
                                </div>
                             </div>
                            </div>
                            <div class="col-md-12"><h5>{{ __('Google Drive Storage Configuration (If google drive storage selected)') }}</h5></div>
                             <div class="col-md-6">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ __('GOOGLE DRIVE CLIENT ID') }}</label>
                                                <input id="google_drive_client_id" name="google_drive_client_id" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->google_drive_client_id }}">
                                            </div>
                                        <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ __('GOOGLE DRIVE CLIENT SECRET') }}</label>
                                        <input id="google_drive_client_secret" name="google_drive_client_secret" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->google_drive_client_secret }}">
                                        </div></div>
                                </div>
                             </div>
                            </div>
                            <div class="col-md-6">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ __('GOOGLE DRIVE REFRESH TOKEN') }}</label>
                                                <input id="google_drive_refresh_token" name="google_drive_refresh_token" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->google_drive_refresh_token }}">
                                            </div>
                                        <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ __('GOOGLE DRIVE FOLDER ID') }}</label>
                                        <input id="google_drive_folder_id" name="google_drive_folder_id" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->google_drive_folder_id }}">
                                        </div></div>
                                </div>
                             </div>
                            </div><?php */ ?>
                            <?php if(View::exists('backblaze::backblaze-settings')): ?>
                            <?php echo $__env->make('backblaze::backblaze-settings', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                            <?php if(View::exists('idrive::idrive-settings')): ?>
                            <?php echo $__env->make('idrive::idrive-settings', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                            <?php if(View::exists('storj::storj-settings')): ?>
                            <?php echo $__env->make('storj::storj-settings', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
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
<?php /**PATH /home/catalogo/public_html/resources/views/admin/media-settings.blade.php ENDPATH**/ ?>