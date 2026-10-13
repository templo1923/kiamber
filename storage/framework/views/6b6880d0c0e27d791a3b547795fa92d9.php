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
    <?php if(in_array('pages',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                       
        <?php if($demo_mode == 'on'): ?>
                     <?php echo $__env->make('admin.demo-mode', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     <?php else: ?>
                     <form action="<?php echo e(route('admin.pages')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?>

                     <?php endif; ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('Pages')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="<?php echo e(url('/admin/add-page')); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <?php echo e(__('Add Page')); ?></a>
                            <input type="submit" value="Delete All" name="action" class="btn btn-danger btn-sm ml-1" id="checkBtn" onClick="return confirm('Are you sure you want to delete?');">
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
                                <strong class="card-title"><?php echo e(__('Pages')); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th><?php echo e(__('Sno')); ?></th>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Display On Header')); ?>?</th>
                                            <th><?php echo e(__('Display On Footer')); ?>?</th>
                                            <th><?php echo e(__('Display Order')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $pageData['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="allChecked">
                                            <td><input type="checkbox" name="page_id[]" value="<?php echo e($page->page_id); ?>"/></td>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e(mb_substr($page->page_title, 0, 50, 'UTF-8')); ?> </td>
                                            
                                            <td><?php if($page->main_menu == 1): ?> <span class="badge badge-success">Yes</span> <?php else: ?> <span class="badge badge-danger">No</span> <?php endif; ?></td>
                                            <td><?php if($page->footer_menu == 1): ?> <span class="badge badge-success">Yes</span> <?php else: ?> <span class="badge badge-danger">No</span> <?php endif; ?></td>
                                            <td><?php echo e($page->menu_order); ?> </td>
                                            <td><?php if($page->page_status == 1): ?> <span class="badge badge-success"><?php echo e(__('Active')); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(__('InActive')); ?></span> <?php endif; ?></td>
                                            <td><a href="<?php echo e(url('/admin')); ?>/edit-page/<?php echo e($page->page_id); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(__('Edit')); ?></a> 
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="<?php echo e(url('/admin')); ?>/demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;<?php echo e(__('Delete')); ?></a>
                                            <?php else: ?> 
                                            <a href="<?php echo e(url('/admin')); ?>/pages/<?php echo e($page->page_id); ?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete?');"><i class="fa fa-trash"></i>&nbsp;<?php echo e(__('Delete')); ?></a><?php endif; ?></td>
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
      </form>

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
                        columns: [1, 2, 3, 4, 5, 6]
                    },
					className: 'ml-4 mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Pages'
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Pages'
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Pages'
                },
				{
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Pages'
                },
				{
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Pages'
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

      

$(document).ready(function () {
    $('#checkBtn').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("You must check at least one checkbox.");
        return false;
      }

    });
	
	
	
	});

</script>

</body>

</html>
<?php /**PATH /home/catalogo/public_html/resources/views/admin/pages.blade.php ENDPATH**/ ?>