<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    <?php echo $__env->make('admin.stylesheet', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('admin.javascript', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body>
    
    <?php echo $__env->make('admin.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Right Panel -->
    <?php if(in_array('pages',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('Add Page')); ?></h1>
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
                           <form action="<?php echo e(route('admin.add-page')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                           
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1" id="tagname"><?php echo e(__('Title')); ?> <span class="require">*</span></label>
                                                <input id="textboxdata" name="page_title" type="text" class="form-control" data-bvalidator="required">
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(__('Description')); ?><span class="require">*</span> <?php if(View::exists('aiwriter::index')): ?> <?php if(in_array('add-page',$ai_writer_display_pages)): ?><?php echo $__env->make('aiwriter::aigenerate', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php endif; ?> <?php endif; ?></label>
                                                
                                            <textarea name="page_desc" id="summary-ckeditor" rows="6" placeholder="page description" class="form-control" data-bvalidator="required"></textarea>
                                            </div>
                                                
                                            
                                                                                      
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(__('Status')); ?> <span class="require">*</span></label>
                                                <select name="page_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1"><?php echo e(__('Active')); ?></option>
                                                <option value="0"><?php echo e(__('InActive')); ?></option>
                                                </select>
                                                
                                            </div> 
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(__('Display On Header')); ?>?<span class="require">*</span></label>
                                                <select name="main_menu" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </select>
                                                
                                            </div>  
                                            
                                                                                        
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(__('Display On Footer')); ?>?<span class="require">*</span></label>
                                                <select name="footer_menu" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                                                                                       
                                                
                                           <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(__('Display Order')); ?></label>
                                                <input id="menu_order" name="menu_order" type="text" class="form-control">
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
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(__('Allow Seo')); ?>? <span class="require">*</span></label>
                                                <select name="page_allow_seo" id="page_allow_seo" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1"><?php echo e(__('Yes')); ?></option>
                                                <option value="0"><?php echo e(__('No')); ?></option>
                                                </select>
                                             </div>
                                            
                                          <div id="ifseo">
                                     <div class="form-group">
                                           <label for="site_keywords" class="control-label mb-1"><?php echo e(__('SEO Meta Keywords')); ?> (<?php echo e(__('max 160 chars')); ?>) <span class="require">*</span></label>
                                            <textarea name="page_seo_keyword" id="page_seo_keyword" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"></textarea>
                                       </div> 
                                       <div class="form-group">
                                           <label for="site_desc" class="control-label mb-1"><?php echo e(__('SEO Meta Description')); ?> (<?php echo e(__('max 160 chars')); ?>) <span class="require">*</span></label>
                                              <textarea name="page_seo_desc" id="page_seo_desc" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"></textarea>
                                            </div>
                                          </div>
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
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
        </div>

        <!-- .content -->


    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


   


</body>

</html>
<?php /**PATH /home/catalogo/public_html/resources/views/admin/add-page.blade.php ENDPATH**/ ?>