<script type="application/javascript">

    const card_show = document.querySelector("#div_card_show");
    const card_form = document.querySelector("#div_card_form");
    const input_rowquid = document.querySelector('#input_rowquid');

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
        nombre.textContent = data.nombre;
        tabla_id.textContent = data.tabla_id;
        valor.textContent = data.valor;
        input_rowquid.value = data.rowquid;
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

            }
            verCargando('div_card_show', false);
        })
    }

    function refreshShow() {
        let rowquid = input_rowquid.value;
        getShow(rowquid);
    }

    const form = document.querySelector('#form_parametros');
    form.addEventListener('submit', event => {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        if (form.checkValidity()){
            verCargando('content_view_parametros');
            let url = "<?= route('parametros') ?>";
            ajaxRequest({ url: url, form: form }, function (data) {
                //acciones extras
                verCargando('content_view_parametros', false);
                if (data.ok){
                    initShow(data);
                }else {
                    //pendiente antonny
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