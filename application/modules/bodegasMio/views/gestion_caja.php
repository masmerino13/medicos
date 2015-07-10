 <form method="post">
 <div class="box">
 	<div class="title">
 		<h4>
 			<span class="icon16 icomoon-icon-equalizer-2"></span>
 			<span><?=ucwords($estado)?> de caja</span>
 		</h4>
 		<a href="#" class="minimize" style="display: none;">Minimize</a>
 	</div>
 	<div class="content" style="display: block;">

 		<div class="form-row row-fluid">
 			<label class="span3">Cajas: </label>
 			<div class="span6 controls">
 				<select id="cmb_caja" name="cmb_caja">
 					<option value="0">Seleccione una caja</option>
 					<?php foreach ($cajas as $caja) { ?>
 					<option value="<?=$caja['caj_id']?>"><?=$caja['caj_nombre']?></option>
 					<?php } ?>
 				</select>
 			</div>
 		</div>

 		<div class="form-row row-fluid">
 			<label class="span3">Cantidad de <?=$estado?>: </label>
 			<div class="span6 controls">   
 				<input type="text" id="txt_cantidad" name="txt_cantidad" />
 			</div>
 		</div>

 		<div class="form-actions">
 			<button type="submit" id="btn_agregar_articulo" name="btn_agregar_articulo" class="btn btn-success">
 				<span class="icon16 icomoon-icon-coins white"></span>Realizar <?=$estado?>
 			</button>
 		</div>
 	</div>
 </div>
 </form>
 