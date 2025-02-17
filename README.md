# Desafio Revvo

Este repositório contém o projeto **Desafio Revvo**, desenvolvido em **PHP puro** (sem frameworks) com **SQLite** como banco de dados. O objetivo é apresentar um **CRUD de Cursos** e um **Slideshow**, seguindo o layout proposto e utilizando um **modal** exibido no primeiro acesso.

---

## Sumário

- [Visão Geral](#visão-geral)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Estrutura de Pastas](#estrutura-de-pastas)
- [Como Executar](#como-executar)
- [Funcionalidades](#funcionalidades)
- [Contato](#contato)

---

## Visão Geral

O Desafio Revvo envolve:
- **Página Inicial** (`index.php`) com:
  - **Slideshow** rotativo (um slide por vez, troca a cada 30s).
  - **Modal** que aparece apenas no primeiro acesso.
  - **Listagem de Cursos** (cada curso com botão para visualizar detalhes).
  - **Card** para adicionar novo curso.
- **CRUD de Cursos**:
  - Criar, listar, editar, visualizar e excluir cursos.
- **Banco de Dados** em **SQLite** (arquivo `database.sqlite` criado automaticamente).
- **Layout Responsivo** em HTML/CSS, usando Grid e Flexbox.

---

## Tecnologias Utilizadas

- **PHP** (versão 7 ou superior)
- **SQLite** (banco de dados em arquivo)
- **HTML5**, **CSS3** e **JavaScript** (DOM, eventos, etc.)
- **Sem Frameworks** de PHP ou JS
- (Opcional) **Gulp** ou **Grunt** para automação de tarefas

---

## Como Executar

1. **Clone ou Baixe** este repositório.
2. Acesse a pasta raiz do projeto (onde está o `index.php`).
3. Rode o servidor embutido do PHP:
   ```bash
   php -S localhost:8080
   ```
4. Abra o navegador em:
    ```bash
    http://localhost:8080
    ```
5. Na primeira execução, o arquivo includes/sqlite.php criará o banco database.sqlite (se não existir) e poderá inserir dados iniciais (3 cursos e 3 slides).
