<?php

namespace App\Repositories\Dashboard;

use App\Models\Slider;

class SliderRepository
{
    public function getSliders()
    {
        return Slider::latest()->get();
    }

    public function getSlider($id)
    {
        return Slider::find($id);
    }

    public function createSlider($data)
    {
        return Slider::create($data);
    }

    public function updateSlider($slider, $data)
    {
        return $slider->update($data);
    }

    public function deleteSlider($slider)
    {
        return $slider->delete();
    }

}
