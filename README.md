## Getting Started

### Prerequisites

- Docker
- Docker Compose

### Installation

1. **Clone the repository**
2. **Copy the `.env.example` file to `.env`**
3. **Inside root of a project run small Docker container containing PHP and Composer to install the application's dependencies**
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
4. **Start Docker containers**
```
./vendor/bin/sail up
```
5. **Generate an application key**
```
./vendor/bin/sail artisan key:generate
```
6. **Run database migrations**
