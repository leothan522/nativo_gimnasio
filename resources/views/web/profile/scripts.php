<script type="application/javascript">
    const form = document.querySelector("#form_web_profile");
    const input_name = document.querySelector("#profile_input_nombre");
    const input_email = document.querySelector("#profile_input_email");
    const input_password = document.querySelector("#profile_input_password");

    form.addEventListener("submit", event => {
        event.preventDefault();
        event.stopPropagation();

        form.classList.add('was-validated');
    });


    console.log('hola');
</script>
