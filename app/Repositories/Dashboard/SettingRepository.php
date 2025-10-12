<?php

namespace App\Repositories\Dashboard;

use App\Models\Setting;

class SettingRepository
{

    public function getSetting($id)
    {
        return Setting::find($id);
    }

    public function updateSetting($data, $setting)
    {
        return $setting->update($data);
    }
}
