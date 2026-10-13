<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]--><head>
    
    @include('admin.stylesheet')
</head>

<body>
    
    @include('admin.navigation')

    <!-- Right Panel -->
    @if(in_array('upgrade',$avilable))
    <div id="right-panel" class="right-panel">

       
                       @include('admin.header')
                       

        
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Upload Addon') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/addons') }}" class="btn btn-success btn-sm"><i class="fa fa-plug"></i> {{ __('Installed Addons') }}</a>
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        
        @include('admin.warning')
        

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div id="div1"></div>
                <div class="row">
                    <div class="col-md-12">
                    
                    <div class="alert alert-warning alert-with-icon font-size-sm mb-4" role="alert">
                <div class="alert-icon-box"><i class="alert-icon dwg-announcement"></i></div> <b>{{ __('Notice') }} : </b><br/>{{ __('Upload new addon from here. if you have a addon already but you have uploaded that addon file again, it will override existing addon files') }}
              </div>
                    </div>
                    <div class="col-md-12">
                       
                        
                        
                      
                        <div class="card">
                           @if($demo_mode == 'on')
                           @include('admin.demo-mode')
                           @else
                           <form action="{{ route('admin.install-addon') }}" method="post" id="setting_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                           
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ __('Your Addon Purchased Code') }} / {{ __('Your Addon Order Id') }} <span class="require">*</span></label>
                                                <input id="addon_purchased_code" name="addon_purchased_code" type="text" class="form-control noscroll_textarea" data-bvalidator="required">
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
                                                <label for="site_title" class="control-label mb-1">{{ __('Upload Addon file') }} (ZIP)<span class="require">*</span></label>
                                                <input id="upload_addon_file" name="upload_addon_file" type="file" class="form-control noscroll_textarea" value="" data-bvalidator="required,extension[zip]">
                                            </div> 
                                            
                        
                                           
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{ __('Submit') }}</button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> {{ __('Reset') }} </button>
                             </div>
                             
                             </div>
                             
                            
                            </form>
                            
                                                    
                                                    
                                                 
                            
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
<?php /*?><script src="{{ URL::to('resources/views/admin/template/assets/js/jquery.form.js') }}"></script>
<script type="text/javascript">
$(function() {
    $(document).ready(function()
    {
        var bar = $('.cc_bar');
		
        var percent = $('.cc_percent');
          $('form').ajaxForm({
            beforeSend: function() {
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
			var json = JSON.parse(xhr.responseText);
                alert(json.msg);
				document.getElementById("setting_form").reset();
				var percentVal = '0%';
				bar.width(percentVal)
				percent.html(percentVal);
            }
          });
    }); 
 });
</script><?php */?>
</body>
</html>