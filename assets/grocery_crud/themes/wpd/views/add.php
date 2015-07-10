<?php  

	//$this->set_css($this->default_theme_path.'/satelite/css/flexigrid.css');	
	//$this->set_js($this->default_theme_path.'/satelite/js/jquery.form.js');	
	$this->set_js($this->default_theme_path.'/wpd/js/flexigrid-add.js');
	
?>

<div class="row-fluid">
	<div class="box">
	    <div class="title">
	        <h4> 
	            <span><?php echo $this->l('form_add'); ?> <?php echo $subject?></span>
	        </h4>
	    </div>
	    <div class="content">	    	
	<?php echo form_open( $insert_url, 'method="post" id="crudForm" autocomplete="off" enctype="multipart/form-data"'); ?>
	<div class="span6">

			<?php
			$counter = 0; 
			$i=0;
			$total=count($fields)/2;
				foreach($fields as $field)
				{
					if($total>=$i)
					{
					$even_odd = $counter % 2 == 0 ? 'odd' : 'even';
					$counter++;
			?>
			<div class='form-field-box <?php echo $even_odd?>' id="<?php echo $field->field_name; ?>_field_box span12">
				<label class="form-label span3">
					<?php echo $input_fields[$field->field_name]->display_as?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""?>
				</label>
				<div class='form-input-box' id="<?php echo $field->field_name; ?>_input_box">
					<div class="span9 controls">
					<?php echo $input_fields[$field->field_name]->input?>
					</div>
				</div>
				<div class='clear'></div>	
			</div>
			<?php }
			$i++;
			}?>
			</div>

			<div class="span6">

			<?php
			$counter = 0; 
			$i=0;
			$total=count($fields)/2;
				foreach($fields as $field)
				{
					if($total<$i)
					{
					$even_odd = $counter % 2 == 0 ? 'odd' : 'even';
					$counter++;
			?>
			<div class='form-field-box <?php echo $even_odd?>' id="<?php echo $field->field_name; ?>_field_box span12">
				<label class="form-label span3">
					<?php echo $input_fields[$field->field_name]->display_as?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""?>
				</label>				
				<div class='form-input-box' id="<?php echo $field->field_name; ?>_input_box">
					<div class="span9 controls">
					<?php echo $input_fields[$field->field_name]->input?>
					</div>
				</div>
				<div class='clear'></div>	
			</div>
			<?php }
			$i++;
			}?>
			</div>
			<!-- Start of hidden inputs -->
				<?php 
					foreach($hidden_fields as $hidden_field){
						echo $hidden_field->input;
					}
				?>
			<!-- End of hidden inputs -->
			
			
			<div id='report-error' class='report-div error'></div>
			<div id='report-success' class='report-div success'></div>							
			
		<div class="clear"></div>

		<div class="pDiv">
			<p>
				<button type='submit'  class="btn btn-success">
					<span class="icon16 icomoon-icon-checkmark white"></span>
					<?php echo $this->l('form_save'); ?>
				</button>
			
<?php 	if(!$this->unset_back_to_list) { ?>				
			
				<button type='button'  id="save-and-go-back-button"  class="btn btn-success">
					<span class="icon16 icomoon-icon-loop white"></span>
					<?php echo $this->l('form_save_and_go_back'); ?>
				</button>
			
			
				<button type='button' onclick="javascript: goToList()"  class="btn btn-danger" >
					<span class="icon16 icomoon-icon-cancel-2 white"></span>
					<?php echo $this->l('form_cancel'); ?>
				</button>
			
<?php 	} ?>	
			</p>					
			<div class='form-button-box'>
				
			</div>
			<div class='clear'></div>	
		</div>
	<?php echo form_close(); ?>
</div>
</div>
</div>
<script>
	var validation_url = '<?php echo $validation_url?>';
	var list_url = '<?php echo $list_url?>';

	var message_alert_add_form = "<?php echo $this->l('alert_add_form')?>";
	var message_insert_error = "<?php echo $this->l('insert_error')?>";
</script>