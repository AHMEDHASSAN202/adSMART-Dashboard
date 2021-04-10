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
        $option = Option::where('option_key', $option_key)->first();
        if (!$option) {
            $option = new Option();
            $option->option_key = $option_key;
        }
        $option->option_value = $this->optionValue($option_value);
        $option->option_data = $option_data;
        $option->save();

        return (boolean) $option;
    }

    private function optionValue($option_value)
    {
        if ($option_value instanceof UploadedFile) {
            //store file
            return $option_value->store('options');
        }

        return $option_value;
    }
}
