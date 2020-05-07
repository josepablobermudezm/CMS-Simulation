<?php if($this->session->userdata['logged_in']['logged_in']==TRUE){ ?>

  <div id="panel_app">

    <div id="user_box2">
      <?php echo "<span>Bienvenido " . $this->session->userdata['logged_in']['realname'] . "</span>"; ?> </a>
      <div id="logout">
        <?php echo form_open('auth/logout');?>
        <button type="submit" name="btn_logout" id="btn_logout" class="boton" title="Salir">🗙</button>
        <?php echo form_close();?>
      </div>

    </div>

    <div id="post_box">



    </div>
    <br>
    <div id="main_panel">
      
    </div>
  </div>


  <?php 
}else {
        header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
      } 
      ?>