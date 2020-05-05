<div id="panel_app">
    <div class="box-header">
      	<h2 class="box-title">Agregando Usuario</h2>
      	<?php echo form_open('twitter/index');?>
	    	<button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
	    <?php echo form_close();?>
    </div>
    <?php echo form_open('user/add'); ?>
  	<div id="edit_panel">
		<label for="txt_usuario" class="control-label"><span class="text-danger">* </span>Usuario:</label>
		<div class="form-group">
			<input type="text" name="txt_usuario" value="<?php echo $this->input->post('txt_usuario'); ?>" class="cajatexto" id="txt_usuario" />
			<span class="text-danger"><?php echo form_error('txt_usuario');?></span>
		</div>
		<label for="txt_clave" class="control-label"><span class="text-danger">* </span>Contraseña:</label>
		<div class="form-group">
			<input type="password" name="txt_clave" value="<?php echo $this->input->post('txt_clave'); ?>" class="cajatexto" id="txt_clave" />
			<span class="text-danger"><?php echo form_error('txt_clave');?></span>
		</div>
		<label for="txt_nombre" class="control-label"><span class="text-danger">* </span>Nombre Real:</label>
		<div class="form-group">
			<input type="text" name="txt_nombre" value="<?php echo $this->input->post('txt_nombre'); ?>" class="cajatexto" id="txt_nombre" />
			<span class="text-danger"><?php echo form_error('txt_nombre');?></span>
		</div>
		<br>
	  	<div class="box-footer">
	    	<button type="submit" class="boton">Guardar</button>
	  	</div>
    <?php echo form_close(); ?>
	</div>
</div>