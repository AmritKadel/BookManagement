<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AdminUser;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userID = get_user_id_from_token($request->header('authorization'));
        $isAdmin = AdminUser::where('id',$userID)->where('user_type','admin')->first();
        if(!$isAdmin->first()){
            return response()->json(['error'=>'This User Cannot Access Admin Route'],403);
        }
        return $next($request);
    }
}
