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
    @if(in_array('newsletter',$avilable))
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       
        
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Addons') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/install-addon') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ __('Install Addon') }}</a>
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
         @include('admin.warning')
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ __('Addons') }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th>{{ __('Sno') }}</th>
                                            <th>{{ __('Addon Image') }}</th>
                                           <th>{{ __('Addon Name') }}</th>
                                           <th>{{ __('Addon Version') }}</th>
                                           <th>{{ __('Addon Url') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($getaddons as $addon)
                                    @php
                                    $img_url = url('/')."/Modules/".$addon->addon_dir."/resources/views/img/".$addon->addon_image;
                                    @endphp
                                        <tr class="allChecked">
                                            <td>{{ $no }}</td>
                                            <td>
                                            <img height="60" src="{{ $img_url }}" alt="{{ $addon->addon_name }}" />
                                            </td>
                                            <td>{{ $addon->addon_name }} </td>
                                            <td>v{{ $addon->addon_version }} </td>
                                            <td>@if(!empty($addon->addon_url))<a href="{{ $addon->addon_url }}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-shopping-cart"></i>&nbsp; {{ __('Buy Now') }}</a>@endif</td>
                                            <td>@if($addon->addon_status == 1) <span class="badge badge-success">{{ __('Activated') }}</span> @else <span class="badge badge-danger">{{ __('Deactivate') }}</span> @endif</td>
                                            <td>
                                            @if($addon->addon_status == 1)
                                            @if($demo_mode == 'on') 
                                            <a href="{{ url('/admin') }}/demo-mode" class="btn btn-secondary btn-sm"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;{{ __('Deactivate') }}</a>
                                            @else
                                            <a href="{{ url('/admin') }}/addon-deactivate/{{ $encrypter->encrypt($addon->addon_id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;{{ __('Deactivate') }}</a>
                                            @endif
                                            @else
                                            @if($demo_mode == 'on') 
                                            <a href="{{ url('/admin') }}/demo-mode" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;{{ __('Activated') }}</a>
                                            @else
                                            <a href="{{ url('/admin') }}/addon-activate/{{ $encrypter->encrypt($addon->addon_id) }}" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;{{ __('Activated') }}</a>
                                            @endif
                                            @endif
                                            @if($demo_mode == 'on') 
                                            <a href="{{ URL::to('/admin/demo-mode') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}</a>
                                            @else
                                            <a href="{{ url('/admin') }}/addons/{{ $encrypter->encrypt($addon->addon_id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete?');"><i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}</a>
                                            @endif
                                            </td>
                                        </tr>
                                       
                                        @php $no++; @endphp
                                   @endforeach     
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

 
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

     
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
                        columns: [0, 2, 3]
                    },
					className: 'ml-4 mr-1',
					filename: '{{ $allsettings->site_title }} - Addons'
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'mr-1',
					filename: '{{ $allsettings->site_title }} - Addons'
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'mr-1',
					filename: '{{ $allsettings->site_title }} - Addons'
                },
				{
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'mr-1',
					filename: '{{ $allsettings->site_title }} - Addons'
                },
				{
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 2, 3]
                    },
					className: 'mr-1',
					filename: '{{ $allsettings->site_title }} - Addons'
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
