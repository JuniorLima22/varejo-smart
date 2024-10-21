
# Sistema de Vendas para Estabelecimento Varejista

## Resumo do Projeto

Este projeto é um sistema web desenvolvido para otimizar a gestão de vendas de um estabelecimento comercial no setor varejista. O sistema permite o cadastro de produtos, gerenciamento de clientes e vendas, além de enviar notificações por e-mail com os detalhes das compras realizadas. O cliente também pode consultar o status de suas compras por meio de um link enviado por e-mail.

### Funcionalidades principais:
- Cadastro de produtos com imagem, descrição, preço de compra e venda, categoria e estoque.
- Cadastro e gerenciamento de clientes, com informações como nome, CPF, e-mail, telefone, e endereço.
- Realização de vendas com aplicação de cupons de desconto.
- Envio automático de e-mails com os detalhes da venda para os clientes após finalização.
- Consultar status e itens da compra através de uma área pública do sistema.

## Tecnologias Utilizadas

- **Linguagem**: PHP 8.x
- **Framework**: Laravel 11.x
- **Front-end**: Livewire
- **Banco de Dados**: PostgreSQL
- **Template de UI**: AdminLTE 3
- **Gerenciamento de dependências**: Composer
- **Gerenciamento de pacotes JS/CSS**: NPM
- **Serviço de e-mail**: Mailtrap (para ambiente de desenvolvimento)

## Pré-requisitos

Antes de começar, certifique-se de ter instalado as seguintes ferramentas em sua máquina:
- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/) (v8.0 ou superior)
- [Node.js](https://nodejs.org/) com npm
- [PostgreSQL](https://www.postgresql.org/)

## Instalação

Siga os passos abaixo para instalar e rodar o projeto localmente:

### 1. Clonar o repositório

```bash
git clone https://github.com/JuniorLima22/varejo-smart.git
```

```bash
cd varejo-smart
```

### 2. Instalar dependências do PHP via Composer

```bash
composer install
```

### 3. Instalar dependências do NPM

```bash
npm install && npm run dev
```

### 4. Configurar o arquivo `.env`

Copie o arquivo `.env.example` e renomeie-o para `.env`:

```bash
cp .env.example .env
```

Em seguida, configure as variáveis de ambiente no `.env`, incluindo as credenciais de acesso ao banco de dados PostgreSQL, servidor de e-mail e outros parâmetros necessários.

### 5. Gerar a chave da aplicação

```bash
php artisan key:generate
```

### 6. Configurar o banco de dados

Crie o banco de dados no PostgreSQL:

```sql
CREATE DATABASE nome_do_banco;
```

Atualize as informações de banco de dados no arquivo `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 7. Executar as migrações e seeders

Rode as migrações para criar as tabelas no banco de dados e, em seguida, execute os seeders para popular as tabelas com dados iniciais:

```bash
php artisan migrate --seed
```

### 8. Iniciar o servidor

Você pode iniciar o servidor de desenvolvimento com o comando:

```bash
php artisan serve
```

O projeto estará acessível em `http://localhost:8000`.

### 9. Configurar o link simbólico para exibir imagens (opcional)

Se você precisar acessar arquivos salvos no storage, crie o link simbólico:

```bash
php artisan storage:link
```

### 10. Configurar serviço de e-mail com **Mailtrap**

Este projeto utiliza **Mailtrap** para testes de envio de e-mail no ambiente de desenvolvimento.

#### 10.1 Criar conta no Mailtrap

Acesse o [Mailtrap](https://mailtrap.io/) e crie uma conta, se ainda não tiver uma. Após isso, no painel do Mailtrap, acesse as **configurações SMTP** e copie as credenciais para configurar no arquivo `.env`.

#### 10.2 Configurar credenciais de SMTP no `.env`

No arquivo `.env`, atualize as configurações para que o Laravel envie os e-mails usando o Mailtrap:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@seuprojeto.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 11. Executar Job para envio de e-mail

Após a finalização de uma venda, um Job é automaticamente acionado para enviar os dados da venda por e-mail ao cliente.

Caso precise executar o Job manualmente, você pode usar o seguinte comando:

```bash
php artisan queue:work
```

## Considerações Finais

Este projeto foi desenvolvido como um exemplo de sistema para otimização da gestão de um estabelecimento comercial. Com o uso de tecnologias modernas como **Laravel**, **Livewire** e **AdminLTE**, foi possível criar um ambiente robusto para gerenciar vendas e clientes, com notificações por e-mail e histórico de pedidos.

### Licenca

O sistema All Blacks é um software de código aberto licenciado sob a [MIT license](http://opensource.org/licenses/MIT).

### Wakatime
Tempo gasto no IDE para este repositório, rastreado automaticamente com [wakatime](https://wakatime.com/) .

[![wakatime](https://wakatime.com/badge/user/98eb4d56-ff6f-4d95-9ae5-48ec3f8d717a/project/f08a5cbd-95e9-43bd-8b74-8c8ff836669a.svg)](https://wakatime.com/badge/user/98eb4d56-ff6f-4d95-9ae5-48ec3f8d717a/project/f08a5cbd-95e9-43bd-8b74-8c8ff836669a)

### Autor

> Made with 💙 by JUNIOR LIMA 👋 <a href="https://www.linkedin.com/in/JuniorLima22/" target="_blank">See my LinkedIn</a> • GitHub <a href="https://github.com/JuniorLima22" target="_blank">@JuniorLima22</a>

<p align="center">
<sub><a href="#top" align="center">↑ voltar para o topo ↑</a></sub>
</p>