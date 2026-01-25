# LAMP Application - Source Code

LAMP stack application deployed on Kubernetes with GitOps (ArgoCD).

## Architecture

- **Apache** (httpd:2.4-alpine) - Web server
- **PHP-FPM** (php:8.3-fpm-alpine) - PHP processor
- **MySQL** (mysql:9.x) - Database

## Docker Images

Images are automatically built and pushed to GitHub Container Registry (GHCR):

- `ghcr.io/dolphin-vr/lamp-app-source/php:latest`
- `ghcr.io/dolphin-vr/lamp-app-source/apache:latest`

## Development Workflow

1. Edit code in `php/app/`
2. Commit and push to `main` branch
3. GitHub Actions builds and pushes Docker images
4. GitHub Actions updates image tags in `lamp-app-manifests` repo
5. ArgoCD automatically syncs and deploys to Kubernetes

## Local Development
```bash
# Build images locally
docker build -t lamp-php ./php
docker build -t lamp-apache ./apache

# Run with docker-compose (for local testing)
docker-compose up
```

## Deployment

Application is deployed via ArgoCD from the manifests repository:
https://github.com/dolphin-vr/lamp-app-manifests
