## API REST

Car API: Uma API que oferece funcionalidades de CRUD (Create, Read, Update, Delete) para gerenciamento de informações sobre carros

### Passos para Configurar e Executar o Projeto Localmente

- Clone o repositório para sua máquina local.
- Crie um arquivo .env utilizando o .env-example como base.
- Atualize as configurações no .env conforme suas necessidades.
- Acesse a pasta do projeto pelo terminal (console/PowerShell/CMD).
- Execute o seguinte comando:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
 ```
- Após o término do processamento, inicie os serviços do contêiner executando o comando:
```shell
./sail up -d
```
