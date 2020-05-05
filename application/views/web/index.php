<?php if ($this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>

  <div id="panel_app">

    <div id="user_box">

      <img src="<?php echo site_url('/resources/photos/baner.jpg'); ?>" style="position: relative;  width:100%; height:100%; " alt="">

    </div>

    <div id="divBoton">
      <ul id="button">
        <li><a href=”#”>Inicio</a></li>
        <li><a href=”#”>Quienes Somos</a></li>
        <li><a href=”#”>Servicios</a></li>
        <li><a href=”#”>Galería</a></li>
        <li><a href=”#”>Contacto</a></li>
      </ul>
    </div>
    <br>

    <div id="main_panel">
      <label id="label" >Titulo de sección</label>
      <p id="parrafo" >Cada vez que escribo una entrada en este blog mis compañeros de estudio se burlan un poco. Dicen que sufro de incontinencia, 
        que no manejo adecuadamente los códigos de un blog, que me extiendo demasiado. ¡Si ya lo decía mi magnífico profesor de Literatura 
        en el colegio! «¿Los haces a peso?», recuerdo que anotó un día —seguramente abrumado— en uno de mis muchos trabajos de comentario de texto.
        Supongo que tienen razón. Mis compañeros, quiero decir. En la era de Twitter hay que ceñirse a los 140 caracteres de rigor. En Twitter, porque 
        no hay otro remedio; y en casi todo lo demás, porque el personal no está dispuesto a ir más allá. Se cansa. Se dispersa.
        Pues, miren, no: no estoy de acuerdo, no me gusta, no me interesa. Me parece imprescindible iniciar un activismo feroz en contra de Twitter y 
        de los valores que esta red ¿social? representa. No es verdad —necesariamente— que lo bueno, si breve, sea dos veces bueno. No, al menos, para 
        la construcción de una sociedad verdaderamente abierta y dialogante. En Twitter no se habla. En Twitter no se escucha. En Twitter se trata de
        hacer carambolas y de batir récords de seguimiento. Pura vanidad. ¿Quizá como este blog?
        Cada vez que escribo una entrada en este blog mis compañeros de estudio se burlan un poco. Dicen que sufro de incontinencia, 
        que no manejo adecuadamente los códigos de un blog, que me extiendo demasiado. ¡Si ya lo decía mi magnífico profesor de Literatura 
        en el colegio! «¿Los haces a peso?», recuerdo que anotó un día —seguramente abrumado— en uno de mis muchos trabajos de comentario de texto.
        Supongo que tienen razón. Mis compañeros, quiero decir. En la era de Twitter hay que ceñirse a los 140 caracteres de rigor. En Twitter, porque 
        no hay otro remedio; y en casi todo lo demás, porque el personal no está dispuesto a ir más allá. Se cansa. Se dispersa.
        Pues, miren, no: no estoy de acuerdo, no me gusta, no me interesa. Me parece imprescindible iniciar un activismo feroz en contra de Twitter y 
        de los valores que esta red ¿social? representa. No es verdad —necesariamente— que lo bueno, si breve, sea dos veces bueno. No, al menos, para 
        la construcción de una sociedad verdaderamente abierta y dialogante. En Twitter no se habla. En Twitter no se escucha. En Twitter se trata de
        hacer carambolas y de batir récords de seguimiento. Pura vanidad. ¿Quizá como este blog?</p>

    </div>
  </div>


<?php
} else {
  header("location: " . base_url()); //dirección de arranque especificada en config.php y luego en routes.php
}
?>