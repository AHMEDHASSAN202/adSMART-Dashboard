<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['activity_description'];

    //========== Appends Attributes ======================\\
    public function getActivityDescriptionAttribute()
    {
        return $this->getActivityDescription($this->user_activity);
    }
    //========== #END# Appends Attributes ===================\\

    //============= Relations ===============\\
    public function model()
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }
    //============= #END# Relations ============\\

    public static function createWithAgent($data=[], $updateIfExists=false)
    {
        $agent = app('agent');
        $platform =$agent->platform();

        $agentData = [
            'platform' => $platform . ' ' . $agent->version($platform),
            'browser' => $agent->browser(),
            'device' => $agent->device(),
            'device_type' => ($agent->isDesktop() ? 'desktop' : ($agent->isPhone() ? 'phone' : null)),
            'ip_address' => request()->ip(),
            'created_at'    => now()
        ];

        //wh will update logged if is logged from same ip
        if ($updateIfExists) {
            return ActivityLog::updateOrInsert([
                'ip_address'    => request()->ip(),
                'user_activity' => $data['user_activity'],
                'auth_id'       => $data['auth_id'],
            ], $agentData + $data);
        }

        return ActivityLog::insert($agentData + $data);
    }

    public static function getActivityDescription($activity)
    {
        $activityDescriptions = [
            'dashboard_logged'  => "you're logged in to dashboard",
            'user_attempted_to_login'  => "user attempted to login",
            'user_reset_password'  => "password reset",
            'update_profile_information'  => "you're update profile information",
            'update_personal_options'  => "you're update personal options",
            'change_your_password'  => "you're changed your password",
        ];

        return @$activityDescriptions[$activity];
    }

    public static function getActivityLogsAuth($id, $limit=10)
    {
        return ActivityLog::where('auth_id', $id)->latest()->limit($limit)->get();
    }

    public static function removeDashboardLoggedActivities()
    {
        return ActivityLog::where('user_activity', 'dashboard_logged')->where('ip_address', '!=', request()->ip())->delete();
    }
}
