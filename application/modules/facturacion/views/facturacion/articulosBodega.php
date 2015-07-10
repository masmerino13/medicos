<link href='<?= base_url()?>assets/plugins/tables/dataTables/jquery.dataTables.css' rel='stylesheet' type='text/css' />
<script src='<?= base_url()?>assets/plugins/tables/dataTables/jquery.dataTables.min.js' type='text/javascript'></script>
<script src='<?= base_url()?>assets/plugins/tables/responsive-tables/responsive-tables.js' type='text/javascript'></script>
<script src='<?= base_url()?>assets/js/datatable.js' type='text/javascript'></script>

<link href='<?= base_url()?>assets/css/validationEngine.jquery.css' rel='stylesheet' type='text/css' />
<script src='<?= base_url()?>assets/js/validation/jquery.validationEngine-es.js' type='text/javascript'></script>
<script src='<?= base_url()?>assets/js/validation/jquery.validationEngine.js' type='text/javascript'></script>


<style>
    #DataTables_Table_0_filter:nth-child(1){display: none}
</style>
<script>
    $(document).ready(function() {
        /*SELECCION DE ARTICULOS EN FACTURA*/

        $('#articuloSelected').validationEngine();

        $(".fac_select_articulos tr").on('click', function(){
            var existencia = $(this).find("td").eq(2).html();
            var precio = $(this).find("td").eq(4).html();
            var articulo = $(this).find("td").eq(1).html();
            var codigo = $(this).find("td").eq(0).html();
            var id = $(this).find("td").eq(5).html();
            var unidad = $(this).find("td").eq(3).html();

            $('#art_descripcion').val(articulo);
            $('#art_cantidad').val(existencia);
            $('#art_cantidad').addClass('validate[required,max['+existencia+']]');
            $('#art_precio').val(precio);
            $('#art_codigo').val(codigo);
            $('#art_id').val(id);
            $('#art_unidad').val(unidad);

        });

        $('#btnInsertaArtFactura').on('click', function(){

            $('.alert').hide().fadeOut(400);

            var cantidad = $('#art_cantidad').val();
            var precio = $('#art_precio').val();
            var descripcion = $('#art_descripcion').val();
            var codigo = $('#art_codigo').val();
            var id = $('#art_id').val();
            var unidad = $('#art_unidad').val();
            var total = cantidad * precio;
            var valida;
            var bodega = $('#bod_id').val();

            $('#listaArticulosFacturaSelected tbody tr').each(function(key){
                if($(this).attr('id') == id)
                {
                    $('#facturamsg').html('Este articulo ya ha sido seleccionado.');
                    $('.alert').show().fadeIn(400);
                    valida = 1;
                    return false;
                }else if($(this).attr('id') !== id){
                    valida = 0;
                }
            });

            if(valida == 1)
            {
                return false;
            }else{
                var total_suma = Number($('#sumas').val()) + Number(total);

                $('#sumas').val($.number(total_suma, 2));

                /*VALIDAMOSIS TRAE CREDITO FISCAL*/
                if($('#tipo_transaccion').val() == 2)
                {
                    $.getJSON('<?= site_url('facturacion/facturar/calcula_iva/')?>',{format: "json",art_id:id}, function(data) {
                        var total_iva = data['iva'] * cantidad;
                        var suma_iva = Number($('#ecf_iva').val()) + Number(total_iva);
                        $('#ecf_iva').attr('value',$.number(suma_iva,2))
                        $('#efa_total').val(Number($('#efa_total').val()) + suma_iva);
                    });
                }

                var total_fac_n = total_suma;
                $('#efa_total').val($.number(total_fac_n, 2));

                /*FINALIZA CREDITO FISCAL*/
                $('#0').remove();
                $('#listaArticulosFacturaSelected tbody').append('<tr id="'+id+'" class="even artAdded"><td class=" sorting_1">'+codigo+'</td><td class="">'+descripcion+'</td><td class="  "><input type="text" class="readonly span2 number_format" readonly name="articulo['+id+'][cant]" value="'+cantidad+'"></td><td class="  ">Unidad</td><td class="  "><input type="text" class="readonly span2" readonly name="articulo['+id+'][precio]" value="'+precio+'"><input type="hidden" value="'+bodega+'" name="articulo['+id+'][bodega]"></td><td class="number_format">'+total.toFixed(2)+'</td></tr>');
            }


            /*function validaArticuloDuplicado(id){
                $('#listaArticulosFacturaSelected tbody tr').each(function(key){
                    if($(this).attr('id') == id)
                    {
                        $('#facturamsg').html('Este articulo ya ha sido seleccionado.');
                        $('.alert').show();
                        return false;
                    }
                });
            }*/
        });

    });
</script>
<div style="height: 300px; overflow-x: auto; overflow-y: scroll; margin-top: 10px;" class="scroll" tabindex="5000">
    <div class="alert alert-error hide">
        <span id="facturamsg"></span>
    </div>
    <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable responsive table table-striped table-bordered table-condensed fac_select_articulos" width="100%" >
        <thead>
        <tr>
            <th>Codigo inventario</th>
            <th>Descripción</th>
            <th>Existencia</th>
            <th>U/Medida</th>
            <th>Precio</th>
            <th>ID</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($articulos))
        {
            foreach($articulos as $row)
            {
                ?>
                <tr>
                    <td><?= $row->art_codigo_inventario?></td>
                    <td><?= $row->art_descripcion?></td>
                    <td><?= $row->axb_existencia?></td>
                    <td>Unidad</td>
                    <td><?= setMoneyFormat($row->art_precio_venta)?></td>
                    <td><?= $row->art_id?></td>
                </tr>
            <?php
            }

        }
        ?>

        </tbody>
    </table>
</div>
<div class="row-fluid">
    <fieldset>
        <legend>Articulo seleccionado</legend>

        <div class="span6">
            <form id="articuloSelected">
            <div class="row-fluid">
                <label class="form-label span3">Articulo:</label>
                <input class="span8" readonly  id="art_descripcion" type="text" />
            </div>
            <div class="row-fluid">
                    <label class="form-label span3">Cantidad:</label>
                    <input class="span3 " id="art_cantidad" value="0" type="text" />
            </div>
            <div class="row-fluid">
                    <label class="form-label span3">Precio:</label>
                    <input class="span3" id="art_precio" value="0" type="text" />
            </div>

                <div class="clear"></div>

                <div class="pDiv marginT10">
                    <p>
                        <a id="btnInsertaArtFactura" class="btn btn-success">
                            <span class="icon16 icomoon-icon-checkmark white"></span>
                            <?= SIIE_BTN_SAVE ?>
                        </a>
                    </p>

                </div>

                <input type="hidden" id="art_id">
                <input type="hidden" id="art_codigo">
                <input type="hidden" id="art_unidad">
                <input type="hidden" id="tipo_transaccion" value="<?= @$tipo_proceso ?>" >
            </form>
        </div>
    </fieldset>

</div>