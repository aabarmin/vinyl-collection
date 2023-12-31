<?php

namespace App\Http\Middleware;

use App\Exceptions\NotAuthenticatedException;
use App\Services\StringUtils;
use Closure;
use Illuminate\Http\Request;
use Storage;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $authorization_header = $request->header('Authorization');
        if (is_null($authorization_header)) {
            throw new NotAuthenticatedException("No Authorization header in the request");
        }
        if (!str_starts_with($authorization_header, "Secret ")) {
            throw new NotAuthenticatedException("Invalid type of secret is provided");
        }
        $secret_token = substr($authorization_header, 7);
        if (!Storage::exists("secret_file.txt")) {
            throw new NotAuthenticatedException("Master secret does not exist");
        }
        $saved_secret = Storage::read("secret_file.txt");
        preg_match('/\d+\.\d+\.\d+/', $saved_secret, $matches);
        if ($secret_token !== $matches[0]) {
            throw new NotAuthenticatedException("Secret is invalid");
        }
        return $next($request);
    }
}