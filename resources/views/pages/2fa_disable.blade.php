<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ $allsettings->site_title }} - {{ __('Disable Two-Factor Authentication') }}</title>
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
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ __('Disable Two-Factor Authentication') }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ __('Disable Two-Factor Authentication') }}</h1>
        </div>
      </div>
      </div>
    </section>
<div class="container py-5 mt-md-2 mb-2">
      <div class="row py-5 justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 bg-white">
                    <h3>{{ __('Disable Two-Factor Authentication') }}</h3>

                    <form method="POST" action="{{ route('disable') }}">
                        @csrf
                        <div class="form-group">
                            <p>Please enter the <strong>OTP</strong> generated on your Authenticator App. <br> Ensure you
                                submit the current one because it refreshes every 30 seconds.</p>
                            <label for="one_time_password">{{ __('Enter OTP to disable 2FA') }}:</label>
                            <input type="number" name="otp" class="form-control" required>
                        </div>
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                        <button class="btn btn-danger mt-3" type="submit">{{ __('Disable 2FA') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@include('footer')
@include('script')
</body>
</html>