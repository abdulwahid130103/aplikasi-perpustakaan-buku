<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogActivityPetugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $user_id = Auth::id();
        $path = $request->path();
        $method = $request->method();

        if ($method === 'POST') {
            DB::table('log_aktivitas_petugas')->insert([
                'user_id' => $user_id,
                'aktivitas' => "Menambahkan data pada path {$path}",
                'waktu' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } elseif ($method === 'PUT' || $method === 'PATCH') {
            $id = $request->route()->parameter('id');
            DB::table('log_aktivitas_petugas')->insert([
                'user_id' => $user_id,
                'aktivitas' => "Mengubah data dengan ID {$id} pada path {$path}",
                'waktu' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } elseif ($method === 'DELETE') {
            $id = $request->route()->parameter('id');
            DB::table('log_aktivitas_petugas')->insert([
                'user_id' => $user_id,
                'aktivitas' => "Menghapus data dengan ID {$id} pada path {$path}",
                'waktu' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return $response;
    }
}
