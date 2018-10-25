<?php

namespace ACL\Console\Commands;

use ACL\Model\Permission;
use ACL\Model\Role;
use Illuminate\Console\Command;
use Illuminate\Routing\Router;
use Illuminate\Routing\Route;

class CreatePermissionsFromRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'louzada:create:permission
                                {prefix? : Nome do grupo}
                                {--force : Force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria permissões através das rotas';

    /**
     * Router instância.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * Todas as rotas.
     *
     * @var \Illuminate\Routing\RouteCollection
     */
    protected $routes;

    /**
     * Valores para imprimir
     *
     * @var array
     */
    protected $headers = ['Rota', 'Shield', 'Name'];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->routes = $router->getRoutes();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->displayInfo($this->getRoutes());
        $this->setChoice($this->getRoutes());
    }

    public function setChoice($permissions)
    {
        foreach ($permissions as $permission) {
            $name = '';
            $string = $permission['shield'] . ", Nome: " . $permission['readable_name'];
            if (Permission::where('name', '=', $permission['shield'])->get()->count() < 1) {
                if (!$this->option('force')) {
                    if ($this->confirm('Deseja modificar o nome de ' . $string . ' ?')) {
                        $name = $this->ask('Digite o novo nome para a permissão ' . $string);
                    }
                }

                $this->createPermission($permission['shield'], ($name ? $name : $permission['readable_name']));
            };
        }

        if ($this->option('force')) {
            $this->info('Permissões criadas com sucesso!');
        }
    }

    /**
     * Retorna um array de rotas com as informações.
     *
     * @return array
     */
    protected function getRoutes()
    {
        $results = [];

        foreach ($this->routes as $route) {
            $results[] = $this->getRouteInformation($route);
        }

        return array_filter($results);
    }

    /**
     * Pega a informação de cada rota.
     *
     * @param  \Illuminate\Routing\Route $route
     * @return array
     */
    protected function getRouteInformation(Route $route)
    {
        return ($this->getActionFilter($route->getAction()));
    }

    /**
     * Pega a informação de cada rota.
     *
     * @param  \Illuminate\Routing\Route $route
     * @return array
     */
    protected function getRoutePermission(Route $route)
    {
        $permission = $this->getShieldRoute($route->getAction());


        return isset($permission['shield']) ? Permission::create([
            'name' => $permission['shield'],
            'readable_name' => $permission['shield']
        ]) : null;
    }

    protected function getShieldRoute($action)
    {
        return (isset($action['shield'])) ? ['name' => (isset($action['as'])
            ? $action['as'] : (isset($action['controller'])
                ? $action['controller'] : null)), 'shield' => (isset($action['shield'])
            ? $action['shield'] : null)]
            : null;
    }

    /**
     * Retorna o nome, shield, is
     * @param array $action
     * @return array|null
     */
    protected function getActionFilter($action)
    {
        return (isset($action['shield'])) ? ['name' => (isset($action['as'])
            ? $action['as'] : (isset($action['controller'])
                ? $action['controller'] : null)), 'shield' => (isset($action['shield'])
            ? $action['shield'] : null), 'readable_name' => $this->generateName($action['shield'])]
            : null;
    }

    protected function generateName($shield)
    {
        preg_match('/\.\w*/', $shield, $match);
        $subst = preg_replace('/\.\w*/', '', $shield);
        $subst = str_replace('_', ' ', $subst);
        if ($match == [".index"]) {
            return $subst . ' index';
        }
        if ($match == [".create"]) {
            return $subst . ' create';
        }
        if ($match == [".edit"]) {
            return $subst . ' edit';
        }
        if ($match == [".destroy"]) {
            return $subst . ' destroy';
        }

        return $subst;
    }

    /**
     *
     * @param $name
     * @param $readable_name
     */
    protected function createPermission($name, $readable_name)
    {
        Permission::create([
            'name' => $name,
            'readable_name' => $readable_name
        ]);

        if (!$this->option('force')) {
            $this->info('Permissão criada com sucesso.');
        }
    }

    /**
     *
     * @param $name
     * @param $readable_name
     */
    protected function createRole($name, $readable_name)
    {
        Role::create([
            'name' => $name,
            'readable_name' => $readable_name
        ]);
        $this->info('Função criada com sucesso.');
    }


    /**
     * Exibe tabela no console.
     *
     * @param  array $routes
     * @return void
     */
    protected function displayInfo(array $routes)
    {
        $this->table($this->headers, $routes);
    }
}
