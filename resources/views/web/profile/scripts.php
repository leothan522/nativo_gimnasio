<script type="application/javascript">
    const form = document.querySelector("#form_web_profile");
    const form_password = document.querySelector("#form_profile_password");

    const input_name = document.querySelector("#profile_input_nombre");
    const error_name = document.querySelector("#error_profile_input_name");
    const input_email = document.querySelector("#profile_input_email");
    const error_email = document.querySelector("#error_profile_input_email");
    const input_password = document.querySelector("#profile_input_password_edit");
    const error_password = document.querySelector("#error_input_password_edit");


    form.addEventListener("submit", event => {
        event.preventDefault();
        event.stopPropagation();

        const text_name = document.querySelector("#text_user_name");
        const text_email = document.querySelector("#text_user_email");

        form.classList.add('was-validated');
        if (form.checkValidity()){
            verCargando('form_web_profile');
            let url = '<?= route('profile/update') ?>';
            ajaxRequest({ url: url, form: form }, function (data) {
                verCargando('form_web_profile', false);
                if (data.ok){
                    resetForm(data);
                    text_name.innerText = data.name;
                    text_email.innerText = data.email;
                }else {
                    form.classList.remove('was-validated');
                    let errors = data.errors;

                    if (data.title === 'Contraseña Incorrecta.'){
                        input_password.classList.add('is-invalid');
                        error_password.innerText = data.message;
                    }else {
                        input_password.classList.remove('is-invalid');
                        input_password.classList.add('is-valid');
                    }

                    if (errors.name){
                        input_name.classList.add('is-invalid');
                        error_name.textContent = errors.name;
                    }else {
                        input_name.classList.remove('is-invalid');
                        input_name.classList.add('is-valid');
                    }

                    if (errors.email){
                        input_email.classList.add('is-invalid');
                        error_email.textContent = errors.email;
                    }else {
                        input_email.classList.remove('is-invalid');
                        input_email.classList.add('is-valid');
                    }


                }

            });
        }
    });

    form_password.addEventListener('submit', event => {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add('was-validated');
        if (form.checkValidity()){
            verCargando('form_profile_password');
        }

    });


    function resetForm(data) {
        form.classList.remove('was-validated');
        input_name.value = data.name;
        input_email.value = data.email;
        input_password.value = '';
    }


    console.log('hola');
</script>
