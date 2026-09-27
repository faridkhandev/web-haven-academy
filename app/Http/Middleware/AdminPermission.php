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
            view()->share('adminAllowed', ['*' => true]);
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

        $allowed = in_array($routeName, $permissions[$bucket], true);

        // Resource sub-routes inherit the resource's index permission.
        if (!$allowed) {
            $parts = explode('.', $routeName);
            if (count($parts) >= 3 && $parts[0] === 'admin') {
                $resource = $parts[0] . '.' . $parts[1] . '.' . $parts[2];
                $allowed = in_array($resource, $permissions[$bucket], true);
            }

            // Detail/create/edit routes inherit the resource index permission for reads,
            // while writes require an explicit modify permission.
            if (!$allowed && $bucket === 'access' && count($parts) >= 3 && $parts[0] === 'admin') {
                $resourceIndex = $parts[0] . '.' . $parts[1] . '.index';
                $allowed = in_array($resourceIndex, $permissions['access'], true);
            }
        }

        if (!$allowed) {
            abort(403, 'You do not have permission to perform this action.');
        }

        $viewAllowed = array_fill_keys(array_merge($permissions['access'], $permissions['modify']), true);
        view()->share('adminAllowed', $viewAllowed);

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
