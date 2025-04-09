PSS 02/2025/SEPLAG (Analista de TI - Perfil Junior, Pleno e Sênior)  
Candidato: FFELIPE MOREIRA DE OLIVEIRA

Inscrição: 7990

Inscriçao: 9641

# ARQUIVO COM TESTES DE POSTMAN NA RAIZ DO PROJETO
SEPLAG_TESTES_ENDPOINTS.postman_collection.json




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

# 📦 SEPLAG API

API RESTful para gerenciamento de dados de pessoas, unidades administrativas, servidores (efetivos e temporários), fotos de perfil e autenticação.  
Esta aplicação é destinada a sistemas de gestão pública e pode ser utilizada para fins de integração com frontend ou outras ferramentas.

---

## 🔐 Autenticação

### POST `/api/login`  
Realiza login e retorna um token JWT para autenticação nas demais rotas.

**Exemplo de payload:**
```json
{
  "email": "teste@teste.com",
  "password": "senha123"
}
```

### POST `/api/refresh`  
Gera um novo token de acesso (refresh token).

---

## 👤 Pessoas

### GET `/api/pessoas`  
Retorna a lista de todas as pessoas cadastradas.

### POST `/api/pessoas`  
Cadastra uma nova pessoa.

**Payload de exemplo:**
```json
{
  "pes_nome": "Pessoa 22",
  "pes_data_nascimento": "2004-02-22",
  "pes_sexo": "Masculino",
  "pes_mae": "Mãe 22",
  "pes_pai": "Pai 22"
}
```

### GET `/api/pessoas/{id}`  
Retorna os dados de uma pessoa específica pelo ID.

### PUT `/api/pessoas/{id}`  
Atualiza os dados de uma pessoa existente.

**Payload de exemplo:**
```json
{
  "pes_mae": "Mãe Atualizada",
  "pes_pai": "Pai Atualizado"
}
```

---

## 🏢 Unidades

### GET `/api/unidades`  
Retorna a lista de todas as unidades cadastradas.

### POST `/api/unidades`  
Cadastra uma nova unidade.

**Payload de exemplo:**
```json
{
  "unid_nome": "Unidade 22",
  "unid_sigla": "U22"
}
```

### GET `/api/unidades/{id}`  
Retorna os dados de uma unidade específica.

### PUT `/api/unidades/{id}`  
Atualiza os dados de uma unidade.

**Payload de exemplo:**
```json
{
  "unid_nome": "Unidade Atualizada",
  "unid_sigla": "UA"
}
```

---

## 👷 Servidores Temporários

### GET `/api/servidores-temporarios`  
Lista todos os servidores temporários.

### POST `/api/servidores-temporarios`  
Cadastra um novo servidor temporário.

**Payload de exemplo:**
```json
{
  "pes_id": 6,
  "st_data_admissao": "2024-02-22"
}
```

### GET `/api/servidores-temporarios/{id}`  
Retorna os dados de um servidor temporário específico.

### PUT `/api/servidores-temporarios/{id}`  
Atualiza os dados de um servidor temporário.

**Payload de exemplo:**
```json
{
  "st_data_demissao": "2025-12-31"
}
```

---

## 🧑‍💼 Servidores Efetivos

### GET `/api/servidores-efetivos`  
Lista todos os servidores efetivos.

### POST `/api/servidores-efetivos`  
Cadastra um servidor efetivo.

**Payload de exemplo:**
```json
{
  "pes_id": 6,
  "se_matricula": "EFETIVO22"
}
```

### GET `/api/servidores-efetivos/{id}`  
Retorna os dados de um servidor efetivo específico.

### PUT `/api/servidores-efetivos/{id}`  
Atualiza dados do servidor efetivo.

**Payload de exemplo:**
```json
{
  "se_matricula": "EFETIVO005 UPDATE"
}
```

### GET `/api/servidores-efetivos/unidade/{unidade_id}`  
Lista todos os servidores efetivos de uma determinada unidade.

### GET `/api/servidores-efetivos/endereco-funcional?nome={nome}`  
Busca servidores efetivos pelo nome, retornando seus dados com endereço funcional.

---

## 🖼️ Foto da Pessoa

### POST `/api/pessoa_foto`  
Realiza o upload de uma foto para uma pessoa.

**Formulário esperado (multipart/form-data):**
- `pes_id`: ID da pessoa
- `foto`: Arquivo de imagem

### GET `/api/pessoa_foto/{id}`  
Retorna a imagem vinculada ao ID da pessoa.

---

## 🛡️ Segurança

Todos os endpoints (exceto `/api/login`) exigem autenticação com token Bearer no cabeçalho da requisição:

```
Authorization: Bearer {TOKEN}
```

---

## 🔧 Observações

- Certifique-se de configurar corretamente as variáveis de ambiente no Postman, principalmente o `{{TOKEN}}` de autenticação.
- As rotas seguem o padrão RESTful para facilitar integração e manutenção.


## ✅ Requisitos

- Docker + Docker Compose
- PHP 8.2
- Laravel 12
- PostgreSQL 15
- MinIO (via container)

---