# MAttermost

- image: https://github.com/politsin/docker-images/tree/main/mattermost
- Expose port: 8065

## DB:

- MySQL: "${DB_USER}:${DB_PASS}@tcp(mysql:3306)/${DB}?charset=utf8mb4,utf8\u0026readTimeout=30s\u0026writeTimeout=30s"
- Pgostgres: "${DB_USER}:${DB_PASS}@tcp(postgres:5432)/${DB}"
