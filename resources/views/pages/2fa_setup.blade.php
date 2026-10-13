<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ $allsettings->site_title }} - {{ __('Enable Two-Factor Authentication') }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
<section class="bg-position-center-top" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_other_banner }}');">
      <div class="py-4">
        <div @if($custom_settings->theme_layout == 'container') class="container-fluid d-lg-flex justify-content-between py-2 py-lg-3" @else class="container d-lg-flex justify-content-between py-2 py-lg-3" @endif>
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ __('Home') }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ __('Enable Two-Factor Authentication') }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ __('Enable Two-Factor Authentication') }}</h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-5 mt-md-2 mb-2">
      <div class="row py-5 justify-content-center">
            <div class="col-md-7">
                @if($dd_mode == "on" && $dd_user == 1)
                <h4 class="required">{{ __('This is Demo version. You can not 2fa admin access') }}</h4>
                <img src="{{ url('/') }}/resources/views/theme/img/blur.jpg" border="0" width="772" height="524">
                @else
                <h3>{{ __('Enable Two-Factor Authentication') }}</h3>
                <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code
                    <strong>{{ $secret }}</strong></p>
                <p>Ensure you submit the current one because it refreshes every 30 seconds.</p>
                <img src="data:image/svg+xml;base64,{{ $qrCodeSvg }}" alt="QR Code">

                <form method="POST" action="{{ route('enable') }}" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="otp">{{ __('Enter OTP from app') }}:</label>
                        <input type="number" name="otp" id="otp" class="form-control" required>
                    </div>
                    @error('otp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @if (session('error') && !$errors->has('otp'))
                        <span class="invalid-feedback" role="alert" style="display: block;">
                            <strong>{{ session('error') }}</strong>
                        </span>
                    @endif
                    <button class="btn btn-primary mt-2" type="submit">{{ __('Enable 2FA') }}</button>
                </form>
                @endif
            </div>
        </div>
    </div>
@include('footer')
@include('script')
</body>
</html>