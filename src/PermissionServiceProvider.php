<?php

namespace CrCms\Permission;

use CrCms\Foundation\Providers\AbstractModuleServiceProvider;
use CrCms\Permission\Commands\GetRoutesCommand;
use CrCms\Permission\Commands\GetTableFieldCommand;
use CrCms\Permission\Http\Middleware\UserPermissionMiddleware;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class PermissionServiceProvider.
 */
class PermissionServiceProvider extends AbstractModuleServiceProvider implements DeferrableProvider
{
    /**
     * @var string
     */
    protected $basePath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;

    /**
     * @var string
     */
    protected $name = 'permission';

    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @return void
     */
    public function boot(): void
    {
        if (function_exists('config_path')) {
            $this->publishes([
                $this->basePath.'config/config.php' => config_path($this->name.'.php'),
            ]);
        }

        $this->loadDefaultMigrations();

        $this->loadDefaultTranslations();

        //load middleware alias
        $this->aliasMiddleware();
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeDefaultConfig();

        $this->registerCommands();
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            GetRoutesCommand::class,
            GetTableFieldCommand::class,
        ];
    }

    /**
     * @return void
     */
    protected function registerCommands(): void
    {
        $this->commands([
            GetRoutesCommand::class,
            GetTableFieldCommand::class,
        ]);
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware(): void
    {
        $router = $this->app['router'];

        $routerMiddleware = [
            // 兼容，后期删除
            'checkUserPermission' => UserPermissionMiddleware::class,
            'permission.check' => UserPermissionMiddleware::class,
        ];

        foreach ($routerMiddleware as $alias => $middleware) {
            $router->aliasMiddleware($alias, $middleware);
        }
    }
}
