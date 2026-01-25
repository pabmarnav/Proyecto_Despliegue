# Maintenance Site

## Despliegue en Desarrollo
1. Construir e iniciar contenedores:
   ```bash
   docker compose up --build -d
   ```
2. Acceder a `http://localhost`.

## Despliegue en AWS Elastic Beanstalk
1. Inicializar EBS:
   ```bash
   eb init -p docker maintenance-app
   ```
2. Crear entorno y desplegar:
   ```bash
   eb create maintenance-env
   eb open
   ```
