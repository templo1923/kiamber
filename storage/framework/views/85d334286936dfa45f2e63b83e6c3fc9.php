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
    <?php if(in_array('maintenance',$avilable)): ?>
    <div id="right-panel" class="right-panel">

       
                       <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('Website Maintenance')); ?></h1>
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
                           <form action="<?php echo e(route('admin.website-maintenance')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            <div class="form-group">
                                              <label for="product_approval" class="control-label mb-1"><?php echo e(__('Maintenance Mode')); ?>?<span class="require">*</span></label><br/>                                         <select name="maintenance_mode" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($allsettings->maintenance_mode == 1): ?> selected <?php endif; ?>><?php echo e(__('ON')); ?></option>
                                                        <option value="0" <?php if($allsettings->maintenance_mode == 0): ?> selected <?php endif; ?>><?php echo e(__('OFF')); ?></option>
                                                        </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Maintenance Mode Title')); ?></label>
                                                <input id="m_mode_title" name="m_mode_title" type="text" class="form-control noscroll_textarea" value="<?php echo e($allsettings->m_mode_title); ?>">
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(__('Maintenance Mode Content')); ?></label>
                                                
                                            <textarea name="m_mode_content" rows="6" placeholder="Maintenance Mode Content" class="form-control"><?php echo e($allsettings->m_mode_content); ?></textarea>
                                            </div>
                                                
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Social Icon Label')); ?></label>
                                                <input id="m_mode_social_label" name="m_mode_social_label" type="text" class="form-control noscroll_textarea" value="<?php echo e($allsettings->m_mode_social_label); ?>">
                                                
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
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(__('Background')); ?> <span class="require">*</span></label>
                                                <select name="m_mode_background" id="m_mode_background" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="color" <?php if($allsettings->m_mode_background == "color"): ?> selected="selected" <?php endif; ?>><?php echo e(__('Color')); ?></option>
                                                <option value="image" <?php if($allsettings->m_mode_background == "image"): ?> selected="selected" <?php endif; ?>><?php echo e(__('Image')); ?></option>
                                                </select>
                                                
                                            </div>
                                            
                                            <div id="m_mode_color" <?php if($allsettings->m_mode_background == "color"): ?> class="form-group display-block" <?php else: ?>  class="form-group display-none" <?php endif; ?>>
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Color')); ?></label>
                                                <input id="m_mode_bgcolor" name="m_mode_bgcolor" type="text" class="form-control noscroll_textarea" value="<?php echo e($allsettings->m_mode_bgcolor); ?>">
                                                <small>(example color code : #666000 )</small>
                                            </div>
                                            
                                            
                                            <div id="m_mode_image" <?php if($allsettings->m_mode_background == "image"): ?> class="form-group display-block" <?php else: ?>  class="form-group display-none" <?php endif; ?>>
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(__('Image')); ?></label>
                                                
                                            <input type="file" id="m_mode_bgimage" name="m_mode_bgimage" class="form-control-file"  data-bvalidator="extension[jpg:png:jpeg:gif]" data-bvalidator-msg="Please select file of type .jpg, .png, .jpeg, .gif">
                                            <?php if($allsettings->m_mode_bgimage != ''): ?>
                                                <img height="50" width="50" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->m_mode_bgimage); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            
                                            <input type="hidden" name="sid" value="1">
                                            <input type="hidden" name="save_bgimage" value="<?php echo e($allsettings->m_mode_bgimage); ?>">
                             
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
<?php /**PATH /home/catalogo/public_html/resources/views/admin/website-maintenance.blade.php ENDPATH**/ ?>