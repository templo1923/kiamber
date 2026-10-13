<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Procesando Pago con Wompi') }}</title>
    {{-- Usamos los estilos del tema para que no se vea vacío --}}
    @include('style')
    <style>
        body { 
            background-color: #f8f9fa; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0;
            font-family: 'Inter', sans-serif;
        }
        .payment-card {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #373092; {{-- Color corporativo Wompi --}}
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 1rem auto;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .wompi-button { margin-top: 20px; }
    </style>
</head>
<body>

    <div class="payment-card">
        <img src="https://static.wompi.co/img/logos/wompi-logo.png" alt="Wompi" style="max-width: 140px; margin-bottom: 1rem;">
        
        <h3 class="h5 mb-2">{{ __('Preparando tu pago') }}</h3>
        <p class="text-muted mb-4">{{ __('Orden #') }}{{ $order_id }}</p>
        
        <div class="loader"></div>
        <p class="small text-muted">{{ __('Estamos conectando con la pasarela segura...') }}</p>

        {{-- WIDGET OFICIAL --}}
        <form>
            <script 
                src="https://checkout.wompi.co/widget.js" 
                data-render="button" 
                data-public-key="{{ $public_key }}" 
                data-currency="COP" 
                data-amount-in-cents="{{ $amount }}" 
                data-reference="{{ $order_id }}" 
               data-redirect-url="{{ url('/success') }}">
            </script>
        </form>
    </div>

    <script>
        /** *  este script hace que el botón de Wompi se presione solo 
         * apenas cargue la página, para que el cliente no tenga que esperar.
         */
        window.onload = function() {
            // Buscamos el botón que genera el script de Wompi
            var btn = document.querySelector('.wompi-button');
            if (btn) {
                btn.click(); 
            } else {
                // Si por el internet lento no ha cargado, reintentamos en 1 segundo
                setTimeout(function() {
                    var retryBtn = document.querySelector('.wompi-button');
                    if (retryBtn) retryBtn.click();
                }, 1500);
            }
        };
    </script>
</body>
</html>