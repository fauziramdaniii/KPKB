<?php
namespace Accounts\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Cors middleware
 */
class CorsMiddleware
{

    /**
     * Invoke method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Message\ResponseInterface $response The response.
     * @param callable $next Callback to invoke the next middleware.
     * @return \Psr\Http\Message\ResponseInterface A response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        if (strtoupper($request->getMethod()) === 'OPTIONS') {
            $response = $response
                ->withAddedHeader('Access-Control-Allow-Headers', 'Content-Type, api_key, Authorization, bid, callback, User-Agent')
                ->withAddedHeader('Access-Control-Allow-Methods', 'GET, POST, DELETE, PUT, OPTIONS')
                ->withAddedHeader('Access-Control-Allow-Origin', '*')
                ->withStatus(200);
            return $response;
        }

        $response = $response->withAddedHeader('Access-Control-Allow-Origin', '*');

        return $next($request, $response);
    }
}
