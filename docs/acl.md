### ACL
 Controle de Acesso de Usuário
  - Ao Criar uma nova rota utilize o padrão abaixo
      ````php
        $this->delete('/destroy/{id}', [
            'uses' => 'CourseController@destroy',
            'as' => 'course.destroy',
            'shield' => 'course.destroy'
        ])->where(['id' => '\d+']);
      ````

  *Após criada a Rota:*
  - A) Em `resources/lang/pt-BR/acl.php` adicione em `name` e `readable_name` :
    Abaixo exemplo para o COntroller StudentController.php*
      ````php
        'name' => [
            'student' => [
                'index' => 'Estudante.listar',
                'create' => 'Estudante.criar',
                'edit' => 'Estudante.editar',
                'destroy' => 'Estudante.excluir',
            ],
           ...

            'readable_name' => [
                'student' => [
                'title'     => 'Estudantes',
                'index'     => 'Listar Estudantes',
                'create'    => 'Criar Estudantes',
                'edit'      => 'Editar Estudantes',
                'destroy'   => 'Excluir Estudantes',
            ],
      ````

  - B) Par limpar o cache das rotas para o JS e inserir no Banco as Novas Permissões
      ````
      php artisan louzada:create:permission --force
      ````