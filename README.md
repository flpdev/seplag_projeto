PSS 02/2025/SEPLAG (Analista de TI - Perfil Junior, Pleno e Sênior)  
Candidato: FFELIPE MOREIRA DE OLIVEIRA
Inscrição: 7990


# Projeto Laravel com PostgreSQL e MinIO

Este projeto utiliza Laravel 12, PostgreSQL como banco de dados e MinIO para armazenamento de objetos compatível com S3.

---

## 🚀 Primeira execução do projeto

Suba os containers e construa as imagens:

```bash
docker-compose up -d --build
```

---

## ▶️ Execuções posteriores

Suba os containers normalmente (sem rebuild):

```bash
docker-compose up -d
```

---

## 📦 Instalar dependências do Laravel

Execute o Composer dentro do container Laravel:

```bash
docker exec -it laravel_app composer update
```

---

## 🛠️ Criar estrutura do banco de dados

Rode as migrations:

```bash
docker exec -it laravel_app php artisan migrate
```

---

## 🌱 Popular banco de dados com seeders

Execute o seeder principal:

```bash
docker exec -it laravel_app php artisan db:seed --class=DatabaseSeeder
```

---

## 🗂️ Console do MinIO (Armazenamento de Imagens)

Acesse via navegador:

🔗 http://localhost:9101

**Credenciais padrão:**

- Usuário: `minioadmin`
- Senha: `minioadmin`

📌 Após login:
1. Vá em **Object Browser**
2. Clique em **Create a Bucket**
3. Crie um bucket com o nome **`photos`**

---

## ✅ Requisitos

- Docker + Docker Compose
- PHP 8.2
- Laravel 12
- PostgreSQL 15
- MinIO (via container)

---