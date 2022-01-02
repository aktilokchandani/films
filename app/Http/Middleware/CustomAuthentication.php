<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class CustomAuthentication
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth, $request;

    /**
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     * @return void
     */
    public function __construct(Auth $auth, Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->authenticate($guards)) {
            return $this->authenticate($guards);
        }
        return $next($request);
    }

    protected function authenticate(array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }
        foreach ($guards as $guard) {
            if ($guard == "api") {
                return $this->apiAuth();
            }
        }
    }

    /**
     * This function is used for validate session based authentication for admin user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function adminAuth($guard)
    {
        if ($this->auth->guard($guard)->guest()) {
            return redirect('/')->with('info', 'Your session has been expired');
        }
    }

    /**
     * This function is used for validate session based authentication for web user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function webAuth($guard)
    {
        if ($this->auth->guard($guard)->guest()) {
            return redirect()->guest('/');
        }
    }

    /**
     * This function is used for validate json web token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function apiAuth()
    {
        $api_token = $this->request->header('authorization');

        if (empty($api_token)) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized',
                'data' => ['auth' => __('app.authorize_header_missing')]
            ], 401);
        }

        $user = User::getUserByToken($api_token);
        if (!isset($user->id)) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized',
                'data' => ['auth' => __('app.authorize_header_invalid')]
            ], 401);
        }

        $this->request['api_token'] = $api_token;
        $this->request['user'] = $user;
    }
}
