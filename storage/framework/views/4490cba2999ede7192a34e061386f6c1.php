
<?php if($message = Session::get('success')): ?>
<div class="toast-container toast-top-center">
    <div class="toast mb-3" id="cart-toast-success" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white"><i class="dwg-check-circle mr-2"></i>
            <h6 class="font-size-sm text-white mb-0 mr-auto"><?php echo e(__('Success')); ?>!</h6>
            <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body"><?php echo e($message); ?></div>
    </div>
</div>
<?php endif; ?> 

<?php if($message = Session::get('error')): ?>
<div class="toast-container toast-top-center">
    <div class="toast mb-3" id="cart-toast-error" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white"><i class="dwg-close-circle mr-2"></i>
            <h6 class="font-size-sm text-white mb-0 mr-auto"><?php echo e(__('Error')); ?>!</h6>
            <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body text-danger"><?php echo e($message); ?></div>
    </div>
</div>
<?php endif; ?>

<?php if(!$errors->isEmpty()): ?>
<div class="toast-container toast-top-center">
    <div class="toast mb-3" id="cart-toast-error" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white"><i class="dwg-close-circle mr-2"></i>
            <h6 class="font-size-sm text-white mb-0 mr-auto"><?php echo e(__('Error')); ?>!</h6>
            <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="toast-body text-danger">
            <?php echo e($error); ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>


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


