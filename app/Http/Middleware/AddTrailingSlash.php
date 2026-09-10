<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();
        
        // 1. Игнорируем корень сайта (/)
        // 2. Игнорируем, если слеш уже есть
        // 3. Игнорируем файлы с расширениями (css, js, png, jpg и т.д.), чтобы не ломать Vite и картинки
        if ($path !== '/' && !str_ends_with($path, '/') && !preg_match('/\.[a-zA-Z0-9]+$/', $path)) {
            
            $query = $request->getQueryString();
            $url = $path . '/';
            
            if ($query) {
                $url .= '?' . $query;
            }
            
            // 301 Moved Permanently - критически важно для SEO
            return redirect($url, 301);
        }
        
        return $next($request);
    }
}