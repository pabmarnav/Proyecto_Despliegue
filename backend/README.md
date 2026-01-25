# Backend Project

## Despliegue en Desarrollo
1. Construir e iniciar contenedores:
   ```bash
   docker compose -f docker-compose.yml up --build -d
   ```
2. Acceder a `http://localhost:8080`.

## Despliegue en Producción
1. Configurar variables de entorno en `.env`.
2. Iniciar contenedores:
   ```bash
   docker compose -f docker-compose.prod.yml up --build -d
   ```
3. Configurar dominio en `conf/vhosts/production.conf`.
