<!-- Login 8 - Bootstrap Brain Component -->
<section class="bg-light p-3 p-md-4 p-xl-5 position-relative" style="min-height: 100vh;">
    <div class="container  position-absolute top-50 start-50 translate-middle">
        <div id="scale" class="row justify-content-center">
            <div class="col-12 col-xxl-11">
                <div class="card border-light-subtle shadow-sm">
                    <div class="row g-0">
                        <div class="col-12 col-md-6 d-none d-lg-flex">
                            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                                 src="<?php asset('img/1617.jpg'); ?>"
                                 alt="Welcome back you've been missed!">
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                            <div class="col-12 col-lg-11 col-xl-10">
                                <div class="card-body p-3 p-md-4 p-xl-5">

                                    <img class="gobernacion_start d-sm-none" src="<?php asset('img/logo_gym.png'); ?>" alt="Logo Gobernacion">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-center mb-2">
                                                <a href="#!">
                                                    <img class="img-fluid d-none d-lg-inline-flex w-50"
                                                         src="<?php asset('img/logo_gym.png'); ?>"
                                                         alt="BootstrapBrain Logo">
                                                    <img class="img-fluid d-lg-none mt-5"
                                                         src="<?php asset('img/logo_gym.png'); ?>"
                                                         alt="BootstrapBrain Logo">
                                                </a>
                                            </div>
                                            <h4 class="text-center d-none">Welcome back you've been missed!</h4>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">

                                            <div class="d-flex gap-3 flex-column mb-3">
                                                <a href="<?= route('login/miembros'); ?>" class="btn btn-lg btn-outline-dark">

                                                    <svg  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                                                    </svg>

                                                    <span class="ms-2 fs-6">Miembros</span>
                                                </a>
                                            </div>

                                            <div class="d-flex gap-3 flex-column">
                                                <a href="<?= route('login/empleados'); ?>" class="btn btn-lg btn-outline-dark">

                                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                                                    </svg>


                                                    <span class="ms-2 fs-6">Empleados</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 text-center mt-5">
                                            <small class="link-secondary text-decoration-none">
                                                &copy; 2025 Gimnasio Copa Cabana Gym.
                                            </small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
