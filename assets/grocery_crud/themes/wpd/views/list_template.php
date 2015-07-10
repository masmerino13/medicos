<script type='text/javascript'>
	var base_url = '<?php echo base_url();?>';

	var subject = '<?php echo $subject?>';
	var ajax_list_info_url = '<?php echo $ajax_list_info_url?>';
	var unique_hash = '<?php echo $unique_hash; ?>';

	var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";
	

</script>
<div id="hidden-operations"></div>
<div id='report-error' class='report-div error'></div>
<div id='report-success' class='report-div success report-list' <?php if($success_message !== null){?>style="display:block"<?php }?>><?php 
if($success_message !== null){?>
	<p><?php echo $success_message; ?></p>
<?php }
?></div>	
<div class="satelite" style='width: 100%;'>
	<div id='main-table-box'>
	
	<?php if(!$unset_add || !$unset_export || !$unset_print){?>
	<div class="row-fluid">
		<div class="span8">
			<?php if(!$unset_add){?>
			<a class="btn btn-primary" href="<?php echo $add_url?>" title="<?php echo $this->l('list_add'); ?> <?php echo $subject?>">
                <span class="icon16 icomoon-icon-file-add white"></span>
                <strong><?php echo $this->l('list_add'); ?> <?php echo $subject?></strong></a>
			<?php }?>
		</div>
		<div class="span4">
			<?php if(!$unset_export) { ?>
        	<a class="btn btn-info" href="<?php echo $export_url; ?>" target="_blank">
				<span class="icon16 icomoon-icon-file-excel white"></span>
				<?php echo $this->l('list_export');?>				
            </a>
           
			<?php } ?>
			<?php if(!$unset_print) { ?>
        	<a class="btn btn-info" href="<?php echo $print_url; ?>">
        		<span class="icon16 icomoon-icon-printer white"></span>
				<?php echo $this->l('list_print');?>
            </a>
			</div>
			<?php }?>						
		
		<div class='clear'></div>
	</div>
	<?php }?>
	
	<div id='ajax_list'>
		<?php echo $list_view?>
	</div>
	</div>
</div>
