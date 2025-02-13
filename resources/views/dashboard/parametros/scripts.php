<script type="application/javascript">

    const card_show = document.querySelector("#div_card_show");
    const card_form = document.querySelector("#div_card_form");
    const input_rowquid = document.querySelector('#input_rowquid');
    const input_opcion = document.querySelector('#input_opcion');


    const input_nombre = document.querySelector('#input_nombre');
    const input_tabla_id = document.querySelector('#input_tabla_id');
    const input_valor = document.querySelector('#input_valor');



    function btnVerMas(refresh = "false") {
        verCargando('content_table');
        let url;
        if (refresh !== "false") {
            url = '<?= route('parametros/refresh') ?>';

        }else {
            url = '<?= route('parametros/limit') ?>';
        }

        let limit = document.querySelector('#total_rows').dataset.rows;

        ajaxRequest({ url: url, response: "html", data: { limit: limit } }, function (data) {
            document.getElementById('content_table').innerHTML = data;
            verCargando('content_table', false);
        });
    }

    function initShow(data) {
        const nombre = document.querySelector('#show_nombre');
        const tabla_id = document.querySelector('#show_tabla_id');
        const valor = document.querySelector('#show_valor');
        input_nombre.value = data.nombre;
        input_tabla_id.value = data.tabla_id;
        input_valor.value = data.valor;
        nombre.textContent = data.nombre;
        tabla_id.textContent = data.tabla_id;
        valor.textContent = data.valor;
        input_rowquid.value = data.rowquid;
        input_opcion.value = "editar";
        card_show.classList.remove('d-none');
        card_form.classList.add('d-none');
        btnVerMas('true');
    }

    function getShow(rowquid) {
        verCargando('div_card_show');
        let url = '<?= route('parametros/show') ?>';
        ajaxRequest({ url: url, data: { rowquid: rowquid} }, function (data) {
            if (data.ok){
                initShow(data);
            }else{
                btnVerMas('true');
                resetForm();
                input_rowquid.value = '';
                card_show.classList.add('d-none');
                card_form.classList.remove('d-none');
            }
            verCargando('div_card_show', false);
        })
    }

    function refreshShow() {
        let rowquid = input_rowquid.value;
        getShow(rowquid);
    }

    function create() {
        input_opcion.value = "create";
        resetForm();
        card_show.classList.add('d-none');
        card_form.classList.remove('d-none');
    }

    function edit() {
        let rowquid = input_rowquid.value;
        input_opcion.value = "editar";
        card_show.classList.add('d-none');
        card_form.classList.remove('d-none');
    }

    function borrarRegistro() {
        confirmToastBootstrap(function () {
            verCargando('div_card_show');
            let rowquid = input_rowquid.value;
            let url = '<?= route('parametros/destroy') ?>';
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

    const form = document.querySelector('#form_parametros');
    form.addEventListener('submit', event => {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        if (form.checkValidity()){
            verCargando('content_view_parametros');
            let opcion = input_opcion.value;
            let url;
            let data;
            if (opcion === "create"){
                url = "<?= route('parametros') ?>";
                data = {};
            }else {
                url = "<?= route('parametros/edit') ?>";
                data = {
                    rowquid: input_rowquid.value,
                }
            }
            ajaxRequest({ url: url, form: form, data: data }, function (data) {
                //acciones extras
                verCargando('content_view_parametros', false);
                if (data.ok){
                    initShow(data);
                }else {
                    //pendiente antonny
                    //Manejar errors de GUMP
                }

            });
        }


    });

    /*function display(opcion = 'table') {
        verCargando('content_view_parametros');
        const form = document.querySelector('#row_div_form_parametros');
        const table = document.querySelector('#row_div_table_parametros');

        switch (opcion) {
            case 'form':
                table.classList.add('d-none');
                form.classList.remove('d-none');
                verCargando("content_view_parametros", false);
                break;

            case 'table':
                form.classList.add('d-none');
                table.classList.remove('d-none');
                verCargando("content_view_parametros", false);
                break;
            default:
                form.classList.add('d-none');
                table.classList.remove('d-none');
                verCargando("content_view_parametros", false);
                break;
        }
    }*/


    console.log('Hi!')




</script>