<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    @include('admin.stylesheet')
    
</head>

<body>
    
    @include('admin.navigation')

    <!-- Right Panel -->
    @if(in_array('manage-products',$avilable))
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       @if($demo_mode == 'on')
                     @include('admin.demo-mode')
                     @else
                     <form action="{{ route('admin.products') }}" method="post" id="setting_form" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     @endif

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Products') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/add-product') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ __('Add Product') }}</a>&nbsp;
                            <a href="{{ url('/admin/products-import-export') }}" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i> {{ __('Product Import / Export') }}</a>
                            <input type="submit" value="Delete All" name="action" class="btn btn-danger btn-sm ml-1" id="checkBtn" onClick="return confirm('Are you sure you want to delete?');">
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
         @include('admin.warning')
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <?php /*?><div class="col-md-3 ml-auto">
                    <form action="{{ route('admin.products') }}" method="post" id="setting_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <input id="search" name="search" type="text" class="move-bars" value="{{ $search }}" placeholder="{{ __('Product Name') }}">
                    
                    <button type="submit" name="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Search
                    </button>
                    
                    </div>
                    </form>
                    </div><?php */?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ __('Products') }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th>{{ __('Sno') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Product Name') }}</th>
                                            <?php /*?><th>{{ __('Category') }}</th><?php */?>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Featured') }}</th>
                                            <th>{{ __('Free Download') }}</th>
                                            <th>{{ __('Flash Sale') }}</th>
                                            @if($allsettings->subscription_mode == 1)
                                            <th>{{ __('Subscription Item') }}?</th>
                                            @endif
                                            <th>{{ __('Reviews') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $product)
                                        <tr class="allChecked">
                                            <td><input type="checkbox" name="product_token[]" value="{{ $product->product_token }}"/></td>
                                            <td>{{ $no }}</td>
                                            <td>@if($product->product_image != '') <img src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}" alt="{{ $product->product_name }}" class="image-size"/>@else <img src="{{ url('/') }}/public/img/no-image.jpg" alt="{{ $product->product_name }}" class="image-size"/>  @endif</td>
                                            <td>@if($product->product_status == 1)<a href="{{ url('/item') }}/{{ $product->product_slug }}" class="blue" target="_blank">@endif{{ mb_substr($product->product_name, 0, 50, 'UTF-8') }}@if($product->product_status == 1)</a>@endif </td>
                                            <?php /*?><td>{{ $product->category_name }}</td><?php */?>
                                            <td>{{ $allsettings->site_currency_symbol }} {{ $product->regular_price }}</td>
                                            
                                            
                                            <td>@if($product->product_featured == 1) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                                            <td>@if($product->product_free == 1) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                                            <td>@if($product->product_flash_sale == 1) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td> 
                                            @if($allsettings->subscription_mode == 1)
                                            <td>@if($product->subscription_item == 1) <span class="badge badge-success">{{ __('On') }}</span> @else <span class="badge badge-danger">{{ __('Off') }}</span> @endif</td>
                                            @endif
                                            <td><a href="{{ url('/admin') }}/reviews/{{ $product->product_token }}" class="blue-color">{{ __('Reviews') }} [{{ $reviews->has($product->product_id) ? count($reviews[$product->product_id]) : 0 }}]</a></td>
                                            <td>@if($product->product_status == 1) <span class="badge badge-success">{{ __('Active') }}</span> @else <span class="badge badge-danger">{{ __('InActive') }}</span> @endif</td>
                                            <td><a href="{{ url('/admin') }}/edit-product/{{ $product->product_token }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ __('Edit') }}</a> 
                                            @if($demo_mode == 'on') 
                                            <a href="{{ url('/admin') }}/demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}</a>
                                            @else 
                                            <a href="{{ url('/admin') }}/products/{{ $product->product_token }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete?');"><i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}</a>
                                            <a href="{{ url('/admin') }}/download/{{ $product->product_token }}" class="btn btn-primary btn-sm mt-1"><i class="fa fa-download"></i>&nbsp;{{ __('Download File') }}</a>
                                            @endif</td>
                                        </tr>
                                        
                                        @php $no++; @endphp
                                   @endforeach     
                                        
                                    </tbody>
                                </table>
                               <?php /*?> <div>
                                {{ $itemData['item']->links('pagination::bootstrap-4') }}
                                </div><?php */?>
                            </div>
                        </div>
                    </div>

 
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

    </form>
    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif
    <!-- Right Panel -->


   @include('admin.javascript')
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
                        columns: [1, 3, 4, 5, 6, 7, 8, 9, 10]
                    },
					className: 'ml-4 mr-1',
					filename: '{{ $allsettings->site_title }} - Products'
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 3, 4, 5, 6, 7, 8, 9, 10]
                    },
					className: 'mr-1',
					filename: '{{ $allsettings->site_title }} - Products'
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 3, 4, 5, 6, 7, 8, 9, 10]
                    },
					className: 'mr-1',
					filename: '{{ $allsettings->site_title }} - Products'
                },
				{
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 3, 4, 5, 6, 7, 8, 9, 10]
                    },
					className: 'mr-1',
					filename: '{{ $allsettings->site_title }} - Products'
                },
				{
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 3, 4, 5, 6, 7, 8, 9, 10]
                    },
					className: 'mr-1',
					filename: '{{ $allsettings->site_title }} - Products'
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
