{{-- TOASTS (Sin cambios) --}}
@if ($message = Session::get('success'))
<div class="toast-container toast-top-center">
    <div class="toast mb-3" id="cart-toast-success" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white"><i class="dwg-check-circle mr-2"></i>
            <h6 class="font-size-sm text-white mb-0 mr-auto">{{ __('Success') }}!</h6>
            <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body">{{ $message }}</div>
    </div>
</div>
@endif 

@if ($message = Session::get('error'))
<div class="toast-container toast-top-center">
    <div class="toast mb-3" id="cart-toast-error" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white"><i class="dwg-close-circle mr-2"></i>
            <h6 class="font-size-sm text-white mb-0 mr-auto">{{ __('Error') }}!</h6>
            <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body text-danger">{{ $message }}</div>
    </div>
</div>
@endif

@if (!$errors->isEmpty())
<div class="toast-container toast-top-center">
    <div class="toast mb-3" id="cart-toast-error" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white"><i class="dwg-close-circle mr-2"></i>
            <h6 class="font-size-sm text-white mb-0 mr-auto">{{ __('Error') }}!</h6>
            <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @foreach ($errors->all() as $error)
        <div class="toast-body text-danger">
            {{ $error }}
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- ESTILOS: Blanco, Negro y Azul + PWA Button --}}
<style>
    /* Fondo Blanco y Bordes */
    .footer-custom-color {
        background-color: #ffffff !important;
        border-top: 1px solid #eaeaea;
    }
    /* Títulos Negros */
    .footer-custom-color .widget-title {
        color: #000000 !important;
        font-weight: 700;
    }
    /* Enlaces Gris Oscuro */
    .footer-custom-color .widget-list-link,
    .footer-custom-color .dropdown-item {
        color: #4a4a4a !important;
    }
    /* Hover Azul */
    .footer-custom-color .widget-list-link:hover,
    .footer-custom-color .dropdown-item:hover {
        color: #007bff !important;
        text-decoration: none;
    }
    /* Detalles Azules */
    .footer-custom-color .text-primary {
        color: #007bff !important;
    }
    .footer-custom-color .text-light, 
    .footer-custom-color #mc-helper {
        color: #666666 !important;
    }
    /* Redes Sociales */
    .footer-custom-color .social-btn.sb-light {
        color: #4a4a4a !important;
        background-color: #f3f3f3 !important;
    }
    .footer-custom-color .social-btn.sb-light:hover {
        color: #ffffff !important;
        background-color: #007bff !important;
        box-shadow: 0 4px 10px rgba(0,123,255,0.3);
    }
    /* Input Newsletter */
    .footer-custom-color .input-group-overlay .form-control {
        background-color: #ffffff;
        border: 1px solid #ced4da;
        color: #333;
    }
    .footer-custom-color .input-group-text {
        background-color: #ffffff;
        border: 1px solid #ced4da;
        border-right: none;
        color: #007bff;
    }
    /* Barra Inferior Negra */
    .footer-bottom-dark {
        background-color: #000000 !important;
        color: #ffffff !important;
    }
    .footer-bottom-dark a {
        color: #dddddd !important;
    }
    .footer-bottom-dark a:hover {
        color: #ffffff !important;
    }
    .footer-bottom-dark .opacity-50 {
        opacity: 0.8 !important;
        color: #ffffff !important;
    }

    /* ESTILO BOTÓN PWA */
    #pwa-install-btn {
        display: none;
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        font-weight: 600;
        transition: all 0.3s;
    }
    #pwa-install-btn:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 12px rgba(0,123,255,0.4);
        transform: translateY(-2px);
    }
    .pwa-instruction {
        font-size: 0.85rem;
        color: #666;
        border: 1px dashed #ccc;
        padding: 10px;
        border-radius: 5px;
        display: none;
    }
</style>

