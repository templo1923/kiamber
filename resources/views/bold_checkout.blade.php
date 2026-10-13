<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procesando Pago Seguro</title>
    @include('style')
    <style>
        body { background: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: sans-serif; }
        #bold-payment-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); z-index: 9999; display: flex; align-items: center; justify-content: center; }
        .modal-content { background: white; border-radius: 15px; padding: 40px; max-width: 450px; width: 90%; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        .icon-box { width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 30px; }
        .progress-container { width: 100%; height: 4px; background: #f0f0f0; border-radius: 2px; overflow: hidden; margin: 30px 0; }
        #bold-progress-bar { width: 0%; height: 100%; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 2s ease-in-out; }
        .bold-checkout-button-container { display: none !important; }
    </style>
</head>
<body>
    <div id="bold-payment-modal">
        <div class="modal-content">
            <div class="icon-box">💳</div>
            <h2 style="color: #333; margin: 0 0 10px; font-size: 24px;">Procesando Pago</h2>
            <p style="color: #666; margin: 0;">Redirigiendo a BOLD para completar tu pago...</p>
            <h3 style="color: #ef434e; margin-top: 15px;">${{ number_format($amount, 0, ',', '.') }} COP</h3>

            <div class="progress-container">
                <div id="bold-progress-bar"></div>
            </div>
            
            <div id="bold-payment-button-container">
                <script src="https://checkout.bold.co/library/boldPaymentButton.js"></script>
                <script 
                    data-bold-button="1" 
                    data-api-key="{{ $api_key }}" 
                    data-order-id="{{ $order_id }}" 
                    data-currency="COP" 
                    data-amount="{{ $amount }}" 
                    data-integrity-signature="{{ $integrity_signature }}"
                    data-redirection-url="{{ isset($is_subscription) ? route('subscription.bold.success') : url('/bold-success') }}?ord={{ $order_id }}"
                    data-description="Pedido Kiamber #{{ $order_id }}">
                </script>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            document.getElementById("bold-progress-bar").style.width = "100%";
            var checkBtn = setInterval(function() {
               var btn = document.querySelector('.bold-button');
               if (btn) {
                  btn.click();
                  clearInterval(checkBtn);
               }
            }, 400);
        };
    </script>
</body>
</html>