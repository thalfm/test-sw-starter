
# 📘 **Star Wars Full-Stack Application**

This project is a full-stack application built with:

- **Laravel (PHP 8.4)** — Backend API  
- **Nginx** — Web server and reverse proxy  
- **PHP-FPM 8.4** — FastCGI process manager for Laravel  
- **React (Vite)** — Frontend application  
- **Docker & Docker Compose** — Containerized environment for development  
- **Node 18** — For building the React application  

The project is fully containerized and can be run on:

- macOS (Intel and Apple Silicon M1/M2/M3)  
- Linux  
- Windows (WSL2 recommended)

---

# 🚀 **Technologies Used**

### **Backend (Laravel + PHP-FPM 8.4)**
- Laravel framework serving REST endpoints under `/api/*`
- PHP-FPM 8.4 for efficient request processing
- Composer for dependency management
- PDO + MySQL extension enabled

### **Web Server (Nginx)**
- Serves the Laravel `public/` directory
- Forwards PHP requests to `backend:9000`
- Handles URL rewriting via `try_files` directive

### **Frontend (React + Vite)**
- Built using Node 18 inside Docker
- Production-ready static build served by Nginx

### **Docker Architecture**
- Containers:
  - `backend` → PHP-FPM + Laravel
  - `nginx` → Web server for the backend
  - `frontend` → React app served by Nginx
- Shared Docker network: `appnet`

---

# 📁 **Project Structure**

```
project-root/
│
├── star-wars-backend/        # Laravel application
│   ├── app/
│   ├── public/
│   ├── routes/
│   ├── vendor/
│   ├── Dockerfile
│
├── star-wars-frontend/       # React application
│   ├── src/
│   ├── dist/
│   ├── Dockerfile
│
├── nginx/
│   └── default.conf          # Nginx config for Laravel
│
└── docker-compose.yml        # Multi-container setup
```

---

# 🐳 **Running the Application with Docker Compose**

Make sure you have:

- **Docker** installed  
- **Docker Compose** installed or Docker Desktop (includes Compose)

---

## ✅ **1. Build and start all services**

From the project root:

```bash
docker-compose build
```

Then:

```bash
docker-compose up mysql
```

PS: wait until the mysql to be ready

Then:

```bash
docker-compose up backend
```

PS: wait until the migration to be completed

Then:

```bash
docker-compose up
```

Docker will:

1. Build the **PHP-FPM/Laravel** backend
2. Build the **Nginx** server for Laravel
3. Build the **React** frontend (Node build → served by Nginx)
4. Build the **MySQL** MySql
5. Build the **Larave Redis** redis
6. Build the **Larave Queue** Execute Laravel Jobs
7. Build the **Larave Scheduler** Cron

---

## 🔍 **2. Access the applications**

### **Frontend (React UI)**
```
http://localhost:3000
```

### **Backend (Laravel API)**
```
http://localhost:8000/api/people
http://localhost:8000/api/movies
```

---

## 🔁 **3. Stopping the environment**

```bash
docker-compose down
```

To remove volumes (cache, vendor, etc.):

```bash
docker-compose down -v
```

---

# ⚙️ **Development Notes**

### Laravel
If you change backend code, the `backend` container automatically reflects updates due to volume mounting:

```
./star-wars-backend:/var/www/html
```

### React
To rebuild the frontend:

```bash
docker-compose build frontend
```

### Logs

Backend logs:

```bash
docker logs php-backend
```

Nginx logs:

```bash
docker logs laravel-nginx
```

Frontend logs:

```bash
docker logs react-frontend
```

---

# 📌 **Environment Requirements**

- Docker 20+
- Docker Compose 1.29+ or Docker Desktop
- At least 4GB RAM recommended for smooth container performance
