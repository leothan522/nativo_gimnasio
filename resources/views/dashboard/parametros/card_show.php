<div class="card card-primary card-outline <?php if ($ocultarShow){ echo 'd-none'; } ?>" id="div_card_show">
    <div class="card-header" id="div_card_show_header">
        <h3 class="card-title">
            Ver Parametro
        </h3>
        <div class="card-tools">

            <button type="button" class="btn btn-tool" onclick="refreshShow()">
                <i class="fa-solid fa-rotate"></i>
            </button>

            <button type="button" class="btn btn-tool">
                <i class="fa-solid fa-file"></i> Nuevo
            </button>

        </div>
    </div>
    <div class="card-body table-responsive" id="div_card_show_body" style="max-height: calc(100vh - 327px)">

        <?php include view_path('dashboard.parametros.show') ?>
        <?php
        if (isset($lastRegistro) && $lastRegistro){
            $rowquid =  $lastRegistro->rowquid;
        }else{
            $rowquid = "NULL";
        }
        ?>
        <input type="hidden" value="<?= $rowquid ?>" id="input_rowquid">

    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center" id="div_card_show_footer">

        <button type="button" class="btn btn-primary btn-sm me-1">
            <i class="fa-regular fa-trash-can"></i> Borrar
        </button>

        <button type="button" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </button>

    </div>
    <!-- /.card-footer-->
    <?php verCargando(); ?>
</div>
