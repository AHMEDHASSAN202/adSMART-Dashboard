<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    //============= Relations ===============\\
    public function model()
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }
    //============= #END# Relations ============\\

    public static function createWithAgent($data=[])
    {
        $agent = app('agent');
        $platform =$agent->platform();

        $agentData = [
            'platform' => $platform . ' ' . $agent->version($platform),
            'browser' => $agent->browser(),
            'device' => $agent->device(),
            'ip_address' => request()->ip(),
        ];

        return ActivityLog::insert($agentData + $data);
    }

    public static function getActivityDescription($activity)
    {
        $activityDescriptions = [
            'dashboard_logged'  => "you're logged in to dashboard",
            'user_attempted_to_login'  => "user attempted to login",
            'user_reset_password'  => "password reset",
        ];

        return @$activityDescriptions[$activity];
    }

    public static function getActivityLogsAuth($id, $limit=10)
    {
        return ActivityLog::where('auth_id', $id)->latest()->limit($limit)->get();
    }
}
