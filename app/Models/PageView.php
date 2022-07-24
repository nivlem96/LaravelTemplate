<?php

namespace App\Models;

use App\Traits\HasPermissions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property int $id
 * @property string $ip
 * @property string $user_agent
 * @property string $uri
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PageView extends Model
{
    use HasPermissions {
        getRolePermissions as public traitRolePermissions;
    }

    public static function getRolePermissions(): array
    {
        return array_merge(self::traitRolePermissions(),
            [
                Permission::KEY_ACCESS => [Role::ROLE_ADMIN],
            ]
        );
    }

    public static function create(Request $request)
    {
        if (empty($request->ip()) || !self::shouldLog($request)) {
            return;
        }
        $pageView = new PageView();
        $pageView->ip = md5($request->ip());
        $pageView->user_agent = $request->userAgent();
        $pageView->uri = $request->getRequestUri();
        $pageView->save();
    }

    public static function shouldLog(Request $request): bool
    {
        $uri = $request->getRequestUri();
        if ($request->method() !== Request::METHOD_GET) {
            return false;
        }
        if (str_contains($uri, '/admin')) {
            return false;
        }
        if (str_contains($uri, '/account')) {
            return false;
        }
        if (str_contains($uri, '/api')) {
            return false;
        }

        return true;
    }

    public static function getPageViewDashboard(int $lastDays, bool $unique = true)
    {
        $query = PageView::query();
        if ($unique) {
            $query->distinct('ip');
        }
        $query->where('created_at', '>', Carbon::now()->subDay($lastDays));

        return $query->count();
    }

    public static function cleanPageViews()
    {
        return PageView::query()->where('created_at', '<', Carbon::now()->subYear())->delete();
    }
}
