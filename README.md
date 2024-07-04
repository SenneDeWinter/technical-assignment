# Technical assignment Take The Lead

### Installation
1. Clone
```bash
  git clone git@github.com:SenneDeWinter/technical-assignment.git
```
2. Install
```bash
  composer install
  npm install
  cp .env.example .env
  php artisan key:generate
  php artisan migrate:fresh
  npm run dev
```

### Database

> [!WARNING]  
> Make sure to add your database credentials to the .env file

### Marvel API

> [!WARNING]  
> Make sure to add your own Marvel API keys to the .env file

### Runnning tests

```bash
  composer test
  composer coverage
```
