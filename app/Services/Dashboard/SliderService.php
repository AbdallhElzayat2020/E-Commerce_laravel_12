<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SliderRepository;
use App\Utils\ImageManager;
use Yajra\DataTables\Facades\DataTables;

class SliderService
{
    protected $sliderRepository, $imageManager;

    public function __construct(SliderRepository $sliderRepository, ImageManager $imageManager)
    {
        $this->sliderRepository = $sliderRepository;
        $this->imageManager = $imageManager;
    }

    public function getAllSliders()
    {
        return $this->sliderRepository->getSliders();
    }

    public function getSlidersForDataTables()
    {
        $slider = self::getAllSliders();

        return DataTables::of($slider)
            ->addIndexColumn()
            ->addColumn('note', function ($slider) {
                return $slider->getTranslation('note', app()->getLocale());
            })
            ->addColumn('file_name', function ($slider) {
                return view('dashboard.pages.sliders.datatables.image', compact('slider'));
            })
            ->addColumn('action', function ($slider) {
                return view('dashboard.pages.sliders.datatables.actions', compact('slider'));
            })
            ->rawColumns(['action', 'file_name'])
            ->make(true);
    }

    public function getSliderById($id)
    {
        return $this->sliderRepository->getSlider($id);
    }

    public function getSliderForEdit($id)
    {
        $slider = $this->getSliderById($id);

        if (!$slider) {
            return null;
        }

        // Get raw file_name to avoid accessor issues
        $rawFileName = $slider->getAttributes()['file_name'] ?? null;
        $fileUrl = $rawFileName ? asset('uploads/sliders/' . $rawFileName) : null;

        // Get translations safely
        $noteAr = '';
        $noteEn = '';
        try {
            $noteAr = $slider->getTranslation('note', 'ar') ?? '';
        } catch (\Exception $e) {
            $noteAr = '';
        }
        try {
            $noteEn = $slider->getTranslation('note', 'en') ?? '';
        } catch (\Exception $e) {
            $noteEn = '';
        }

        return [
            'id' => $slider->id,
            'note_ar' => $noteAr,
            'note_en' => $noteEn,
            'file_name' => $fileUrl,
        ];
    }

    public function createSlider($data)
    {
        if (array_key_exists('file_name', $data) && $data['file_name'] != null) {

            $file_name = $this->imageManager->uploadSingleFile('/', $data['file_name'], 'sliders');

            $data['file_name'] = $file_name;
        }

        return $this->sliderRepository->createSlider($data);
    }

    public function updateSlider($id, $data)
    {
        $slider = $this->getSliderById($id);

        if (!$slider) {
            return false;
        }

        if (array_key_exists('file_name', $data) && $data['file_name'] != null) {
            // Get raw file_name for deletion (before accessor adds path)
            $rawFileName = $slider->getAttributes()['file_name'] ?? null;

            // Delete old image if exists
            if ($rawFileName) {
                $this->imageManager->deleteImageLocal('uploads/sliders/' . $rawFileName);
            }

            // Upload new image
            $file_name = $this->imageManager->uploadSingleFile('/', $data['file_name'], 'sliders');
            $data['file_name'] = $file_name;
        } else {
            // Remove file_name from data if not provided to keep existing image
            unset($data['file_name']);
        }

        return $this->sliderRepository->updateSlider($slider, $data);
    }

    public function deleteSlider($id)
    {
        $slider = $this->getSliderById($id);

        if (!$slider) {
            return false;
        }

        // Get raw file_name for deletion (before accessor adds path)
        $rawFileName = $slider->getAttributes()['file_name'] ?? null;

        if ($rawFileName) {
            $this->imageManager->deleteImageLocal('uploads/sliders/' . $rawFileName);
        }

        return $this->sliderRepository->deleteSlider($slider);
    }
}
