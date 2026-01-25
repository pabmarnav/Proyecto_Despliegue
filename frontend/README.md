# Frontend Project

## Despliegue en Desarrollo
1. Construir e iniciar contenedores:
   ```bash
   docker compose -f docker-compose.yml up --build -d
   ```
2. Acceder a `http://localhost`.

## Despliegue en Producción
1. Iniciar contenedores:
   ```bash
   docker compose -f docker-compose.prod.yml up --build -d
   ```
2. La configuración de URLs se inyecta automáticamente desde `config/urls.prod.js`.
3. Configurar dominios en `conf/vhosts/production.conf`.
