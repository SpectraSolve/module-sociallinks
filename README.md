# SocialLinks Module for Laravel (nwidart/laravel-modules)

A Laravel module that centralizes your project's social links and provides:
- Admin UI to manage social URLs
- Redirect routes like /discord, /github, /twitter, etc.
- Publishable views and config

This module follows the nwidart/laravel-modules structure.


## Requirements
- PHP and Composer
- Laravel application using nwidart/laravel-modules
- Node.js (for building front-end assets with Vite, optional)

Note: If you need to install system dependencies on macOS, you can use Homebrew.


## Installation
1) Place the module in your Laravel app's Modules directory as Modules/SocialLinks.

2) Ensure it is registered via module manifest:
```json path=/Users/maxwitt/Downloads/module-sociallinks/module.json start=1
{
  "name": "SocialLinks",
  "alias": "sociallinks",
  "description": "",
  "keywords": [],
  "priority": 0,
  "providers": [
    "Modules\\SocialLinks\\Providers\\SocialLinksServiceProvider"
  ],
  "files": []
}
```

3) Install PHP dependencies (from your Laravel project root):
```bash path=null start=null
composer dump-autoload
```

4) Optionally install and build front-end assets (from this module folder or your root if you aggregate builds):
```bash path=null start=null
npm install
npm run build
```
The module ships with Vite configuration and dev dependencies:
```json path=/Users/maxwitt/Downloads/module-sociallinks/package.json start=1
{
  "private": true,
  "type": "module",
  "scripts": {
    "dev": "vite",
    "build": "vite build"
  },
  "devDependencies": {
    "axios": "^1.1.2",
    "laravel-vite-plugin": "^0.7.5",
    "sass": "^1.69.5",
    "postcss": "^8.3.7",
    "vite": "^4.0.0"
  }
}
```


## What it provides
- Service provider that registers routes, views, translations, and publishes config/views
```php path=/Users/maxwitt/Downloads/module-sociallinks/Providers/SocialLinksServiceProvider.php start=8
class SocialLinksServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'SocialLinks';
    protected string $moduleNameLower = 'sociallinks';

    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
```

- Config with metadata and admin menu entry
```php path=/Users/maxwitt/Downloads/module-sociallinks/Config/config.php start=1
<?php
return [
    'name' => 'SocialLinks',
    'icon' => 'https://imgur.png',
    'author' => 'Gamestacks',
    'version' => '1.3.0',
    'wemx_version' => '[*]',

    'elements' => [
        'admin_menu' => [
            [
                'name' => 'SocialLinks',
                'icon' => '<i class="fa-solid fa-link"></i>',
                'href' => '/admin/sociallinks',
                'style' => '',
            ],
        ],
    ]
];
```

- Web routes including admin page and social redirects
```php path=/Users/maxwitt/Downloads/module-sociallinks/Routes/web.php start=17
Route::middleware(['auth', 'permission:admin.view'])->group(function () {
    Route::get('/admin/sociallinks', [SocialLinksController::class, 'index']);

    Route::get('/discord', function () {
        return redirect(settings('sociallinks::discord', '/'));
    });
    Route::get('/github', function () {
        return redirect(settings('sociallinks::github', '/'));
    });
    Route::get('/twitter', function () {
        return redirect(settings('sociallinks::twitter', '/'));
    });
    Route::get('/tiktok', function () {
        return redirect(settings('sociallinks::tiktok', '/'));
    });
    Route::get('/gamepanel', function () {
        return redirect(settings('sociallinks::gamepanel', '/'));
    });
    Route::get('/instagram', function () {
        return redirect(settings('sociallinks::instagram', '/'));
    });
    Route::get('/youtube', function () {
        return redirect(settings('sociallinks::youtube', '/'));
    });
});
```

- Admin view to edit links (stored via a settings helper)
```php path=/Users/maxwitt/Downloads/module-sociallinks/Resources/views/index.blade.php start=30
<form action="{{ route('admin.settings.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-12">
            <label>Discord Link</label>
            <input type="text" name="sociallinks::discord" value="@settings('sociallinks::discord', '/')" class="form-control">
        </div>
        <div class="form-group col-12">
            <label>Github Link</label>
            <input type="text" name="sociallinks::github" value="@settings('sociallinks::github', '/')" class="form-control">
        </div>
        <div class="form-group col-12">
            <label>Twitter Link</label>
            <input type="text" name="sociallinks::twitter" value="@settings('sociallinks::twitter', '/')" class="form-control">
        </div>
        <div class="form-group col-12">
            <label>TikTok Link</label>
            <input type="text" name="sociallinks::tiktok" value="@settings('sociallinks::tiktok', '/')" class="form-control">
        </div>
        <div class="form-group col-12">
            <label>Gamepanel Link</label>
            <input type="text" name="sociallinks::gamepanel" value="@settings('sociallinks::gamepanel', '/')" class="form-control">
        </div>
        <div class="form-group col-12">
            <label>Instagram Link</label>
            <input type="text" name="sociallinks::instagram" value="@settings('sociallinks::instagram', '/')" class="form-control">
        </div>
        <div class="form-group col-12">
            <label>Youtube Link</label>
            <input type="text" name="sociallinks::youtube" value="@settings('sociallinks::youtube', '/')" class="form-control">
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">{!! __('admin.submit') !!}</button>
    </div>
</form>
```


## Usage
- Visit the admin page at /admin/sociallinks (requires auth and permission: admin.view).
- Fill in each platform URL and submit.
- Public redirects become available at:
  - /discord
  - /github
  - /twitter
  - /tiktok
  - /gamepanel
  - /instagram
  - /youtube

The redirects use a settings('sociallinks::key', '/') helper to resolve configured URLs.


## Configuration and Publishing
Publish config and views if desired:
```bash path=null start=null
php artisan vendor:publish --tag=config
php artisan vendor:publish --tag=views --tag=sociallinks-module-views
```
Depending on your app, tags may vary; see the provider's publishes calls.


## Development
- Routes are registered via a RouteServiceProvider:
```php path=/Users/maxwitt/Downloads/module-sociallinks/Providers/RouteServiceProvider.php start=40
protected function mapWebRoutes(): void
{
    Route::middleware('web')
        ->namespace($this->moduleNamespace)
        ->group(module_path('SocialLinks', '/Routes/web.php'));
}
```
- PSR-4 autoloading is defined in composer.json:
```json path=/Users/maxwitt/Downloads/module-sociallinks/composer.json start=18
"autoload": {
  "psr-4": {
    "Modules\\SocialLinks\\": "",
    "Modules\\SocialLinks\\App\\": "app/",
    "Modules\\SocialLinks\\Database\\Factories\\": "database/factories/",
    "Modules\\SocialLinks\\Database\\Seeders\\": "database/seeders/"
  }
}
```

- Vite setup exists; you can adjust Resources/assets/js/app.js and sass/app.scss and your vite.config.js.

After making PHP changes:
```bash path=null start=null
composer dump-autoload
```
After making front-end changes:
```bash path=null start=null
npm run dev
```


## Testing quick checklist
- Permissions: Ensure user has permission:admin.view to access /admin/sociallinks.
- Settings backend: Ensure route('admin.settings.store') exists in your app and persists settings('sociallinks::...').
- Verify each redirect returns a 302 to the configured URL.


## License
Specify your license here (e.g., MIT). Currently not provided.
