<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elige tu Plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">$0</p>

            <form action="/finalizar-registro/gratis" method="POST">
                <input type="submit" class="paquete__submit" value="Incripción Gratis">
            </form>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a Talleres y Conferencias</li>
                <li class="paquete__elemento">Acceso a las Grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y Bebida</li>
            </ul>
            <p class="paquete__precio">$199</p>
            
            <!-- Set up a container element for the button -->
            <div id="paypal-button-container"></div>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Enlace a Talleres y Conferencias</li>
                <li class="paquete__elemento">Acceso a las Grabaciones</li>
            </ul>
            <p class="paquete__precio">$49</p>

            <!-- Set up a container element for the button -->
            <div id="paypal-button-container--virtual"></div>
        </div>
    </div>
</main>


<!-- Replace "test" with your own sandbox Business account app client ID -->
<script 
    src="https://www.paypal.com/sdk/js?client-id=ATq1MZqHJCSasKT_nU6yTXur5n4MzeDPHy1iHuQLQW_bwpP10jfE70WEmaPPEJCRERPJ0pRUuXV48Ye0&currency=USD"

    data-sdk-integration-source='button-factory'
></script>

<script>
function createOrder() {
  paypal.Buttons({
    style: {
        shape: 'rect',
        color: 'blue',
        layout: 'vertical',
        label: 'pay',
    },

    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
            "description": "1",
            "amount": {"currency_code":"USD","value":199}
        }]
      });
    },

    onApprove: function(data, actions) {
      return actions.order.capture().then(function(orderData){

        const datos = new FormData();
        datos.append('paquete_id', orderData.purchase_units[0].description);
        datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

        url = '/finalizar-registro/pagar';
        fetch(url,{
            method: 'POST',
            body: datos
        })
        .then(response => response.json())
        .then(resultado => {
            if(resultado.resultado) {
                // actions.redirect('http://localhost:3000/finalizar-registro/conferencias');
                console.log(resultado);
            }
        })

      })
    },

    onError: function(err) {
        console.log(err);
    }
  }).render('#paypal-button-container');

  paypal.Buttons({
    style: {
        shape: 'rect',
        color: 'blue',
        layout: 'vertical',
        label: 'pay',
    },

    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
            "description": "2",
            "amount": {"currency_code":"USD","value":49}
        }]
      });
    },

    onApprove: function(data, actions) {
      return actions.order.capture().then(function(orderData){

        const datos = new FormData();
        datos.append('paquete_id', orderData.purchase_units[0].description);
        datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

        url = '/finalizar-registro/pagar';
        fetch(url,{
            method: 'POST',
            body: datos
        })
        .then(response => response.json())
        .then(resultado => {
            if(resultado.resultado) {
                // actions.redirect('http://localhost:3000/finalizar-registro/conferencias');
                
                console.log(resultado);
            }
        })

      })
    },

    onError: function(err) {
        console.log(err);
    }
  }).render('#paypal-button-container--virtual');
}
createOrder()
</script>
