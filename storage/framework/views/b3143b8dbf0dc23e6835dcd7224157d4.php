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
    <?php if(in_array('newsletter',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                       
        
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('Addons')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="<?php echo e(url('/admin/install-addon')); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <?php echo e(__('Install Addon')); ?></a>
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
         <?php echo $__env->make('admin.warning', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(__('Addons')); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th><?php echo e(__('Sno')); ?></th>
                                            <th><?php echo e(__('Addon Image')); ?></th>
                                           <th><?php echo e(__('Addon Name')); ?></th>
                                           <th><?php echo e(__('Addon Version')); ?></th>
                                           <th><?php echo e(__('Addon Url')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $getaddons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $img_url = url('/')."/Modules/".$addon->addon_dir."/resources/views/img/".$addon->addon_image;
                                    ?>
                                        <tr class="allChecked">
                                            <td><?php echo e($no); ?></td>
                                            <td>
                                            <img height="60" src="<?php echo e($img_url); ?>" alt="<?php echo e($addon->addon_name); ?>" />
                                            </td>
                                            <td><?php echo e($addon->addon_name); ?> </td>
                                            <td>v<?php echo e($addon->addon_version); ?> </td>
                                            <td><?php if(!empty($addon->addon_url)): ?><a href="<?php echo e($addon->addon_url); ?>" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-shopping-cart"></i>&nbsp; <?php echo e(__('Buy Now')); ?></a><?php endif; ?></td>
                                            <td><?php if($addon->addon_status == 1): ?> <span class="badge badge-success"><?php echo e(__('Activated')); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(__('Deactivate')); ?></span> <?php endif; ?></td>
                                            <td>
                                            <?php if($addon->addon_status == 1): ?>
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="<?php echo e(url('/admin')); ?>/demo-mode" class="btn btn-secondary btn-sm"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;<?php echo e(__('Deactivate')); ?></a>
                                            <?php else: ?>
                                            <a href="<?php echo e(url('/admin')); ?>/addon-deactivate/<?php echo e($encrypter->encrypt($addon->addon_id)); ?>" class="btn btn-secondary btn-sm"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;<?php echo e(__('Deactivate')); ?></a>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="<?php echo e(url('/admin')); ?>/demo-mode" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;<?php echo e(__('Activated')); ?></a>
                                            <?php else: ?>
                                            <a href="<?php echo e(url('/admin')); ?>/addon-activate/<?php echo e($encrypter->encrypt($addon->addon_id)); ?>" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;<?php echo e(__('Activated')); ?></a>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="<?php echo e(URL::to('/admin/demo-mode')); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;<?php echo e(__('Delete')); ?></a>
                                            <?php else: ?>
                                            <a href="<?php echo e(url('/admin')); ?>/addons/<?php echo e($encrypter->encrypt($addon->addon_id)); ?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete?');"><i class="fa fa-trash"></i>&nbsp;<?php echo e(__('Delete')); ?></a>
                                            <?php endif; ?>
                                            </td>
                                        </tr>
                                       
                                        <?php $no++; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                        
                                    </tbody>
                                </table>
                            </div>
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
   <script type="text/javascript">
      $(document).ready(function () { 
    var oTable = $('#example').dataTable({
        stateSave: true,
		responsive: true,
		dom: 'Bfrtip',
        buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'ml-4 mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Addons'
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Addons'
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Addons'
                },
				{
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Addons'
                },
				{
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Addons'
                }
                
            ]
    });

    var allPages = oTable.fnGetNodes();

    $('body').on('click', '#selectAll', function () {
        if ($(this).hasClass('allChecked')) {
            $('input[type="checkbox"]', allPages).prop('checked', false);
        } else {
            $('input[type="checkbox"]', allPages).prop('checked', true);
        }
        $(this).toggleClass('allChecked');
    })
});

      


	
	
	
	});

</script>

</body>

</html>
<?php /**PATH /home/catalogo/public_html/resources/views/admin/addons.blade.php ENDPATH**/ ?>