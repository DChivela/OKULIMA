# OKULIMA
# Okulima - Sistema de Gestão Agrícola Inteligente

## Sumário

- [Sobre o Projeto](#sobre-o-projeto)
- [Funcionalidades](#funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Populando o Banco de Dados](#populando-o-banco-de-dados)
- [Executando o Projeto](#executando-o-projeto)
- [Contribuindo](#contribuindo)
- [Licença](#licença)

## Sobre o Projeto

Okulima é um sistema de gestão agrícola inteligente desenvolvido para auxiliar na administração de fazendas, equipamentos, trabalhadores, atividades e colheitas. Este projeto visa otimizar a produtividade agrícola através de um sistema centralizado e intuitivo.

## Funcionalidades

1. **Gestão de Usuários**: Criação, edição e exclusão de usuários com diferentes níveis de acesso.
2. **Gestão de Trabalhadores**: Administração de trabalhadores e suas profissões.
3. **Gestão de Equipamentos**: Controle de equipamentos agrícolas, incluindo aquisição e custos operacionais.
4. **Gestão de Fazendas e Campos de Cultivo**: Gerenciamento de fazendas, incluindo dados de aquisição, exploração e irrigação.
5. **Gestão de Produtos**: Administração de produtos agrícolas.
6. **Atividades de Abastecimento**: Registro de abastecimentos realizados nos equipamentos.
7. **Atividades de Máquinas**: Controle de atividades realizadas pelas máquinas.
8. **Atividades de Colheitas**: Registro das colheitas realizadas.
9. **Atividades de Trabalhadores**: Controle das atividades realizadas pelos trabalhadores.
10. **Sistema de Busca**: Busca inteligente em várias tabelas do sistema.

## Tecnologias Utilizadas

- **Linguagem de Programação**: PHP
- **Framework**: Laravel
- **Banco de Dados**: MySQL
- **Front-end**: Blade, HTML, CSS, JavaScript
- **Outras Ferramentas**: Composer, Artisan

## Requisitos

- PHP >= 7.3
- Composer
- MySQL
- Servidor Apache ou Nginx

## Instalação

1. **Clone o Repositório**

   ```bash
   git clone https://github.com/seu-usuario/okulima.git
   cd okulima
   
2. **Instale as Dependências**

   ```bash
   composer install
   npm install && npm run dev

3. **Copie o Arquivo .env**

   ```bash
   cp .env.example .env

4. **Gere a Chave da Aplicação**

   ```bash
   php artisan key:generate

5. **Configure o Arquivo .env**

   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=okulima
    DB_USERNAME=root
    DB_PASSWORD=secret


6. **Migre as Tabelas**

   ```bash
   php artisan migrate
   php artisan db:seed
   php artisan serve

7. **Inicie o sistema**

   ```bash
   php artisan serve
