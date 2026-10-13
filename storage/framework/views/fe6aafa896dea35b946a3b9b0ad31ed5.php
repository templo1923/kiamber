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
    <?php if(in_array('backups',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('Backups')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                    <ol class="breadcrumb text-right">
                            <?php if($demo_mode == 'on'): ?>
                            <a href="<?php echo e(url('/admin/demo-mode')); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <?php echo e(__('Create Backup')); ?></a>
                            <?php else: ?>
                            <a href="<?php echo e(url('/admin/backup/create')); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <?php echo e(__('Create Backup')); ?></a>
                            <?php endif; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
         <?php if(session('error')): ?>
    
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <?php endif; ?>
         <?php if( Session::has('success') ): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo e(Session::get('success')); ?>

                </div>
                <?php endif; ?>

                <?php if( Session::has('update') ): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo e(Session::get('update')); ?>

                </div>
                <?php endif; ?>

                <?php if( Session::has('delete') ): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo e(Session::get('delete')); ?>

                </div>
            <?php endif; ?>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(__('Backups')); ?></strong>
                            </div>
                            <div class="card-body">
                                <?php if(count($backups)): ?>
                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><?php echo e(__('File Name')); ?></th>
                        <th><?php echo e(__('File Size')); ?></th>
                        <th><?php echo e(__('Created Date')); ?></th>
                        <th><?php echo e(__('Created Age')); ?></th>
                        <th><?php echo e(__('Action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($backup['file_name']); ?></td>
                            <td><?php echo e(\DownGrade\Http\Controllers\Admin\BackupController::humanFilesize($backup['file_size'])); ?></td>
                            <td>
                                <?php echo e(date('F jS, Y, g:ia (T)',$backup['last_modified'])); ?>

                            </td>
                            <td>
                                <?php echo e(\Carbon\Carbon::parse($backup['last_modified'])->diffForHumans()); ?>

                            </td>
                            <td class="text-right">
                                <?php if($demo_mode == 'on'): ?>
                                <a class="btn btn-success"
                                   href="<?php echo e(url('/admin/demo-mode')); ?>"><i
                                        class="fa fa-cloud-download"></i> <?php echo e(__('Download')); ?></a>
                                <a class="btn btn-danger" data-button-type="delete"
                                   href="<?php echo e(url('/admin/demo-mode')); ?>"><i class="fa fa-trash-o"></i>
                                    <?php echo e(__('Delete')); ?></a>
                                <?php else: ?>
                                <a class="btn btn-success"
                                   href="<?php echo e(url('admin/backup/download/'.$backup['file_name'])); ?>"><i
                                        class="fa fa-cloud-download"></i> <?php echo e(__('Download')); ?></a>
                                <a class="btn btn-danger" onClick="return confirm('<?php echo e(__('Are you sure you want to delete')); ?>?');" data-button-type="delete"
                                   href="<?php echo e(url('admin/backup/delete/'.$backup['file_name'])); ?>"><i class="fa fa-trash-o"></i>
                                    <?php echo e(__('Delete')); ?></a>
                                <?php endif; ?>    
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="well">
                    <h4><?php echo e(__('No backups')); ?></h4>
                </div>
            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-12">
                       
                        
                        
                      
                        <div class="card">
                           <?php if($demo_mode == 'on'): ?>
                           <?php echo $__env->make('admin.demo-mode', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                           <?php else: ?>
                           <form action="<?php echo e(route('admin.backup')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                           
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><strong><?php echo e(__('Backup Types')); ?> </strong></label><br/>
                                                
                                                <input id="backup_types" name="backup_types" type="radio" class="noscroll_textarea" value="database" data-bvalidator="required" <?php if($custom_settings->backup_types == 'database'): ?> checked="checked" <?php endif; ?>> <?php echo e(__('Database Only')); ?> <small class="require">( <?php echo e(__("it's takes short time")); ?> )</small><br/>
                                                <input id="backup_types" name="backup_types" type="radio" class="noscroll_textarea" value="files_database" data-bvalidator="required" <?php if($custom_settings->backup_types == 'files_database'): ?> checked="checked" <?php endif; ?>> <?php echo e(__('Files and Database')); ?> <small class="require">( <?php echo e(__("it's takes long time")); ?> )</small><br/>
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
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?> 
    <!-- Right Panel -->


   <?php echo $__env->make('admin.javascript', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
   

</body>

</html>
<?php /**PATH /home/catalogo/public_html/resources/views/admin/backup.blade.php ENDPATH**/ ?>