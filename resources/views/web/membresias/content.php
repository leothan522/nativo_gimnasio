<div class="row p-3">
    <!--<div class="col-sm-12 col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php /*asset('img/user_blank.png'); */?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Detalles del perfil </h4>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Nombre:</strong> <span id="text_user_name" class="text-uppercase"><?php /*= \app\Providers\Auth::user()->name */?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Correo:</strong> <span id="text_user_email" class=""><?php /*= \app\Providers\Auth::user()->email */?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Fecha de Registro:</strong> <span class=""><?php /*= getFecha(\app\Providers\Auth::user()->created_at) */?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

    <div class="card-body table-responsive" id="div_card_form_body" >

        <form novalidate class="row justify-content-center"  id="form_parametros">
            <?php include view_path('web.membresias.form') ?>

        </form>

    </div>

    <!--<div class="col-sm-12 col-md-8 p-sm-2">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>-->
</div>