# CLAUDE.md

## Project overview
- This repository is a Laravel 10 application for creating and playing story scenes for an otome game workflow.
- `README.md` is the default Laravel README (framework overview, docs links, security policy, license), so project-specific behavior is mainly defined in `routes/`, `app/Http/Controllers/`, `app/Models/`, and `database/migrations/`.

## Common developer commands

### Setup
```bash
cd /home/runner/work/OTOMEGAME/OTOMEGAME
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
```

### Local development
```bash
php artisan serve
npm run dev
```

### Build / test / lint
```bash
npm run build
php artisan test
./vendor/bin/pint --test
```

### Sail (Docker) workflow
`compose.yaml` is configured for Laravel Sail + MySQL 8.4 + phpMyAdmin:
```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### Notes from this repository check
- `npm install` and `npm run build` run successfully in this environment.
- `php artisan test` / Pint require `vendor/` (composer install). If composer cannot fetch packages in CI/sandbox, PHP-side commands will fail until dependencies are available.

## Major directory structure and architecture

```text
app/
  Http/Controllers/      # Story/Scene/Character/Background/Balloon CRUD + play flow
  Models/                # Eloquent domain models and relations
  Actions/Fortify/       # Registration/profile/password actions
  Providers/             # RouteServiceProvider + Fortify view/limiter setup
database/
  migrations/            # Schema for stories, scenes, characters, assets, users/auth tables
  factories/ seeders/    # Mostly default skeleton content
resources/views/
  auth/                  # Custom login/register Blade views
  stories|scenes|...     # Server-rendered CRUD/play templates
routes/
  web.php                # Main app routes (all domain routes under auth middleware)
  api.php                # Default Sanctum user endpoint
```

### Higher-level request flow
1. `/` redirects to Fortify login (`RouteServiceProvider::HOME` is `/story` after auth).
2. Authenticated users manage:
   - stories
   - characters and character images
   - backgrounds
   - balloons
   - scenes
3. Scene playback uses:
   - `GET /stories/{story}/play` to jump to the first scene by `order`
   - `GET /stories/{story}/play/{order}` to render one scene and find next scene
4. Views are Blade templates; no SPA framework is used.

### Ownership conventions used in controllers
- User scoping is explicit in queries:
  - stories/characters use `created_by`
  - backgrounds/balloons use `user_id`
  - scenes are scoped via `whereHas('story', created_by = auth()->id())`

## Tech stack

From `composer.json`, `package.json`, and config:
- PHP `^8.1`
- Laravel Framework `^10.10`
- Laravel Fortify (auth routes/actions/views)
- Laravel Sanctum (API auth token infrastructure)
- Laravel Tinker
- PHPUnit 10, Laravel Pint
- Frontend build: Vite 5 + `laravel-vite-plugin` + Axios
- Docker local env: Laravel Sail (`compose.yaml`), MySQL 8.4, phpMyAdmin

## Database design (inferred from migrations + models)

### Core domain tables
- `stories`
  - columns: `id`, `title`, `description`, `is_published`, `created_by`, timestamps
  - FK: `created_by -> users.id`
  - model: `Story` belongsTo `author(User)`, hasMany `scenes`

- `characters`
  - columns: `id`, `created_by`, `name`, `description`, timestamps
  - `created_by` is not declared as FK in migration
  - model: `Character` hasMany `character_images`

- `character_images`
  - columns: `id`, `character_id`, `image_path`, `pose_name`, timestamps
  - FK: `character_id -> characters.id` (cascade delete)
  - model: belongsTo `character`

- `backgrounds`
  - columns: `id`, `name`, `image_path`, `user_id`, timestamps
  - FK: `user_id -> users.id` (cascade delete)
  - model: referenced by scenes as `background_id1` / `background_id2`

- `balloons`
  - columns: `id`, `name`, `image_path`, `character_id (nullable)`, `user_id`, timestamps
  - FK: `character_id -> characters.id` (nullable, cascade delete)
  - FK: `user_id -> users.id` (cascade delete)
  - model: hasMany `scenes`, optional character-specific balloon

- `scenes`
  - columns: `id`, `story_id`, `order`, `background_id1`, `background_id2`, `balloon_id`, `text`, `character_image1_id`, `character_image2_id`, `character_image3_id`, timestamps
  - FK: `story_id -> stories.id` (cascade delete)
  - FKs to backgrounds/balloons/character_images are nullable with `set null` on delete
  - model: belongsTo story, two backgrounds, one balloon, up to three character images

### Auth/infrastructure tables
- Default Laravel tables: `users`, `password_reset_tokens`, `failed_jobs`, `personal_access_tokens`, two-factor columns migration.
- `2026_05_18_123118_add_role_to_users_table.php` currently has an empty migration body (no schema change yet).

## Practical notes for future coding assistance
- Uploaded asset paths are saved to DB and rendered via `asset('storage/...')`; remember `php artisan storage:link` for local access.
- Most business routes are protected by `auth` middleware in `routes/web.php`.
- Existing test suite is currently skeleton-level (`tests/Feature/ExampleTest.php`, `tests/Unit/ExampleTest.php`), so feature changes should usually include targeted tests when practical.
