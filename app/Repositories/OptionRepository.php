<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use App\Models\Option;

class OptionRepository
{
    public function getOptions()
    {
        return Cache::rememberForever('options', function () {
            return Option::all();
        });
    }

    public function getOption($option_key)
    {
        $options = $this->getOptions();
        return $options->where('option_key', $option_key)->first();
    }

    public function updateOrCreateOption($option_key, $option_value, $option_data = '')
    {
        $value = $this->optionValue($option_value);

        return Option::updateOrInsert(['option_key' => $option_key], ['option_value' => $value, 'option_data' => $option_data]);
    }

    private function optionValue($option_value)
    {
        if ($option_value instanceof UploadedFile) {
            //store file
            return $option_value->store('images/options', 'public');
        }

        return $option_value;
    }

    public function saveOptions(array $data)
    {
        foreach ($data as $optionKey => $optionValue) {
            if ($optionValue !== '' && $optionValue !== null) {
                $this->updateOrCreateOption($optionKey, $optionValue);
            }
        }
        Cache::forget('options');
    }
}
