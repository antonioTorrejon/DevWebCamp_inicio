<main class="pagina">
    <h2 class="pagina__encabezado"><?php echo $titulo; ?></h2>
    <p class="pagina__descripcion">Tu pase - Te recomendamos guardarlo</p>
    <p class="pagina__descripcion">Y te recordamos que puedes compartirlo en redes sociales</p>

    <div class="pase-virtual">
        <div class="pase pase--<?php echo strtolower($registro->paquete->nombre); ?> pase--acceso">
            <div class="pase__contenido">
                <h4 class="pase__logo">&#60;DevWebCamp /></h4>
                <p class="pase__plan"><?php echo $registro->paquete->nombre; ?></p>
                <p class="pase__nombre"><?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido ; ?></p>
            </div>

            <p class="pase__codigo"><?php echo '#' . $registro->token; ?></p>
        </div>
    </div>

</main>