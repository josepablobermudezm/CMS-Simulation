<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>

  <div id="panel_app">

    <div id="user_box2">
      <?php echo "<label>Bienvenido " . $this->session->userdata['logged_in']['realname'] . "</label>"; ?> </a>

      <!--<button type="submit" name="btn_logout" id="btn_logout" class="boton" title="Salir">salir</button>-->

    </div>

    <div id="divBoton">
      <ul id="button">
        <li id="EditarSeccion" onclick="ChangeDiv(this)"><a>Editar Secciones</a></li>
        <li id="SerccionUsuarios" onclick="ChangeDiv(this)"><a>Agregar/Editar Usuarios</a></li>
        <li id="SalirSeccion" onclick="ChangeDiv(this)"><a>Salir</a></li>
      </ul>
    </div>

    <div id="divGrande">
      <div id="div_6" class="main_panel1">
        <?php echo form_open_multipart('admin/editarGuardar/'); ?>
        <div class="row">
          <select id="secciones" name="secciones" onclick="BlockInput(this)">
            <option value="0" selected>Elegir Sección</option>
            <?php foreach ($sections as $s) { ?>
              <option id="<?php echo $s['id_secciones']; ?><?php echo $s['titulo']; ?><?php echo $s['imagen']; ?><?php echo $s['detalle']; ?>" value="<?php echo $s['id_secciones']; ?>"><?php echo $s['titulo']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="row">
          <input onchange="ChangeImage()" type="file" name="txt_file" id="txt_file" size="20" accept="image/jpeg,image/gif,image/png" class="btn btn-info" />
          <img id="imagenS" src="" alt="" height="40" width="60">
        </div>
        <div class="row">
          <input id="titulo" class="input" name="titulo" type="text" value="" placeholder="Titulo" size="30" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div class="row">
          <textarea id="descripcion" class="input" name="descripcion" placeholder="Descripción" rows="7" cols="30"></textarea><br />
          <span id="message_validation" class="error_message"></span>
        </div>

        <!-- Servicios -->

        <div id="TituloServicio" class="row2">
          <?php echo "<label>Deseas agregar o editar servicios?</label>"; ?> </a>
          <br>
          <select id="serviciosSELECT" name="serviciosSELECT" onclick="ServiceInput(this)">
            <option value="0" selected>Elegir Servicio</option>
            <?php foreach ($servicios as $s) { ?>
              <option id="<?php echo $s['id_servicio']; ?>" value="<?php echo $s['id_servicio']; ?>"><?php echo $s['titulo']; ?></option>
            <?php } ?>
          </select>
          <br>
          <input id="tituloS" class="input" name="tituloS" type="text" value="" placeholder="Titulo Servicio" size="30" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div id="DetalleServicio" class="row2">
          <input id="detalleS" class="input" name="detalleS" type="text" value="" placeholder="Detalle" size="30" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div id="Descripcionservicio" class="row2">
          <textarea id="descripcionS" class="input" name="descripcionS" placeholder="Descripción" rows="7" cols="30"></textarea><br />
          <span id="email_validation" class="error_message"></span>
        </div>

        <div id="ImagesBox">
          <div id="container2">
            <?php if (sizeof($images) > 0) { ?>
              <img id="expandedImg" src="<?php echo site_url('/resources/photos/') . $images[0]['imagen']; ?>" name="<?php echo $images[0]['id_imagen']; ?>" style="height:250px" alt="Descripcion: <?php echo $images[0]['descripcion']; ?>">
              <span id="close" onclick="deleteImg()" class="closebtn">&times;</span>
              <span onclick="before2()" class="beforebtn">&laquo;</span>
              <span onclick="next2()" class="nextbtn">&raquo;</span>
              <div id="imgDescription"></div>
            <?php } ?>
          </div>
          <div id="row2">
            <?php foreach ($images as $i) { ?>
              <div class="column2">
                <img src="<?php echo site_url('/resources/photos/') . $i['imagen']; ?>" id="<?php echo $i['imagen']; ?>" name="<?php echo $i['id_imagen']; ?>" alt="Descripcion: <?php echo $i['descripcion']; ?>" class="Imágenes2" onclick="enlargeImg(this);">
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="row">
          <input id="submit_button" type="submit" value="Guardar" />
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>


  </div>


<?php
} else {
  header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>