<footer class="pt-5 footer-custom-color">
    <div <?php if($custom_settings->theme_layout == 'container'): ?> class="container-fluid pt-2 pb-3" <?php else: ?> class="container pt-2 pb-3" <?php endif; ?>>
        <div class="row">
            
            
            <div class="col-md-4 text-center text-md-left mb-4">
                
                
                <div class="text-nowrap mb-3">
                    <a class="d-inline-block align-middle mt-n2 mr-2" href="<?php echo e(URL::to('/')); ?>">
                        <?php if($allsettings->site_logo != ''): ?>
                            <img class="d-block mx-auto mx-md-0" width="180" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="<?php echo e($allsettings->site_title); ?>"/>
                        <?php endif; ?>
                    </a>
                </div>

                
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start mb-3">
                    <?php if($custom_settings->item_sold_display == 1): ?>
                        <h6 class="mb-2 mb-md-0 mr-md-3">
                            <span class="text-primary font-weight-bold"><?php if($allsettings->item_sold_count == ""): ?><?php echo e($count_sold); ?><?php else: ?><?php echo e($allsettings->item_sold_count); ?><?php endif; ?> </span>
                            <span class="font-weight-normal text-dark"><?php echo e(__('Item Sold')); ?></span>
                        </h6>
                    <?php endif; ?>
                    <?php if($custom_settings->members_count_display == 1): ?>
                        <h6>
                            <span class="text-primary font-weight-bold"><?php if($allsettings->members_count == ""): ?><?php echo e($total_customer); ?><?php else: ?><?php echo e($allsettings->members_count); ?><?php endif; ?> </span>
                            <span class="font-weight-normal text-dark"><?php echo e(__('Members')); ?></span>
                        </h6>
                    <?php endif; ?>
                </div>

                
                <div class="widget mt-4 text-md-nowrap text-center text-md-left">
                    <?php if($allsettings->facebook_url != ''): ?>
                        <a class="social-btn sb-light sb-facebook mr-2 mb-2" href="<?php echo e($allsettings->facebook_url); ?>" target="_blank"><i class="dwg-facebook"></i></a>
                    <?php endif; ?>
                    <?php if($allsettings->twitter_url != ''): ?>
                        <a class="social-btn sb-light sb-twitter mr-2 mb-2" href="<?php echo e($allsettings->twitter_url); ?>" target="_blank"><i class="dwg-twitter"></i></a>
                    <?php endif; ?>
                    <?php if($allsettings->pinterest_url != ''): ?>
                        <a class="social-btn sb-light sb-pinterest mr-2 mb-2" href="<?php echo e($allsettings->pinterest_url); ?>" target="_blank"><i class="dwg-pinterest"></i></a>
                    <?php endif; ?>
                    <?php if($allsettings->gplus_url != ''): ?>
                        <a class="social-btn sb-light sb-dribbble mr-2 mb-2" href="<?php echo e($allsettings->gplus_url); ?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
                    <?php endif; ?>
                    <?php if($allsettings->instagram_url != ''): ?>
                        <a class="social-btn sb-light sb-behance mr-2 mb-2" href="<?php echo e($allsettings->instagram_url); ?>" target="_blank"><i class="dwg-instagram"></i></a>
                    <?php endif; ?>
                </div>

                
                <?php if(!empty($custom_settings->available_payment_methods)): ?>
                    <div class="mt-3 text-center text-md-left">
                        <img class="d-inline-block" width="187" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($custom_settings->available_payment_methods); ?>" alt="<?php echo e($allsettings->site_title); ?>"/>
                    </div>
                <?php endif; ?>

                
                <div class="widget mt-4 pt-2">
                    <h3 class="widget-title pb-1"><?php echo e(__('Instala nuestra aplicación')); ?></h3>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <p class="font-size-ms text-muted mb-3">
                            <?php echo e(__('Accede más rápido desde tu escritorio o móvil.')); ?>

                        </p>
                        
                        <button id="pwa-install-btn" class="btn btn-primary btn-shadow btn-sm">
                            <i class="dwg-smartphone mr-2"></i> <?php echo e(__('Instalar Web App')); ?>

                        </button>
                        
                        <div id="ios-instruction" class="pwa-instruction mt-2">
                           <i class="dwg-iphone"></i> En iOS: Presiona <strong>Compartir</strong> y selecciona <strong>"Agregar a Inicio"</strong>.
                        </div>
                    </div>
                </div>

            </div>

            
            <div class="col-12 d-md-none text-center mb-4 pb-2">
                <div class="btn-group dropdown d-block mx-auto mb-3">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo e(__('Categories')); ?></button>
                    <ul class="dropdown-menu">
                        <?php $__currentLoopData = $footer_menu['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a class="dropdown-item" href="<?php echo e(URL::to('/shop/category')); ?>/<?php echo e($menu->category_slug); ?>"><?php echo e($menu->category_name); ?></a></li> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="btn-group dropdown d-block mx-auto">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo e(__('More Info')); ?></button>
                    <ul class="dropdown-menu">
                        <?php if($allsettings->site_blog_display == 1): ?>
                            <li><a class="dropdown-item" href="<?php echo e(URL::to('/blog')); ?>"><?php echo e(__('Blog')); ?></a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="<?php echo e(URL::to('/shop')); ?>"><?php echo e(__('Shop')); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo e(URL::to('/my-favourite')); ?>"><?php echo e(__('My Favourite')); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo e(URL::to('/my-purchases')); ?>"><?php echo e(__('My Purchases')); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo e(URL::to('/contact')); ?>"><?php echo e(__('Contact')); ?></a></li>
                    </ul>
                </div>
            </div>

            
            <div class="col-md-2 d-none d-md-block text-center text-md-left mb-4">
                <div class="widget widget-links pb-2">
                    <h3 class="widget-title"><?php echo e(__('Categories')); ?></h3>
                    <ul class="widget-list">
                        <?php $__currentLoopData = $footer_menu['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="widget-list-item"><a class="widget-list-link" href="<?php echo e(URL::to('/shop/category')); ?>/<?php echo e($menu->category_slug); ?>"><?php echo e($menu->category_name); ?></a></li> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 d-none d-md-block text-center text-md-left mb-4">
                <div class="widget widget-links pb-2">
                    <h3 class="widget-title"><?php echo e(__('More Info')); ?></h3>
                    <ul class="widget-list">
                        <?php if($allsettings->site_blog_display == 1): ?>
                            <li class="widget-list-item"><a class="widget-list-link" href="<?php echo e(URL::to('/blog')); ?>"><?php echo e(__('Blog')); ?></a></li>
                        <?php endif; ?>
                        <li class="widget-list-item"><a class="widget-list-link" href="<?php echo e(URL::to('/shop')); ?>"><?php echo e(__('Shop')); ?></a></li>
                        <li class="widget-list-item"><a class="widget-list-link" href="<?php echo e(URL::to('/my-favourite')); ?>"><?php echo e(__('My Favourite')); ?></a></li>
                        <li class="widget-list-item"><a class="widget-list-link" href="<?php echo e(URL::to('/my-purchases')); ?>"><?php echo e(__('My Purchases')); ?></a></li>
                        <li class="widget-list-item"><a class="widget-list-link" href="<?php echo e(URL::to('/contact')); ?>"><?php echo e(__('Contact')); ?></a></li>
                    </ul>
                </div>
            </div>

            
            <div class="col-md-4 text-center text-md-left">
                <?php if($allsettings->site_newsletter_display == 1): ?>
                <div class="widget pb-2 mb-4">
                    <h3 class="widget-title pb-1"><?php echo e(__('Newsletter')); ?></h3>
                    <form class="validate" action="<?php echo e(route('newsletter')); ?>" method="post" name="mc-embedded-subscribe-form" id="footer_form" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="input-group input-group-overlay flex-nowrap">
                            <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="dwg-mail"></i></span></div>
                            <input class="form-control prepended-form-control" type="email" id="mce-EMAIL" value="" placeholder="<?php echo e(__('Enter your email address')); ?>" data-bvalidator="required" name="news_email">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="subscribe" id="mc-embedded-subscribe"><?php echo e(__('Subscribe')); ?></button>
                            </div>
                        </div>

                        
                        <?php if($allsettings->site_google_recaptcha == 1): ?>
                            <?php if($custom_settings->google_captcha_version == 'v3'): ?>
                            <div class="col-sm-12">
                                <div class="form-group<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
                                    <div class="col-sm-12">
                                        <?php echo RecaptchaV3::field('register'); ?>

                                        <?php if($errors->has('g-recaptcha-response')): ?>
                                            <span class="help-block"><strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="mt-2 d-flex justify-content-center justify-content-md-start">  
                                <div class="form-group <?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
                                    <?php echo app('captcha')->display(); ?>

                                    <?php if($errors->has('g-recaptcha-response')): ?>
                                        <span class="help-block"><strong class="red"><?php echo e($errors->first('g-recaptcha-response')); ?></strong></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>  

                        <small class="form-text opacity-50" id="mc-helper"><?php echo e(__('Want more script,themes & templates? Subscribe to our mailing list to receive an update when new items arrive')); ?>!</small>
                        <div class="subscribe-status"></div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="pt-4 footer-bottom-dark">
        <div <?php if($custom_settings->theme_layout == 'container'): ?> class="container-fluid" <?php else: ?> class="container" <?php endif; ?>>
            <div class="d-md-flex justify-content-between align-items-center">
                <div class="pb-4 font-size-xs opacity-50 text-center text-md-left">
                    <div><?php echo html_entity_decode($allsettings->site_copyright); ?> <?php echo e($allsettings->site_title); ?></div>
                </div>
                <div class="widget widget-links pb-4">
<ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
    <?php $__currentLoopData = $footerpages['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="widget-list-item ml-4">
        <a class="widget-list-link font-size-ms" href="<?php echo e(URL::to('/')); ?>/<?php echo e($pages->page_slug); ?>"><?php echo e($pages->page_title); ?></a>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php if($allsettings->cookie_popup == 1): ?>
<div class="alert text-center cookiealert" role="alert">
    <?php echo e($allsettings->cookie_popup_text); ?>

    <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
        <?php echo e($allsettings->cookie_popup_button); ?>

    </button>
</div>
<?php endif; ?>

<a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2"><?php echo e(__('Top')); ?></span><i class="btn-scroll-top-icon dwg-arrow-up"></i></a>


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
</script><?php /**PATH /home/catalogo/public_html/resources/views/footer.blade.php ENDPATH**/ ?>