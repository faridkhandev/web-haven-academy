<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AdminPermission
{
    public function handle(Request $request, Closure $next): Response
    {
        $groupId = (int) $request->session()->get('admin_user_group_id', 0);

        // Super admin keeps unrestricted access.
        if ($groupId === 1) {
            return $next($request);
        }

        $routeName = (string) ($request->route()?->getName() ?? '');
        if ($routeName === '') {
            abort(403);
        }

        $row = DB::table('bh_user_group')
            ->select('permission')
            ->where('user_group_id', $groupId)
            ->first();

        $permissions = $this->decode($row?->permission ?? null);
        $bucket = in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true)
            ? 'modify'
            : 'access';

        if (!in_array($routeName, $permissions[$bucket], true)) {
            abort(403, 'You do not have permission to perform this action.');
        }

        return $next($request);
    }

    private function decode(?string $value): array
    {
        if (!$value) {
            return ['access' => [], 'modify' => []];
        }

        $decoded = @unserialize($value);
        if (!is_array($decoded)) {
            $decoded = json_decode($value, true);
        }

        return [
            'access' => array_values(array_map('strval', $decoded['access'] ?? [])),
            'modify' => array_values(array_map('strval', $decoded['modify'] ?? [])),
        ];
    }
}
