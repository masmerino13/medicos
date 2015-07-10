 <form>
 <div class="box">
 	<div class="title">
 		<h4>
 			<span class="icon16 icomoon-icon-equalizer-2"></span>
 			<span>Agregar Articulos</span>
 		</h4>
 		<a href="#" class="minimize" style="display: none;">Minimize</a>
 	</div>
 	<div class="content" style="display: block;">

 		<div class="form-row row-fluid">
 			<label class="span3">Articulos: </label>
 			<div class="span6 controls">
 				<select id="cmb_articulo" name="cmb_articulo">
 					<option value="0">Seleccione un articulo</option>
 					<?php foreach ($articulos as $articulo) { ?>
 					<option value="<?=$articulo['art_id']?>" data-precio-neto="<?=$articulo['art_precio_neto']?>"><?=$articulo['art_nombre']?></option>
 					<?php } ?>
 				</select>
 			</div>
 		</div>

 		<div class="form-row row-fluid">
 			<label class="span3">Cantidad: </label>
 			<div class="span6 controls">   
 				<input type="text" id="txt_cantidad" name="txt_cantidad" />
 			</div>
 		</div>

 		<div class="form-actions">
 			<button type="button" disabled="true" id="btn_agregar_articulo" name="btn_agregar_articulo" class="btn btn-success">
 				<span class="icon16 icomoon-icon-cart-4 white"></span>Agregar Articulo
 			</button>
 		</div>
 	</div>
 </div>

 <div class="box">
 	<div class="title">
 		<h4>
 			<span class="icon16 icomoon-icon-equalizer-2"></span>
 			<span>Cotizacion</span>
 		</h4>
 		<a href="#" class="minimize" style="display: none;">Minimize</a>
 	</div>
 	<div class="content" style="display: block;"> 		
 		<table id="tbl_cotizacion" name="tbl_cotizacion" style="width:100%" border="1">
 			<tr>
		        <th>Articulo</th>
		        <th>Cantidad</th>
		        <th>Precio unitario</th>
		        <th>Precio total</th>
		        <th>Descuentos</th>
		        <th>Precio neto</th>
		        
		    </tr>
		    <tr>
		    	<th></th>
		    	<th></th>
		    	<th>0.00</th>
		    	<th>0.00</th>
		    	<th>0.00</th>
		    	<th>0.00</th>
		    	
		    </tr>
 		</table>
 	</div>
 </div>
 </form>
 <script type="text/javascript" src="<?=base_url()?>assets/js/modulos/facturacion/cotizacion.js"></script>