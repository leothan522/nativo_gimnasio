<script type="application/javascript">

    const card_show = document.querySelector("#div_card_show");
    const card_form = document.querySelector("#div_card_form");
    const title = document.querySelector("#form_header_title");
    const input_rowquid = document.querySelector('#input_rowquid');
    const input_opcion = document.querySelector('#input_opcion');


    const input_cedula = document.querySelector('#input_cedula');
    const input_nombre = document.querySelector('#input_nombre');
    const input_telefono = document.querySelector('#input_telefono');
    const input_email = document.querySelector('#input_email');
    const input_inscripcion = document.querySelector('#input_inscripcion');
    const input_membresia = document.querySelector('#input_membresia');
    const input_inicio = document.querySelector('#input_inicio');



    function btnVerMas(refresh = "false") {
        verCargando('content_table');
        let url;
        if (refresh !== "false") {
            url = '<?= route('miembros/refresh') ?>';

        }else {
            url = '<?= route('miembros/limit') ?>';
        }

        let limit = document.querySelector('#total_rows').dataset.rows;

        ajaxRequest({ url: url, response: "html", data: { limit: limit } }, function (data) {
            document.getElementById('content_table').innerHTML = data;
            verCargando('content_table', false);
        });
    }

    function initShow(data) {
        const cedula = document.querySelector('#show_cedula');
        const nombre = document.querySelector('#show_nombre');
        const telefono = document.querySelector('#show_telefono');
        const email = document.querySelector('#show_email');
        const inscripcion = document.querySelector('#show_inscripcion');
        const membresia_nombre = document.querySelector('#show_membresia_nombre');
        const membresia_duracion = document.querySelector('#show_membresia_duracion');
        const membresia_precio = document.querySelector('#show_membresia_precio');
        const inicio = document.querySelector('#show_inicio');
        const status = document.querySelector('#show_status');

        cedula.textContent = data.cedula;
        nombre.textContent = data.nombre;
        telefono.textContent = data.telefono;
        email.textContent = data.email;
        inscripcion.textContent = data.ver_inscripcion;
        membresia_nombre.textContent = data.membresia_nombre;
        membresia_duracion.textContent = data.membresia_duracion;
        membresia_precio.textContent = data.membresia_precio;
        inicio.textContent = data.ver_inicio;
        status.textContent = data.status;

        input_cedula.value = data.cedula;
        input_nombre.value = data.nombre;
        input_telefono.value = data.telefono;
        input_email.value = data.email;
        input_inscripcion.value = data.inscripcion;
        input_membresia.value = data.membresia_id;
        input_inicio.value = data.inicio;

        input_rowquid.value = data.rowquid;
        input_opcion.value = "editar";
        card_show.classList.remove('d-none');
        card_form.classList.add('d-none');
        //btnVerMas('true');
    }

    function getShow(rowquid, search = 'false') {
        verCargando('div_card_show');
        let url = '<?= route('miembros/show') ?>';
        ajaxRequest({ url: url, data: { rowquid: rowquid} }, function (data) {
            if (data.ok){
                initShow(data);
                if (search === 'false'){
                    btnVerMas('true');
                }else {
                    document.querySelector('#btn_search_submit').click();
                }
            }else{
                btnVerMas('true');
                resetForm();
                input_rowquid.value = '';
                card_show.classList.add('d-none');
                card_form.classList.remove('d-none');
            }
            verCargando('div_card_show', false);
        });
    }

    function refreshShow() {
        let rowquid = input_rowquid.value;
        getShow(rowquid);
    }

    function create() {
        title.textContent = "Crear Miembro";
        input_opcion.value = "create";
        resetForm();
        card_show.classList.add('d-none');
        card_form.classList.remove('d-none');
    }

    function edit() {
        verCargando('div_card_show');
        let rowquid = input_rowquid.value;
        let url = '<?= route('miembros/show') ?>';
        ajaxRequest({ url: url, data: { rowquid: rowquid} }, function (data) {
            if (data.ok){
                initShow(data);
                title.textContent = "Editar Miembro";
                input_opcion.value = "editar";
                card_show.classList.add('d-none');
                card_form.classList.remove('d-none');
            }
            verCargando('div_card_show', false);
        });

    }

    function borrarRegistro() {
        confirmToastBootstrap(function () {
            verCargando('div_card_show');
            let rowquid = input_rowquid.value;
            let url = '<?= route('miembros/destroy') ?>';
            ajaxRequest({ url: url, data: { rowquid: rowquid } }, function (data) {
                if (data.ok){
                    if (data.lastRegistro){
                        getShow(data.rowquid);
                    }else {
                        btnVerMas('true');
                        resetForm();
                        input_rowquid.value = '';
                        input_opcion.value = 'create';
                        card_show.classList.add('d-none');
                        card_form.classList.remove('d-none');
                    }
                }
                verCargando('div_card_show', false);
            });
        });
    }

    function resetForm() {
        const btn_reset_from = document.querySelector('#btn_reset_from');
        btn_reset_from.click();
        //pendiente antonny

    }

    const form_buscar = document.querySelector('#form_buscar');
    form_buscar.addEventListener('submit', event => {
        event.preventDefault();
        event.stopPropagation();
        form_buscar.classList.add('was-validated');
        if (form_buscar.checkValidity()){
            verCargando('content_table');
            let url = "<?= route('miembros/search') ?>";
            ajaxRequest({ url: url, response: "html", form: form_buscar }, function (data) {
                //acciones extras
                verCargando('content_table', false);
                document.getElementById('content_table').innerHTML = data;
            });
        }
    });

    const form = document.querySelector('#form_parametros');
    form.addEventListener('submit', event => {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        if (form.checkValidity()){
            verCargando('div_card_form');
            let opcion = input_opcion.value;
            let url;
            let data;
            if (opcion === "create"){
                url = "<?= route('miembros') ?>";
                data = {};
            }else {
                url = "<?= route('miembros/edit') ?>";
                data = {
                    rowquid: input_rowquid.value,
                }
            }
            ajaxRequest({ url: url, form: form, data: data }, function (data) {
                //acciones extras
                verCargando('div_card_form', false);
                if (data.ok){
                    initShow(data);
                    //btnVerMas('true');
                }else {
                    //pendiente antonny
                    //Manejar errors de GUMP
                }

            });
        }


    });




    console.log('Hi!')




</script>