  <div id="panel_app">
    <div id="user_box">
      <img id="img" src="<?php echo site_url('/resources/photos/1.jpg'); ?>" style="position: relative;  width:100%; height:100%; ">
    </div>
    <div id="divBoton">
      <ul id="button">
        <?php foreach ($sections as $s) { ?>
          <li id="<?php echo $s['id_secciones']; ?>" onclick="ChangeDiv(<?php echo $s['id_secciones']; ?>,'<?php echo site_url('/resources/photos/'); ?>'+'<?php echo $s['imagen']; ?>')"><a><?php echo $s['nombre']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
    <br>
    <div id="divGrande">
      <?php foreach ($sections as $s) { ?>
        <?php if ($s['nombre'] != 'Servicios' && $s['nombre'] != 'Galería' && $s['nombre'] != 'Contacto' && $s['nombre'] != 'Quienes Somos') { ?>
          <div id="div_<?php echo $s['id_secciones']; ?>" class="main_panel1">
            <label id="label"><?php echo $s['titulo']; ?></label>
            <p id="parrafo"><?php echo $s['detalle']; ?></p>
          </div>
        <?php } ?>
      <?php } ?>
      <div id="div_2" class="main_panel2">
        <label id="label">Quienes Somos</label>
        <p id="parrafo">Transformación de marcas

          Nos apasiona ayudar a las marcas a encontrar su voz creativa. Fundado(a) en el año 2017, nuestro(a) Agencia de publicidad busca ayudar a nuestros clientes a
          triunfar en un mundo en constante cambio y a que aprovechen sus fortalezas para crear un mapa personalizado hacia el éxito. Estamos aquí para hacer que tu
          vida sea más fácil: consúltanos cómo podemos ayudarte.
          Nos enfocamos en entregar nuestros productos de una forma virtual mediante el uso de nubes de información.

          LO HACEMOS BIEN

          Nuestro enfoque a Fotografía y video le dará a tu negocio el toque extra de adrenalina que necesita. Ya sea que tengamos que comenzar desde cero o que nos
          contrates para asesorarte en tu visión creativa, trabajaremos juntos para lograr los mejores resultados posibles.

          CAMPAÑAS PUBLICITARIAS
          Deja que nos encarguemos de todo
          Impulsa tu identidad de marca y no pierdas potenciales clientes con nuestro extraordinario servicio de publicidad. Trabajamos juntos para combinar nuestras
          visiones creativas e idear algo realmente espectacular. El costo por una campaña de publicidad depende de cuantas personas quiera el cliente alcanzar, pero
          se pueden estimar unos 10$ por cada 1000 clientes potenciales alcanzados.

          ANUNCIOS COMERCIALES
          Resultados que te encantarán

          Con nuestro servicio de Anuncios Comerciales, nuestro equipo creativo se tomará el tiempo necesario para comprender tu marca y encontrar la forma más
          efectiva que transmitir el mensaje a tu audiencia. Desde estrategia hasta la implementación, tenemos todas las respuestas</p>
      </div>
    </div>
  </div>