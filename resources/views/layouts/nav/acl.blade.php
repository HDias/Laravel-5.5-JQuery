@if (hasPermission(['acl.permission.index', 'acl.permission.edit', 'acl.role.index', 'acl.role.create', 'acl.role.edit', 'user.index', 'user.create', 'user.edit']))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ menuActive(['acl.permission.index', 'acl.permission.edit', 'acl.role.index', 'acl.role.create', 'acl.role.edit', 'user.index', 'user.create', 'user.edit'], Route::currentRouteName(), 2) }}" 
            data-toggle="dropdown"
            href="#" 
            id="dropdownComponentsAcl" 
            data-toggle="dropdown" 
            aria-haspopup="true" 
            aria-expanded="false">
            <i class="fa fa-fw fa-shield"></i>
            Controle de Acesso
        </a>
        <div class="dropdown-menu" 
            aria-labelledby="dropdownComponentsAcl">

                @if (hasPermission(['user.index', 'user.create', 'user.edit']))
                    <a class="dropdown-item {{ menuActive(['user.index', 'user.create', 'user.edit'], Route::currentRouteName(), 3) }}" 
                        href="{{ route('user.index') }}">Usuários</a>
                @endif

                @if (hasPermission(['acl.role.index', 'acl.role.create', 'acl.role.edit']))
                    <a class="dropdown-item {{ menuActive(['acl.role.index', 'acl.role.create', 'acl.role.edit'], Route::currentRouteName(), 3) }}" 
                        href="{{ route('acl.role.index') }}">Perfis</a>
                @endif

                @if (hasPermission(['acl.permission.index', 'acl.permission.edit']))
                    <a class="dropdown-item {{ menuActive(['acl.permission.index', 'acl.permission.edit'], Route::currentRouteName(), 3) }}" 
                        href="{{ route('acl.permission.index') }}">Permissões</a>
                @endif

        </div>
    </li>
@endif