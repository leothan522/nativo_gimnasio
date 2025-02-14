<div class="row justify-content-center p-3">

    <div class="col-sm-12 col-md-7 <?php if (!$miembro){ echo 'd-none'; } ?>" id="show_plan">
        <div class="card">
            <div class="card-body">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php asset('img/'.$membresia.'.jpg'); ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Detalles de tu Plan Actual </h4>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Inscripción:</strong> <span id="text_inscripcion" class="text-uppercase"><?= getFecha($inscripcion) ?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Membresía:</strong> <span id="text_membresia" class="text-uppercase"><?= $membresia ?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Duración:</strong> <span id="text_duracion" class=""><?= $duracion ?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Precio:</strong> <span id="text_precio" class=""><?= $precio ?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Inicio:</strong> <span id="text_inicio" class=""><?= getFecha($inicio) ?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Estatus:</strong> <span id="text_estatus" class=""><?= $estatus ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive <?php if ($miembro){ echo 'd-none'; } ?>" id="div_card_form_body">
        <div class="col-12 text-center">
            <p class="text-dark">Actualmente no posees una membresía. Por favor, completa los datos requeridos y selecciona una opción disponible.</p>
        </div>

        <form novalidate class="row justify-content-center"  id="form_membresias">
            <?php include view_path('web.membresias.form') ?>
        </form>
        <?php verCargando(); ?>
    </div>

</div>