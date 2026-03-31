<p align="center">
    <a
        href="https://laravel.com"
        target="_blank"
    >
        <img
            src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"
            alt="Laravel Logo">
    </a>
</p>

## Start Project

### Composer

Install dependencies:

```bash
composer install
```

Update dependencies:

```bash
composer update
```

Check outdated dependencies:

```bash
composer outdated
```

### Node

Install dependencies:

```bash
pnpm i
```

Check outdated dependencies:

```bash
pnpm outdated
```

Upgrade dependencies to latest minor versions:

```bash
pnpm add -g npm-check-updates
ncu -u -t minor
```

Upgrade dependencies to latest major versions:

```bash
pnpm add -g npm-check-updates
ncu -u -t latest
```

### DDEV

Start the local environment:

```bash
ddev start
```

### Initialization

Copy the example environment file to .env:

```bash
cp .env.example .env
```

Generate the application key:

```bash
ddev artisan key:generate
```

Run the seeders:

```bash
ddev artisan db:seed
```

Generate types:

```bash
ddev artisan typescript:transform
```
