<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>

  <div id="panel_app">

    <div id="user_top">
      <?php echo "<label> Bienvenido ".$this->session->userdata['logged_in']['realname'] . "</label>"; ?> 
      <?php echo form_open_multipart('admin/logout'); ?>
      <button type="submit" name="btn_logout" id="btn_logout" class="boton" title="Salir">&#10005</button>
      <?php echo form_close(); ?> 
      

    </div>
    
    <div id="divBoton">

      <div id="menu2"> <button  id="menu" onclick="change('div_secciones')">Editar Secciones</button> </div>
      <div id="menu2"><button id="menu" onclick="change('usuarios')">Agregar/Editar Usuarios</button> </div>
    </div>
    
    <div id="divGrande">
      <div id="div_secciones" class="main_panel1">
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
          <input class="submit_button" type="submit" value="Guardar" />
        </div>
        <div id="caja_delete_serv">
          <input id="btn_eliminarServ" type="button" value="Eliminar Servicio" onclick="EliminarServicio()" />
        </div>
        <?php echo form_close(); ?>
      </div>
      <?php echo form_open_multipart('admin/guardarUsuario/'); ?>
      <div id="usuarios" class="main_panel2">
        <div class="row">
          <select id="usuarios" name="usuarios" onclick="BlockUser(this)">
            <option value="0" selected>Elegir un Usuario</option>
            <?php foreach ($users as $u) { ?>
              <option id="user_<?php echo $u['users_id'];?>" value="<?php echo $u['users_id']; ?>">
                <?php echo $u['realname']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="row">
          <input id="txt_nombre" class="txt_nombre" name="txt_nombre" type="text" value="" placeholder="Nombre Real" size="64" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div class="row">
          <input id="txt_correo" class="txt_correo" name="txt_correo" type="text" value="" placeholder="Correo" size="50" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div class="row">
          <input id="txt_usuario" class="txt_usuario" name="txt_usuario" type="text" value="" placeholder="Nombre de usuario" size="64" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div class="row">
          <input id="txt_clave" class="txt_clave" name="txt_clave" type="password" value="" placeholder="Clave" size="128" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div class="row">
          <input class="submit_button" type="submit" value="Guardar" />
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>


  </div>


  <?php
} else {
  header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>