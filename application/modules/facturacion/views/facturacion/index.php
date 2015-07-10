<div class="row-fluid">
    <div class="span8">
        <div class="centerContent">

            <ul class="bigBtnIcon">
                <?php
                foreach($iconos as $row):
                ?>
                <li>
                    <a href="<?= site_url('core/itemId/'.$row->ixm_id) ?>" title="<?= $row->ixm_titulo?>" class="tipB">
                        <span class="icon <?= $row->ixm_icono?>"></span>
                        <span class="txt"><?= substr($row->ixm_titulo,0,15)?></span>
                    </a>
                </li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
    </div><!-- End .span8 -->
</div>