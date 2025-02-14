<script type="application/javascript">

    const form = document.querySelector('#form_membresias');
    const show_plan = document.querySelector('#show_plan');

    const select_membresia = document.querySelector('#select_membresias');
    const error_select = document.querySelector('#error_select');
    const input_name = document.querySelector('#input_membresias_nombre');
    const error_name = document.querySelector('#error_membresias_input_nombre');
    const input_cedula = document.querySelector('#input_membresias_cedula');
    const error_cedula = document.querySelector('#error_membresias_input_cedula');
    const input_telefono = document.querySelector('#input_membresias_telefono');
    const error_telefono = document.querySelector('#error_membresias_input_telefono');
    const input_direccion = document.querySelector('#input_membresias_direccion');
    const error_direccion = document.querySelector('#error_membresias_input_direccion');



    form.addEventListener("submit", event => {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add('was-validated');
        if (form.checkValidity()){
            verCargando('div_card_form_body');
            let url = '<?= route('membresia') ?>';
            ajaxRequest({ url: url, form: form }, function (data) {
                if (data.ok){
                    location.reload();
                }
            });
        }
    });

    console.log('hola');
</script>
