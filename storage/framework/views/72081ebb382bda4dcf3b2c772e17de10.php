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
    <?php if(in_array('settings',$avilable)): ?>
    <div id="right-panel" class="right-panel">

       
                       <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(__('Payment Settings')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        
        <?php echo $__env->make('admin.warning', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                       
                        
                        
                      
                        <div class="card">
                           <?php if($demo_mode == 'on'): ?>
                           <?php echo $__env->make('admin.demo-mode', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                           <?php else: ?>
                           <form action="<?php echo e(route('admin.payment-settings')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                          <?php endif; ?>
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Processing Fee')); ?> (<?php echo e(__('extra fee')); ?>) <span class="require">*</span></label>
                                                <input id="site_extra_fee" name="site_extra_fee" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_extra_fee); ?>" data-bvalidator="required,min[0]"><small>(if you will set <strong>"0"</strong> processing fee is <strong>OFF</strong>)</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Minimum withdrawal amount')); ?> (<?php echo e($setting['setting']->site_currency_symbol); ?>)<span class="require">*</span></label>
                                                <input id="site_minimum_withdrawal" name="site_minimum_withdrawal" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_minimum_withdrawal); ?>" data-bvalidator="required,digit,min[1]">
                                            </div> 
                                            
                                                                                          
                                          <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Flash Sale Discount Percentage')); ?> (%)<span class="require">*</span></label>
                                                <input id="site_flash_sale_discount" name="site_flash_sale_discount" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_flash_sale_discount); ?>" data-bvalidator="required,number,min[1],max[99]">
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
                                              <label for="product_approval" class="control-label mb-1"><?php echo e(__('Affiliate Referral')); ?>?<span class="require">*</span></label><br/>
                                              <select name="affiliate_referral" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1" <?php if($custom_settings->affiliate_referral == 1): ?> selected <?php endif; ?>><?php echo e(__('ON')); ?></option>
                                                        <option value="0" <?php if($custom_settings->affiliate_referral == 0): ?> selected <?php endif; ?>><?php echo e(__('OFF')); ?></option>
                                              </select>
                                              
                                            </div>
                                                
                                                
                                                <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Sign Up')); ?> <?php echo e(__('Referral Commission')); ?> (<?php echo e($setting['setting']->site_currency_symbol); ?>)<span class="require">*</span></label>
                                                
                                                <input id="site_referral_commission" name="site_referral_commission" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_referral_commission); ?>"  data-bvalidator="required,number,min[0]"></div>
                                                
                                                
                                                <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Per Sale Referral Commission Type')); ?><span class="require">*</span></label>
                                                <select name="per_sale_referral_commission_type" id="per_sale_referral_commission_type" class="form-control" required>
                                                <option value="fixed" <?php if($custom_settings->per_sale_referral_commission_type == 'fixed'): ?> selected <?php endif; ?>><?php echo e(__('Fixed')); ?></option>
                                                <option value="percentage" <?php if($custom_settings->per_sale_referral_commission_type == 'percentage'): ?> selected <?php endif; ?>><?php echo e(__('Percentage')); ?></option>
                                                </select>
                                            </div>
                                                
                                                <div class="form-group"><label for="site_title" class="control-label mb-1"><?php echo e(__('Per Sale Referral Commission')); ?> <span id="nfixed" <?php if($custom_settings->per_sale_referral_commission_type == 'fixed'): ?> class="inline-block" <?php else: ?>  class="display-none" <?php endif; ?>>(<?php echo e($setting['setting']->site_currency_symbol); ?>)</span><span id="npercentage" <?php if($custom_settings->per_sale_referral_commission_type == 'percentage'): ?> class="inline-block" <?php else: ?>  class="display-none" <?php endif; ?>>(%)</span><span class="require">*</span></label>
                                                <input id="per_sale_referral_commission" name="per_sale_referral_commission" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->per_sale_referral_commission); ?>"  data-bvalidator="required,number,min[0]"></div>
                                                
                                                <input type="hidden" name="sid" value="1">
                             
                             
                             </div>
                                </div>

                            </div>
                             
                             
                             
                             </div>
                             
                             
                             
                             <div style="clear:both;"></div>
                             
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Payment Methods')); ?> </label><br/>
                                                <?php $__currentLoopData = $payment_option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input id="payment_option" name="payment_option[]" type="checkbox" <?php if(in_array($payment,$get_payment)): ?> checked <?php endif; ?> class="noscroll_textarea" value="<?php echo e($payment); ?>"> <?php echo e(str_replace("-"," ",$payment)); ?> <?php if($payment == 'fapshi'): ?> (<?php echo e(__('Mobile Money')); ?>) <?php endif; ?><br/>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Withdraw Methods')); ?> </label><br/>
                                                <?php $__currentLoopData = $withdraw_option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input id="withdraw_option" name="withdraw_option[]" type="checkbox" <?php if(in_array($withdraw->withdrawal_key,$get_withdraw)): ?> checked <?php endif; ?> class="noscroll_textarea" value="<?php echo e($withdraw->withdrawal_key); ?>" data-bvalidator="required"> <?php echo e($withdraw->withdrawal_name); ?><br/>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </div>
                                            
                                          
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                             
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Paypal Settings')); ?></h4></div></div>
                             
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Paypal Email Id')); ?> <span class="require">*</span></label><br/>
                                               <input id="paypal_email" name="paypal_email" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->paypal_email); ?>" data-bvalidator="required,email">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Paypal Mode')); ?> <span class="require">*</span></label><br/>
                                               
                                                <select name="paypal_mode" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->paypal_mode == 1): ?> selected <?php endif; ?>>Live</option>
                                                <option value="0" <?php if($setting['setting']->paypal_mode == 0): ?> selected <?php endif; ?>>Demo</option>
                                                </select>
                                                
                                             </div>
                                            
                                          
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                             
                             
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Paystack Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Paystack Default Currency Code')); ?> <span class="require">*</span></label><br/>
                                               <input id="paystack_default_currency" name="paystack_default_currency" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->paystack_default_currency); ?>" data-bvalidator="required">
                                                <small>Example : NGN</small>
                                                
                                             </div>
                                             
                                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Paystack Merchant Email')); ?> <span class="require">*</span></label><br/>
                                               <input id="paystack_merchant_email" name="paystack_merchant_email" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->paystack_merchant_email); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Paystack Public Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="paystack_public_key" name="paystack_public_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->paystack_public_key); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                           
                                           
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Paystack Secret Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="paystack_secret_key" name="paystack_secret_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->paystack_secret_key); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                   
                                         
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Bank Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    
                                    
                                    
                                    <div class="form-group">
                                              <div style="height:0px;"></div>
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Local Bank Details')); ?> <span class="require">*</span></label><br/>
                                               <textarea name="local_bank_details" class="form-control noscroll_textarea" data-bvalidator="required" rows="5" cols="20"><?php echo e($setting['setting']->local_bank_details); ?></textarea>
                                                
                                                
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
                                              <div style="height:0px;"></div>
                                                
                                             </div>
                                             <div class="form-group">
                                               <strong><?php echo e(__('example')); ?>:<br/><br/>

                                                <?php echo e(__('Bank Name')); ?> : Test Bank<br/>
                                                <?php echo e(__('Branch Name')); ?> : Test Branch<br/>
                                                <?php echo e(__('Branch Code')); ?> : 00000<br/>
                                                <?php echo e(__('IFSC Code')); ?> : 63632EF</strong>
                                              </div>
                                         
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Offline Payment Settings')); ?></h4></div></div>
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    
                                    
                                    
                                    <div class="form-group">
                                              <div style="height:0px;"></div>
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Offline Payment Details')); ?></label><br/>
                                               <textarea name="offline_payment_details" class="form-control noscroll_textarea" rows="5" cols="20"><?php echo e($custom_settings->offline_payment_details); ?></textarea>
                                                
                                                
                                             </div>
                                           
                                           
                                            
                                         
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Razorpay Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Razorpay Key Id')); ?> <span class="require">*</span></label><br/>
                                               <input id="razorpay_key" name="razorpay_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->razorpay_key); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Razorpay Secret Key')); ?><span class="require">*</span></label><br/>
                                               <input id="razorpay_secret" name="razorpay_secret" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->razorpay_secret); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                         
                                    </div>
                                </div>

                            </div>
                            </div>
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Coingate Settings')); ?></h4></div></div>
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Coingate Mode')); ?> <span class="require">*</span></label><br/>
                                               
                                                <select name="coingate_mode" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->coingate_mode == 1): ?> selected <?php endif; ?>>Live</option>
                                                <option value="0" <?php if($setting['setting']->coingate_mode == 0): ?> selected <?php endif; ?>>Demo</option>
                                                </select>
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Coingate Auth Token')); ?> <span class="require">*</span></label><br/>
                                               <input id="coingate_auth_token" name="coingate_auth_token" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->coingate_auth_token); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                           
                                           
                                            
                                         
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('CoinPayments')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('CoinPayments Merchant ID')); ?> <span class="require">*</span></label><br/>
                                               <input id="coinpayments_merchant_id" name="coinpayments_merchant_id" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->coinpayments_merchant_id); ?>" data-bvalidator="required">
                                                
                                                
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
                             <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Payhere Settings')); ?></h4></div></div>
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Payhere Mode')); ?> </label><br/>
                                               
                                                <select name="payhere_mode" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->payhere_mode == 1): ?> selected <?php endif; ?>>Live</option>
                                                <option value="0" <?php if($setting['setting']->payhere_mode == 0): ?> selected <?php endif; ?>>Demo</option>
                                                </select>
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Payhere Merchant Id')); ?> <span class="require">*</span></label><br/>
                                               <input id="payhere_merchant_id" name="payhere_merchant_id" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->payhere_merchant_id); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                         
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('PayFast Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('PayFast Mode')); ?> <span class="require">*</span></label><br/>
                                               
                                                <select name="payfast_mode" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->payfast_mode == 1): ?> selected <?php endif; ?>>Live</option>
                                                <option value="0" <?php if($setting['setting']->payfast_mode == 0): ?> selected <?php endif; ?>>Demo</option>
                                                </select>
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('PayFast Merchant Id')); ?> <span class="require">*</span></label><br/>
                                               <input id="payfast_merchant_id" name="payfast_merchant_id" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->payfast_merchant_id); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                           
                                           
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('PayFast Merchant Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="payfast_merchant_key" name="payfast_merchant_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->payfast_merchant_key); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                    
                                    
                                         
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Flutterwave Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Flutterwave Default Currency Code')); ?> <span class="require">*</span></label><br/>
                                               <input id="flutterwave_default_currency" name="flutterwave_default_currency" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->flutterwave_default_currency); ?>" data-bvalidator="required">
                                                <small>Example : NGN</small>
                                                
                                             </div>
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Flutterwave Public Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="flutterwave_public_key" name="flutterwave_public_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->flutterwave_public_key); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Flutterwave Secret Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="flutterwave_secret_key" name="flutterwave_secret_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->flutterwave_secret_key); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                         
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Mercadopago Settings')); ?></h4></div></div>
                             
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mercadopago Public Key')); ?></label><br/>
                                            <input id="mercadopago_client_id" name="mercadopago_client_id" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->mercadopago_client_id); ?>">
                                                
                                                
                                             </div>
                                            
                                          
                                          <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mercadopago Access Token')); ?></label><br/>
                                  <input id="mercadopago_client_secret" name="mercadopago_client_secret" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->mercadopago_client_secret); ?>">
                                                
                                                
                                             </div>
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Mercadopago Mode')); ?></label><br/>
                                               
                                                <select name="mercadopago_mode" class="form-control">
                                                <option value="1" <?php if($custom_settings->mercadopago_mode == 1): ?> selected <?php endif; ?>><?php echo e(__('Live')); ?></option>
                                                <option value="0" <?php if($custom_settings->mercadopago_mode == 0): ?> selected <?php endif; ?>><?php echo e(__('Demo')); ?></option>
                                                </select>
                                                
                                             </div>
                                            
                                          
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Coinbase Settings')); ?></h4></div></div>
                            
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Coinbase Api Key')); ?></label><br/>
                                               <input id="coinbase_api_key" name="coinbase_api_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->coinbase_api_key); ?>">
                                                
                                                
                                             </div>
                                            
                                            <br/>
                                             
                                         
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                            
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Coinbase Secret Key')); ?></label><br/>
                                               
                                                <input id="coinbase_secret_key" name="coinbase_secret_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->coinbase_secret_key); ?>">
                                                
                                             </div>
                                            
                                          
                                                
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            <div class="col-md-12">
                            <div class="card-body">
                            <div id="pay-invoice">
                            <div class="card-body">
                            <div class="form-group">
                            <p><?php echo e(__('Coinbase Checkout Webhook URL')); ?> : <code><?php echo e(url('/')); ?>/webhooks/coinbase-checkout</code></p>
                            <p><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_three" class="blue-color"><?php echo e(__('How to configure webhooks url')); ?>?</a></p>
                             </div>
                            </div>
                            </div>                
                                </div>            
                            </div>
                            
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Cashfree Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Cashfree Mode')); ?> <span class="require">*</span></label><br/>
                                               
                                                <select name="cashfree_mode" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($custom_settings->cashfree_mode == 1): ?> selected <?php endif; ?>>Live</option>
                                                <option value="0" <?php if($custom_settings->cashfree_mode == 0): ?> selected <?php endif; ?>>Demo</option>
                                                </select>
                                                
                                             </div>
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Cashfree API Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="cashfree_api_key" name="cashfree_api_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->cashfree_api_key); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Cashfree API Secret')); ?> <span class="require">*</span></label><br/>
                                               <input id="cashfree_api_secret" name="cashfree_api_secret" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->cashfree_api_secret); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                         
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="card-body">
                            <div id="pay-invoice">
                            <div class="card-body">
                            <div class="form-group">
                            <p><?php echo e(__('Go To Whitelisting URL')); ?> : <code>https://merchant.cashfree.com/merchants/pg/developers/whitelisting?env=prod</code></p>
                            <p><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_four" class="blue-color"><?php echo e(__('How To Put My Domain')); ?>?</a></p>
                             </div>
                            </div>
                            </div>                
                                </div>            
                            </div>
                            
                            
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('NowPayments Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('NowPayments Mode')); ?></label><br/>
                                               
                                                <select name="nowpayments_mode" class="form-control">
                                                <option value="1" <?php if($custom_settings->nowpayments_mode == 1): ?> selected <?php endif; ?>><?php echo e(__('Live')); ?></option>
                                                <option value="0" <?php if($custom_settings->nowpayments_mode == 0): ?> selected <?php endif; ?>><?php echo e(__('Demo')); ?></option>
                                                </select>
                                                
                                             </div>
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('NowPayments API Key')); ?></label><br/>
                                               <input id="nowpayments_api_key" name="nowpayments_api_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->nowpayments_api_key); ?>">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('NowPayments IPN Secret')); ?></label><br/>
                                               <input id="nowpayments_ipn_secret" name="nowpayments_ipn_secret" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->nowpayments_ipn_secret); ?>">
                                                
                                                
                                             </div>
                                         
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('UddoktaPay Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('UddoktaPay API Key')); ?></label><br/>
                                               <input id="uddoktapay_api_key" name="uddoktapay_api_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->uddoktapay_api_key); ?>">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('UddoktaPay API URL')); ?></label><br/>
                                               <input id="uddoktapay_api_url" name="uddoktapay_api_url" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->uddoktapay_api_url); ?>">
                                                <small>Example : https://sandbox.uddoktapay.com/api/checkout-v2</small>
                                                
                                             </div>
                                         
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Fapshi Settings')); ?></h4></div></div>
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Fapshi Mode')); ?></label><br/>
                                               
                                                <select name="fapshi_mode" class="form-control">
                                                <option value="1" <?php if($custom_settings->fapshi_mode == 1): ?> selected <?php endif; ?>><?php echo e(__('Live')); ?></option>
                                                <option value="0" <?php if($custom_settings->fapshi_mode == 0): ?> selected <?php endif; ?>><?php echo e(__('Demo')); ?></option>
                                                </select>
                                                
                                             </div>
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Fapshi Api User')); ?></label><br/>
                                               <input id="fapshi_api_user" name="fapshi_api_user" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->fapshi_api_user); ?>">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Fapshi Api Key')); ?></label><br/>
                                               <input id="fapshi_api_key" name="fapshi_api_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($custom_settings->fapshi_api_key); ?>">
                                                
                                                
                                             </div>
                                           
                                           
                                            
                                         
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
<div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Bold Settings (Colombia)')); ?></h4></div></div>
<div class="col-md-6">
    <div class="card-body">
        <div class="form-group">
            <label class="control-label mb-1"><?php echo e(__('Bold API Key')); ?></label>
            <input name="bold_api_key" type="text" class="form-control" value="<?php echo e($custom_settings->bold_api_key); ?>">
        </div>
        <div class="form-group">
            <label class="control-label mb-1"><?php echo e(__('Bold Secret Key')); ?></label>
            <input name="bold_secret_key" type="text" class="form-control" value="<?php echo e($custom_settings->bold_secret_key); ?>">
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card-body">
        <div class="form-group">
            <label class="control-label mb-1"><?php echo e(__('TRM Rate (USD to COP)')); ?></label>
            <input name="bold_trm_rate" type="number" class="form-control" value="<?php echo e($custom_settings->bold_trm_rate ?? 4000); ?>">
        </div>
    </div>
