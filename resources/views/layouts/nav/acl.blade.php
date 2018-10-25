@if (hasPermission(['acl.permission.index', 'acl.permission.edit', 'acl.role.index', 'acl.role.create', 'acl.role.edit', 'user.index', 'user.create', 'user.edit']))
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="ACL">
        <a class="nav-link nav-link-collapse" data-toggle="collapse"
           href="#collapseComponentsAcl" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-shield"></i>
            <span class="nav-link-text">Controle de Acesso</span>
        </a>
        <ul class="sidenav-second-level collapse {{ menuActive(['acl.permission.index', 'acl.permission.edit', 'acl.role.index', 'acl.role.create', 'acl.role.edit', 'user.index', 'user.create', 'user.edit'], Route::currentRouteName(), 2) }}"
            id="collapseComponentsAcl">

            @if (hasPermission(['user.index', 'user.create', 'user.edit']))
                <li class="{{ menuActive(['user.index', 'user.create', 'user.edit'], Route::currentRouteName(), 3) }}">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="fa fa-fw fa-arrow-right"></i>
                        <span class="nav-link-text">Usuários</span>
                    </a>
                </li>
            @endif

            @if (hasPermission(['acl.role.index', 'acl.role.create', 'acl.role.edit']))
                <li class="{{ menuActive(['acl.role.index', 'acl.role.create', 'acl.role.edit'], Route::currentRouteName(), 3) }}">
                    <a class="nav-link" href="{{ route('acl.role.index') }}">
                        <i class="fa fa-fw fa-arrow-right"></i>
                        <span class="nav-link-text">Perfis</span>
                    </a>
                </li>
            @endif

            @if (hasPermission(['acl.permission.index', 'acl.permission.edit']))
                <li class="{{ menuActive(['acl.permission.index', 'acl.permission.edit'], Route::currentRouteName(), 3) }}">
                    <a class="nav-link" href="{{ route('acl.permission.index') }}">
                        <i class="fa fa-fw fa-arrow-right"></i>
                        <span class="nav-link-text">Permissões</span>
                    </a>
                </li>
            @endif

        </ul>
    </li>
@endif