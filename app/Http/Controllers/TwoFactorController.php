<?php

namespace DownGrade\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DownGrade\Models\Settings;
use Auth;
use DB;
use Cookie;
use Redirect;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	public function setup()
    {
	    $sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);
		$extra_options = Settings::editCustom();
        $google2fa = app('pragmarx.google2fa');

        $user = Auth::user();

        if ($user->google2fa_secret) {
            return redirect()->route('my-profile')->with('info', '2FA already enabled.');
        }

        $secret = $google2fa->generateSecretKey();

        $qrUrl = $google2fa->getQRCodeUrl(
            $setting['setting']->site_title,
            $user->email,
            $secret
        );

        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            )
        );

        $qrCodeSvg = base64_encode($writer->writeString($qrUrl));

        session(['2fa_secret' => $secret]);
        $dd_mode = $extra_options->demo_mode;
		$dd_user = $user->id;
        return view('2fa_setup', compact('qrCodeSvg', 'secret', 'dd_mode', 'dd_user'));
    }

    public function enable(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = Auth::user();
        $secret = session('2fa_secret');
        $google2fa = app('pragmarx.google2fa');

        if ($google2fa->verifyKey($secret, $request->otp)) 
		{
            $user->google2fa_secret = $secret;
            $user->save();

            return redirect()->route('2fa')->with('success', '2FA enabled!');
        }
		else
		{
           return back()->with('error', 'Invalid OTP, please try again.');
		   
		}   
    }

    public function showDisableForm()
    {
        $user = Auth::user();

        if (!$user->google2fa_secret) {
            return redirect()->route('my-profile')->with('info', '2FA is not enabled.');
        }

        return view('2fa_disable');
    }
	
	public function twofa_verify()
	{
	    return view('2fa_verify');
	}
	
	
	public function update_verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = Auth::user();
        $secret = session('2fa_secret');
        $google2fa = app('pragmarx.google2fa');

        if ($google2fa->verifyKey($secret, $request->otp)) 
		{
            $user->google2fa_secret = $secret;
			$user->google2fa_access = "yes";
            $user->save();
            if($user->user_type == 'admin')
			{
			   return redirect('/admin');
			}
			else
			{
            return redirect('/my-profile');
			}
        }
		else
		{
           return back()->with('error', 'Invalid OTP, please try again.');
		   
		}   
    }

    public function disable(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = Auth::user();

        if (!$user->google2fa_secret) {
            return redirect()->route('my-profile')->with('info', '2FA is not enabled.');
        }

        $google2fa = app('pragmarx.google2fa');

        $otpValid = $google2fa->verifyKey($user->google2fa_secret, $request->input('otp'));

        if (!$otpValid) {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }

        $user->google2fa_secret = null;
        $user->save();

        session()->forget('google2fa_passed');
        if($user->user_type == 'admin')
			{
			   return redirect('/admin')->with('success', '2FA has been disabled.');
			}
			else
			{
            return redirect()->route('my-profile')->with('success', '2FA has been disabled.');
			}
        
    }

	
	
	
}
