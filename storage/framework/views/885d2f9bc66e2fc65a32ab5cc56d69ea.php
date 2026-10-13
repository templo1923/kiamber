<header class="bg-light box-shadow-sm navbar-sticky">
    
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
      <!-- Topbar-->
      <?php if($allsettings->site_header_top_bar == 1): ?>
      <div class="topbar topbar-dark bg-dark">
        <div <?php if($custom_settings->theme_layout == 'container'): ?> class="container-fluid" <?php else: ?> class="container" <?php endif; ?>>
          <div>
            <?php if($allsettings->site_google_translate == 1): ?>
<div class="topbar-text dropdown disable-autohide">
    
    <a class="topbar-link dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown">
        <?php $idioma_actual = App::getLocale(); ?>
        
        <?php if($idioma_actual == 'es'): ?>
            Español
        <?php elseif($idioma_actual == 'en'): ?>
            Inglés
        <?php elseif($idioma_actual == 'fr'): ?>
            Francés
        <?php elseif($idioma_actual == 'ar'): ?>
            Árabe
        <?php else: ?>
            <?php echo e($idioma_actual); ?>

        <?php endif; ?>
    </a>

    <ul class="dropdown-menu">
        <?php $__currentLoopData = $available_locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale_name => $available_locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <li>
            <a class="dropdown-item pb-1" href="<?php echo e(URL::to('/language')); ?>/<?php echo e($available_locale); ?>">
                <?php if($available_locale == 'es'): ?>
                    Español
                <?php elseif($available_locale == 'en'): ?>
                    Inglés
                <?php elseif($available_locale == 'fr'): ?>
                    Francés
                <?php elseif($available_locale == 'ar'): ?>
                    Árabe
                <?php else: ?>
                    <?php echo e($locale_name); ?>

                <?php endif; ?>
            </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
            <div class="topbar-text text-nowrap d-none d-md-inline-block border-left border-light pl-3 ml-3"></div>
            </div>
        <div class="topbar-text dropdown d-md-none ml-auto"><a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown"><?php if($custom_settings->verify_mode == 1): ?><?php echo e(__('Verify Purchase')); ?> / <?php endif; ?><?php echo e(__('Contact')); ?><?php if($allsettings->site_blog_display == 1): ?> / <?php echo e(__('Blog')); ?><?php endif; ?></a>
            <ul class="dropdown-menu dropdown-menu-right">
              <?php if($custom_settings->verify_mode == 1): ?>
              <li><a class="dropdown-item" href="<?php echo e(URL::to('/verify')); ?>"><i class="dwg-check text-muted mr-2"></i><?php echo e(__('Verify Purchase')); ?></a></li>
              <?php endif; ?>
              <li><a class="dropdown-item" href="<?php echo e(URL::to('/contact')); ?>"><i class="dwg-support text-muted mr-2"></i><?php echo e(__('Contact')); ?></a></li>
              <?php if($allsettings->site_blog_display == 1): ?>
              <li><a class="dropdown-item" href="<?php echo e(URL::to('/blog')); ?>"><i class="dwg-image text-muted mr-2"></i><?php echo e(__('Blog')); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="d-none d-md-block ml-3 text-nowrap">
          <?php if($custom_settings->verify_mode == 1): ?>
          <a class="topbar-link ml-3 pl-3 d-none d-md-inline-block" href="<?php echo e(URL::to('/verify')); ?>"><i class="dwg-check mt-n1"></i><?php echo e(__('Verify Purchase')); ?></a>
          <?php endif; ?> 
          <a class="topbar-link ml-3 pl-3 border-left border-light d-none d-md-inline-block" href="<?php echo e(URL::to('/contact')); ?>"><i class="dwg-support mt-n1"></i><?php echo e(__('Contact')); ?></a>
          <?php if($allsettings->site_blog_display == 1): ?>
          <a class="topbar-link ml-3 border-left border-light pl-3 d-none d-md-inline-block" href="<?php echo e(URL::to('/blog')); ?>"><i class="dwg-image mt-n1"></i><?php echo e(__('Blog')); ?></a>
          <?php endif; ?>
          </div>
         </div> 
      </div>
      <?php endif; ?>
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <div class="navbar-sticky">
        <div class="navbar navbar-expand-lg navbar-light bg-light">
          <div <?php if($custom_settings->theme_layout == 'container'): ?> class="container-fluid" <?php else: ?> class="container" <?php endif; ?>>
          <?php if($allsettings->site_logo != ''): ?>
          <a class="navbar-brand d-none d-sm-block mr-4 order-lg-1" href="<?php echo e(URL::to('/')); ?>" style="min-width: 7rem;">
             <img width="200" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="<?php echo e($allsettings->site_title); ?>"/>
          </a>
          <?php endif; ?>
          <?php if($allsettings->site_favicon != ''): ?>
          <a class="navbar-brand d-sm-none mr-2 order-lg-1" href="<?php echo e(URL::to('/')); ?>" style="min-width: 4.625rem;">
             <img width="120" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="<?php echo e($allsettings->site_title); ?>"/>
          </a>
          <?php endif; ?>
            <div class="navbar-toolbar d-flex align-items-center order-lg-3">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool d-none d-lg-flex" href="#searchBox" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip"><?php echo e(__('Search')); ?></span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-search"></i></div></a>
                <?php if(Auth::guest()): ?>
                <a class="navbar-tool d-none d-lg-flex" href="<?php echo e(url('/my-favourite')); ?>"><span class="navbar-tool-tooltip"><?php echo e(__('Favourites')); ?></span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-heart"></i></div></a>
                <a class="navbar-tool ml-1 mr-n1" href="<?php echo e(URL::to('/login')); ?>"><span class="navbar-tool-tooltip"><?php echo e(__('Account')); ?></span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-user"></i></div></a>
                <?php endif; ?>
                <?php if(Auth::check()): ?>
                <?php if(Auth::user()->id != 1): ?>
                <a class="navbar-tool d-none d-lg-flex" href="<?php echo e(url('/my-favourite')); ?>"><span class="navbar-tool-tooltip"><?php echo e(__('Favourites')); ?></span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-heart"></i></div></a>
                <?php endif; ?>
                <div class="navbar-tool dropdown ml-2">
                <a class="navbar-tool-icon-box border dropdown-toggle" <?php if(Auth::user()->id == 1): ?> href="<?php echo e(url('/admin')); ?>" target="_blank" <?php else: ?> href="<?php echo e(url('/my-profile')); ?>" <?php endif; ?>>         <?php if(!empty(Auth::user()->user_photo)): ?>
                <img width="32" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e(Auth::user()->user_photo); ?>" alt="<?php echo e(Auth::user()->name); ?>"/>
                <?php else: ?>
                <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e(Auth::user()->name); ?>">
                <?php endif; ?>
                </a>
                <a class="navbar-tool-text ml-n1" <?php if(Auth::user()->id == 1): ?> href="<?php echo e(url('/admin')); ?>" target="_blank" <?php else: ?> href="<?php echo e(url('/my-profile')); ?>" <?php endif; ?>>
                <small><?php echo e(Auth::user()->name); ?></small><?php echo e($allsettings->site_currency_symbol); ?><?php echo e(Auth::user()->earnings); ?>

                </a>
                <div class="dropdown-menu dropdown-menu-right" style="min-width: 14rem;">
                <?php if(!empty(Auth::user()->google2fa_secret) && (Auth::user()->google2fa_access == "yes")): ?>
                <?php if(Auth::user()->id != 1): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/my-profile')); ?>"><i class="dwg-settings opacity-60 mr-2"></i><?php echo e(__('My Profile')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/my-purchases')); ?>"><i class="dwg-basket opacity-60 mr-2"></i><?php echo e(__('My Purchases')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/my-favourite')); ?>"><i class="dwg-heart opacity-60 mr-2"></i><?php echo e(__('My Favourite')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(URL::to('/redeem-voucher')); ?>"><i class="dwg-gift opacity-60 mr-2"></i><?php echo e(__('Redeem Voucher')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(URL::to('/my-referral')); ?>"><i class="dwg-share opacity-60 mr-2"></i><?php echo e(__('My Referral')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(URL::to('/my-tickets')); ?>"><i class="fa fa-ticket opacity-60 mr-2"></i><?php echo e(__('Support Tickets')); ?></a>
                <?php if($allsettings->site_withdrawal_display == 1): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/withdrawal')); ?>"><i class="dwg-currency-exchange opacity-60 mr-2"></i><?php echo e(__('Withdrawal')); ?></a>
                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(empty(Auth::user()->google2fa_secret)): ?>
                <?php if(Auth::user()->id != 1): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/my-profile')); ?>"><i class="dwg-settings opacity-60 mr-2"></i><?php echo e(__('My Profile')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/my-purchases')); ?>"><i class="dwg-basket opacity-60 mr-2"></i><?php echo e(__('My Purchases')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/my-favourite')); ?>"><i class="dwg-heart opacity-60 mr-2"></i><?php echo e(__('My Favourite')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(URL::to('/redeem-voucher')); ?>"><i class="dwg-gift opacity-60 mr-2"></i><?php echo e(__('Redeem Voucher')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(URL::to('/my-referral')); ?>"><i class="dwg-share opacity-60 mr-2"></i><?php echo e(__('My Referral')); ?></a>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(URL::to('/my-tickets')); ?>"><i class="fa fa-ticket opacity-60 mr-2"></i><?php echo e(__('Support Tickets')); ?></a>
                <?php if($allsettings->site_withdrawal_display == 1): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/withdrawal')); ?>"><i class="dwg-currency-exchange opacity-60 mr-2"></i><?php echo e(__('Withdrawal')); ?></a>
                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(Auth::user()->id == 1): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/admin')); ?>"><i class="dwg-settings opacity-60 mr-2"></i><?php echo e(__('Admin Panel')); ?></a>
                <?php endif; ?>
                <?php if($custom_settings->google2fa_option == 1): ?>
                <?php if(Auth::user()->google2fa_secret): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(URL::to('/disable')); ?>"><i class="fa fa-ban opacity-60 mr-2"></i><?php echo e(__('Disable 2FA')); ?></a>
                <?php else: ?>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(URL::to('/setup')); ?>"><i class="dwg-check opacity-60 mr-2"></i><?php echo e(__('Enable 2FA')); ?></a>
                <?php endif; ?>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(url('/logout')); ?>"><i class="dwg-sign-out opacity-60 mr-2"></i><?php echo e(__('Logout')); ?></a>
                
              </div>
              </div>
              <?php endif; ?>
              <div class="navbar-tool dropdown ml-3"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="<?php echo e(url('/cart')); ?>"><span class="navbar-tool-label"><?php echo e($cartcount); ?></span><i class="navbar-tool-icon dwg-cart"></i></a>
                <!-- Cart dropdown-->
                <?php if($cartcount != 0): ?>
                <div class="dropdown-menu dropdown-menu-right" style="width: 20rem;">
                  <div class="widget widget-cart px-3 pt-2 pb-3">
                    <div data-simplebar data-simplebar-auto-hide="false">
                      <?php $subtotall = 0; ?>
                      <?php $__currentLoopData = $cartitem['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="widget-cart-item pb-2 mb-2 border-bottom">
                        <a href="<?php echo e(url('/cart')); ?>/<?php echo e(base64_encode($cart->ord_id)); ?>" class="close text-danger" onClick="return confirm('<?php echo e(__('Are you sure you want to delete?')); ?>');"><span aria-hidden="true">&times;</span></a>
                        <div class="media align-items-center"><a class="d-block mr-2" href="<?php echo e(url('/item')); ?>/<?php echo e($cart->product_slug); ?>">
                        <?php if($cart->product_image!=''): ?>
                        <img width="64" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($cart->product_image); ?>" alt="<?php echo e($cart->product_name); ?>"/>
                        <?php else: ?>
                        <img width="64" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($cart->product_name); ?>"/>
                        <?php endif; ?>
                        </a>
                          <div class="media-body">
                            <h6 class="widget-product-title cart-product-title"><a href="<?php echo e(url('/item')); ?>/<?php echo e($cart->product_slug); ?>"><?php echo e($cart->product_name); ?></a></h6>
                            <div class="widget-product-meta"><span class="text-accent mr-2"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($cart->total_price); ?></span></div>
                          </div>
                        </div>
                      </div>
                      <?php $subtotall += $cart->total_price; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
                    <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                      <div class="font-size-sm mr-2 py-2"><span class="text-muted"><?php echo e(__('Subtotal')); ?></span><span class="text-accent font-size-base ml-1"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($subtotall); ?></span></div><a class="btn btn-outline-secondary btn-sm" href="<?php echo e(url('/cart')); ?>"><?php echo e(__('View Cart')); ?><i class="dwg-arrow-right ml-1 mr-n1"></i></a></div><a class="btn btn-primary btn-sm btn-block" href="<?php echo e(url('/checkout')); ?>"><i class="dwg-card mr-2 font-size-base align-middle"></i><?php echo e(__('Checkout')); ?></a>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="collapse navbar-collapse mr-auto order-lg-2" id="navbarCollapse">
              <!-- Search-->
              <div class="input-group-overlay d-lg-none my-3">
                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
                <form action="<?php echo e(route('shop')); ?>" id="search_form1" method="post"  enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input class="form-control prepended-form-control" type="text" name="product_item" placeholder="<?php echo e(__('Search your products...')); ?>">
                </form>
              </div>
              <!-- Primary menu-->
              <ul class="navbar-nav">
                <?php if($demo_mode == 'on'): ?>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="<?php echo e(URL::to('/')); ?>"><?php echo e(__('Home')); ?></a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/layout/container')); ?>"><?php echo e(__('Full Width Layout')); ?></a></li>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/layout/boxed')); ?>"><?php echo e(__('Boxed Layout')); ?></a></li>
                  </ul>
                </li>
                <?php else: ?>
                <li class="nav-item dropdown"><a class="nav-link" href="<?php echo e(URL::to('/')); ?>"><?php echo e(__('Home')); ?></a>
                </li>
                <?php endif; ?>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="<?php echo e(URL::to('/shop')); ?>"><?php echo e(__('Shop')); ?></a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/featured-items')); ?>"><?php echo e(__('Featured Items')); ?></a></li>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/free-items')); ?>"><?php echo e(__('Free Items')); ?></a></li>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/new-releases')); ?>"><?php echo e(__('New Releases')); ?></a></li>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/popular-items')); ?>"><?php echo e(__('Popular Items')); ?></a></li>
                    <?php if($allsettings->subscription_mode == 1): ?>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/subscriber-downloads')); ?>"><?php echo e(__('Subscriber Downloads')); ?></a></li>
                    <?php endif; ?>
                  </ul>
                </li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"><?php echo e(__('Categories')); ?></a>
    <ul class="dropdown-menu">
        <?php
            // CONSULTA DIRECTA A LA BASE DE DATOS PARA FORZAR QUE APAREZCAN
            $direct_categories = \DB::table('category')
                                ->where('drop_status', 'no')
                                ->where('category_status', 1)
                                ->orderBy('category_name', 'asc')
                                ->get();
        ?>

        <?php $__currentLoopData = $direct_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="dropdown-item" href="<?php echo e(URL::to('/shop/category')); ?>/<?php echo e($cat->category_slug); ?>">
                    <?php echo e($cat->category_name); ?>

                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li>
