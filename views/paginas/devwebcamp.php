<main class="devwebcamp">
    <h2 class="devwebcamp__encabezado"><?php echo $titulo; ?></h2>
    <p class="devwebcamp__descripcion">Conoce la conferencia más importante de habla hispana</p>

    <div class="devwebcamp__grid">
        <div data-aos="<?php aos_animacion(); ?>" class="devwebcamp_imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/sobre_devwebcamp.jpg" alt="imagen devwebcamp">
            </picture>
        </div>

        <div data-aos="<?php aos_animacion(); ?>" class="devwebcamp__contenido">
            <p class="devwebcamp__texto">
            Praesent tortor odio, sagittis sit amet velit quis, vulputate suscipit ex. Integer ullamcorper blandit hendrerit. Nunc orci leo, cursus in ullamcorper ut, pretium ut nisl. Curabitur cursus ultricies ipsum, sit amet tempor orci placerat a. Duis id commodo tortor.</p>
            
            <p class="devwebcamp__texto">Phasellus hendrerit risus quis lectus commodo volutpat. Nulla enim urna, fringilla vitae dui in, posuere aliquam felis. Donec est arcu, sodales sed suscipit vitae, sodales eget ipsum.  </p>
        </div>
    </div>
</main>