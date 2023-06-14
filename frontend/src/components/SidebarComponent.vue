<template>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="height: 100vh;">
        <RouterLink to="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img src="../assets/logoCMCL.png" alt="">
            <span class="fs-5">Câmara Municipal Capão do Leão</span>
        </RouterLink>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <RouterLink style="display: block; text-align: left;" class="btn btn-dark" to="/fornecedores">
                    <i class="bi bi-building"></i>
                    &nbsp; Fornecedores
                </RouterLink>
            </li>
            <li>
                <RouterLink style="display: block; text-align: left;" class="btn btn-dark" to="/vereadores">
                    <i class="bi bi-person-badge"></i>
                    &nbsp; Vereadores
                </RouterLink>

            </li>
            <li>
                <RouterLink style="display: block; text-align: left;" class="btn btn-dark" to="/materiais">
                    <i class="bi bi-bag"></i>
                    &nbsp; Materiais
                </RouterLink>

            </li>
        </ul>
        <!-- <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div> -->
    </div>
</template>
  
<script>
export default {
    name: 'SidebarComponent',

}
</script>
