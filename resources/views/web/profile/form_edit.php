<div class="row justify-content-center">
    <div class="card mt-4" style="width: 90%;">
        <div class="card-body">
            <form id="form_web_profile" class="position-relative" novalidate>
                <div class="row justify-content-center g-3">

                    <div class="col-12">
                        <label for="profile_input_password_edit" class="form-label text-primary-emphasis">Contraseña Actual</label>
                        <div class="input-group has-validation">
                            <input id="profile_input_password_edit" name="password" type="password" class="form-control" placeholder="Ingrese la Contraseña"  required>
                            <div class="invalid-feedback" id="error_input_password_edit">Contraseña requerida.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="profile_input_nombre" class="form-label text-primary-emphasis">Nombre</label>
                        <div class="input-group has-validation">
                            <input id="profile_input_nombre" name="name" type="text" class="form-control" value="<?= \app\Providers\Auth::user()->name ?>" placeholder="Ingrese el Nombre" required>
                            <div class="invalid-feedback" id="error_profile_input_name">Nombre requerido.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="profile_input_email" class="form-label text-primary-emphasis">Correo</label>
                        <div class="input-group has-validation">
                            <input id="profile_input_email" name="email" type="text" class="form-control"value="<?= \app\Providers\Auth::user()->email ?>" placeholder="Ingrese el Correo" required>
                            <div class="invalid-feedback" id="error_profile_input_email">Correo requerido.</div>
                        </div>
                    </div>
                    <input type="hidden" name="rowquid" value="<?= \app\Providers\Auth::user()->rowquid ?>">


                    <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                </div>
                <?php verCargando(); ?>
            </form>
        </div>
    </div>
</div>

