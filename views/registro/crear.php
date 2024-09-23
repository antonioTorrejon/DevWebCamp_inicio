<main class="registro">
    <h2 class="registro__encabezado"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elige tu plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Plan gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete_elemento">Acceso virtual a DevWebcamp</li>
            </ul>

            <p class="paquete__precio">0€</p>

            <form method="POST" action="/finalizar-registro/gratis">
                <input 
                class="paquetes__submit"
                type="submit"
                value="Inscripción gratis"
                >
            </form>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">Plan presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete_elemento">Acceso presencial a DevWebcamp</li>
                <li class="paquete_elemento">Pase durante 2 días</li>
                <li class="paquete_elemento">Acceso a talleres y conferencias</li>
                <li class="paquete_elemento">Acceso a las grabaciones</li>
                <li class="paquete_elemento">Regalo de una camiseta del evento</li>
                <li class="paquete_elemento">Cmoida y bebida</li>
            </ul>

            <p class="paquete__precio">199€</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Plan virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete_elemento">Acceso virtual a DevWebcamp</li>
                <li class="paquete_elemento">Pase durante 2 días</li>
                <li class="paquete_elemento">Acceso a talleres y conferencias</li>
                <li class="paquete_elemento">Acceso a las grabaciones</li>
            </ul>

            <p class="paquete__precio">49€</p>
        </div>
    </div>
</main>


<script src="https://www.paypal.com/sdk/js?client-id=AWzD-CnKN_tyss9jKa4m_IuVRol06C3c_TsGv-F5cgIhElgfBDzXmHrhKFEA_aOFLGr6Uilz8ef3xCko&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
 
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
            purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":199}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {

            const url = window.location.origin + '/finalizar-registro/conferencias';
            const datos = new FormData();

            datos.append('paquete_id', orderData.purchase_units[0].description);
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

            fetch('/finalizar-registro/pagar', {
              method: 'POST',
              body: datos
            })
            .then(respuesta => respuesta.json())
            .then(resultado => {
              if(resultado.resultado){
                actions.redirect(url);
              }
            })
 
          });

        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
 
  initPayPalButton();
</script>