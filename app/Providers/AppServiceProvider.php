<?php

namespace DownGrade\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use DownGrade\Models\Members;
use DownGrade\Models\Settings;
use DownGrade\Models\Category;
use DownGrade\Models\SubCategory;
use DownGrade\Models\Pages;
use DownGrade\Models\Comment;
use DownGrade\Models\Product; 
use DownGrade\Models\Attribute;
use DownGrade\Models\EmailTemplate;
use Illuminate\Support\Facades\View;
use Auth;
use Illuminate\Support\Facades\Config;
use Route;
use Request;
use Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Session;
use URL;
use Mail;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		view()->composer('*', function ($view) {
        $view->with('current_locale', app()->getLocale());
        $view->with('available_locales', config('app.available_locales'));
        });
		
		
		
		
		$dg_ver = 'user_license_7_4';
		View::share('dg_ver', $dg_ver);
		$drop_column = 'user_license_7_3';
		
		$allsettings = Settings::allSettings();
		View::share('allsettings', $allsettings);
		
		$custom_settings = Settings::editCustom();
		View::share('custom_settings', $custom_settings);
		
		$demo_text = '- This is Demo version. So Maximum 1MB Allowed';
		View::share('demo_text', $demo_text);
		
		$main_menu['category'] = Category::mainmenuCategoryData($allsettings->menu_display_categories,$allsettings->menu_categories_order);
		View::share('main_menu', $main_menu);
		
		
		$footer_menu['category'] = Category::mainmenuCategoryData($allsettings->footer_menu_display_categories,$allsettings->footer_menu_categories_order);
		View::share('footer_menu', $footer_menu);
		
		$categories['menu'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->take($allsettings->menu_display_categories)->orderBy('display_order',$allsettings->menu_categories_order)->get();
		View::share('categories', $categories);
		// checked
		
		$footerpages['pages'] = Pages::footermenuData();
		View::share('footerpages', $footerpages);
		
		$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
		View::share('encrypter', $encrypter);
		
		$allpages['pages'] = Pages::menupageData();
		View::share('allpages', $allpages);
		
		$total_customer = Members::totaluserCount();
		View::share('total_customer', $total_customer);
		
		$top_ads = explode(',',$allsettings->top_ads_pages);
		$sidebar_ads = explode(',',$allsettings->sidebar_ads_pages);
		$bottom_ads = explode(',',$allsettings->bottom_ads_pages);
		
		View::share('top_ads', $top_ads);
		View::share('sidebar_ads', $sidebar_ads);
		View::share('bottom_ads', $bottom_ads);
		
		$view['sold'] = Product::SoldProduct();
		$count_sold = 0;
		foreach($view['sold'] as $sold)
		{
		  $count_sold += $sold->product_sold;
		  /*if($sold->product_preview == "")
		  {
		  $product_image = $sold->product_image;
		  $product_id = $sold->product_id;
		  $off_flash = array('product_preview' => $product_image);
		  Product::updatefavouriteData($product_id,$off_flash);
		  }*/
		}
		View::share('count_sold', $count_sold);
		
		$mainmenu_count = Pages::mainmenuPageCount();
		View::share('mainmenu_count', $mainmenu_count);
			
		view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });
		
		if($allsettings->stripe_mode == 0) 
		{ 
		$stripe_publish_key = $allsettings->test_publish_key; 
		$stripe_secret_key = $allsettings->test_secret_key;
		
		}
		else
		{ 
		$stripe_publish_key = $allsettings->live_publish_key;
		$stripe_secret_key = $allsettings->live_secret_key;
		}
		View::share('stripe_publish_key', $stripe_publish_key);
		View::share('stripe_secret_key', $stripe_secret_key);
		
		
		Schema::table('custom_settings', function($table) use ($dg_ver,$drop_column)
        {
		
		    if (!Schema::hasColumn('custom_settings', $dg_ver)) 
			{
			$table->integer($dg_ver)->default(0);
			}
			if (Schema::hasColumn('custom_settings', $drop_column)) 
            {
		    $table->dropColumn($drop_column);
			}
			if (!Schema::hasColumn('custom_settings', 'google2fa_option')) 
			{
			$table->integer('google2fa_option')->default(1);
			}
			if (!Schema::hasColumn('custom_settings', 'product_name_limit')) 
			{
			$table->integer('product_name_limit');
			}
			if (!Schema::hasColumn('custom_settings', 'fapshi_mode')) 
			{
			$table->integer('fapshi_mode')->default(0);
			}
			if (!Schema::hasColumn('custom_settings', 'fapshi_api_user')) 
			{
			$table->string('fapshi_api_user')->nullable();
			}
			if (!Schema::hasColumn('custom_settings', 'fapshi_api_key')) 
			{
			$table->string('fapshi_api_key')->nullable();
			}
			if (!Schema::hasColumn('custom_settings', 'fapshi_payment_token')) 
			{
			$table->string('fapshi_payment_token')->nullable();
			}
			if (!Schema::hasColumn('custom_settings', 'fapshi_purchase_token')) 
			{
			$table->string('fapshi_purchase_token')->nullable();
			}
			if (!Schema::hasColumn('custom_settings', 'product_license_price')) 
			{
			$table->integer('product_license_price')->default(1);
			}
			if (!Schema::hasColumn('custom_settings', 'author_url')) 
			{
			$table->string('author_url')->default("https://codecanor.com");
			}
			if (!Schema::hasColumn('custom_settings', 'author_consumer_key')) 
			{
			$table->string('author_consumer_key')->default("ck_63618c733ca7359bde2a254d85adeb1bb6242e89");
			}
			if (!Schema::hasColumn('custom_settings', 'author_consumer_secret')) 
			{
			$table->string('author_consumer_secret')->default("cs_7a2237ee830809c9a6c825a6ef5158971d39fb45");
			}
			
		});	
		
		Config::set('mail.driver', $allsettings->mail_driver);
		Config::set('mail.host', $allsettings->mail_host);
		Config::set('mail.port', $allsettings->mail_port);
		Config::set('mail.username', $allsettings->mail_username);
		Config::set('mail.password', $allsettings->mail_password);
		Config::set('mail.encryption', $allsettings->mail_encryption);
		
		Config::set('services.facebook.client_id', $allsettings->facebook_client_id);
		Config::set('services.facebook.client_secret', $allsettings->facebook_client_secret);
		Config::set('services.facebook.redirect', $allsettings->facebook_callback_url);
		Config::set('services.google.client_id', $allsettings->google_client_id);
		Config::set('services.google.client_secret', $allsettings->google_client_secret);
		Config::set('services.google.redirect', $allsettings->google_callback_url);
		
		Config::set('paystack.publicKey', $allsettings->paystack_public_key);
		Config::set('paystack.secretKey', $allsettings->paystack_secret_key);
		Config::set('paystack.merchantEmail', $allsettings->paystack_merchant_email);
		Config::set('paystack.paymentUrl', 'https://api.paystack.co');
		
		Config::set('filesystems.disks.wasabi.key', $allsettings->wasabi_access_key_id);
		Config::set('filesystems.disks.wasabi.secret', $allsettings->wasabi_secret_access_key);
		Config::set('filesystems.disks.wasabi.region', $allsettings->wasabi_default_region);
		Config::set('filesystems.disks.wasabi.bucket', $allsettings->wasabi_bucket);
		
		Config::set('fapshi.apiuser', $custom_settings->fapshi_api_user);
		Config::set('fapshi.apikey', $custom_settings->fapshi_api_key);
		if($custom_settings->fapshi_mode == 1)
		{
		Config::set('fapshi.fapshiurl', 'https://live.fapshi.com');
		}
		else
		{
		Config::set('fapshi.fapshiurl', 'https://sandbox.fapshi.com');  
		}
		
		
		$subscribed_user = Members::SubscribedUser();
		if(count($subscribed_user) != 0)
		{
			foreach($subscribed_user as $user)
			{
			   $user_subscr_date = $user->user_subscr_date;
			   
			   
			   $before_days = '-'.$allsettings->reminder_renewal_before_days.' days';
			   $before_date = date('Y-m-d', strtotime($before_days, strtotime($user_subscr_date)));
			   
			   $today = date('Y-m-d');
               $paymentDate=date('Y-m-d', strtotime($today));
			   $contractDateBegin = date('Y-m-d', strtotime($before_date));
			   $contractDateEnd = date('Y-m-d', strtotime($user_subscr_date));
			   
			   $expired_date = $user_subscr_date;
			   $pack_name = $user->user_subscr_type;
			   $to_email = $user->email;
			   $to_name = $user->name;
			   $subscription_url = URL::to('/subscription');
			   $from_name = $allsettings->sender_name;
               $from_email = $allsettings->sender_email;
			   
			   if(empty($user->user_renewal_email))
			   {
				   if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))
				   {
					 
					 $record = array('expired_date' => $expired_date, 'pack_name' => $pack_name, 'subscription_url' => $subscription_url, 'to_name' => $to_name, 'to_email' => $to_email, 'from_name' => $from_name, 'from_email' => $from_email);
						/* email template code */
						$checktemp = EmailTemplate::checkTemplate(23);
						if($checktemp != 0)
						{
							$template_view['mind'] = EmailTemplate::viewTemplate(23);
							$template_subject = $template_view['mind']->et_subject;
						}
						else
						{
							$template_subject = "Subscription Renewal Notifications";
						}
						/* email template code */
						Mail::send('subscription_renewal_mail', $record, function($message) use ($from_email, $from_name, $to_name, $to_email, $template_subject) {
								$message->to($to_email, $to_name)
										->subject($template_subject);
								$message->from($from_email,$from_name);
							});
					 
					 
					 
				   }
				   $up_user_data = array('user_renewal_email' => 1);
				   Members::updateReferral($user->id,$up_user_data); 
				   
			   }
			}
		}	
		
				
		Config::set('filesystems.disks.dropbox.token', $allsettings->dropbox_token);
		
		Config::set('filesystems.disks.google.clientId', $allsettings->google_drive_client_id);
		Config::set('filesystems.disks.google.clientSecret', $allsettings->google_drive_client_secret);
		Config::set('filesystems.disks.google.refreshToken', $allsettings->google_drive_refresh_token);
		Config::set('filesystems.disks.google.folderId', $allsettings->google_drive_folder_id);
		
		
		
		if($custom_settings->shop_search_type == 'ajax')
		{
		$minprice['price'] = Product::minpriceData();
		View::share('minprice', $minprice);
		
		$maxprice['price'] = Product::maxpriceData();
		View::share('maxprice', $maxprice);
		
		
		$minprice_count = Product::minpriceCount();
		View::share('minprice_count', $minprice_count);
		
		$maxprice_count = Product::maxpriceCount();
		View::share('maxprice_count', $maxprice_count);
		}
		view()->composer('*', function($view)
		{
			$session_id = Session::getId();
			if (Auth::check()) {
			    $user['avilable'] = Members::logindataUser(Auth::user()->id);
			   $avilable = explode(',',$user['avilable']->user_permission);
			   $today_date = date('Y-m-d');
			   if(Auth::user()->user_today_download_date != $today_date)
			   {
			         $download_limiter = 0;
					 $up_user_download = array('user_today_download_date' => $today_date, 'user_today_download_limit' => $download_limiter);
					 Members::updateReferral(Auth::user()->id,$up_user_download);
			   }
  $stringmatch ="dashboard,settings,country,customers,category,subscription,manage-products,orders,refund-request,withdrawal,blog,ads,pages,contact,etemplate,newsletter,clear-cache,voucher,maintenance,coupons,backups,upgrade,tickets,addons";
				  if(Auth::user()->id == 1)
				  {
				    if($user['avilable']->user_permission != $stringmatch)
					{
					   $tempup = array('user_permission' => $stringmatch);
					   Members::updateReferral(Auth::user()->id,$tempup);
					} 
				  }
				  
			}else {
				$avilable = "";
			}
			$cartcount = Product::getcartCount();
			$view->with('cartcount', $cartcount);
			$cartitem['item'] = Product::getcartData();
			$view->with('cartitem', $cartitem);
			view()->share('avilable', $avilable);
		});
		
		$demo_mode = $custom_settings->demo_mode; // on
		View::share('demo_mode', $demo_mode);
		
		Config::set('recaptchav3.sitekey', $custom_settings->google_recaptcha_site_key);
		Config::set('recaptchav3.secret', $custom_settings->google_recaptcha_secret_key);
		
		Config::set('captcha.sitekey', $custom_settings->google_recaptcha_site_key);
		Config::set('captcha.secret', $custom_settings->google_recaptcha_secret_key);
		
		Config::set('filesystems.disks.s3.key', $custom_settings->aws_access_key_id);
		Config::set('filesystems.disks.s3.secret', $custom_settings->aws_secret_access_key);
		Config::set('filesystems.disks.s3.region', $custom_settings->aws_default_region);
		Config::set('filesystems.disks.s3.bucket', $custom_settings->aws_bucket);
		
		$pwa_settings = Settings::pwaSettings();
		View::share('pwa_settings', $pwa_settings);
		
		Config::set('laravelpwa.name', $pwa_settings->app_name);
		Config::set('laravelpwa.manifest.name', $pwa_settings->app_name);
		Config::set('laravelpwa.manifest.short_name', $pwa_settings->short_name);
		Config::set('laravelpwa.manifest.background_color', $pwa_settings->background_color);
		Config::set('laravelpwa.manifest.theme_color', $pwa_settings->theme_color);
		
		Config::set('laravelpwa.manifest.icons.72x72.path', 'images/icons/'.$pwa_settings->pwa_icon1);
		Config::set('laravelpwa.manifest.icons.96x96.path', 'images/icons/'.$pwa_settings->pwa_icon2);
		Config::set('laravelpwa.manifest.icons.128x128.path', 'images/icons/'.$pwa_settings->pwa_icon3);
		Config::set('laravelpwa.manifest.icons.144x144.path', 'images/icons/'.$pwa_settings->pwa_icon4);
		Config::set('laravelpwa.manifest.icons.152x152.path', 'images/icons/'.$pwa_settings->pwa_icon5);
		Config::set('laravelpwa.manifest.icons.192x192.path', 'images/icons/'.$pwa_settings->pwa_icon6);
		Config::set('laravelpwa.manifest.icons.384x384.path', 'images/icons/'.$pwa_settings->pwa_icon7);
		Config::set('laravelpwa.manifest.icons.512x512.path', 'images/icons/'.$pwa_settings->pwa_icon8);
		
		
		Config::set('laravelpwa.manifest.splash.640x1136', 'images/icons/'.$pwa_settings->pwa_splash1);
		Config::set('laravelpwa.manifest.splash.750x1334', 'images/icons/'.$pwa_settings->pwa_splash2);
		Config::set('laravelpwa.manifest.splash.828x1792', 'images/icons/'.$pwa_settings->pwa_splash3);
		Config::set('laravelpwa.manifest.splash.1125x2436', 'images/icons/'.$pwa_settings->pwa_splash4);
		Config::set('laravelpwa.manifest.splash.1242x2208', 'images/icons/'.$pwa_settings->pwa_splash5);
		Config::set('laravelpwa.manifest.splash.1242x2688', 'images/icons/'.$pwa_settings->pwa_splash6);
		Config::set('laravelpwa.manifest.splash.1536x2048', 'images/icons/'.$pwa_settings->pwa_splash7);
		Config::set('laravelpwa.manifest.splash.1668x2224', 'images/icons/'.$pwa_settings->pwa_splash8);
		Config::set('laravelpwa.manifest.splash.1668x2388', 'images/icons/'.$pwa_settings->pwa_splash9);
		Config::set('laravelpwa.manifest.splash.2048x2732', 'images/icons/'.$pwa_settings->pwa_splash10);
		
		Schema::table('users', function($table) 
		{
		    
			
			if (!Schema::hasColumn('users', 'google2fa_secret')) 
			{
			$table->string('google2fa_secret')->nullable();
			}
		    if (!Schema::hasColumn('users', 'google2fa_access')) 
			{
			$table->string('google2fa_access',20)->default('no')->nullable();
			}
			
		});
		Schema::table('product_withdrawal', function($table) 
		{
		    if (!Schema::hasColumn('product_withdrawal', 'mobile_money')) 
			{
			$table->string('mobile_money')->nullable()->after('bank_details');
			}
		
		});
		if (!Schema::hasTable('tickets')) 
		{
		   
		   $destinationPath = app_path('/Seeds/tickets.sql');
           DB::unprepared(file_get_contents($destinationPath));
		   
		}
		if (!Schema::hasTable('tickets_reply')) 
		{
		   
		   $destinationPath = app_path('/Seeds/tickets_reply.sql');
           DB::unprepared(file_get_contents($destinationPath));
		   
		}
		if (!Schema::hasTable('addons')) 
		{
		   
		   $destinationPath = app_path('/Seeds/addons.sql');
           DB::unprepared(file_get_contents($destinationPath));
		   
		}
		
		if (!Schema::hasTable('product_report')) 
		{
		   
		   $destinationPath = app_path('/Seeds/product_report.sql');
           DB::unprepared(file_get_contents($destinationPath));
		   
		}
		Schema::table('addons', function($table) 
		{
		    if (!Schema::hasColumn('addons', 'addon_url')) 
			{
			$table->text('addon_url')->nullable()->after('addon_envato_id');
			}
		
		});
		Schema::table('product_order', function($table) 
		{
		    
			if (!Schema::hasColumn('product_order', 'extra_service_ids')) 
			{
			$table->string('extra_service_ids')->nullable()->after('total_price');
			}
			if (!Schema::hasColumn('product_order', 'extra_service_fees')) 
			{
			$table->string('extra_service_fees')->nullable()->after('extra_service_ids');
			}
			
		});
		
		
    }
}
