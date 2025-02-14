<div class="col-4">

    <div class="card card-outline card-navy" >

        <div class="card-header">
            <h5 class="card-title">Crear Membresía</h5>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-12">
                    <label for="select_membresias" class="form-label text-primary-emphasis">Membresías</label>
                    <select id="select_membresias" class="form-select" aria-label="Default select example">
                        <option>Seleccione</option>
                        <?php foreach ($membresias as $membresia){ ?>
                            <option value="<?php echo $membresia->id; ?>"><?php echo $membresia->nombre?>  <?php echo $membresia->precio; ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback" id="error_select">La membresía es requerida</div>

                </div>

                <div class="col-12">
                    <label for="input_membresias_nombre" class="form-label text-primary-emphasis">Nombre</label>
                    <div class="input-group has-validation">
                        <input id="input_membresias_nombre" name="name" type="text" class="form-control" placeholder="Ingrese el Nombre" required>
                        <div class="invalid-feedback" id="error_membresias_input_nombre">El nombre es requerido</div>
                    </div>
                </div>

                <div class="col-12">
                    <label for="input_membresias_cedula" class="form-label text-primary-emphasis">Cédula</label>
                    <div class="input-group has-validation">
                        <input id="input_membresias_cedula" name="cedula" type="text" class="form-control" placeholder="Ingrese la Cédula" required>
                        <div class="invalid-feedback" id="error_membresias_input_cedula">La cédula es requerida</div>
                    </div>
                </div>


                <div class="col-12">
                    <label for="input_membresias_telefono" class="form-label text-primary-emphasis">Teléfono</label>
                    <div class="input-group has-validation">
                        <input id="input_membresias_telefono" name="telefono" type="text" class="form-control" placeholder="Ingrese el Teléfono" required>
                        <div class="invalid-feedback" id="error_membresias_input_telefono">El teléfono es requerido</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating mb-3">
                        <textarea id="input_membresias_direccion" name="direccion" class="form-control" style="height: 70px" required></textarea>
                        <label for="input_membresias_direccion">Dirección</label>
                        <div id="error_membresias_input_direccion" class="invalid-feedback">La dirección es obligatoria.</div>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo \app\Providers\Auth::user()->id; ?>">
                <input type="hidden" name="token" value="<?php echo generarStringAleatorio(16, true) ?>">


                <div class="row justify-content-end g-2">
                    <button type="submit" class="col-md-4 btn btn-block btn-success me-2">
                        <i class="fas fa-save me-1"></i>
                        Guardar
                    </button>
                </div>


            </div>

        </div>

    </div>



</div>
