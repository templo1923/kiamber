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
    <?php if(in_array('orders',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                       <?php if($demo_mode == 'on'): ?>
                     <?php echo $__env->make('admin.demo-mode', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                     <?php else: ?>
                     <form action="<?php echo e(route('admin.orders')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?>

                     <?php endif; ?> 

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('Orders')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <input type="submit" value="Delete All" name="action" class="btn btn-danger btn-sm ml-1" id="checkBtn" onClick="return confirm('Are you sure you want to delete?');">
                </div>
            </div>
        </div>
        
         <?php echo $__env->make('admin.warning', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-3 ml-auto">
                    <?php /*?><form action="{{ route('admin.orders') }}" method="post" id="setting_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <input id="search" name="search" type="text" class="move-bars" value="{{ $search }}" placeholder="{{ __('Order Id') }} OR {{ __('Buyer') }}">
                    
                    <button type="submit" name="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Search
                    </button>
                    
                    </div>
                    </form><?php */?>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(__('Orders')); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th><?php echo e(__('Sno')); ?></th>
                                            <th><?php echo e(__('Order ID')); ?></th>
                                            <th><?php echo e(__('Buyer')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <th><?php echo e(__('Processing Fee')); ?></th>
                                            <th><?php echo e(__('VAT Fee')); ?></th>
                                            <th><?php echo e(__('Payment Type')); ?></th>
                                            <th><?php echo e(__('Payment Id')); ?></th>
                                            <th><?php echo e(__('Complete Payment? (Localbank Only)')); ?></th>
                                            <!--<th>Payment Approval?</th> -->
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr  class="allChecked">
                                            <td><input type="checkbox" name="purchase_token[]" value="<?php echo e($order->purchase_token); ?>"/></td>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($order->purchase_token); ?> </td>
                                            <td><?php echo e($order->username); ?></td>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->subtotal); ?> </td>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->processing_fee); ?> </td>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->vat_price); ?></td>
                                            <td><?php echo e($order->payment_type); ?></td>
                                            <td><?php if($order->payment_token != ''): ?> <?php echo e($order->payment_token); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php if(($order->payment_type == 'localbank' || $order->payment_type == 'offline') && ($order->payment_status == 'pending')): ?> <a href="<?php echo e(url('/admin')); ?>/orders/<?php echo e(base64_encode($order->purchase_token)); ?>" class="blue-color" onClick="return confirm('<?php echo e(__('Are you sure click to complete payment')); ?>?');"><?php echo e(__('Click to Complete Payment')); ?>?</a> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><a href="<?php echo e(url('/admin')); ?>/order-details/<?php echo e($order->purchase_token); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>&nbsp; <?php echo e(__('View More')); ?></a>
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="<?php echo e(url('/admin')); ?>/demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;<?php echo e(__('Delete')); ?></a>
                                            <?php else: ?> 
                                            <a href="<?php echo e(url('/admin')); ?>/orders/delete/<?php echo e($order->purchase_token); ?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete?');"><i class="fa fa-trash"></i>&nbsp;<?php echo e(__('Delete')); ?></a><?php endif; ?>
                                            </td>
                                        </tr>
                                        
                                        <?php $no++; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                        
                                    </tbody>
                                </table>
                                <div>
                                <?php echo e($itemData['item']->links('pagination::bootstrap-4')); ?>

                                </div>
                            </div>
                        </div>
                    </div>

 
                </div>
            </div>
        </div>

    </form>
    </div>
    <?php else: ?>
    <?php echo $__env->make('admin.denied', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    


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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    },
					className: 'ml-4 mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Orders'
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Orders'
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Orders'
                },
				{
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Orders'
                },
				{
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    },
					className: 'mr-1',
					filename: '<?php echo e($allsettings->site_title); ?> - Orders'
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
<?php /**PATH /home/catalogo/public_html/resources/views/admin/orders.blade.php ENDPATH**/ ?>