<!--<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon bi bi-palette"></i>
        <p>Level 1</p>
    </a>
</li>-->

<!--<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon bi bi-speedometer"></i>
        <p>
            Level 1
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Level 2</p>
            </a> </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Level 2</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Level 2</p>
            </a>
        </li>
    </ul>
</li>-->

<li class="nav-item <?php if (isset($MODULO) && ($MODULO == "usuarios" || $MODULO == "parametros")){ echo "menu-open"; } ?>">
    <a href="#" class="nav-link <?php if (isset($MODULO) && ($MODULO == "usuarios" || $MODULO == "parametros")){ echo "active"; } ?>">
        <i class="nav-icon fa-solid fa-gear"></i>
        <p>
            Configuración
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= route('usuarios') ?>" class="nav-link <?php if (isset($MODULO) && $MODULO == "usuarios"){ echo "active"; } ?>">
                <i class="nav-icon fa-solid fa-user-gear"></i>
                <p>Usuarios</p>
            </a> </li>
        <li class="nav-item">
            <a href="<?= route('parametros') ?>" class="nav-link <?php if (isset($MODULO) && $MODULO == "parametros"){ echo "active"; } ?>">
                <i class="fa-solid fa-list"></i>
                <p>Parametros</p>
            </a>
        </li>
    </ul>
</li>

