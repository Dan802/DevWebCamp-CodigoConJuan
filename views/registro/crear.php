<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elige tu plan</p>

    <div class="paquetes__grid">
        <div class="paquete" <?php aos_animacion(); ?>>
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a TetrisCoders</li>
            </ul>

            <p class="paquete__precio">$0</p>

            <form action="/finalizar-registro/gratis" method="POST">
                <input type="submit" class="paquetes__submit" value="Inscripción Gratis">
            </form>
        </div>

        <div class="paquete" <?php aos_animacion(); ?>>
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a TetrisCoders</li>
                <li class="paquete__elemento">Pase por dos días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>

            <p class="paquete__precio">$129</p>

            <!-- Paypal -->
            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div><!-- Paypal -->

        </div>

        <div class="paquete" <?php aos_animacion(); ?>>
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Pase por dos días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>

            <p class="paquete__precio">$15</p>

            <!-- Paypal -->
            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container-virtual"></div>
                </div>
            </div><!-- Paypal -->
        </div>
    </div>
</main>

<!-- PAYPAL -->
<!-- Reemplazar CLIENT_ID por tu client id proporcionado al crear la app desde el developer dashboard) -->
<script src="https://www.paypal.com/sdk/js?client-id=AXXYJVHzOtkrBF-XWOZVAsgMO1AmLqfYdX7UYZiodb6023mdSGVypDJ-FRC_E4-tES-iEcjSCdNDailK&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
 
<script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":129}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
 
            // Full available details
            // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
 
            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Gracias por tu pago!</h3>';

            // Creamos los datos a enviar a la API en PHP
            const datos = new FormData();
            datos.append('paquete_id', orderData.purchase_units[0].description);
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

            // Eviamos los datos a la API en PHP
            fetch('/finalizar-registro/pagar', {
              method: 'POST', // El metodo default es GET
              body: datos
            })
            .then( respuesta => respuesta.json())
            .then( resultado => {
              if(resultado.resultado){
                actions.redirect(window.location.href = '/finalizar-registro/conferencias');
              }
            })
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');

      // SEGUNDO BOTON PLAN VIRTUAL
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"2","amount":{"currency_code":"USD","value":15}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
 
            // Full available details
            // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
 
            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container-virtual');
            element.innerHTML = '';
            element.innerHTML = '<h3>Gracias por tu pago!</h3>';

            // Creamos los datos a enviar a la API en PHP
            const datos = new FormData();
            datos.append('paquete_id', orderData.purchase_units[0].description);
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);
            datos.append('regalo_id', 0);

            // Eviamos los datos a la API en PHP
            fetch('/finalizar-registro/pagar', {
              method: 'POST', // El metodo default es GET
              body: datos
            })
            .then( respuesta => respuesta.json())
            .then( resultado => {
              if(resultado.resultado){
                actions.redirect(window.location.href = '/finalizar-registro/conferencias');
              }
            })
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container-virtual');
    }
 
  initPayPalButton();
</script>