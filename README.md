# Minimarket PRO-413 - Sistema de Microservicios

## Requisitos
- Docker y Docker Compose
- Java 17+ y Maven
- PHP 8+

## Ejecución

### 1. Base de datos
docker-compose up -d

### 2. Backend
cd backend && mvn spring-boot:run

### 3. Frontend
cd frontend && php -S localhost:8080

## URLs
- Frontend: http://localhost:8080
- API REST: http://localhost:8081/api/productos
- MySQL: localhost:3307 (db_minimarket_pro413)