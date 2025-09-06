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