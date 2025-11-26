# 📘 PHP Basic Setup

Este projeto é um ambiente mínimo e moderno para desenvolvimento em PHP,
totalmente isolado em Docker, contendo:

-   PHP 8.4 (Alpine)
-   Composer
-   PHPUnit
-   PHPStan
-   Xdebug
-   Node + npm
-   Servidor embutido do PHP (`php -S`)
-   Autoload PSR-4 com `src/`

Ideal para estudos, pequenos projetos ou como template inicial.

------------------------------------------------------------------------

## 🚀 Como executar

### 1. Suba o container

``` sh
docker compose up --build -d
```

A aplicação ficará disponível em:

    http://localhost:8000

------------------------------------------------------------------------

## 🐳 Docker

O ambiente roda com:

-   Porta exposta: **8000**
-   Montagem do diretório do projeto em `/app`
-   Instalação automática das dependências via `composer install`
-   Servidor embutido do PHP apontando para `public/`

------------------------------------------------------------------------

## 📂 Estrutura do projeto

    .
    ├── public/
    │   └── index.php
    ├── src/
    │   └── ...
    ├── tests/
    │   └── ...
    ├── docker/
    │   └── php/
    │       └── xdebug.ini
    ├── .husky/
    │   └── install-from-apt.sh
    └── composer.json

------------------------------------------------------------------------

## 🧪 Scripts disponíveis

### Rodar testes

``` sh
docker exec app composer test
```

### Rodar PHPStan

``` sh
docker exec app composer stan
```

### Rodar análise + testes

``` sh
docker exec app composer check-all
```

### Gerar cobertura de testes

``` sh
docker exec app composer coverage
```

A cobertura será gerada em `coverage/`.

### Rodar Pré Commit Manualmente

``` sh
docker exec app composer pre-commit
```
CsFixer + PhpUnit + PhpStan 

------------------------------------------------------------------------

## 🐞 Debug com Xdebug

Variáveis já configuradas:

    XDEBUG_MODE=debug
    XDEBUG_SESSION=1

Ajustes adicionais podem ser feitos em:

    docker/php/xdebug.ini

------------------------------------------------------------------------

## ⚙️ Instalação opcional do NVM (Debian/Ubuntu)

O repositório inclui o script:

    .husky/install-from-apt.sh

Esse arquivo é útil quando o projeto precisa ser configurado em um
ambiente **fora do Docker**, usando uma base **Debian/Ubuntu** (APT).

O script faz:

-   Instalação do `curl` (se necessário)
-   Download do instalador oficial do NVM
-   Carregamento automático do NVM no shell
-   Possibilidade de instalar uma versão específica do Node.js

Exemplo de uso:

``` sh
chmod +x .husky/install-from-apt.sh
./.husky/install-from-apt.sh
```

Este script **não é executado automaticamente** dentro do container (que
já usa Alpine e já possui Node instalado), mas fica disponível como
utilitário para quem quiser configurar o ambiente local manualmente.

------------------------------------------------------------------------

## 👤 Autor

**Pedro Barros**
