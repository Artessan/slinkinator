<?php

namespace App\Http\Middleware;
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateBearerToken
{

    public function handle(Request $request, Closure $next): mixed
    {
        $authorizationHeader = $request->header('Authorization');

        if (!$authorizationHeader || !preg_match('/Bearer\s*(\S*)/', $authorizationHeader, $matches)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $token = $matches[1];

        if (!$this->isValidToken($token)) {
            return response()->json(['error' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }

    private function isValidToken(string $token): bool
    {
        if (empty($token)) {
            return true;
        }

        if (!empty(preg_replace('/[{}[\]()]/', '', $token))) {
            return false;
        }

        return $this->areBracketsBalanced($token);
    }

    private function areBracketsBalanced(string $token): bool
    {
        $stack = collect();
        $pairs = [')' => '(', ']' => '[', '}' => '{',];

        $characters = collect(str_split($token));

        foreach ($characters as $char) {
            if (in_array($char, $pairs)) {
                $stack->push($char);
                continue;
            }

            if (!array_key_exists($char, $pairs)) {
                continue;
            }

            if ($stack->isEmpty() || $stack->pop() !== $pairs[$char]) {
                return false;
            }
        }

        return $stack->isEmpty();
    }
}
