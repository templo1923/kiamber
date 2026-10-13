<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    @include('admin.stylesheet')
    @include('admin.javascript')
</head>

<body>
    
    @include('admin.navigation')

    <!-- Right Panel -->
    @if(in_array('manage-products',$avilable))
    <div id="right-panel" class="right-panel">

       
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ __('Add Product') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        
        @include('admin.warning')

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                       
                        
                        
                      
                        <div class="card">
                           
                           <div class="col-md-12">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                          <div class="form-group">
                                            <label for="name" class="control-label mb-1">{{ __('Files') }} @if($demo_mode == 'on') <span class="require">{{ $demo_text }}</span> @endif</label>
                                            <form action="{{route('fileupload')}}" class='dropzone' enctype="multipart/form-data">
                                            <input type="hidden" name="product_token" value="">
                                            </form>
                                            </div>
                                          </div>
                                     </div>
                                 </div>
                             </div>               
                                            
                           @if($demo_mode == 'on')
                           @include('admin.demo-mode')
                           @else
                            <form action="{{ route('admin.add-product') }}" method="post" id="category_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                          
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                         <div class="form-group">
                                                <label for="name" class="control-label mb-1" id="tagname">{{ __('Product Name') }} <span class="require">*</span></label>
                                                <input id="textboxdata" name="product_name" type="text" class="form-control" @if($custom_settings->product_name_limit == 0) data-bvalidator="required" @else data-bvalidator="required,maxlen[{{ $custom_settings->product_name_limit }}]" @endif>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Product Slug') }}</label>
                                                <input id="product_slug" name="product_slug" type="text" class="form-control">
                                                <small>({{ __("if leave empty, it's automatically get product name to slug") }})</small>
                                            </div>
                                                                                       
                                            
                                            <div class="form-group">
                                                <label for="site_keywords" class="control-label mb-1">{{ __('Short Description') }} <span class="require">*</span></label>
                                                
                                            <textarea name="product_short_desc" id="product_short_desc" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"></textarea>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ __('Description') }} <span class="require">*</span>@if(View::exists('aiwriter::index')) @if(in_array('add-product',$ai_writer_display_pages))@include('aiwriter::aigenerate')@endif @endif</label>
                                                
                                            <textarea name="product_desc" id="summary-ckeditor" rows="6"  class="form-control" data-bvalidator="required"></textarea>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Category') }} <span class="require">*</span></label>
                                                <?php /*?><select name="product_category" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @foreach($category['view'] as $category)
                                                <option value="{{$category->cat_id}}">{{ $category->category_name }}</option>
                                                @endforeach 
                                                
                                                </select><?php */?>
                                                <select name="product_category" id="product_category" class="form-control" data-bvalidator="required">
                                            <option value=""></option>
                                            @foreach($re_categories['menu'] as $menu)
                                                <option value="category_{{ $menu->cat_id }}">{{ $menu->category_name }}</option>
                                                @foreach($menu->subcategory as $sub_category)
                                                <option value="subcategory_{{$sub_category->subcat_id}}"> - {{ $sub_category->subcategory_name }}</option>
                                                @endforeach  
                                            @endforeach
                                            </select>
                                            </div> 
                                            
                                            @foreach($attribute['fields'] as $attribute_field)
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ $attribute_field->attr_label }}</label>
                                                @php $field_value=explode(',',$attribute_field->attr_field_value); @endphp
                                                @if($attribute_field->attr_field_type == 'multi-select')
                                                <select  name="attributes_{{ $attribute_field->attr_id }}[]" class="form-control" multiple="multiple">
                                                @foreach($field_value as $field)
                                                <option value="{{ $field }}">{{ $field }}</option>
                                                @endforeach
                                                </select>
                                                @endif
                                                @if($attribute_field->attr_field_type == 'single-select')
                                                <select name="attributes_{{ $attribute_field->attr_id }}[]" class="form-control">
                                                  <option value=""></option>
                                                  @foreach($field_value as $field)
                                                  <option value="{{ $field }}">{{ $field }}</option>
                                                  @endforeach
                                                </select>
                                                @endif
                                                @if($attribute_field->attr_field_type == 'textbox')
                                                <input name="attributes_{{ $attribute_field->attr_id }}[]" type="text" class="form-control">
                                                @endif
                                                
                                            </div>
                                           @endforeach
                                             
                                             
                                             <?php /*?><div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Package Includes') }}</label>
                                                <select name="package_includes[]" class="form-control" multiple>
                                                 @foreach($package['view'] as $package)
                                                <option value="{{$package->package_id}}">{{ $package->package_name }}</option>
                                                @endforeach 
                                                
                                                </select>
                                                
                                            </div> 
                                            
                                             
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Compatible Browsers') }}</label>
                                                <select name="compatible_browsers[]" class="form-control" multiple>
                                                @foreach($browser['view'] as $browser)
                                                <option value="{{$browser->browser_id}}">{{ $browser->browser_name }}</option>
                                                @endforeach 
                                                
                                                </select>
                                                
                                            </div> <?php */?>
                                            
                                            @if($custom_settings->product_license_price == 1)
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Regular License Price') }} ({{ __('6 Months Support') }}) ({{ $allsettings->site_currency_symbol }})<span class="require">*</span></label>
                                                <input id="regular_price" name="regular_price" type="text" class="form-control" data-bvalidator="required,min[1]">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Extended License Price') }} ({{ __('12 Months Support') }}) ({{ $allsettings->site_currency_symbol }})</label>
                                                <input id="extended_price" name="extended_price" type="text" class="form-control" data-bvalidator="min[1]">
                                            </div>   
                                            @else
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Price') }} ({{ $allsettings->site_currency_symbol }}) <span class="require">*</span></label>
                                                <input id="regular_price" name="regular_price" type="text" class="form-control" data-bvalidator="required,min[1]">
                                            </div>
                                            @endif
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                             <div class="col-md-6">
                             
                             
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div id="display_message"></div>
                                    <div id="hide_message">
                                    <div class="form-group">
                                                <label for="customer_earnings" class="control-label mb-1">{{ __('Upload Thumbnail Image') }} (Size : 296px X 200px)<span class="require">*</span></label>
                                                <select name="product_image1" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @foreach($getdata1['first'] as $get)
                                                <option value="{{ $get->product_file_name }}">{{ $get->original_file_name }}</option>
                                                @endforeach
                                                </select>
                                             </div> 
                                             
                                             
                                             <div class="form-group">
                                                <label for="customer_earnings" class="control-label mb-1">{{ __('Upload Preview Image') }} (Size : 762px X 508px)<span class="require">*</span></label>
                                                <select name="product_preview1" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @foreach($getdata4 as $get)
                                                <option value="{{ $get->product_file_name }}">{{ $get->original_file_name }}</option>
                                                @endforeach
                                                </select>
                                             </div>
                                             
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Upload Main File Type') }} <span class="require">*</span></label>
                                               <select name="product_file_type1" id="product_file_type1" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="file">{{ __('File') }}</option>
                                                    <option value="link">{{ __('Link / URL') }}</option>
                                                </select>
                                            </div>
                                    
                                    <div class="form-group" id="main_file">
                                                <label for="customer_earnings" class="control-label mb-1">{{ __('Upload Main File') }} ({{ __('Zip Format Only') }})<span class="require">*</span></label>
                                                <select  name="product_file1" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @foreach($getdata2['second'] as $get)
                                                <option value="{{ $get->product_file_name }}">{{ $get->original_file_name }}</option>
                                                @endforeach
                                                </select>
                                             </div>  
                                    
                                    
                                    <div class="form-group" id="main_link">
                                                <label for="name" class="control-label mb-1">{{ __('Main File Link/URL') }} <span class="require">*</span></label>
                                                <input type="text" id="product_file_link1" name="product_file_link1" class="form-control" data-bvalidator="required">
                                                
                                            </div>
                                    
                                     <div class="form-group">
                                                <label for="customer_earnings" class="control-label mb-1">{{ __('Upload Gallery Images') }} ({{ __('Multiselect') }})</label>
                                                <select id="product_gallery" name="product_gallery[]" class="form-control" multiple>
                                                @foreach($getdata3['third'] as $get)
                                                <option value="{{ $get->product_file_name }}">{{ $get->original_file_name }}</option>
                                                @endforeach
                                                </select>
                                             </div>
                                    </div>
                                    
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Future Update') }}? <span class="require">*</span></label>
                                                <select name="future_update" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                                    
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Product Support') }}? <span class="require">*</span></label>
                                                <select name="item_support" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                                            
                                            
                                            
                                            
                                  <div class="form-group">
                                                <label for="site_keywords" class="control-label mb-1">{{ __('Tags') }}</label>
                                                
                                            <textarea name="product_tags" id="product_tags" rows="4" placeholder="separate tag with commas" class="form-control noscroll_textarea"></textarea>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Featured Product') }}? <span class="require">*</span></label>
                                                <select name="product_featured" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                                    
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Flash Sale') }}? <span class="require">*</span></label>
                                                <select name="product_flash_sale" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                               
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Free Download') }}? <span class="require">*</span></label>
                                                <select name="product_free" id="product_free" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                                            @if($allsettings->subscription_mode == 1)
                                            <div class="form-group" id="subscription_box">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Subscription Item') }}? <span class="require">*</span></label>
                                                <select name="subscription_item" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                
                                                <option value="1">On</option>
                                                <option value="0">Off</option>
                                                </select>
                                                <small>({{ __('if Yes means subscription user will allowed free download this product') }})</small>
                                            </div>
                                            @else
                                            <input type="hidden" name="subscription_item" value="0">
                                            @endif 
                                             
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Demo Url') }}</label>
                                                <input id="product_demo_url" name="product_demo_url" type="text" class="form-control" data-bvalidator="url">
                                                
                                            </div> 
                                     
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ __('Allow Seo') }}? <span class="require">*</span></label>
                                                <select name="product_allow_seo" id="product_allow_seo" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </select>
                                                
                                            </div>      
                             <div id="ifseo">
                            <div class="form-group">
                                                <label for="site_keywords" class="control-label mb-1">{{ __('SEO Meta Keywords') }} ({{ __('max 160 chars') }}) <span class="require">*</span></label>
                                                
                                            <textarea name="product_seo_keyword" id="product_seo_keyword" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"></textarea>
                                            </div> 
                               
                             
                                       <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ __('SEO Meta Description') }} ({{ __('max 160 chars') }}) <span class="require">*</span></label>
                                                
                                            <textarea name="product_seo_desc" id="product_seo_desc" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"></textarea>
                                            </div>
                                  </div>  
                                     
                                     <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Product Sold') }}</label>
                                                <input id="product_sold" name="product_sold" type="text" class="form-control">
                                                
                                     </div>
                                     
                                     <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Fake Stars') }} (Count)</label>
                                                <input id="product_fake_stars" name="product_fake_stars" type="text" class="form-control">
                                                <small>(if leave blank automatic star count will be showing on product details page)</small>
                                     </div>
                                     
                                      <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ __('Video Url') }}</label>
                                                <input id="product_video_url" name="product_video_url" type="text" class="form-control">
                                                <small>( Example : https://www.youtube.com/watch?v=cXxAVn3rASk )</small>
                                     </div>
                                     
                                  <input type="hidden" name="image_size" value="{{ $allsettings->site_max_image_size }}">             
                                  <input type="hidden" name="zip_size" value="{{ $allsettings->site_max_zip_size }}"> 
                                  <input type="hidden" name="user_id" value="1">
                             </div>
                                </div>

                            </div>
                            
                             
                             </div>
                             @if(View::exists('extraservices::extra-services'))
                             @include('extraservices::add-product')
                             @endif 
                             
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


   
   @include('admin.zone')
    
</body>

</html>
