<?php

namespace CrCms\Permission\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use CrCms\Permission\Contracts\UserContract;
use Illuminate\Contracts\Container\Container;
use CrCms\Permission\Tasks\ValidateUserPermissionNodesTask;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserPermissionMiddleware
{
    protected $app;

    /**
     * userPermissionMiddleware constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->app->make(UserContract::class);

        $boolean = $this->app->make(ValidateUserPermissionNodesTask::class)->handle($user);

        if (!$boolean) {
            throw new AccessDeniedHttpException('暂无权限');
        }

        return $next($request);
    }
}