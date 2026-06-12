# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Gladius Card** is a Laravel 11 application serving as a "warrior card" management system. It has two surfaces:
- A **Filament v3 admin panel** (`/admin`) for managing all entities
- A **REST API** (`/api/warriors`) consumed by external clients (e.g., a card display frontend)

## Commands

```bash
# Install dependencies
composer install
yarn install

# Setup
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

# Run locally
php artisan serve
yarn dev   # Vite for assets

# Using Laravel Sail (Docker)
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed

# Tests
php artisan test
php artisan test --filter=TestClassName   # single test class
php artisan test tests/Feature/ExampleTest.php  # single file

# Code style (Laravel Pint)
./vendor/bin/pint

# Clear caches after config changes
php artisan optimize:clear
```

## Architecture

### Domain Model

```
Clan (has many Warriors)
  └─ Warriors (belongs to Clan, soft deletes)
       └─ computed attributes: logo_xp, logo_hp, logo_leader
            └─ resolved via Insignia lookup by Group.field + requirement threshold

Group (has many Insignias)
  └─ Group.field links to Warrior attributes ('xp' | 'hp')

Insignia (belongs to Group)
  └─ path: file path to badge image, requirement: numeric threshold
```

### Insignia Resolution (key business logic)

`Warrior` has three computed Eloquent `Attribute` accessors ([app/Models/Warrior.php](app/Models/Warrior.php)):
- `logo_xp` / `logo_hp`: find the highest-requirement `Insignia` in the matching `Group` where `requirement <= warrior.xp/hp`
- `logo_leader`: returns the "Mestre Fundador" insignia path if `is_leader === true`

These are computed on-the-fly — not stored on the `warriors` table.

### API Layer

Routes in [routes/api.php](routes/api.php) — no authentication required:
- `GET /api/warriors` → `RetrivedAllWarriors` → `WarriorCollection`
- `GET /api/warriors/{warrior}` → `ShowWarrior` → `WarriorResource`

`WarriorResource` ([app/Http/Resources/WarriorResource.php](app/Http/Resources/WarriorResource.php)) resolves all image paths via `Storage::disk('public')->url(...)`. The `leader_logo` key is only included when `is_leader` is true.

### Admin Panel

Filament panel at `/admin` ([app/Providers/Filament/AdminPanelProvider.php](app/Providers/Filament/AdminPanelProvider.php)). Resources auto-discovered from `app/Filament/Resources/`:
- `WarriorResource` — includes soft-delete support (Restore/ForceDelete actions), photo upload to `public` disk with image editor
- `ClanResource`, `GroupResource`, `InsigniaResource`, `UserResource`

All models use `SoftDeletes`. The Filament resources override `getEloquentQuery()` to include soft-deleted records with a `TrashedFilter`.

### File Storage

Warrior photos and insignia images are stored on the `public` disk. Run `php artisan storage:link` if public symlink is missing.

### Deployment

GitHub Actions ([.github/workflows/deploy.yml](.github/workflows/deploy.yml)) deploys on push to `main` via SSH: pulls, `composer install`, `php artisan migrate --force`, `php artisan optimize`. Secrets: `HOST`, `USERNAME`, `PASSWORD`, `PORT`.
