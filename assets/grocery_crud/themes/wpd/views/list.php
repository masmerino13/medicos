

<?php 
 $url1="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//echo $funcion;
$column_width = (int)(80/count($columns));
if (!isset($texto)) {
	$texto = "";
}
?>
<div class="row-fluid">

                        <div class="span12">

                            <div class="box gradient">

                                <div class="title">
                                    <h4>
                                        <span><?php echo $subject?></span>
                                    </h4>
                                </div>
                                 <div class="content noPad clearfix">
		<table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
		<thead>
			<tr>				
				<?php foreach($columns as $column){?>
				<th>
					<?php echo $column->display_as?>
				</th>	
				<?php }?>
				<?php if(!$unset_delete || !$unset_edit || !empty($actions) || $texto){?>
				<th>				
						<?php echo $this->l('list_actions'); ?>
				</th>
				<?php }?>
			</tr>
		</thead>		
		<tbody>
<?php foreach($list as $num_row => $row){ ?>        
		<tr  <?php if($num_row % 2 == 1){?>class="erow"<?php }?>>
			<?php foreach($columns as $column){?>
			<td>
				<?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ; ?>
			</td>
			<?php }?>
		

			<?php if(!$unset_delete || !$unset_edit || !empty($actions) ||$texto){?>
			<td align="left" style="width:20%">
				<div class='tools'>
					<div class="btn-group">
							<button class="btn"><?php echo $this->l('list_actions'); ?></button>
							<button class="btn dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<?php
								}
								if(!empty($row->action_urls)){
									foreach($row->action_urls as $action_unique_id => $action_url){
										$action = $actions[$action_unique_id];
										?>

										<li>
											<a custom="<?php echo $action_url; ?>" href="<?php echo $action_url; ?>" class="acciones <?php echo $action->css_class; ?> crud-action" title="<?php echo $action->label?>">
												<span class="icon16 <?php echo $action->image_url; ?>"></span>
											<?php											
											echo ' '.$action->label;
											?>
											</a>
										</li>	
										<?php

									}
								}

								if(!$unset_edit){?>
									<li>
										<a href="<?php echo $row->edit_url?>" title="<?php echo $this->l('list_edit')?> <?php echo $subject?>">
											<span class="icon16  icon-pencil"></span>
											<?php echo $this->l('list_edit'); ?>
										</a>
									</li>
								<?php
								if(!$unset_delete){?>
									<li>
										<a href="<?php echo $row->delete_url?>" data-target-url="<?php echo $row->delete_url?>" title="<?php echo $this->l('list_delete')?> <?php echo $subject?>" class="delete-row" >
											<span class='icon16  icon-trash'></span>
											<?php echo $this->l('list_delete'); ?>
										</a>
									</li>
								<?php
								}								
								?>
								</ul>
							</div>
			</td>
			<?php }?>
		</tr>
<?php } ?>        
		</tbody>
		</table>
		 </div>
	</div><!-- End .box -->

                        </div><!-- End .span12 -->

                    </div><!-- End .row-fluid -->

<script>
function refresh(refreshh){
$.ajax({
  url: refreshh+"/ajax_list",
  success: function(data){  
  	$('#ajax_list').html(data);    
  }
});
}
</script>