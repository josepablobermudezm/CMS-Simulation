<?php if($this->session->userdata['logged_in']['logged_in']==TRUE){ ?>

<div id="panel_app">

  <div id="user_box">
      <?php 
        echo "<img src='" . site_url('/resources/photos/' . $this->session->userdata['logged_in']['photo']) 
        . "' alt='photo_profile'  width=50 id='photo_profile' />" . 
        "<span>HOLA! "  . $this->session->userdata['logged_in']['realname'] . ".</span>" ;
      ?>

    <div id="logout">
        <?php echo form_open('twitter/index');?>
        <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
        <?php echo form_close();?>
    </div>

  </div>

  <div id="post_box">

    <?php echo form_open('twitter/edit/'. $tweet['tweets_id'],'onsubmit="send()"');?>
      <br>
      <textarea cols="4" rows="6" id="txt_post" name="txt_post" placeholder="Escribe algo!" tabindex="1"><?php echo ($this->input->post('txt_post') ? $this->input->post('txt_post') : $tweet['post']); ?></textarea>
      <button type="submit" id="btn_edit" name="btn_edit" value="btn_edit" class="boton" tabindex="2" title="Editar">Editar</button>

      <span style="color: #f00"><?php echo form_error('txt_post');?></span>
    <?php echo form_close();?>

  </div>
</div>


<?php 
    }else {
        header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
    } 
?>