</div>

<div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Wompi Settings (Colombia)')); ?></h4></div></div>
<div class="col-md-6">
    <div class="card-body">
        <div class="form-group">
            <label class="control-label mb-1"><?php echo e(__('Wompi Public Key')); ?></label>
            <input name="wompi_public_key" type="text" class="form-control" value="<?php echo e($custom_settings->wompi_public_key); ?>">
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card-body">
        <div class="form-group">
            <label class="control-label mb-1"><?php echo e(__('Wompi Integrity Secret')); ?></label>
            <input name="wompi_integrity_secret" type="text" class="form-control" value="<?php echo e($custom_settings->wompi_integrity_secret); ?>">
        </div>
    </div>
</div>

<div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Binance Pay Settings')); ?></h4></div></div>
<div class="col-md-6">
    <div class="card-body">
        <div class="form-group">
            <label class="control-label mb-1"><?php echo e(__('Binance API Key')); ?></label>
            <input name="binance_api_key" type="text" class="form-control" value="<?php echo e($custom_settings->binance_api_key); ?>">
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card-body">
        <div class="form-group">
            <label class="control-label mb-1"><?php echo e(__('Binance Secret Key')); ?></label>
            <input name="binance_secret_key" type="text" class="form-control" value="<?php echo e($custom_settings->binance_secret_key); ?>">
        </div>
    </div>
