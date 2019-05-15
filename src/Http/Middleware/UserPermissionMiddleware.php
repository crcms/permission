<?php

namespace CrCms\Permission\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Container\Container;
use CrCms\Permission\Tasks\ValidateUserPermissionNodesTask;
use Illuminate\Support\Facades\Auth;
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
        $boolean = $this->app->make(ValidateUserPermissionNodesTask::class)->handle(Auth::user());

        if (! $boolean) {
            throw new AccessDeniedHttpException('暂无权限');
        }

        return $next($request);
    }
}
