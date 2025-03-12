# Catálogo para revisão sistemática das extensões de BPMN

Foi desenvolvido para armazenar resultados de revisão sistemática da literatura, para posterior apresentação e análise de resultados.
Está sendo utilizado em: 

# Usando docker

Copie e cole o arquivo .env.example com o nome .env

Edite os atribuidos UID e GID se necessário para os ids do seu usuário Linux, WSL ou  MACOS

Linux e WSL UID e GID geralmente são 1000

Mac UID é 501 e GID é 20

No arquivo .env também edite as credenciais do Single Sign on conforme as documentações das plataformas (Facebook, Google e Github)

```
docker-compose build
```

```
docker-compose up -d
```

No navegador você acessa com http://localhost:8000


Assim que o container subir você deve instalar as dependência

```
docker-compose exec web composer install
```

```
docker-compose exec web php artisan migrate
```
