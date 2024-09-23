<?php
    use Model\Ponente;
    include_once __DIR__ .'/conferencias.php';
 ?>

 <section class="resumen">
    <div class="resumen__grid">
        <div data-aos="<?php aos_animacion(); ?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $ponentes_total; ?></p>
            <p class="resumen__texto">Profesionales</p>
        </div>

        <div data-aos="<?php aos_animacion(); ?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $conferencias_total; ?></p>
            <p class="resumen__texto">Conferencias</p>
        </div>

        <div data-aos="<?php aos_animacion(); ?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $workshops_total; ?></p>
            <p class="resumen__texto">Workshops</p>
        </div>

        <div data-aos="<?php aos_animacion(); ?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero">500</p>
            <p class="resumen__texto">Asistentes</p>
        </div>
    </div>
 </section>

 <section class="profesionales">
    <h2 class="profesionales__encabezado">Profesionales</h2>
    <p class="profesionales__descripcion">Conoce a nuestros expertos de DevWebCamp</p>

    <div class="profesionales__grid">
    <?php foreach ($ponentes as $ponente) { ?>
        <div data-aos="<?php aos_animacion(); ?>" class="profesional">
            <picture>
                <source srcset="/img/ponentes/<?php echo $ponente->imagen; ?>.webp" type="image/webp">
                <source srcset="/img/ponentes/'<?php echo $ponente->imagen; ?>.png" type="image/png">
                <img class="profesional__imagen" loading="lazy" width="200" height="300" src="/img/ponentes/<?php echo $evento->ponente->imagen; ?>.png" alt="Imagen ponente">
            </picture>

            <div class="profesional__informacion">
                <h4 class="profesional__nombre">
                    <?php echo $ponente->nombre . ' ' . $ponente->apellido; ?>
                </h4>
                <p class="profesional__ubicacion">
                    <?php echo $ponente->ciudad . ', ' . $ponente->pais; ?>
                </p>

                <nav class="profesional-sociales">
                    <?php
                        $redes = json_decode ($ponente->redes);
                    ?>

                    <?php if(!empty($redes->facebook)) { ?>
                        <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook; ?>">
                            <i class="fa-brands fa-facebook-f"></i>
                            <span class="profesional-sociales__ocultar">Facebook</span> <!--  Para la accesibilidad -->
                        </a> 
                    <?php } ?>

                    <?php if(!empty($redes->twitter)) { ?>
                        <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->twitter; ?>">
                            <i class="fa-brands fa-twitter"></i>
                            <span class="profesional-sociales__ocultar">Twitter</span>
                        </a> 
                    <?php } ?>

                    <?php if(!empty($redes->youtube)) { ?>
                        <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->youtube; ?>">
                            <i class="fa-brands fa-youtube"></i>
                            <span class="profesional-sociales__ocultar">YouTube</span>
                        </a> 
                    <?php } ?>

                    <?php if(!empty($redes->instagram)) { ?>
                        <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram; ?>">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="profesional-sociales__ocultar">Instagram</span>
                        </a> 
                    <?php } ?>

                    <?php if(!empty($redes->tiktok)) { ?>
                        <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->tiktok; ?>">
                            <i class="fa-brands fa-tiktok"></i>
                            <span class="profesional-sociales__ocultar">Tiktok</span>
                        </a> 
                    <?php } ?>

                    <?php if(!empty($redes->github)) { ?>
                        <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->github; ?>">
                            <i class="fa-brands fa-github"></i>
                            <span class="profesional-sociales__ocultar">Github</span>
                        </a>
                    <?php } ?>
                </nav>

                <ul class="profesional__listado-aptitudes">
                    <?php 
                    $tags = explode(',', $ponente->tags);
                    foreach ($tags as $tag) { ?>
                        <li class="profesional__aptitud">
                            <?php echo $tag; ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
    </div>
 </section>

 <div id="mapa" class="mapa"></div>

 <section class="pases">
    <h2 class="pases__encabezado">Pases & precios</h2>
    <p class="pases__descripcion">Precios para WebDevCamp</p>

    <div class="pases__grid">
        <div data-aos="<?php aos_animacion(); ?>" class="pase pase--presencial">
            <h4 class="pase__logo">&#60;DevWebCamp /></h4>
            <p class="pase__plan">Presencial</p>
            <p class="pase__precio">199€</p>
        </div>
        <div data-aos="<?php aos_animacion(); ?>" class="pase pase--virtual">
            <h4 class="pase__logo">&#60;DevWebCamp /></h4>
            <p class="pase__plan">Virtual</p>
            <p class="pase__precio">49€</p>
        </div>
        <div data-aos="<?php aos_animacion(); ?>" class="pase pase--gratis">
            <h4 class="pase__logo">&#60;DevWebCamp /></h4>
            <p class="pase__plan">Gratuito</p>
            <p class="pase__precio">Gratis - 0€</p>
        </div>
    </div>

    <div class="pase__enlace-contenedor">
        <a href="/paquetes" class="pase__enlace">Ver paquetes</a>
    </div>
 </section>