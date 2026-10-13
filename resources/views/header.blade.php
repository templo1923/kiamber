<header class="bg-light box-shadow-sm navbar-sticky">
    
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
      <!-- Topbar-->
      @if($allsettings->site_header_top_bar == 1)
      <div class="topbar topbar-dark bg-dark">
        <div @if($custom_settings->theme_layout == 'container') class="container-fluid" @else class="container" @endif>
          <div>
            @if($allsettings->site_google_translate == 1)
<div class="topbar-text dropdown disable-autohide">
    
    <a class="topbar-link dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown">
        @php $idioma_actual = App::getLocale(); @endphp
        
        @if($idioma_actual == 'es')
            Español
        @elseif($idioma_actual == 'en')
            Inglés
        @elseif($idioma_actual == 'fr')
            Francés
        @elseif($idioma_actual == 'ar')
            Árabe
        @else
            {{ $idioma_actual }}
        @endif
    </a>

    <ul class="dropdown-menu">
        @foreach($available_locales as $locale_name => $available_locale) 
        <li>
            <a class="dropdown-item pb-1" href="{{ URL::to('/language') }}/{{ $available_locale }}">
                @if($available_locale == 'es')
                    Español
                @elseif($available_locale == 'en')
                    Inglés
                @elseif($available_locale == 'fr')
                    Francés
                @elseif($available_locale == 'ar')
                    Árabe
                @else
                    {{ $locale_name }}
                @endif
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endif
            <div class="topbar-text text-nowrap d-none d-md-inline-block border-left border-light pl-3 ml-3"></div>
            </div>
        <div class="topbar-text dropdown d-md-none ml-auto"><a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">@if($custom_settings->verify_mode == 1){{ __('Verify Purchase') }} / @endif{{ __('Contact') }}@if($allsettings->site_blog_display == 1) / {{ __('Blog') }}@endif</a>
            <ul class="dropdown-menu dropdown-menu-right">
              @if($custom_settings->verify_mode == 1)
              <li><a class="dropdown-item" href="{{ URL::to('/verify') }}"><i class="dwg-check text-muted mr-2"></i>{{ __('Verify Purchase') }}</a></li>
              @endif
              <li><a class="dropdown-item" href="{{ URL::to('/contact') }}"><i class="dwg-support text-muted mr-2"></i>{{ __('Contact') }}</a></li>
              @if($allsettings->site_blog_display == 1)
              <li><a class="dropdown-item" href="{{ URL::to('/blog') }}"><i class="dwg-image text-muted mr-2"></i>{{ __('Blog') }}</a></li>
              @endif
            </ul>
          </div>
          <div class="d-none d-md-block ml-3 text-nowrap">
          @if($custom_settings->verify_mode == 1)
          <a class="topbar-link ml-3 pl-3 d-none d-md-inline-block" href="{{ URL::to('/verify') }}"><i class="dwg-check mt-n1"></i>{{ __('Verify Purchase') }}</a>
          @endif 
          <a class="topbar-link ml-3 pl-3 border-left border-light d-none d-md-inline-block" href="{{ URL::to('/contact') }}"><i class="dwg-support mt-n1"></i>{{ __('Contact') }}</a>
          @if($allsettings->site_blog_display == 1)
          <a class="topbar-link ml-3 border-left border-light pl-3 d-none d-md-inline-block" href="{{ URL::to('/blog') }}"><i class="dwg-image mt-n1"></i>{{ __('Blog') }}</a>
          @endif
          </div>
         </div> 
      </div>
      @endif
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <div class="navbar-sticky">
        <div class="navbar navbar-expand-lg navbar-light bg-light">
          <div @if($custom_settings->theme_layout == 'container') class="container-fluid" @else class="container" @endif>
          @if($allsettings->site_logo != '')
          <a class="navbar-brand d-none d-sm-block mr-4 order-lg-1" href="{{ URL::to('/') }}" style="min-width: 7rem;">
             <img width="200" src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}"/>
          </a>
          @endif
          @if($allsettings->site_favicon != '')
          <a class="navbar-brand d-sm-none mr-2 order-lg-1" href="{{ URL::to('/') }}" style="min-width: 4.625rem;">
             <img width="120" src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}"/>
          </a>
          @endif
            <div class="navbar-toolbar d-flex align-items-center order-lg-3">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool d-none d-lg-flex" href="#searchBox" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">{{ __('Search') }}</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-search"></i></div></a>
                @if(Auth::guest())
                <a class="navbar-tool d-none d-lg-flex" href="{{ url('/my-favourite') }}"><span class="navbar-tool-tooltip">{{ __('Favourites') }}</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-heart"></i></div></a>
                <a class="navbar-tool ml-1 mr-n1" href="{{ URL::to('/login') }}"><span class="navbar-tool-tooltip">{{ __('Account') }}</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-user"></i></div></a>
                @endif
                @if (Auth::check())
                @if(Auth::user()->id != 1)
                <a class="navbar-tool d-none d-lg-flex" href="{{ url('/my-favourite') }}"><span class="navbar-tool-tooltip">{{ __('Favourites') }}</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon dwg-heart"></i></div></a>
                @endif
                <div class="navbar-tool dropdown ml-2">
                <a class="navbar-tool-icon-box border dropdown-toggle" @if(Auth::user()->id == 1) href="{{ url('/admin') }}" target="_blank" @else href="{{ url('/my-profile') }}" @endif>         @if(!empty(Auth::user()->user_photo))
                <img width="32" src="{{ url('/') }}/public/storage/users/{{ Auth::user()->user_photo }}" alt="{{ Auth::user()->name }}"/>
                @else
                <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ Auth::user()->name }}">
                @endif
                </a>
                <a class="navbar-tool-text ml-n1" @if(Auth::user()->id == 1) href="{{ url('/admin') }}" target="_blank" @else href="{{ url('/my-profile') }}" @endif>
                <small>{{ Auth::user()->name }}</small>{{ $allsettings->site_currency_symbol }}{{ Auth::user()->earnings }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="min-width: 14rem;">
                @if(!empty(Auth::user()->google2fa_secret) && (Auth::user()->google2fa_access == "yes"))
                @if(Auth::user()->id != 1)
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/my-profile') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ __('My Profile') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/my-purchases') }}"><i class="dwg-basket opacity-60 mr-2"></i>{{ __('My Purchases') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/my-favourite') }}"><i class="dwg-heart opacity-60 mr-2"></i>{{ __('My Favourite') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/redeem-voucher') }}"><i class="dwg-gift opacity-60 mr-2"></i>{{ __('Redeem Voucher') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/my-referral') }}"><i class="dwg-share opacity-60 mr-2"></i>{{ __('My Referral') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/my-tickets') }}"><i class="fa fa-ticket opacity-60 mr-2"></i>{{ __('Support Tickets') }}</a>
                @if($allsettings->site_withdrawal_display == 1)
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/withdrawal') }}"><i class="dwg-currency-exchange opacity-60 mr-2"></i>{{ __('Withdrawal') }}</a>
                @endif
                @endif
                @endif
                @if(empty(Auth::user()->google2fa_secret))
                @if(Auth::user()->id != 1)
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/my-profile') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ __('My Profile') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/my-purchases') }}"><i class="dwg-basket opacity-60 mr-2"></i>{{ __('My Purchases') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/my-favourite') }}"><i class="dwg-heart opacity-60 mr-2"></i>{{ __('My Favourite') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/redeem-voucher') }}"><i class="dwg-gift opacity-60 mr-2"></i>{{ __('Redeem Voucher') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/my-referral') }}"><i class="dwg-share opacity-60 mr-2"></i>{{ __('My Referral') }}</a>
                <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/my-tickets') }}"><i class="fa fa-ticket opacity-60 mr-2"></i>{{ __('Support Tickets') }}</a>
                @if($allsettings->site_withdrawal_display == 1)
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/withdrawal') }}"><i class="dwg-currency-exchange opacity-60 mr-2"></i>{{ __('Withdrawal') }}</a>
                @endif
                @endif
                @endif
                @if(Auth::user()->id == 1)
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/admin') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ __('Admin Panel') }}</a>
                @endif
                @if($custom_settings->google2fa_option == 1)
                @if (Auth::user()->google2fa_secret)
                <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/disable') }}"><i class="fa fa-ban opacity-60 mr-2"></i>{{ __('Disable 2FA') }}</a>
                @else
                <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('/setup') }}"><i class="dwg-check opacity-60 mr-2"></i>{{ __('Enable 2FA') }}</a>
                @endif
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/logout') }}"><i class="dwg-sign-out opacity-60 mr-2"></i>{{ __('Logout') }}</a>
                
              </div>
              </div>
              @endif
              <div class="navbar-tool dropdown ml-3"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{ url('/cart') }}"><span class="navbar-tool-label">{{ $cartcount }}</span><i class="navbar-tool-icon dwg-cart"></i></a>
                <!-- Cart dropdown-->
                @if($cartcount != 0)
                <div class="dropdown-menu dropdown-menu-right" style="width: 20rem;">
                  <div class="widget widget-cart px-3 pt-2 pb-3">
                    <div data-simplebar data-simplebar-auto-hide="false">
                      @php $subtotall = 0; @endphp
                      @foreach($cartitem['item'] as $cart)
                      <div class="widget-cart-item pb-2 mb-2 border-bottom">
                        <a href="{{ url('/cart') }}/{{ base64_encode($cart->ord_id) }}" class="close text-danger" onClick="return confirm('{{ __('Are you sure you want to delete?') }}');"><span aria-hidden="true">&times;</span></a>
                        <div class="media align-items-center"><a class="d-block mr-2" href="{{ url('/item') }}/{{ $cart->product_slug }}">
                        @if($cart->product_image!='')
                        <img width="64" src="{{ url('/') }}/public/storage/product/{{ $cart->product_image }}" alt="{{ $cart->product_name }}"/>
                        @else
                        <img width="64" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $cart->product_name }}"/>
                        @endif
                        </a>
                          <div class="media-body">
                            <h6 class="widget-product-title cart-product-title"><a href="{{ url('/item') }}/{{ $cart->product_slug }}">{{ $cart->product_name }}</a></h6>
                            <div class="widget-product-meta"><span class="text-accent mr-2">{{ $allsettings->site_currency_symbol }} {{ $cart->total_price }}</span></div>
                          </div>
                        </div>
                      </div>
                      @php $subtotall += $cart->total_price; @endphp
                      @endforeach
                     </div>
                    <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                      <div class="font-size-sm mr-2 py-2"><span class="text-muted">{{ __('Subtotal') }}</span><span class="text-accent font-size-base ml-1">{{ $allsettings->site_currency_symbol }} {{ $subtotall }}</span></div><a class="btn btn-outline-secondary btn-sm" href="{{ url('/cart') }}">{{ __('View Cart') }}<i class="dwg-arrow-right ml-1 mr-n1"></i></a></div><a class="btn btn-primary btn-sm btn-block" href="{{ url('/checkout') }}"><i class="dwg-card mr-2 font-size-base align-middle"></i>{{ __('Checkout') }}</a>
                  </div>
                </div>
                @endif
              </div>
            </div>
            <div class="collapse navbar-collapse mr-auto order-lg-2" id="navbarCollapse">
              <!-- Search-->
              <div class="input-group-overlay d-lg-none my-3">
                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
                <form action="{{ route('shop') }}" id="search_form1" method="post"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input class="form-control prepended-form-control" type="text" name="product_item" placeholder="{{ __('Search your products...') }}">
                </form>
              </div>
              <!-- Primary menu-->
              <ul class="navbar-nav">
                @if($demo_mode == 'on')
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="{{ URL::to('/') }}">{{ __('Home') }}</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ URL::to('/layout/container') }}">{{ __('Full Width Layout') }}</a></li>
                    <li><a class="dropdown-item" href="{{ URL::to('/layout/boxed') }}">{{ __('Boxed Layout') }}</a></li>
                  </ul>
                </li>
                @else
                <li class="nav-item dropdown"><a class="nav-link" href="{{ URL::to('/') }}">{{ __('Home') }}</a>
                </li>
                @endif
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="{{ URL::to('/shop') }}">{{ __('Shop') }}</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ URL::to('/featured-items') }}">{{ __('Featured Items') }}</a></li>
                    <li><a class="dropdown-item" href="{{ URL::to('/free-items') }}">{{ __('Free Items') }}</a></li>
                    <li><a class="dropdown-item" href="{{ URL::to('/new-releases') }}">{{ __('New Releases') }}</a></li>
                    <li><a class="dropdown-item" href="{{ URL::to('/popular-items') }}">{{ __('Popular Items') }}</a></li>
                    @if($allsettings->subscription_mode == 1)
                    <li><a class="dropdown-item" href="{{ URL::to('/subscriber-downloads') }}">{{ __('Subscriber Downloads') }}</a></li>
                    @endif
                  </ul>
                </li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">{{ __('Categories') }}</a>
    <ul class="dropdown-menu">
        @php
            // CONSULTA DIRECTA A LA BASE DE DATOS PARA FORZAR QUE APAREZCAN
            $direct_categories = \DB::table('category')
                                ->where('drop_status', 'no')
                                ->where('category_status', 1)
                                ->orderBy('category_name', 'asc')
                                ->get();
        @endphp

        @foreach($direct_categories as $cat)
            <li>
                <a class="dropdown-item" href="{{ URL::to('/shop/category') }}/{{ $cat->category_slug }}">
                    {{ $cat->category_name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>
<?php /*?><li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">{{ __('Categories') }}</a>
                  <ul class="dropdown-menu">
                    @foreach($main_menu['category'] as $menu) 
                    <li><a class="dropdown-item" href="{{ URL::to('/shop/category') }}/{{ $menu->category_slug }}">{{ $menu->category_name }}</a></li>
                    @endforeach
                  </ul>
                </li><?php */?>
                @if($mainmenu_count != 0)
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">{{ __('Pages') }}</a>
                  <ul class="dropdown-menu">
                    @foreach($allpages['pages'] as $pages)
                    <li><a class="dropdown-item" href="{{ URL::to('/') }}/{{ $pages->page_slug }}">{{ $pages->page_title }}</a></li>
                    @endforeach
                  </ul>
                </li>
                @endif
                @if($allsettings->subscription_mode == 1)
                <li class="nav-item dropdown"><a class="nav-link" href="{{ url('/subscription') }}">{{ __('Subscription') }}</a></li>
                @endif
                <li class="nav-item dropdown"><a class="nav-link" href="{{ URL::to('/sale') }}">{{ __('Flash Sale') }}</a></li>
                @if($allsettings->product_updates_tabs == 1)
                <li class="nav-item dropdown"><a class="nav-link red-color" href="{{ URL::to('/updates') }}">{{ __('Updates') }}</a></li>
                @endif
                @if($demo_mode == 'on')
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">{{ __('Price Option') }}?</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ URL::to('/price-option') }}/{{ $encrypter->encrypt(1) }}">{{ __('License Price') }}</a></li>
                    <li><a class="dropdown-item" href="{{ URL::to('/price-option') }}/{{ $encrypter->encrypt(0) }}">{{ __('Single Price') }}</a></li>
                  </ul>
                </li>
                @endif
               </ul>
            </div>
          </div>
        </div>
        <!-- Search collapse-->
        <div class="search-box collapse" id="searchBox">
          <div class="card pt-2 pb-4 border-0 rounded-0">
            <div @if($custom_settings->theme_layout == 'container') class="container-fluid" @else class="container" @endif>
              <div class="input-group-overlay">
                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-search"></i></span></div>
                <form action="{{ route('shop') }}" id="search_form2" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input class="form-control prepended-form-control" type="text" name="product_item" id="product_item_top" placeholder="{{ __('Search your products') }}...">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>