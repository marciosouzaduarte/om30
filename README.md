
<p align="center"><a href="https://om30.com.br" target="_blank"><img src="https://h77b30.p3cdn1.secureserver.net/wp-content/uploads/2022/06/logo-om30-1.png" width="400" alt="OM30 Logo"></a></p>

## Setup do teste OM30

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/marciosouzaduarte/om30.git
```

Entre na pasta gerada
```sh
cd om30/
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Entre na máquina que tem a aplicação
```sh
docker exec -it om30-app bash
```


Baixe as dependências
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Crie as tabelas
```sh
php artisan migrate
```

Gere dados fake
```sh
php artisan db:seed
```

Adicione a pasta Unit
```sh
mkdir tests/Unit
```


Acesse o projeto
[http://localhost](http://localhost)
