<script type="application/javascript">
    const form = document.querySelector("#form_web_profile");
    const input_name = document.querySelector("#profile_input_nombre");
    const input_email = document.querySelector("#profile_input_email");
    const input_password = document.querySelector("#profile_input_password");

    form.addEventListener("submit", event => {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add('was-validated');
        if (form.checkValidity()){
            verCargando('form_web_profile');
            let url = '<?= route('profile/update') ?>';
            ajaxRequest({ url: url, form: form }, function (data) {
                verCargando('form_web_profile', false);
            });
        }
    });


    console.log('hola');
</script>
