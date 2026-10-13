<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ __('My Purchases') }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
<div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_other_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ __('Home') }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ __('My Purchases') }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ __('My Purchases') }}</h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
             @include('dashboard-menu')
          </aside>
          <!-- Content-->
          @if(count($orderData['item']) != 0)
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <!-- Title-->
              @foreach($orderData['item'] as $item)
              <div class="border-bottom py-4">
              <div class="media d-block d-sm-flex align-items-center">
              <a class="d-block mb-3 mb-sm-0 mr-sm-4 mx-auto" href="{{ url('/item') }}/{{ $item->product_slug }}" style="width: 12.5rem;">
              @if($item->product_image!='')
              <img class="rounded-lg purchase-img" src="{{ url('/') }}/public/storage/product/{{ $item->product_image }}" alt="{{ $item->product_name }}">
              @else
              <img class="rounded-lg purchase-img" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $item->product_name }}">
              @endif
              </a>
                <div class="d-block mb-3 mb-sm-0 mr-sm-4 mx-auto">
                  <h3 class="h6 product-title mb-2"><a href="{{ url('/item') }}/{{ $item->product_slug }}">{{ $item->product_name }}</a></h3>
                  <div class="text-accent font-size-sm"><strong>{{ __('Price') }}:</strong> {{ $allsettings->site_currency_symbol }}{{ $item->product_price }}</div>
                  <div class="d-flex align-items-center justify-content-center justify-content-sm-start">
                   @if($item->approval_status != 'payment released to customer')
                    @if($item->rating != 0)
                    <a class="d-block text-muted text-center my-2" href="javascript:void(0);" data-toggle="modal" data-target="#myModal_{{ $item->ord_id }}">
                      <div class="star-rating">
                      @if($item->rating == 1)
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      @endif
                      @if($item->rating == 2)
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      @endif
                      @if($item->rating == 3)
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      @endif
                      @if($item->rating == 4)
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star"></i>
                      @endif
                      @if($item->rating == 5)
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      <i class="sr-star dwg-star-filled active"></i>
                      @endif
                      </div>
                      <div class="font-size-xs">{{ __('Rate this product') }}</div>
                      </a>
                      @else
                      <a class="d-block text-muted text-center my-2" href="javascript:void(0);" data-toggle="modal" data-target="#myModal_{{ $item->ord_id }}">
                      <div class="star-rating">
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      <i class="sr-star dwg-star"></i>
                      </div>
                      <div class="font-size-xs">{{ __('Rate this product') }}</div>
                      </a>
                      @endif
                      @endif
                  </div>
                  @if($item->approval_status != 'payment released to customer')
                  <div class="d-flex">
                  <a href="{{ url('/my-purchases') }}/{{ $item->product_token }}" class="btn btn-primary btn-sm mr-3"><i class="dwg-download mr-1"></i>{{ __('Download File') }}</a>
                  <a href="{{ url('/invoice') }}/{{ $item->product_token }}/{{ $item->ord_id }}" class="btn btn-danger btn-sm mr-3"><i class="dwg-download mr-1"></i>{{ __('Invoice') }}</a>
                  </div>
                  @endif
                </div>
                <div class="d-block mb-3 mb-sm-0 mr-sm-4 mx-auto">
                <div class="text-accent font-size-sm mb-1"><strong>{{ __('Order Id') }}</strong> {{ $item->ord_id }}</div>
                <div class="text-accent font-size-sm mb-1"><strong>{{ __('Purchase Id') }}</strong> {{ $item->purchase_token }}</div>
                <div class="text-accent font-size-sm mb-1"><strong>{{ __('Purchase Date') }}</strong> {{ date("d M Y", strtotime($item->start_date)) }}</div>
                @if($custom_settings->product_license_price == 1)
                <div class="text-accent font-size-sm mb-1"><strong>{{ __('Expiry date') }}</strong> {{ date("d M Y", strtotime($item->end_date)) }}</div>
                <div class="text-accent font-size-sm mb-1"><strong>{{ __('Licence') }}</strong> {{ $item->license }}</div>
                @endif
                  @if($allsettings->site_refund_display == 1)
                  @if($item->approval_status != 'payment released to customer')
                  <div class="text-accent font-size-sm mb-1"><strong>{{ __('Refund Request') }}</strong> <a href="javascript:void(0);" data-toggle="modal" data-target="#refund_{{ $item->ord_id }}"> {{ __('Send Request') }}</a></div>
                  @endif
                  @endif
                </div>
                
              </div>
              @if(View::exists('extraservices::extra-services'))
                @include('extraservices::purchase')
                @endif
              </div>
              <div class="modal fade" id="myModal_{{ $item->ord_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Rating this Item') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('my-purchases') }}" method="post" id="profile_form" enctype="multipart/form-data">
      {{ csrf_field() }} 
      <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                    <input type="hidden" name="ord_id" value="{{ $item->ord_id }}">
                    <input type="hidden" name="product_token" value="{{ $item->product_token }}">
                    <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                    <input type="hidden" name="product_user_id" value="{{ $item->product_user_id }}">
                    <input type="hidden" name="product_url" value="{{ url('/item') }}/{{ $item->product_slug }}">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">{{ __('Your Rating') }}</label>
            <select name="rating" class="form-control" required>
                                        <option value="1" @if($item->rating == 1) selected @endif>1</option>
                                        <option value="2" @if($item->rating == 2) selected @endif>2</option>
                                        <option value="3" @if($item->rating == 3) selected @endif>3</option>
                                        <option value="4" @if($item->rating == 4) selected @endif>4</option>
                                        <option value="5" @if($item->rating == 5) selected @endif>5</option>
                                    </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">{{ __('Rating Reason') }}</label>
           <select name="rating_reason" class="form-control" required>
                                            <option value="design" @if($item->rating_reason == 'design') selected @endif>{{ __('Design Quality') }}</option>
                                            <option value="customization" @if($item->rating_reason == 'customization') selected @endif>{{ __('Customization') }}</option>
                                            <option value="support" @if($item->rating_reason == 'support') selected @endif>{{ __('Support') }}</option>
                                            <option value="performance" @if($item->rating_reason == 'performance') selected @endif>{{ __('Performance') }}</option>
                                            <option value="documentation" @if($item->rating_reason == 'documentation') selected @endif>{{ __('Well Documented') }}</option>
                                        </select>
          </div>
          <div class="form-group">
          <label for="message-text" class="col-form-label">{{ __('Comments') }}</label>
          <textarea name="rating_comment" id="rating_comment" class="form-control" required>{{ $item->rating_comment }}</textarea>
                            <p>{{ __('Your review will be public visible and seller may reply to your comments') }}</p>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit Rating') }}</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="refund_{{ $item->ord_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Refund Request') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('refund') }}" method="post" id="profile_form" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="modal-body">
          <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                    <input type="hidden" name="ord_id" value="{{ $item->ord_id }}">
                    <input type="hidden" name="purchased_token" value="{{ $item->purchase_token }}">
                    <input type="hidden" name="product_token" value="{{ $item->product_token }}">
                    <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                    <input type="hidden" name="product_user_id" value="{{ $item->product_user_id }}">
                    <input type="hidden" name="product_url" value="{{ url('/item') }}/{{ $item->product_slug }}">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">{{ __('Refund Reason') }}</label>
            <select name="refund_reason" class="form-control" required>
                             <option value="Item is not as described or the item does not work the way it should">
                             {{ __('Item is not as described or the item does not work the way it should') }}</option>
                                            <option value="Item has a security vulnerability">{{ __('Item has a security vulnerability') }}</option>
                                            <option value="Item support is promised but not provided">{{ __('Item support is promised but not provided') }}</option>
                                            <option value="Item support extension not used">{{ __('Item support extension not used') }}</option>
                                            <option value="Items that have not been downloaded">{{ __('Items that have not been downloaded') }}</option>
                                        </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">{{ __('Comments') }}</label>
            <textarea name="refund_comment" id="refund_comment" class="form-control" required></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit Request') }}</button>
      </div>
      </form>
    </div>
  </div>
 </div>
     @endforeach
      <!-- Product-->
       </div>
          </section>
          @else
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
             <div class="pt-2 px-4 pl-lg-0 pr-xl-5" align="center">
             {{ __('No Data Found') }}
             </div>
             </section>
              @endif
        </div>
      </div>
    </div>
@include('footer')
@include('script')
</body>
</html>