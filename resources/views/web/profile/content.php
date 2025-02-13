<div class="row p-3">
    <div class="col-sm-12 col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php asset('img/user_blank.png'); ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Detalles del perfil</h4>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Nombre:</strong> <span class="text-uppercase"><?= \app\Providers\Auth::user()->name ?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Correo:</strong> <span class=""><?= \app\Providers\Auth::user()->email ?></span>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                    <strong>Fecha de Registro:</strong> <span class=""><?= getFecha(\app\Providers\Auth::user()->created_at) ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-5 p-sm-2 p-md-0">
        <div class="card">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                            Editar Perfil
                        </button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                            Cambiar Contraseña
                        </button>
                        </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

                        <?php include view_path('web/profile/form_edit'); ?>

                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

                        <?php include view_path('web/profile/form_password'); ?>

                    </div>
                    </div>
            </div>
        </div>
    </div>

    <!--<div class="col-sm-12 col-md-8 p-sm-2">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>-->
</div>