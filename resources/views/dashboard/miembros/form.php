<div class="col-6">

    <div class="card card-outline card-navy" >

        <div class="card-header">
            <h5 class="card-title">Datos Personales</h5>
            <div class="card-tools">
                <span class="btn btn-tool"><i class="fas fa-book"></i></span>
            </div>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-12">
                    <label for="input_cedula" class="form-label text-primary-emphasis">Cédula:</label>
                    <div class="input-group has-validation">
                        <input id="input_cedula" name="cedula" type="text" class="form-control" placeholder="Cédula" required>
                        <div class="invalid-feedback" id="error_parametros_input_nombre">Chequear!</div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="input_nombre" class="form-label text-primary-emphasis">Nombre:</label>
                    <div class="input-group has-validation">
                        <input id="input_nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required>
                        <div class="invalid-feedback" id="error_parametros_input_nombre">Chequear!</div>
                    </div>
                </div>

                <div class="col-12">
                    <label for="input_telefono" class="form- text-primary-emphasis">Teléfono:</label>
                    <div class="input-group has-validation">
                        <input id="input_telefono" name="Telefono" type="text" class="form-control" placeholder="Teléfono" required>
                        <div class="invalid-feedback">Chequear!</div>
                    </div>
                </div>

                <div class="col-12">
                    <label for="input_email" class="form-label text-primary-emphasis">Email:</label>
                    <div class="input-group has-validation">
                        <input id="input_email" name="email" type="email" class="form-control" placeholder="Email" required>
                        <div class="invalid-feedback">Chequear!</div>
                    </div>
                </div>


            </div>

        </div>

    </div>

</div>
<div class="col-6">

    <div class="card card-outline card-navy" >

        <div class="card-header">
            <h5 class="card-title">Datos Membresia</h5>
            <div class="card-tools">
                <span class="btn btn-tool"><i class="fas fa-book"></i></span>
            </div>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-12">
                    <label for="input_inscripcion" class="form-label text-primary-emphasis">Inscripción:</label>
                    <div class="input-group has-validation">
                        <input id="input_inscripcion" name="email" type="date" class="form-control" placeholder="Inscripción" required>
                        <div class="invalid-feedback">Chequear!</div>
                    </div>
                </div>

                <div class="col-12">
                    <label for="input_membresia" class="form-label text-primary-emphasis">Membresia:</label>
                    <div class="input-group has-validation">
                        <select id="input_membresia" class="form-select" aria-label="Membresia" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($listarMembresias as $membresia){ ?>
                                <option value="<?= $membresia->id ?>"><?= $membresia->nombre ?> [ <?= $membresia->duracion ?> | <?= $membresia->precio ?> ]</option>
                            <?php } ?>
                        </select>

                        <div class="invalid-feedback" id="error_parametros_input_nombre">Chequear!</div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="input_inicio" class="form-label text-primary-emphasis">Inicio:</label>
                    <div class="input-group has-validation">
                        <input id="input_inicio" name="inicio" type="date" class="form-control" placeholder="Inicio" required>
                        <div class="invalid-feedback" id="error_parametros_input_nombre">Chequear!</div>
                    </div>
                </div>


            </div>

        </div>

    </div>

</div>
