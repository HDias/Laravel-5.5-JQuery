### Configuração LOCAL (DEV)

 - A) Instalar as dependências PHP
     ````
     composer update
     composer dumpautoload
     php artisan db:seed --class=CidadesEstadosSeeder
     php artisan config:clear
     ````

 - B) Intalar dependências JS
     ````
     npm install
     ````

*OBS: existe uma arquivo que já tem essa sequencia de comandos*
     ``bash bin/update``

 - C) Criar Banco e Inserir Tabelas e dados Fake

    *Configure seu arquivo `.env` antes disso com a conexão do Banco de daos Local*
     ````
     php artisan config:clear
     php artisan config:cache
     composer dumpautoload
     php artisan migrate:reset
     php artisan db:seed --class=CidadesEstadosSeeder # Cria as tabelas de cidades e estados
     php artisan migrate --seed
     php artisan louzada:create:permission --force # Cria as permissões de acordo com as rotas com shield

     ````

  *OBS: existe uma arquivo que já tem essa sequência de comandos. O Comando abaixo*
     `` bash bin/migrate``