{{-- INICIO DEL FOOTER --}}
<footer class="pt-5 footer-custom-color">
    <div @if($custom_settings->theme_layout == 'container') class="container-fluid pt-2 pb-3" @else class="container pt-2 pb-3" @endif>
        <div class="row">
            
            {{-- ==========================================================
                 COLUMNA 1: LOGO, INFO, REDES, PAGOS + PWA APP
                 (Movimos la App aquí para equilibrar la altura)
                 ========================================================== --}}
            <div class="col-md-4 text-center text-md-left mb-4">
                
                {{-- Logo --}}
                <div class="text-nowrap mb-3">
                    <a class="d-inline-block align-middle mt-n2 mr-2" href="{{ URL::to('/') }}">
                        @if($allsettings->site_logo != '')
                            <img class="d-block mx-auto mx-md-0" width="180" src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}"/>
                        @endif
                    </a>
                </div>

                {{-- Estadísticas --}}
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start mb-3">
                    @if($custom_settings->item_sold_display == 1)
                        <h6 class="mb-2 mb-md-0 mr-md-3">
                            <span class="text-primary font-weight-bold">@if($allsettings->item_sold_count == ""){{ $count_sold }}@else{{ $allsettings->item_sold_count }}@endif </span>
                            <span class="font-weight-normal text-dark">{{ __('Item Sold') }}</span>
                        </h6>
                    @endif
                    @if($custom_settings->members_count_display == 1)
                        <h6>
                            <span class="text-primary font-weight-bold">@if($allsettings->members_count == ""){{ $total_customer }}@else{{ $allsettings->members_count }}@endif </span>
                            <span class="font-weight-normal text-dark">{{ __('Members') }}</span>
                        </h6>
                    @endif
                </div>

                {{-- Redes Sociales --}}
                <div class="widget mt-4 text-md-nowrap text-center text-md-left">
                    @if($allsettings->facebook_url != '')
                        <a class="social-btn sb-light sb-facebook mr-2 mb-2" href="{{ $allsettings->facebook_url }}" target="_blank"><i class="dwg-facebook"></i></a>
                    @endif
                    @if($allsettings->twitter_url != '')
                        <a class="social-btn sb-light sb-twitter mr-2 mb-2" href="{{ $allsettings->twitter_url }}" target="_blank"><i class="dwg-twitter"></i></a>
                    @endif
                    @if($allsettings->pinterest_url != '')
                        <a class="social-btn sb-light sb-pinterest mr-2 mb-2" href="{{ $allsettings->pinterest_url }}" target="_blank"><i class="dwg-pinterest"></i></a>
                    @endif
                    @if($allsettings->gplus_url != '')
                        <a class="social-btn sb-light sb-dribbble mr-2 mb-2" href="{{ $allsettings->gplus_url }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                    @endif
                    @if($allsettings->instagram_url != '')
                        <a class="social-btn sb-light sb-behance mr-2 mb-2" href="{{ $allsettings->instagram_url }}" target="_blank"><i class="dwg-instagram"></i></a>
                    @endif
                </div>

                {{-- Métodos de Pago --}}
                @if(!empty($custom_settings->available_payment_methods))
                    <div class="mt-3 text-center text-md-left">
                        <img class="d-inline-block" width="187" src="{{ url('/') }}/public/storage/settings/{{ $custom_settings->available_payment_methods }}" alt="{{ $allsettings->site_title }}"/>
                    </div>
                @endif

                {{-- SECCIÓN PWA: "Instala nuestra App" (MOVIDA AQUÍ PARA LLENAR ESPACIO) --}}
                <div class="widget mt-4 pt-2">
                    <h3 class="widget-title pb-1">{{ __('Instala nuestra aplicación') }}</h3>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <p class="font-size-ms text-muted mb-3">
                            {{ __('Accede más rápido desde tu escritorio o móvil.') }}
                        </p>
                        {{-- Botón PWA --}}
                        <button id="pwa-install-btn" class="btn btn-primary btn-shadow btn-sm">
                            <i class="dwg-smartphone mr-2"></i> {{ __('Instalar Web App') }}
                        </button>
                        {{-- Mensaje iOS --}}
                        <div id="ios-instruction" class="pwa-instruction mt-2">
                           <i class="dwg-iphone"></i> En iOS: Presiona <strong>Compartir</strong> y selecciona <strong>"Agregar a Inicio"</strong>.
                        </div>
                    </div>
                </div>

            </div>

            {{-- ==========================================================
                 VISTA MÓVIL: DROPDOWNS
                 ========================================================== --}}
            <div class="col-12 d-md-none text-center mb-4 pb-2">
                <div class="btn-group dropdown d-block mx-auto mb-3">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">{{ __('Categories') }}</button>
                    <ul class="dropdown-menu">
                        @foreach($footer_menu['category'] as $menu)
                            <li><a class="dropdown-item" href="{{ URL::to('/shop/category') }}/{{ $menu->category_slug }}">{{ $menu->category_name }}</a></li> 
                        @endforeach
                    </ul>
                </div>
                <div class="btn-group dropdown d-block mx-auto">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">{{ __('More Info') }}</button>
                    <ul class="dropdown-menu">
                        @if($allsettings->site_blog_display == 1)
                            <li><a class="dropdown-item" href="{{ URL::to('/blog') }}">{{ __('Blog') }}</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ URL::to('/shop') }}">{{ __('Shop') }}</a></li>
                        <li><a class="dropdown-item" href="{{ URL::to('/my-favourite') }}">{{ __('My Favourite') }}</a></li>
                        <li><a class="dropdown-item" href="{{ URL::to('/my-purchases') }}">{{ __('My Purchases') }}</a></li>
                        <li><a class="dropdown-item" href="{{ URL::to('/contact') }}">{{ __('Contact') }}</a></li>
                    </ul>
                </div>
            </div>

            {{-- ==========================================================
                 VISTA DESKTOP: LISTAS CENTRALES
                 ========================================================== --}}
            <div class="col-md-2 d-none d-md-block text-center text-md-left mb-4">
                <div class="widget widget-links pb-2">
                    <h3 class="widget-title">{{ __('Categories') }}</h3>
                    <ul class="widget-list">
                        @foreach($footer_menu['category'] as $menu)
                            <li class="widget-list-item"><a class="widget-list-link" href="{{ URL::to('/shop/category') }}/{{ $menu->category_slug }}">{{ $menu->category_name }}</a></li> 
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-2 d-none d-md-block text-center text-md-left mb-4">
                <div class="widget widget-links pb-2">
                    <h3 class="widget-title">{{ __('More Info') }}</h3>
                    <ul class="widget-list">
                        @if($allsettings->site_blog_display == 1)
                            <li class="widget-list-item"><a class="widget-list-link" href="{{ URL::to('/blog') }}">{{ __('Blog') }}</a></li>
                        @endif
                        <li class="widget-list-item"><a class="widget-list-link" href="{{ URL::to('/shop') }}">{{ __('Shop') }}</a></li>
                        <li class="widget-list-item"><a class="widget-list-link" href="{{ URL::to('/my-favourite') }}">{{ __('My Favourite') }}</a></li>
                        <li class="widget-list-item"><a class="widget-list-link" href="{{ URL::to('/my-purchases') }}">{{ __('My Purchases') }}</a></li>
                        <li class="widget-list-item"><a class="widget-list-link" href="{{ URL::to('/contact') }}">{{ __('Contact') }}</a></li>
                    </ul>
                </div>
            </div>

            {{-- ==========================================================
                 COLUMNA 4: NEWSLETTER (SOLO BOLETIN, APP MOVIDA A COLUMNA 1)
                 ========================================================== --}}
            <div class="col-md-4 text-center text-md-left">
                @if($allsettings->site_newsletter_display == 1)
                <div class="widget pb-2 mb-4">
                    <h3 class="widget-title pb-1">{{ __('Newsletter') }}</h3>
                    <form class="validate" action="{{ route('newsletter') }}" method="post" name="mc-embedded-subscribe-form" id="footer_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="input-group input-group-overlay flex-nowrap">
                            <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-mail"></i></span></div>
                            <input class="form-control prepended-form-control" type="email" id="mce-EMAIL" value="" placeholder="{{ __('Enter your email address') }}" data-bvalidator="required" name="news_email">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="subscribe" id="mc-embedded-subscribe">{{ __('Subscribe') }}</button>
                            </div>
                        </div>

                        {{-- Recaptcha --}}
                        @if($allsettings->site_google_recaptcha == 1)
                            @if($custom_settings->google_captcha_version == 'v3')
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                    <div class="col-sm-12">
                                        {!! RecaptchaV3::field('register') !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block"><strong>{{ $errors->first('g-recaptcha-response') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="mt-2 d-flex justify-content-center justify-content-md-start">  
                                <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                    {!! app('captcha')->display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block"><strong class="red">{{ $errors->first('g-recaptcha-response') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endif  

                        <small class="form-text opacity-50" id="mc-helper">{{ __('Want more script,themes & templates? Subscribe to our mailing list to receive an update when new items arrive') }}!</small>
                        <div class="subscribe-status"></div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- BARRA INFERIOR --}}
    <div class="pt-4 footer-bottom-dark">
        <div @if($custom_settings->theme_layout == 'container') class="container-fluid" @else class="container" @endif>
            <div class="d-md-flex justify-content-between align-items-center">
                <div class="pb-4 font-size-xs opacity-50 text-center text-md-left">
                    <div>@php echo html_entity_decode($allsettings->site_copyright); @endphp {{ $allsettings->site_title }}</div>
                </div>
                <div class="widget widget-links pb-4">
<ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
    @foreach($footerpages['pages'] as $pages)
    <li class="widget-list-item ml-4">
        <a class="widget-list-link font-size-ms" href="{{ URL::to('/') }}/{{ $pages->page_slug }}">{{ $pages->page_title }}</a>
    </li>
    @endforeach
</ul>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- COOKIES & SCROLL TOP --}}
@if($allsettings->cookie_popup == 1)
<div class="alert text-center cookiealert" role="alert">
    {{ $allsettings->cookie_popup_text }}
    <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
        {{ $allsettings->cookie_popup_button }}
    </button>
</div>
@endif

<a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">{{ __('Top') }}</span><i class="btn-scroll-top-icon dwg-arrow-up"></i></a>

{{-- SCRIPT PWA --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let deferredPrompt;
        const installBtn = document.getElementById('pwa-install-btn');
        const iosMsg = document.getElementById('ios-instruction');
        const isIos = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

        if (isIos) {
            if(installBtn) installBtn.style.display = 'none';
            if(iosMsg) iosMsg.style.display = 'block';
        } else {
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;
                if(installBtn) installBtn.style.display = 'inline-flex';
            });
            if(installBtn) {
                installBtn.addEventListener('click', async () => {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        const { outcome } = await deferredPrompt.userChoice;
                        deferredPrompt = null;
                        if(outcome === 'accepted') {
                            installBtn.style.display = 'none';
                        }
                    }
                });
            }
        }
    });
</script>