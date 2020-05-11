
  <div id="panel_app">
    <div id="user_box">
      <img id="img" src="<?php echo site_url('/resources/photos/' . $sections[0]['imagen']); ?>" style="position: relative;  width:100%; height:100%; ">
    </div>
    <div id="divBoton">
      <ul id="button">
        <?php foreach ($sections as $s) { ?>
          <li id="<?php echo $s['id_secciones']; ?>" onclick="ChangeDiv(<?php echo $s['id_secciones']; ?>,'<?php echo site_url('/resources/photos/'); ?>'+'<?php echo $s['imagen']; ?>')"><a><?php echo $s['titulo']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
    <br>
    <div id="divGrande">
      <?php foreach ($sections as $s) { ?>
        <?php if ($s['titulo'] != 'Servicios' && $s['titulo'] != 'Galería' && $s['titulo'] != 'Contacto' && $s['titulo'] != 'Quienes Somos' && $s['titulo'] != 'Inicio' ) { ?>
          <div id="div_<?php echo $s['id_secciones']; ?>" class="main_panel2">
            <label id="label"><?php echo $s['titulo']; ?></label>
            <p id="parrafo"><?php echo $s['detalle']; ?></p>
          </div>
        <?php } ?>
      <?php } ?>
      <div id="div_5" class="main_panel2">
        <label id="label">Servicios</label>
        <br>
        <div>
          <?php foreach ($servicios as $s) { ?>
            <div class="servicios">
              <div id="serv_titulo">
                <label><?php echo $s['titulo']; ?></label>
              </div>
              <div id="serv_descrip">
                <p id="descripcion"><?php echo $s['descripcion']; ?></p>
                <div class="detalles" id='det_<?php echo $s['id_servicio']; ?>'><?php echo $s['detalle']; ?></div>
              </div>
              <div><button class="btn_dets" onclick="MostrarDetalle(this,'det_<?php echo $s['id_servicio']; ?>')">Ver más</button></div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div id="div_1" class="main_panel1">
        <label id="label">Inicio</label>
        <p id="parrafo"><?php echo $inicio[0]['detalle']; ?></p>
      </div>
      <div id="div_2" class="main_panel2">
        <label id="label">Quienes Somos</label>
        <p id="parrafo"><?php echo $quienesSomos[0]['detalle']; ?></p>
      </div>
      <div id="after_submit"></div>
      <div id="div_6" class="main_panel2">
        <?php// echo form_open_multipart('web/correo/'); ?>
        <div class="row">
          <input id="name" class="input" name="name" type="text" value="" placeholder="Nombre" size="30" /><br />
          <span id="name_validation" class="error_message"></span>
        </div>
        <div class="row">
          <input id="email" class="input" name="email" type="text" value="" placeholder="Correo" size="30" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div class="row">
          <textarea id="message" class="input" name="message" placeholder="Mensaje" rows="7" cols="30"></textarea><br />
          <span id="message_validation" class="error_message"></span>
        </div>
        <div class="row">
          <input id="submit_button" type="button" value="Enviar" onclick="EnviarCorreo()" />
        </div>
        <?php //echo form_close(); ?>
      </div>

      <div id="div_4" class="main_panel2">
        <div class="container">
          <img id="expandedImg" src="<?php echo site_url('/resources/photos/') . $images[0]['imagen']; ?>" style="height:650px" alt="Descripcion: <?php echo $images[0]['descripcion']; ?>">
          <span onclick="before(this)" class="beforebtn">&laquo;</span>
          <span onclick="next(this)" class="nextbtn">&raquo;</span>
          <div id="imgDescription"></div>
        </div>

        <div class="row">
          <?php foreach ($images as $i) { ?>
            <div class="column">
              <img src="<?php echo site_url('/resources/photos/') . $i['imagen']; ?>" id="<?php echo $i['imagen']; ?>" alt="Descripcion: <?php echo $i['descripcion']; ?>" class="Imágenes" onclick="enlargeImg(this);">
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  </div>