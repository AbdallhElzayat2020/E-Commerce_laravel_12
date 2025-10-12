<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Update\UpdateSettingRequest;
use App\Services\Dashboard\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $setting = $this->settingService->getSetting(1);
        if (!$setting) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return view('dashboard.pages.settings.index', compact('setting'));
    }


    public function update(UpdateSettingRequest $request, string $id)
    {
        $data = $request->except(['_token', '_method']);
        $setting = $this->settingService->updateSetting($data, $id);
        if (!$setting) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.settings.index')->with('success', __('dashboard.success_msg'));
    }
}
