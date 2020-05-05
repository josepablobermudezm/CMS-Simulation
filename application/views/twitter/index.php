<?php if($this->session->userdata['logged_in']['logged_in']==TRUE){ ?>

  <div id="panel_app">

    <div id="user_box">

      <img src="" alt="">
      
      <div id="logout">
      </div>

    </div>

    <div id="post_box">
      <br>
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