<?php /*?><li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">{{ __('Categories') }}</a>
                  <ul class="dropdown-menu">
                    @foreach($main_menu['category'] as $menu) 
                    <li><a class="dropdown-item" href="{{ URL::to('/shop/category') }}/{{ $menu->category_slug }}">{{ $menu->category_name }}</a></li>
                    @endforeach
                  </ul>
                </li><?php */?>
                <?php if($mainmenu_count != 0): ?>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"><?php echo e(__('Pages')); ?></a>
                  <ul class="dropdown-menu">
                    <?php $__currentLoopData = $allpages['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/')); ?>/<?php echo e($pages->page_slug); ?>"><?php echo e($pages->page_title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </li>
                <?php endif; ?>
                <?php if($allsettings->subscription_mode == 1): ?>
                <li class="nav-item dropdown"><a class="nav-link" href="<?php echo e(url('/subscription')); ?>"><?php echo e(__('Subscription')); ?></a></li>
                <?php endif; ?>
                <li class="nav-item dropdown"><a class="nav-link" href="<?php echo e(URL::to('/sale')); ?>"><?php echo e(__('Flash Sale')); ?></a></li>
                <?php if($allsettings->product_updates_tabs == 1): ?>
                <li class="nav-item dropdown"><a class="nav-link red-color" href="<?php echo e(URL::to('/updates')); ?>"><?php echo e(__('Updates')); ?></a></li>
                <?php endif; ?>
                <?php if($demo_mode == 'on'): ?>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"><?php echo e(__('Price Option')); ?>?</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/price-option')); ?>/<?php echo e($encrypter->encrypt(1)); ?>"><?php echo e(__('License Price')); ?></a></li>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/price-option')); ?>/<?php echo e($encrypter->encrypt(0)); ?>"><?php echo e(__('Single Price')); ?></a></li>
                  </ul>
                </li>
                <?php endif; ?>
               </ul>
            </div>
          </div>
        </div>
        <!-- Search collapse-->
        <div class="search-box collapse" id="searchBox">
          <div class="card pt-2 pb-4 border-0 rounded-0">
            <div <?php if($custom_settings->theme_layout == 'container'): ?> class="container-fluid" <?php else: ?> class="container" <?php endif; ?>>
              <div class="input-group-overlay">
                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
                <form action="<?php echo e(route('shop')); ?>" id="search_form2" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input class="form-control prepended-form-control" type="text" name="product_item" id="product_item_top" placeholder="<?php echo e(__('Search your products')); ?>...">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header><?php /**PATH /home/catalogo/public_html/resources/views/header.blade.php ENDPATH**/ ?>