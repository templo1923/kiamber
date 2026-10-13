<?php

namespace DownGrade\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DownGrade\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use DownGrade\Models\Members;
use DownGrade\Models\Settings;
use DownGrade\Models\Subscription;
use DownGrade\Models\Category;
use Auth;
use URL;
use Mail;
use Helper;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
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
		
	public function view_myprofile()
	{
	
	  if($this->custom() != 0)
	  {
	  return view('my-profile');
	  }
	  else
	  {
		  return redirect('/admin/license');
	  }
	
	}
	
	public function upgrade_subscription($id)
	{
	   $subscr_id = base64_decode($id);
	   $subscr['view'] = Members::getSubscription($subscr_id);
	   $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $get_payment = explode(',', $setting['setting']->payment_option);
	  if($this->custom() != 0)
	  {
	   return view('confirm-subscription', ['subscr' => $subscr, 'get_payment' => $get_payment]);
	  }
	  else
	  {
		  return redirect('/admin/license');
	  } 
	}
	
	
	
	public function cause_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	
	public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
	
	
public function update_subscription(Request $request)
    {
        // 1. Captura de datos básicos del formulario
        $token = $request->input('token');
        $price = base64_decode($request->input('user_subscr_price'));
        $user_id = Auth::user()->id;
        $order_email = Auth::user()->email;
        $purchase_token = rand(111111,999999);
        $payment_method = $request->input('payment_method');
        $user_subscr_type = $request->input('user_subscr_type');
        $user_subscr_date = $request->input('user_subscr_date');
        $user_subscr_causes = $request->input('user_subscr_causes');
        $user_subscr_id = $request->input('user_subscr_id');
        $website_url = $request->input('website_url');
        $subscr_value = "+".$user_subscr_date;
        $subscr_date = date('Y-m-d', strtotime($subscr_value));
        $sid = 1;
        $setting['setting'] = Settings::editGeneral($sid);
        
        // 2. Preparación de datos para actualizar la suscripción del usuario
        $updatedata = array(
            'user_subscr_type' => $user_subscr_type, 
            'user_subscr_price' => $price, 
            'user_subscr_causes' => $user_subscr_causes, 
            'user_subscr_id' => $user_subscr_id
        );

        /* Configuración de URLs de retorno */
        $paypal_email = $setting['setting']->paypal_email;
        $paypal_mode = $setting['setting']->paypal_mode;
        $site_currency = $setting['setting']->site_currency_code;
        $paypal_url = ($paypal_mode == 1) ? "https://www.paypal.com/cgi-bin/webscr" : "https://www.sandbox.paypal.com/cgi-bin/webscr";
        
        $success_url = $website_url.'/success/'.$purchase_token;
        $cancel_url = $website_url.'/cancel';
        
        $stripe_mode = $setting['setting']->stripe_mode;
        if($stripe_mode == 0) {
            $stripe_publish_key = $setting['setting']->test_publish_key;
            $stripe_secret_key = $setting['setting']->test_secret_key;
        } else {
            $stripe_publish_key = $setting['setting']->live_publish_key;
            $stripe_secret_key = $setting['setting']->live_secret_key;
        }

        // 3. PASO CRÍTICO: Guardamos la intención de suscripción en la DB una sola vez
        Subscription::upsubscribeData($user_id, $updatedata);

        // 4. LÓGICA DE PASARELAS (Usamos else if para evitar ejecuciones dobles)
        
        // --- PAYPAL ---
        if($payment_method == 'paypal')
        {
             $paypal = '<form method="post" id="paypal_form" action="'.$paypal_url.'">
              <input type="hidden" value="_xclick" name="cmd">
              <input type="hidden" value="'.$paypal_email.'" name="business">
              <input type="hidden" value="'.$user_subscr_type.'" name="item_name">
              <input type="hidden" value="'.$purchase_token.'" name="item_number">
              <input type="hidden" value="'.$price.'" name="amount">
              <input type="hidden" value="USD" name="'.$site_currency.'">
              <input type="hidden" value="'.$success_url.'" name="return">
              <input type="hidden" value="'.$cancel_url.'" name="cancel_return">
            </form>
            <script>window.paypal_form.submit();</script>';
            echo $paypal;
        }
        
        // --- BOLD (KIAMBER) ---
        else if($payment_method == 'bold')
        {
            $custom_settings = \DownGrade\Models\Settings::editCustom();
            $trm = $custom_settings->bold_trm_rate ?? 4000;
            $amount_cop = (int) round($price * $trm);
            
            $api_key = "qFB8sDlXb-kU_I9OYTvRp-LwGKJZCzVMkMVXVuq3j7A"; 
            $secret_key = "AUOVypQH5ZPgHdBZkFwU1A"; 

            $signature_payload = $purchase_token . $amount_cop . "COP" . $secret_key;
            $integrity_signature = hash('sha256', $signature_payload);

            return view('bold_checkout', [
                'amount' => $amount_cop,
                'api_key' => $api_key,
                'order_id' => $purchase_token,
                'integrity_signature' => $integrity_signature,
                'is_subscription' => true 
            ]);
        }
        
        // --- STRIPE ---
        else if($payment_method == 'stripe')
        {
            \Stripe\Stripe::setApiKey($stripe_secret_key);
            
            $customer = \Stripe\Customer::create(array(
                'email' => $order_email,
                'source'  => $token
            ));
            
            $subscribe_name = $user_subscr_type;
            $subscribe_price = $price * 100;
            $book_id = $purchase_token;
            
            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $subscribe_price,
                'currency' => $site_currency,
                'description' => $subscribe_name,
                'metadata' => array('order_id' => $book_id)
            ));
            
            $chargeResponse = $charge->jsonSerialize();
            
            if($chargeResponse['paid'] == 1 && $chargeResponse['captured'] == 1) 
            {
                $payment_token = $chargeResponse['balance_transaction'];
                $checkoutdata = array('user_subscr_date' => $subscr_date);
                Subscription::confirmsubscriData($user_id, $checkoutdata);
                
                return view('success')->with(['payment_token' => $payment_token]);
            }
        }
    }
    
    
    
    
    
	