</div>                            
                            
                            
                            
                            <div class="col-md-12"><div class="card-body"><h4><?php echo e(__('Stripe Settings')); ?></h4></div></div>
                             
                             
                              <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Stripe Mode')); ?> <span class="require">*</span></label><br/>
                                               
                                                <select name="stripe_mode" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->stripe_mode == 1): ?> selected <?php endif; ?>>Live</option>
                                                <option value="0" <?php if($setting['setting']->stripe_mode == 0): ?> selected <?php endif; ?>>Demo</option>
                                                </select>
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Test Publishable Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="test_publish_key" name="test_publish_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->test_publish_key); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Live Publishable Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="live_publish_key" name="live_publish_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->live_publish_key); ?>" data-bvalidator="required">
                                                
                                                
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Stripe Payment Type')); ?> </label><br/>
                                               
                                                <select name="stripe_type" class="form-control">
                                                <option value="charges" <?php if($setting['setting']->stripe_type == 'charges'): ?> selected <?php endif; ?>><?php echo e(__('Charges API')); ?></option>
                                                <option value="intents" <?php if($setting['setting']->stripe_type == 'intents'): ?> selected <?php endif; ?>><?php echo e(__('Intents API')); ?></option>
                                                </select>
                                                
                                             </div>
                                             
                                             
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Test Secret Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="test_secret_key" name="test_secret_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->test_secret_key); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                           
                                           
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(__('Live Secret Key')); ?> <span class="require">*</span></label><br/>
                                               <input id="live_secret_key" name="live_secret_key" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->live_secret_key); ?>" data-bvalidator="required">
                                                
                                                
                                             </div>
                                         
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> <?php echo e(__('Submit')); ?>

                                                        </button>
                                                        <button type="reset" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-ban"></i> <?php echo e(__('Reset')); ?>

                                                        </button>
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

<div id="myModal_three" class="modal fade 2checkout" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <img class="lazy" width="1223" height="678" src="<?php echo e(url('/')); ?>/resources/views/theme/img/coinbase_info.png"  class="img-responsive">
        </div>
    </div>
  </div>
</div>
<div id="myModal_four" class="modal fade 2checkout" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <img class="lazy" width="1223" height="678" src="<?php echo e(url('/')); ?>/resources/views/theme/img/cashfree1.png"  class="img-responsive">
            <img class="lazy" width="1223" height="678" src="<?php echo e(url('/')); ?>/resources/views/theme/img/cashfree2.png"  class="img-responsive">
        </div>
    </div>
  </div>
</div>
</body>

</html>
<?php /**PATH /home/catalogo/public_html/resources/views/admin/payment-settings.blade.php ENDPATH**/ ?>