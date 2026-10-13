<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ __('Thank You') }} - {{ $allsettings->site_title }}</title>
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
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ __('Thank You') }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ __('Thank You') }}</h1>
        </div>
      </div>
      </div>
    </section>
<div @if($custom_settings->theme_layout == 'container') class="container-fluid py-5 mt-md-2 mb-2" @else class="container py-5 mt-md-2 mb-2" @endif>
      @if(in_array('pages',$top_ads))
      <div class="row">
          <div class="col-lg-12 mb-4" align="center">
             @php echo html_entity_decode($allsettings->top_ads); @endphp
          </div>
       </div>   
       @endif
      <div class="row">
        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
          <div class="panel-body mb-5">
            <h3>{{ __('Your details has been sent. Once received payment will confirm your subscription') }}</h3>
            <h5 class="mt-3 text-info">{{ __('Your Subscription Id') }} : {{ $purchase_token }}</h5>
          </div>
          
          <div class="panel-body mb-5">
            <h3>{{ __('Below are you amount transaction details') }}</h3>
            <h5 class="mt-3 pb-2">{{ __('Bank Details') }}</h5>
            
            {{-- SECCIÓN DE PAGO MANUAL --}}
            <div class="row mt-4">
                <div class="col-md-6">
                    <p style="font-size: 1.1rem;">@php echo nl2br($bank_details) @endphp</p>
                </div>
                {{-- Imagen del QR --}}
                <div class="col-md-6 text-center">
                    <p><strong>{{ __('Escanea para pagar') }}</strong></p>
                    <img src="{{ url('/') }}/public/storage/settings/qr-pago.png" alt="QR de Pago" style="max-width: 200px; border: 5px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                </div>
            </div>

            {{-- BOTÓN DE WHATSAPP DINÁMICO --}}
            <div class="mt-5 p-4 bg-secondary text-center rounded">
                <h4 class="mb-3"><strong>PASO FINAL:</strong></h4>
                <p>Una vez realizado el pago, envía el comprobante por WhatsApp indicando tu número de pedido.</p>
                <a href="https://wa.me/573004085041?text=Hola,%20adjunto%20comprobante%20de%20pago%20para%20la%20suscripción%20#{{ $purchase_token }}" 
                   target="_blank" 
                   class="btn btn-success btn-lg shadow">
                   <i class="dwg-whatsapp mr-2"></i> ENVIAR COMPROBANTE POR WHATSAPP
                </a>
            </div>
          </div>
         </div>
      </div>
      @if(in_array('pages',$bottom_ads))
       <div class="row">
          <div class="col-lg-12 mb-4" align="center">
             @php echo html_entity_decode($allsettings->bottom_ads); @endphp
          </div>
       </div>   
       @endif
    </div>
@include('footer')
@include('script')
</body>
</html>