public function bold_subscription_success(Request $request)
{
    // 1. Capturamos los datos básicos
    $status = $request->input('bold-tx-status');
    $purchase_token = $request->input('ord'); 
    $payment_token = $request->input('bold-order-id');

    // 2. Si el pago no es exitoso, pa' fuera
    if ($status !== 'approved' && $status !== 'successful') {
        return redirect('/cancel');
    }

    // 3. BUSQUEDA DIRECTA (Sin usar Auth::user)
    // Buscamos al usuario que tiene asignado ese token de compra en la DB
    $user = \Illuminate\Support\Facades\DB::table('users')
        ->where('user_purchase_token', $purchase_token)
        ->first();

    if(!$user) {
        // Si no lo encuentra por token, es que el token no se guardó bien
        return "Error: No se encontró el usuario para la orden " . $purchase_token;
    }

    // 4. Traemos los datos del plan que el usuario tiene pre-seleccionado
    $sub_data = \Illuminate\Support\Facades\DB::table('subscription')
        ->where('subscr_id', $user->user_subscr_id)
        ->first();

    if($sub_data) {
        $final_date = date('Y-m-d', strtotime("+".$sub_data->subscr_duration));
        
        // 5. ACTUALIZACIÓN DIRECTA (Lo que el panel necesita ver)
        \Illuminate\Support\Facades\DB::table('users')
            ->where('id', $user->id)
            ->update([
                'user_subscr_date' => $final_date,
                'user_subscr_name' => $sub_data->subscr_name,
                'user_subscr_item' => $sub_data->subscr_item,
                'user_subscr_download' => $sub_data->subscr_download_item,
                'user_subscr_payment_status' => 'completed',
                'user_subscr_payment_type' => 'bold'
            ]);
        
        return view('success')->with(['payment_token' => $payment_token]);
    }

    return redirect('/')->with('error', 'Error procesando la suscripción');
}




	public function update_myprofile(Request $request)
	{
	
	   $name = $request->input('name');
	   $username = $request->input('username');
         $email = $request->input('email');
		 
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 
		 		 
		  $token = $request->input('edit_id');
		  $image_size = $request->input('image_size');
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif,svg|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		if ($request->hasFile('user_photo')) {
		     
			Members::droPhoto($token); 
		   
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  
		 
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'password' => $pass, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'));
 
            
            
			Members::updateData($token, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	
	
	
	public function paypal_success($ord_token, Request $request)
	{
	
	$payment_token = $request->input('tx');
	$purchased_token = $ord_token;
	$subscr_id = Auth::user()->user_subscr_id;
	$subscr['view'] = Subscription::editsubData($subscr_id);
	$subscri_date = $subscr['view']->subscr_duration;
	$subscr_value = "+".$subscri_date;
	$subscr_date = date('Y-m-d', strtotime($subscr_value));
	$user_id = Auth::user()->id;
	$checkoutdata = array('user_subscr_date' => $subscr_date);
	Subscription::confirmsubscriData($user_id,$checkoutdata);
	$result_data = array('payment_token' => $payment_token);
	return view('success')->with($result_data);
	
	}
	
	public function payment_cancel()
	{
	  return view('cancel');
	}
	
	
	
	public function donation_delete($id)
	{
	   $donor_id = base64_decode($id);
	   Causes::deleteDonor($donor_id);
	   return redirect()->back()->with('success','Delete successfully.');
	}
	
	
	
	
	
}
