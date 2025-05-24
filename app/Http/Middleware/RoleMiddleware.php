<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    //DALAM routingnya biasa nya kalau ga ada method ini kyk gini ->middleware("auth")
    //TAPI karena sudah ada middleware (lihat jg d kernel.php $middlewareAliases di tambah "roles"). berfungsi sebagai pengecekan auth
    // Parameternya skrg d route menjadi ->middleware("auth", "role:namaRole")
    public function handle(Request $request, Closure $next, ...$roles): Response
    {


        //fungsi auth()-> itu untuk check apa sudah ada yang logged in, baca dokumentasi middleware -cupcake legend
        if (!auth()->check()) {
            abort(403, "unauthorized");
        }

        if (!in_array(auth()->user()->roles, $roles)) {
            abort(403, "unauthorized");
        }

        return $next($request);
    }
}
