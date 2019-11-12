<?php
    /*********************************************************************
     * This middleware will attach the following CORS headers to all responses:
     * - allow all headers
     * - allow requests from all origins
     * - allow all the headers which were provided in the request
     * ref : https://gist.github.com/danharper/06d2386f0b826b669552
     *********************************************************************/
    namespace App\Http\Middleware;

    class CorsMiddleware {
      public function handle($request, \Closure $next) {
        $response = $next($request);

        //$response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
        $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST');
        //$response->header('Access-Control-Allow-Headers', "Content-Type, Accept, X-Requested-With, remember-me");
        //$response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        $response->header('Access-Control-Allow-Headers', "Content-Type");
        $response->header('Access-Control-Allow-Origin', '*');

        return $response;
      }
    }
