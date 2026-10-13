<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Pagando con Binance Pay') }}</title>
    @include('style')
    <style>
        body { background-color: #1e2026; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column; font-family: 'Rubik', sans-serif; }
        .card { padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); background: #2b2f36; text-align: center; max-width: 450px; width: 100%; }
        .btn-binance { background-color: #FCD535; color: #1e2026; font-weight: bold; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-block; margin-top: 20px; width: 100%; }
        .btn-binance:hover { background-color: #e5c02b; color: #1e2026; text-decoration: none; }
        .spinner { border: 4px solid rgba(255,255,255,0.1); border-left-color: #FCD535; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; margin: 20px auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div class="card">
        <img src="https://public.bnbstatic.com/image/cms/blog/20210331/53063499-d50c-4e6f-87ee-8d9607833502.png" alt="Binance Pay" style="max-width: 180px; margin-bottom: 20px;">
        
        <h3>{{ __('Orden') }} #{{ $order_id }}</h3>
        <p>{{ __('Monto a pagar:') }}</p>
        <h2 style="color: #FCD535;">${{ number_format($amount, 2) }} USD</h2>
        
        <div class="spinner"></div>
        <p>{{ __('Redirigiendo a Binance segura...') }}</p>

        @if(isset($checkout_url))
            <script>
                // Redirigir automáticamente a Binance Pay en 2 segundos
                setTimeout(function() {
                    window.location.href = "{{ $checkout_url }}";
                }, 1500);
            </script>
            
            <a href="{{ $checkout_url }}" class="btn-binance">{{ __('Clic aquí si no redirige automáticamente') }}</a>
        @else
            <div class="alert alert-danger mt-3">
                {{ __('Error: No se pudo generar el link de pago de Binance. Contacte soporte.') }}
            </div>
        @endif
    </div>

</body>
</html>