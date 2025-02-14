<div class="row justify-content-center">

    <div class="col-6">

        <ol class="list-group">

            <li class="list-group-item active d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="">Datos Personales</div>
                </div>
                <span class="fw-bold"><i class="fa-solid fa-user"></i></span>
            </li>

            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Cédula:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-uppercase" id="show_cedula">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo formatoMillares($lastRegistro->cedula, 0);
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Nombre:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-uppercase" id="show_nombre">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo $lastRegistro->nombre;
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Teléfono:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-uppercase" id="show_telefono">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo $lastRegistro->telefono;
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Email:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-lowercase" id="show_email">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo $lastRegistro->email;
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Dirección:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-uppercase" id="show_direccion">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo $lastRegistro->direccion;
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
        </ol>
    </div>
    <div class="col-6">

        <ol class="list-group">

            <li class="list-group-item active d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="">Membresia</div>
                </div>
                <span class="fw-bold"><i class="fa-regular fa-address-card"></i></span>
            </li>

            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Cédula:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-uppercase" id="show_cedula">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo formatoMillares($lastRegistro->cedula, 0);
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Nombre:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-uppercase" id="show_nombre">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo $lastRegistro->nombre;
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Teléfono:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-uppercase" id="show_telefono">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo $lastRegistro->telefono;
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Email:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-lowercase" id="show_email">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo $lastRegistro->email;
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
            <li class="list-group-item list-group-item-light d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>Dirección:</div>
                </div>
                <span class="fw-bold text-primary ms-2 text-uppercase" id="show_direccion">
                    <?php
                    if (isset($lastRegistro) && $lastRegistro){
                        echo $lastRegistro->direccion;
                    }else{
                        echo "NULL";
                    }
                    ?>
                </span>
            </li>
        </ol>
    </div>
</div>

