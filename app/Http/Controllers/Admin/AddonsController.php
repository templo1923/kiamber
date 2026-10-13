<?php

namespace DownGrade\Http\Controllers\Admin;


use Illuminate\Http\Request;
use DownGrade\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use DownGrade\Models\Settings;
use DownGrade\Models\EmailTemplate;
use DownGrade\Models\Members;
use DownGrade\Models\Addons;
use Auth;
use Mail;
use Artisan;
use Helper;
use ZipArchive;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Config;


class AddonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	public function custom()
	{
	    $dw_v = Helper::version_no();
		$custom = Settings::editCustom();
		return $custom->$dw_v;
	} 
	
	public function logout(Request $request) {
	  $data = array("google2fa_access" => "no");
	  Members::verifyuserData(Auth::user()->user_token,$data);
	  Auth::logout();
	  return redirect('/login');
    }
	
	
	public function delete_cache()
	{
	    Artisan::call('cache:clear');
		Artisan::call('view:clear');
		Artisan::call('config:cache');
		Artisan::call('optimize:clear');
		/*return redirect(admin/contact)->with('success','All cache data has been cleared');*/
		return redirect()->back()->with('success','All cache data has been cleared');
		
	}
	
	
	public function deactivate_addon($addon_id)
	{
	   $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	   $id   = $encrypter->decrypt($addon_id);
	   $singleaddon = Addons::singleAddon($id);
	   Artisan::call('module:disable', ['module' => $singleaddon->addon_slug, '--no-interaction' => true]);
	   $data = array('addon_status' => 0);
	   Addons::updateAddon($id,$data);
	   /* clear cache */
	   Artisan::call('optimize:clear');
	   /* clear cache */
	   return redirect()->back()->with('success','Deactivated successfully');
	    
	}
	
	public function activate_addon($addon_id)
	{
	   $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	   $id   = $encrypter->decrypt($addon_id);
	   $singleaddon = Addons::singleAddon($id);
	   Artisan::call('module:enable', ['module' => $singleaddon->addon_slug, '--no-interaction' => true]);
	   /* clear cache */
	   Artisan::call('optimize:clear');
	   /* clear cache */
	   $data = array('addon_status' => 1);
	   Addons::updateAddon($id,$data);
	   
	   return redirect()->back()->with('success','Activated successfully');
	    
	}
	
	public function delete_addon($addon_id)
	{
	   $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	   $id   = $encrypter->decrypt($addon_id);
	   $singleaddon = Addons::singleAddon($id);
	   Artisan::call('module:disable', ['module' => $singleaddon->addon_slug, '--no-interaction' => true]);
	   File::deleteDirectory(base_path('/Modules/'.$singleaddon->addon_slug));
	   Addons::deleteAddon($id);
	   /* clear cache */
	   Artisan::call('optimize:clear');
	   /* clear cache */
	   return redirect()->back()->with('success','Deleted successfully');
	    
	}
	
	public function upload_addon(Request $request) 
	{
	  
	   $this->validate($request, [
		 
		                    'addon_purchased_code' => 'required',
							'upload_addon_file' => 'mimes:zip',

        	]);
        
		$rules = array();
		
		$messages = array(
		      
	    );
		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
			$custom_settings = Settings::editCustom();
			$purchased_code = $request->input('addon_purchased_code');
			if(strlen($purchased_code) < 10)
			{
			    
				    $consumer_key = $custom_settings->author_consumer_key; // Replace with your Consumer Key
					$consumer_secret = $custom_settings->author_consumer_secret; // Replace with your Consumer Secret
					$store_url = $custom_settings->author_url; // Replace with your store URL
					
					// Order ID to retrieve
					$order_id = $purchased_code; // Replace with the actual Order ID
					
					// Construct the API endpoint URL
					$api_endpoint = $store_url . '/wp-json/wc/v3/orders/' . $order_id;
					
					// Initialize cURL
					$ch = curl_init();
					
					// Set cURL options
					curl_setopt($ch, CURLOPT_URL, $api_endpoint);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
					curl_setopt($ch, CURLOPT_USERPWD, $consumer_key . ":" . $consumer_secret); // Basic authentication
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); // Use basic authentication
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For development, disable SSL verification (remove in production)
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For development, disable SSL verification (remove in production)
					
					// Execute the cURL request
					$response = curl_exec($ch);
					// Check for cURL errors
					if (curl_errno($ch)) {
						return redirect()->back()->with('error','FAILED: Invalid Addon Order Id');
					} else {
						// Decode the JSON response
						$order_details = json_decode($response, true);
						
						// Check if order details were retrieved successfully
						if(!empty($order_details['status']))
						{
						if ($order_details['status'] == "processing" || $order_details['status'] == "completed" && $order_details['id'] == $order_id) 
						{
							//$order_details['id'] .'-'. $order_details['status']; // processing // completed
							
							$addon_id = $order_details['line_items'][0]['product_id'];
						   if ($request->hasFile('upload_addon_file')) 
							{
								$image = $request->file('upload_addon_file');
								$originalFileName = $image->getClientOriginalName();
								$fileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME);
								
								$img_name = time() . uniqid().'.'.$image->getClientOriginalExtension();
								$module_name = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_name');
								$module_slug = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_slug');
								$module_image = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_image');
								$module_version = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_version');
								$module_dir = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_dir');
								$module_url = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_url');
								$destinationPath = base_path('/public/storage/data/');
								$imagePath = $destinationPath. "/".  $img_name;
								$image->move($destinationPath, $img_name);
								$addition_data = array('upgrade_files' => $img_name);
								Settings::updateCustomData($addition_data);
								
								$countaddon = Addons::checkAddon($module_dir);
								
								$zip = new ZipArchive;
								$zip->open(base_path('/public/storage/data/'.$img_name));
								$zip->extractTo(base_path('/Modules/'));
								Settings::deleteUpgrade();
								Artisan::call('module:enable', ['module' => $fileNameWithoutExtension, '--no-interaction' => true]);
								/* clear cache */
								Artisan::call('optimize:clear');
								/* clear cache */
								if($countaddon == 0)
								{
								$data = array('addon_name' => $module_name, 'addon_slug' => $module_slug, 'addon_image' => $module_image, 'addon_version' => $module_version, 'addon_dir' => $module_dir, 'addon_status' => 1, 'addon_envato_id' => $addon_id, 'addon_url' => $module_url);
								Addons::saveAddon($data);
								}
							
							
							}
							
							
							return redirect('/admin/addons')->with('success','Success! Installation Done');
							
						} 
						else 
						{  
										return redirect()->back()->with('error','FAILED: Invalid Addon Order Id');
										
						} 
							
							
						}
						else 
						{  
										return redirect()->back()->with('error','FAILED: Invalid Addon Order Id');
										
						} 	
							
						
					}
					
					// Close cURL
					curl_close($ch);
			
			
			}
			else
			{
				$code= $purchased_code; 
				$url = "https://api.envato.com/v3/market/author/sale?code=".$code;
				$curl = curl_init($url);
				$personal_token = "sS3y8m5fMdYZMWVbSPtI7LdJYmtC9F2O";
				$header = array();
				$header[] = 'Authorization: Bearer '.$personal_token;
				$header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
				$header[] = 'timeout: 20';
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
				$envatoRes = curl_exec($curl);
				curl_close($curl);
				$envatoRes = json_decode($envatoRes);
				//if($envatoRes->license == base64_decode(Helper::key_no())){ $key_val = 1; } else { $key_val = 0; }
				if (isset($envatoRes->item->name)) 
				{   
				//$addon_thumb = $envatoRes->item->previews->icon_with_landscape_preview->icon_url;
				//$addon_name = $envatoRes->item->name;
						   $addon_id = $envatoRes->item->id;
						   if ($request->hasFile('upload_addon_file')) 
							{
								$image = $request->file('upload_addon_file');
								$originalFileName = $image->getClientOriginalName();
								$fileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME);
								
								$img_name = time() . uniqid().'.'.$image->getClientOriginalExtension();
								$module_name = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_name');
								$module_slug = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_slug');
								$module_image = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_image');
								$module_version = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_version');
								$module_dir = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_dir');
								$module_url = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_url');
								$destinationPath = base_path('/public/storage/data/');
								$imagePath = $destinationPath. "/".  $img_name;
								$image->move($destinationPath, $img_name);
								$addition_data = array('upgrade_files' => $img_name);
								Settings::updateCustomData($addition_data);
								
								$countaddon = Addons::checkAddon($module_dir);
								
								$zip = new ZipArchive;
								$zip->open(base_path('/public/storage/data/'.$img_name));
								$zip->extractTo(base_path('/Modules/'));
								Settings::deleteUpgrade();
								Artisan::call('module:enable', ['module' => $fileNameWithoutExtension, '--no-interaction' => true]);
								/* clear cache */
								Artisan::call('optimize:clear');
								/* clear cache */
								if($countaddon == 0)
								{
								$data = array('addon_name' => $module_name, 'addon_slug' => $module_slug, 'addon_image' => $module_image, 'addon_version' => $module_version, 'addon_dir' => $module_dir, 'addon_status' => 1, 'addon_envato_id' => $addon_id, 'addon_url' => $module_url);
								Addons::saveAddon($data);
								}
							
							
							}
							
							
							return redirect('/admin/addons')->with('success','Success! Installation Done');
							
					} 
					else 
				    {  
										return redirect()->back()->with('error','FAILED: Invalid Addon Purchase Code');
										
					} 
				
				
				}
				
			
			
		}	
	
	}
	
	
	public function Install_Addon($key,$addon_real_name)
	{
	        $fileNameWithoutExtension = $addon_real_name;
	        $purchased_code = $key;
			$custom_settings = Settings::editCustom();
			if(strlen($purchased_code) < 10)
			{
			
			    
				    $consumer_key = $custom_settings->author_consumer_key; // Replace with your Consumer Key
					$consumer_secret = $custom_settings->author_consumer_secret; // Replace with your Consumer Secret
					$store_url = $custom_settings->author_url; // Replace with your store URL
					
					// Order ID to retrieve
					$order_id = $purchased_code; // Replace with the actual Order ID
					
					// Construct the API endpoint URL
					$api_endpoint = $store_url . '/wp-json/wc/v3/orders/' . $order_id;
					
					// Initialize cURL
					$ch = curl_init();
					
					// Set cURL options
					curl_setopt($ch, CURLOPT_URL, $api_endpoint);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
					curl_setopt($ch, CURLOPT_USERPWD, $consumer_key . ":" . $consumer_secret); // Basic authentication
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); // Use basic authentication
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For development, disable SSL verification (remove in production)
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For development, disable SSL verification (remove in production)
					
					// Execute the cURL request
					$response = curl_exec($ch);
					// Check for cURL errors
					if (curl_errno($ch)) {
						echo('FAILED: Invalid Addon Order Id');
					} else {
						// Decode the JSON response
						$order_details = json_decode($response, true);
						
						// Check if order details were retrieved successfully
						if(!empty($order_details['status']))
						{
						if ($order_details['status'] == "processing" || $order_details['status'] == "completed" && $order_details['id'] == $order_id) 
						{
							//$order_details['id'] .'-'. $order_details['status']; // processing // completed
							
							    
						        $addon_id = $order_details['line_items'][0]['product_id'];
								$module_name = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_name');
								$module_slug = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_slug');
								$module_image = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_image');
								$module_version = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_version');
								$module_dir = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_dir');
								$module_url = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_url');
								$countaddon = Addons::checkAddon($module_dir);
								//shell_exec('composer dump-autoload -o'); 
								Artisan::call('module:enable', ['module' => $fileNameWithoutExtension, '--no-interaction' => true]);
								/* clear cache */
								Artisan::call('optimize:clear');
								/* clear cache */
								if($countaddon == 0)
								{
									$data = array('addon_name' => $module_name, 'addon_slug' => $module_slug, 'addon_image' => $module_image, 'addon_version' => $module_version, 'addon_dir' => $module_dir, 'addon_status' => 1, 'addon_envato_id' => $addon_id, 'addon_url' => $module_url);
									Addons::saveAddon($data);
								}
							
							echo('Success! Installation Done');
							
						} 
						else 
						{  
										echo('FAILED: Invalid Addon Order Id');
										
						} 
							
							
						}
						else 
						{  
										echo('FAILED: Invalid Addon Order Id');
										
						} 	
							
						
					}
					
					// Close cURL
					curl_close($ch);
				
				
				
			
			
			
			
			}
			else
			{
						$code= $purchased_code; 
						$url = "https://api.envato.com/v3/market/author/sale?code=".$code;
						$curl = curl_init($url);
						$personal_token = "sS3y8m5fMdYZMWVbSPtI7LdJYmtC9F2O";
						$header = array();
						$header[] = 'Authorization: Bearer '.$personal_token;
						$header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
						$header[] = 'timeout: 20';
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
						$envatoRes = curl_exec($curl);
						curl_close($curl);
						$envatoRes = json_decode($envatoRes);
						if (isset($envatoRes->item->name)) 
						{   
							$addon_id = $envatoRes->item->id;
							$module_name = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_name');
							$module_slug = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_slug');
							$module_image = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_image');
							$module_version = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_version');
							$module_dir = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_dir');
							$module_url = Config::get('addon.'.strtolower($fileNameWithoutExtension).'.module_url');
							$countaddon = Addons::checkAddon($module_dir);
							//shell_exec('composer dump-autoload -o'); 
							Artisan::call('module:enable', ['module' => $fileNameWithoutExtension, '--no-interaction' => true]);
							/* clear cache */
							Artisan::call('optimize:clear');
							/* clear cache */
							if($countaddon == 0)
							{
								$data = array('addon_name' => $module_name, 'addon_slug' => $module_slug, 'addon_image' => $module_image, 'addon_version' => $module_version, 'addon_dir' => $module_dir, 'addon_status' => 1, 'addon_envato_id' => $addon_id, 'addon_url' => $module_url);
								Addons::saveAddon($data);
							}
							
							
							echo('Success! Installation Done');
							
							
						}
						else 
						{  
									echo('FAILED: Invalid Addon Purchase Code');
									
						} 
			
			}
	   
	   
	} 
	
	
	
	
	
	
	public function view_install_addon()
	{
	   if($this->custom() != 0)
	   {
		   
	     if(!empty(Auth::user()->google2fa_secret) && (Auth::user()->google2fa_access == "yes"))
			{
			return view('admin.install-addon');
			}
			else if(empty(Auth::user()->google2fa_secret))
			{
			return view('admin.install-addon');
			}
			else
			{
			return redirect('/2fa');  
			}
		 
	   }
	   else
	   {
		  return redirect('/admin/license');
	   }
	}
	
	
	public function view_addons()
	{
	  
	  $getaddons = Addons::getaddonsViews();
	  $data = array('getaddons' => $getaddons);
	  if($this->custom() != 0)
	  {
	  
	    
		if(!empty(Auth::user()->google2fa_secret) && (Auth::user()->google2fa_access == "yes"))
			{
			return view('admin.addons')->with($data);
			}
			else if(empty(Auth::user()->google2fa_secret))
			{
			return view('admin.addons')->with($data);
			}
			else
			{
			return redirect('/2fa');  
			}
	  
	  }
	  else
	  {
		  return redirect('/admin/license');
	  }
	
	}
	
	
	
	
}
