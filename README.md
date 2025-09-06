# 🚀 SisFrete API

API desenvolvida em **Laravel** com **Docker**, utilizando MySQL e documentação com **Swagger**.

## ⚙️ Como rodar o projeto

Clone o repositório e rode o seguinte comando:

```bash
docker compose up -d --build
```

Isso irá:

- Subir o container da aplicação (PHP + Apache);
- Subir o banco de dados MySQL;
- Rodar migrations e seeders automaticamente;
- Gerar a documentação Swagger.

Após subir, acesse:

- **API** → http://localhost:8080
- **Swagger Docs** → http://localhost:8080/api/documentation

## ⚠️ Observação para usuários Windows

Se você estiver no Windows, pode ocorrer erro relacionado ao `entrypoint.sh`, como:

```bash
/usr/local/bin/entrypoint.sh: exec: line 2: syntax error: unexpected carriage return
```

Isso acontece por causa dos line endings (CRLF).

### Para corrigir:

1. **Converta o arquivo para LF:**
   - No VSCode: altere CRLF → LF no canto inferior direito.
   - Ou rode no Git Bash/WSL:
     ```bash
     dos2unix entrypoint.sh
     ```

2. **Garanta que o arquivo é executável:**
   ```bash
   chmod +x entrypoint.sh
   ```

3. **Rode novamente:**
   ```bash
   docker compose up -d --build
   ```

# Explicação Arquitetura Código

Foi usado uma Clean Arch (Arquitetura Limpa) no código, usando camadas de Repository (Interação com dados do Eloquent e Models) e Services (Aplicação de regras de négocio), também foi usado Inversão e Injeção de depêndencia para escalabilidade e manutenibilidade da aplicação, além de ser uma excelente prática.

# Explicação Sql

Os desafios e a explicação de melhoria de performance estão no arquivo `sisfrete.sql`

# Explicação Modelagem

A modelagem está no arquivo `diagram.png`

## Normalizações/Index
   1 - Tabelas Pivot foram usadas para normalizar as relações N para N de orders e products (Um produto pode estar em mais de um pedido e um pedido pode ter mais de um produto), e entre products e product_types, que segue a mesma lógica.
   
   2 - Customer_type foi criada para normalizar e tornar mais flexivem a manutenção de clientes juridicos(CNPJ) e físicos(CPF), e para o controle de documento de cada tipo de cliente também foi criado o campo 'national_identification', que é um index em customers, e já é normalizado.

## Proof
   1 - Nota-se que na tabela payments tem o campo proof, que ao invés de ser um BLOB(Binary Large Object) para guardar a imagem do comprovante, é um text, feito para guardar um PATH, dessa forma garantindo mais flexibilidade ao banco de dados que não precisará lhidar com um tipo tão pesado igual o BLOB, e também facilita a comunição com futuras integrações para o front-end.


