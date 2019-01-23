### Test - PHPUnit
Vamos criar seu ambiente de testes:

 - 1º `cp .env.testing.example .env.testing` Depois de copiar seu arquivo de configuração do banco de testes, rode o comando abaixo:
     ```
     bash bin/build-phpunit-env
     ```

  - 2º Agora rode os tests existente e veja se está tudo certo:
      ```
      bash bin/phpunit
      ```

  #### ATENÇÃO! Para utilizar novamente os sistema via NAVEGADOR rode:
  ```
  php artisan config:cache
  ```