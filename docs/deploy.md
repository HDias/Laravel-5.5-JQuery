#### Deploy (Usando Envoy)

*OBS: É necessário que já esteja clonado no servidor e configurado o `.env` o projeto e com os caminhos de instalação como no arquivo `Envoy.blade.php`*

 - É necessário instalar o repositório do Envoy de forma global do COMPOSER.
``
composer global require laravel/envoy
``
 - Depois:
    ````
    sudo ln -s /home/horecio/.composer/vendor/laravel/envoy/envoy /usr/local/bin/envoy
    ````

##### HOMOLOGAÇÃO

 - A) Para Deploy (HOMOLOGAÇÃO).
     ````
     envoy run deploy --env=homolog --branch=master
     ````

 - B) Para Criar o Usuário *superadmin* (HOMOLOGAÇÃO).
     ````
     envoy run seed --env=homolog
     ````

 - C) Para Inserir as Permissions no Banco (HOMOLOGAÇÃO).
     ````
     envoy run permissions --env=homolog
     ````
 --------------------------------------
 ##### PRODUÇÃO

 - A) Para Deploy (PRODUÇÃO).
     ````
     envoy run deploy --env=production --branch=master
     ````

 - B) Para Criar o Usuário *superadmin* (HOMOLOGAÇÃO).
     ````
     envoy run seed --env=production
     ````

 - C) Para Inserir as Permissions no Banco (HOMOLOGAÇÃO).
     ````
     envoy run permissions --env=production
     ````

 ##### DEPLOY REFRESH

  - Para limpar todo o banco e reiniciar a aplicação no server

    A) HOMOLOGAÇÃO
     ````
     envoy run deployRefresh --env=homolog --branch=master
     ````

    B) PRODUÇÃO
     ````
     envoy run deployRefresh --env=production --branch=master
     ````
