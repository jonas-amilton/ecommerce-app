# Ecommerce App

Aplicacao ecommerce em Laravel 12 com areas separadas por perfil de usuario:

- Storefront publico
- Painel de Admin
- Painel de Seller
- Painel de Customer

O projeto usa autenticacao multi-guard com subdominios dedicados.

## Stack Tecnica

- PHP 8.2+
- Laravel 12
- Blade
- Tailwind CSS 4
- Alpine.js
- Vite
- Pest/PHPUnit para testes

## Arquitetura de Acesso

Cada perfil usa um guard e subdominio proprio:

- Admin: `admin.ecommerce.local` (guard `admin`)
- Seller: `seller.ecommerce.local` (guard `seller`)
- Customer: `customer.ecommerce.local` (guard `customer`)
- Storefront: `ecommerce.local`

Atalhos no dominio principal:

- `GET /signin` redireciona para `customer.login`
- `GET /signup` redireciona para `customer.register`

## Requisitos

- PHP 8.2+
- Composer
- Node.js 18+
- npm
- Banco de dados configurado no `.env`
- Apache 2 com `mod_rewrite` habilitado (para uso com subdominios locais)

## Setup Local

### 1) Dependencias

```bash
composer install
npm install
```

### 2) Arquivo de ambiente

```bash
cp .env.example .env
php artisan key:generate
```

### 3) Configuracao minima no `.env`

```env
APP_URL=http://ecommerce.local
APP_DOMAIN=ecommerce.local
```

Configure tambem as variaveis de banco (`DB_*`) de acordo com seu ambiente.

### 4) Migracoes e seed

```bash
php artisan migrate --seed
```

Isso cria os usuarios padrao de acesso (ver secao de credenciais abaixo).

### 5) Entradas no `/etc/hosts`

```hosts
127.0.0.1 ecommerce.local
127.0.0.1 www.ecommerce.local
127.0.0.1 admin.ecommerce.local
127.0.0.1 seller.ecommerce.local
127.0.0.1 customer.ecommerce.local
```

## Apache (Ambiente Local)

Diretorio de sites:

```bash
/etc/apache2/sites-available
```

### ecommerce.local.conf

```apache
<VirtualHost *:80>
    ServerName ecommerce.local
    ServerAlias www.ecommerce.local
    DocumentRoot /var/www/ecommerce-app/public

    <Directory /var/www/ecommerce-app/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/ecommerce.local_error.log
    CustomLog ${APACHE_LOG_DIR}/ecommerce.local_access.log combined

    SetEnv APP_ENV local
    SetEnv APP_DEBUG true
</VirtualHost>
```

### admin.ecommerce.local.conf

```apache
<VirtualHost *:80>
    ServerName admin.ecommerce.local
    DocumentRoot /var/www/ecommerce-app/public

    <Directory /var/www/ecommerce-app/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/admin.ecommerce.local_error.log
    CustomLog ${APACHE_LOG_DIR}/admin.ecommerce.local_access.log combined
</VirtualHost>
```

### seller.ecommerce.local.conf

```apache
<VirtualHost *:80>
    ServerName seller.ecommerce.local
    DocumentRoot /var/www/ecommerce-app/public

    <Directory /var/www/ecommerce-app/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/seller.ecommerce.local_error.log
    CustomLog ${APACHE_LOG_DIR}/seller.ecommerce.local_access.log combined
</VirtualHost>
```

### customer.ecommerce.local.conf

```apache
<VirtualHost *:80>
    ServerName customer.ecommerce.local
    DocumentRoot /var/www/ecommerce-app/public

    <Directory /var/www/ecommerce-app/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/customer.ecommerce.local_error.log
    CustomLog ${APACHE_LOG_DIR}/customer.ecommerce.local_access.log combined
</VirtualHost>
```

### Habilitar e recarregar Apache

```bash
sudo a2enmod rewrite
sudo a2ensite ecommerce.local.conf admin.ecommerce.local.conf seller.ecommerce.local.conf customer.ecommerce.local.conf
sudo systemctl reload apache2
```

## URLs Principais

### Storefront

- Home: `http://ecommerce.local/`
- Catalogo: `http://ecommerce.local/catalogo`
- Carrinho: `http://ecommerce.local/carrinho`
- Checkout: `http://ecommerce.local/checkout`

### Login e Cadastro

- Atalho login: `http://ecommerce.local/signin`
- Atalho cadastro: `http://ecommerce.local/signup`
- Admin login: `http://admin.ecommerce.local/login`
- Seller login: `http://seller.ecommerce.local/login`
- Customer login: `http://customer.ecommerce.local/login`
- Seller cadastro: `http://seller.ecommerce.local/register`
- Customer cadastro: `http://customer.ecommerce.local/register`

### Dashboards

- Admin: `http://admin.ecommerce.local/`
- Seller: `http://seller.ecommerce.local/`
- Customer: `http://customer.ecommerce.local/`

## Credenciais Padrao (Seed)

Disponiveis apos `php artisan migrate --seed`:

- Admin: `admin@example.com` / `password`
- Seller: `seller@example.com` / `password`
- Customer: `customer@example.com` / `password`
- Usuario generico: `test@example.com` / `password`

## Comandos Uteis

```bash
# Ambiente de desenvolvimento (server, queue, logs e vite)
composer run dev

# Rodar testes
composer run test
php artisan test

# Verificar rotas
php artisan route:list

# Limpar caches
php artisan optimize:clear
```

## Testes

O projeto usa Pest sobre a infraestrutura de teste do Laravel.

```bash
php artisan test
```

## Estrutura de Rotas

Arquivos principais de roteamento:

- `routes/web.php` (dominio principal + storefront + atalhos)
- `routes/storefront/web.php`
- `routes/admin/auth.php`
- `routes/admin/web.php`
- `routes/seller/auth.php`
- `routes/seller/web.php`
- `routes/customer/auth.php`
- `routes/customer/web.php`

A composicao de dominios e middlewares ocorre em `bootstrap/app.php`.

## Troubleshooting

### Subdominios nao funcionam

- Verifique entradas em `/etc/hosts`
- Verifique `APP_DOMAIN=ecommerce.local` no `.env`
- Verifique se os sites Apache estao habilitados (`a2ensite`)

### Erro 419/CSRF em login

- Confirme que esta acessando pela URL correta do subdominio
- Rode `php artisan optimize:clear`
- Recarregue a pagina para renovar sessao/cookie

### Erro de permissao em `storage` ou `bootstrap/cache`

```bash
chmod -R 775 storage bootstrap/cache
```

## Licenca

Este projeto usa a licenca MIT. Consulte `LICENSE`.
