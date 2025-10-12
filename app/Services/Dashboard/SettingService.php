<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SettingRepository;
use App\Utils\ImageManager;

class SettingService
{

    public $imageManager, $settingRepository;

    public function __construct(SettingRepository $settingRepository, ImageManager $imageManager)
    {
        $this->settingRepository = $settingRepository;
        $this->imageManager = $imageManager;
    }


    public function getSetting($id)
    {
        return $this->settingRepository->getSetting($id) ?? abort(404);
    }

    public function updateSetting($data, $id)
    {
        $setting = self::getSetting($id);

        if (array_key_exists('logo', $data) && $data['logo'] != null) {
            // delete old logo
            $this->imageManager->deleteImageLocal($setting->logo);
            $file_name = $this->imageManager->uploadSingleFile('/', $data['logo'], 'settings');
            $data['logo'] = $file_name;
        }

        if (array_key_exists('favicon', $data) && $data['favicon'] != null) {
            // delete old logo
            $this->imageManager->deleteImageLocal($setting->favicon);
            $file_name = $this->imageManager->uploadSingleFile('/', $data['favicon'], 'settings');
            $data['favicon'] = $file_name;
        }

        return $this->settingRepository->updateSetting($data, $setting);
    }
}
