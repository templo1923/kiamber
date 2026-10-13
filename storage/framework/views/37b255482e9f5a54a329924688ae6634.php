<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo e(__('Checkout')); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_other_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(__('Home')); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(__('Checkout')); ?></li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(__('Checkout')); ?></h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Content-->
          <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-3">
          <form action="<?php echo e(route('checkout')); ?>" class="needs-validation" id="checkout_form" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
              <!-- Title-->
              <?php if(Auth::guest()): ?>
              <h2 class="h6 border-bottom pb-3 mb-3"><?php echo e(__('Not a customer yet')); ?>?</h2>
              <!-- Billing detail-->
              <div class="row pb-4">
                <div class="col-6 form-group">
                  <label for="mc-email"><?php echo e(__('Email address')); ?>  <span class='text-danger'>*</span></label>
                  <input type="text" id="email" class="form-control" name="email" data-bvalidator="required,email">
                </div>
                <div class="col-sm-6 form-group">
                  <label for="mc-company"><?php echo e(__('Password')); ?> <span class='text-danger'>*</span></label>
                  <input type="text" id="password" class="form-control" name="password" data-bvalidator="required,minlen[6]">
                </div>
              </div>
              <?php endif; ?>
              <?php if(Auth::check()): ?>
              <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
              <?php endif; ?>
              <div class="widget mb-3 d-lg-none">
                <h2 class="widget-title"><?php echo e(__('Order summary')); ?></h2>
                <?php 
                 $subtotal = 0;
                 $order_id = '';
                 $product_price = '';
                 $product_userid = '';
                 $coupon_code = ""; 
                 $new_price = 0; 
                 $single_price = 0;
                 $default_single_price = 0;
                 ?>
                 <?php $__currentLoopData = $cart['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="media align-items-center pb-2 border-bottom">
                <a class="d-block mr-2" href="<?php echo e(url('/item')); ?>/<?php echo e($cart->product_slug); ?>">
                <?php if($cart->product_image!=''): ?>
                <img class="rounded-sm" width="64" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($cart->product_image); ?>" alt="<?php echo e($cart->product_name); ?>"/>
                <?php else: ?>
                <img class="rounded-sm" width="64" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($cart->product_name); ?>"/>
                <?php endif; ?>
                </a>
                  <div class="media-body pl-1">
                    <h6 class="widget-product-title grid-product-title"><a href="<?php echo e(url('/item')); ?>/<?php echo e($cart->product_slug); ?>"><?php echo e($cart->product_name); ?></a></h6>
                    <div class="widget-product-meta"><span class="text-accent border-right pr-2 mr-2"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($cart->total_price); ?></span><?php if($custom_settings->product_license_price == 1): ?><span class="font-size-xs text-muted"><?php echo e($cart->license); ?><?php if($cart->license == 'regular'): ?> (<?php echo e(__('6 months')); ?>) <?php elseif($cart->license == 'extended'): ?> (<?php echo e(__('12 months')); ?>) <?php endif; ?></span><?php endif; ?></div>
                  </div>
                </div>
                <?php 
                $subtotal += $cart->total_price;
                $default_single_price += $cart->total_price;
                $single_price += $cart->total_price;
                $order_id .= $cart->ord_id.',';
                $product_price .= $cart->total_price.','; 
                $product_userid .= $cart->product_user_id.','; 
                if($cart->discount_price != 0)
                {
                    $price = $cart->discount_price;
                    $new_price += $cart->discount_price;
                    $coupon_code = $cart->coupon_code;
                }
                else
                {
                   $price = $cart->total_price;
                   $new_price += $cart->total_price;
                   $coupon_code = "";
                }
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <ul class="list-unstyled font-size-sm py-3">
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(__('Subtotal')); ?></span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($subtotal); ?></span></li>
                  <?php if($allsettings->site_extra_fee != 0): ?>
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(__('Processing Fee')); ?></span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($allsettings->site_extra_fee); ?></span></li>
                  <?php endif; ?>
                  <?php if($coupon_code != ""): ?>
                  <?php 
                  $coupon_discount = $subtotal - $new_price;
                  $final = $new_price + $allsettings->site_extra_fee;
                  $last_price =  $new_price;
                  $priceamount = $new_price;
                  ?>
                  <li class="d-flex justify-content-between align-items-center font-size-base"><span class="mr-2"><?php echo e(__('Discount Price')); ?></span><span class="text-right"> - <?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($coupon_discount); ?></span></li>
                  <?php else: ?>
                  <?php 
                  $final = $subtotal+$allsettings->site_extra_fee; 
                  $last_price =  $subtotal;
                  $priceamount = $subtotal;
                  ?>
                  <?php endif; ?>
                  <?php if($country_percent != 0): ?>
                  <?php
                  $vat_price = ($single_price * $country_percent) / 100;
                  $default_vat_price = ($default_single_price * $country_percent) / 100;
                  ?>
                  <li class="d-flex justify-content-between align-items-center font-size-base"><span class="mr-2"><?php echo e(__('VAT')); ?> (%)</span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($vat_price); ?></span></li>
                  <?php else: ?>
                  <?php
                  $vat_price = 0;
                  $default_vat_price = 0;
                  ?>
                  <?php endif; ?> 
                  <?php
                  
                  $finbb = $final + $vat_price;
                  ?> 
                  <li class="d-flex justify-content-between align-items-center font-size-base"><span class="mr-2"><?php echo e(__('Total')); ?></span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($finbb); ?></span></li>
                </ul>
              </div>
              <div class="accordion mb-2" id="payment-method" role="tablist">
                <?php $no = 1; ?>
                <?php $__currentLoopData = $get_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card">
                  <div class="card-header" role="tab">
                    <h3 class="accordion-heading"><a href="#<?php echo e($payment); ?>" id="<?php echo e($payment); ?>" data-toggle="collapse"><?php echo e(__('Pay with')); ?> <?php if($payment == 'fapshi'): ?><?php echo e(__('Mobile Money')); ?><?php else: ?><?php echo e($payment); ?><?php endif; ?><span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                  </div>
                  <div class="collapse <?php if($no == 1): ?> show <?php endif; ?>" id="<?php echo e($payment); ?>" data-parent="#payment-method" role="tabpanel">
                  <?php if($payment == 'stripe'): ?>
                    <div class="card-body font-size-sm custom-radio custom-control">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio"  value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('Stripe')); ?></span> - <?php echo e(__('Credit or debit card')); ?></p>
                      <?php if($stripe_type == 'charges'): ?>
                      <div class="stripebox mb-3" id="ifYes" style="display:none;">
                        <label for="card-element"><?php echo e(__('Credit or debit card')); ?></label>
                        <div id="card-element"></div>
                        <div id="card-errors" role="alert"></div>
                      </div>
                      <?php endif; ?>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Stripe')); ?></button>
                    </div> 
                    <?php endif; ?>
                    <?php if($payment == 'paypal'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(__('PayPal')); ?></span> - <?php echo e(__('the safer, easier way to pay')); ?></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with PayPal')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if(Auth::check()): ?>
                    <?php if($payment == 'wallet'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('Wallet')); ?></span> - (<?php echo e($allsettings->site_currency_symbol); ?><?php echo e(Auth::user()->earnings); ?>)</p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Wallet')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if($payment == 'paystack'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(__('PayStack')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with PayStack')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'offline'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(__('Offline')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Offline')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'localbank'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(__('Local Bank')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Local Bank')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'razorpay'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(__('Razorpay')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Razorpay')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'coingate'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(__('Coingate')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Coingate')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'coinpayments'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('CoinPayments')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with CoinPayments')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'payhere'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('PayHere')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with PayHere')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'payfast'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('PayFast')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with PayFast')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'flutterwave'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('Flutterwave')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Flutterwave')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'mercadopago'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('Mercadopago')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Mercadopago')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'coinbase'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('Coinbase')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Coinbase')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'cashfree'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('Cashfree')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Cashfree')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'nowpayments'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('NowPayments')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with NowPayments')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'uddoktapay'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('UddoktaPay')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with UddoktaPay')); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'fapshi'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" data-bvalidator="required"> <?php echo e(__('Mobile Money')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Mobile Money')); ?></button>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($payment == 'bold'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-bold" name="payment_method" type="radio" class="custom_radio" value="bold" data-bvalidator="required"> <?php echo e(__('Bold (Tarjetas/PSE)')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Bold')); ?></button>
                    </div>
                    <?php endif; ?>

                    
                    <?php if($payment == 'wompi'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-wompi" name="payment_method" type="radio" class="custom_radio" value="wompi" data-bvalidator="required"> <?php echo e(__('Wompi (Bancolombia/PSE)')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Wompi')); ?></button>
                    </div>
                    <?php endif; ?>

                    
                    <?php if($payment == 'binance'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-binance" name="payment_method" type="radio" class="custom_radio" value="binance" data-bvalidator="required"> <?php echo e(__('Binance Pay (Cripto)')); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(__('Checkout with Binance')); ?></button>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
                <?php $no++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                

                
                
                <?php if(View::exists('iyzico::iyzico-settings')): ?>
                <div class="accordion mb-2" id="payment-method" role="tablist"> 
                <div class="card">
                <?php echo $__env->make('iyzico::iyzico-option', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div> 
                </div>
                <?php endif; ?>
                <div class="clear-fix">&nbsp;</div>
                <div class="mt-3">
                <div class="form-group">
                  <input  type="checkbox" name="register_rules" id="ch2" value="1" data-bvalidator="required">
                  <span class="become_vendor"><?php echo e(__('I agree to the')); ?> <a href="<?php echo e(URL::to('/terms-and-conditions')); ?>"><?php echo e(__('terms & conditions')); ?></a> <?php echo e(__('and')); ?> <a href="<?php echo e(URL::to('/privacy-policy')); ?>"><?php echo e(__('privacy policy')); ?></a></span>
                </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="order_id" value="<?php echo e(rtrim($order_id,',')); ?>">
            <input type="hidden" name="product_prices" value="<?php echo e(base64_encode(rtrim($product_price,','))); ?>">
            <input type="hidden" name="product_user_id" value="<?php echo e(rtrim($product_userid,',')); ?>">
            <input type="hidden" name="amount" value="<?php echo e(base64_encode($finbb)); ?>">
            <input type="hidden" name="processing_fee" value="<?php echo e(base64_encode($allsettings->site_extra_fee)); ?>">
            <input type="hidden" name="website_url" value="<?php echo e(url('/')); ?>">
            <input type="hidden" name="vat_price" value="<?php echo e(base64_encode($vat_price)); ?>">
            <input type="hidden" name="default_vat_price" value="<?php echo e(base64_encode($default_vat_price)); ?>">
            <input type="hidden" name="token" class="token">
            </form>
          </section>
          <aside class="col-lg-4 d-none d-lg-block">
            <hr class="d-lg-none">
            <div class="cz-sidebar-static h-100 ml-auto border-left">
              <div class="widget mb-3">
                <h2 class="widget-title text-center"><?php echo e(__('Order summary')); ?></h2>
                <?php 
                 $subtotal = 0;
                 $order_id = '';
                 $product_price = '';
                 $single_price = 0;
                 $product_userid = ''; 
                 $coupon_code = ""; 
                 $new_price = 0;
                 ?>
                 <?php $__currentLoopData = $cart_mobile['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="media align-items-center pb-3 mb-3 border-bottom">
                <a class="d-block mr-2" href="<?php echo e(url('/item')); ?>/<?php echo e($cart->product_slug); ?>">
                <?php if($cart->product_image!=''): ?>
                <img class="rounded-sm" width="64" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($cart->product_image); ?>" alt="<?php echo e($cart->product_name); ?>"/>
                <?php else: ?>
                <img class="rounded-sm" width="64" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($cart->product_name); ?>"/>
                <?php endif; ?>
                </a>
                  <div class="media-body pl-1">
                    <h6 class="widget-product-title grid-product-title"><a href="<?php echo e(url('/item')); ?>/<?php echo e($cart->product_slug); ?>"><?php echo e($cart->product_name); ?></a></h6>
                    <div class="widget-product-meta"><span <?php if($custom_settings->product_license_price == 1): ?> class="text-accent border-right pr-2 mr-2" <?php else: ?> class="text-accent pr-2 mr-2" <?php endif; ?>><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($cart->total_price); ?></span><?php if($custom_settings->product_license_price == 1): ?><span class="font-size-xs text-muted"><?php echo e($cart->license); ?><?php if($cart->license == 'regular'): ?> (<?php echo e(__('6 months')); ?>) <?php elseif($cart->license == 'extended'): ?> (<?php echo e(__('12 months')); ?>) <?php endif; ?></span><?php endif; ?></div>
                  </div>
                </div>
                <?php 
                $subtotal += $cart->total_price;
                $single_price += $cart->total_price;
                $order_id .= $cart->ord_id.',';
                $product_price .= $cart->total_price.','; 
                $product_userid .= $cart->product_user_id.',';
                if($cart->discount_price != 0)
                {
                    $price = $cart->discount_price;
                    $new_price += $cart->discount_price;
                    $coupon_code = $cart->coupon_code;
                }
                else
                {
                   $price = $cart->total_price;
                   $new_price += $cart->total_price;
                   $coupon_code = "";
                } 
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <ul class="list-unstyled font-size-sm pt-3 pb-2 border-bottom">
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(__('Subtotal')); ?></span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($subtotal); ?></span></li>
                  <?php if($allsettings->site_extra_fee != 0): ?>
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(__('Processing Fee')); ?></span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($allsettings->site_extra_fee); ?></span></li>
                  <?php endif; ?>
                  <?php if($coupon_code != ""): ?>
                  <?php 
                  $coupon_discount = $subtotal - $new_price;
                  $final = $new_price + $allsettings->site_extra_fee;
                  $last_price =  $new_price;
                  $priceamount = $new_price;
                  ?>
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(__('Discount Price')); ?></span><span class="text-right"> - <?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($coupon_discount); ?></span></li>
                  <?php else: ?>
                  <?php 
                  $final = $subtotal+$allsettings->site_extra_fee; 
                  $last_price =  $subtotal;
                  $priceamount = $subtotal;
                  ?>
                  <?php endif; ?>
                  <?php if($country_percent != 0): ?>
                  <?php
                  $vat_price = ($single_price * $country_percent) / 100;
                  ?>
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(__('VAT')); ?> (%)</span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($vat_price); ?></span></li>
                  <?php else: ?>
                  <?php
                  $vat_price = 0;
                  ?>
                  <?php endif; ?> 
                  <?php
                  
                  $finbb = $final + $vat_price;
                  ?>
                </ul>
                <h3 class="font-weight-normal text-center my-4"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($finbb); ?></h3>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
<?php echo $__env->make('footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



<script>
$(document).ready(function() {
    // Esto hace que el círculo se pinte de azul al abrir la pestaña
    $('.accordion-heading a').on('click', function() {
        var targetId = $(this).attr('href').replace('#', '');
        var radioInput = $('#opt1-' + targetId);
        
        if (radioInput.length) {
            radioInput.prop('checked', true).trigger('change');
            
            // Si es de los nuevos, cambia la ruta; si es PayPal, la resetea
            var form = $('#checkout_form');
            if (targetId === 'bold' || targetId === 'wompi' || targetId === 'binance') {
                form.attr('action', "<?php echo e(route('kiamber-payment')); ?>");
            } else {
                form.attr('action', "<?php echo e(route('checkout')); ?>");
            }
        }
    });
});
</script>




</body>
</html><?php /**PATH /home/catalogo/public_html/resources/views/pages/checkout.blade.php ENDPATH**/ ?>