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
          <select name="secciones">
            <option value="0" selected>Elegir Sección</option>
            <?php foreach ($sections as $s) { ?>
              <option value="<?php echo $s['id_secciones']; ?>"><?php echo $s['titulo']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="row">
          <input type="file" name="txt_file" id="txt_file" size="20" accept="image/jpeg,image/gif,image/png" class="btn btn-info" />
        </div>
        <div class="row">
          <input id="titulo" class="input" name="titulo" type="text" value="" placeholder="Titulo" size="30" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div class="row">
          <textarea id="descripcion" class="input" name="descripcion" placeholder="Descripción" rows="7" cols="30"></textarea><br />
          <span id="message_validation" class="error_message"></span>
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