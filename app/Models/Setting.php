<?php

namespace App\Models;

use App\Traits\HasHistories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasHistories;

    const PHOTO_SIZES = [
        'about' => [
            'width' => 3 * 200,
            'height' => 2 * 200,
        ],
        'vision' => [
            'width' => 3 * 200,
            'height' => 2 * 200,
        ],
        'mission' => [
            'width' => 3 * 200,
            'height' => 2 * 200,
        ],
    ];

    const CRITERIA = [
        'contact' => [
            'phone',
            'email',
            'facebook',
            'address',
        ],
        'about' => [
            'about_company_thumbnail',
            'about_company_headline',
            'about_company_description',
        ],
        'vision' => [
            'company_vision_thumbnail',
            'company_vision_headline',
            'company_vision_description',
        ],
        'mission' => [
            'company_mission_thumbnail',
            'company_mission_headline',
            'company_mission_description',
        ],
        'product' => [
            'product_cleanroom_thumbnail',
            'product_cleanroom_description',
            'product_hvac_thumbnail',
            'product_hvac_description',
            'product_air_filtration_thumbnail',
            'product_air_filtration_description',
        ],
        'service' => [
            'service_cleanroom_thumbnail',
            'service_cleanroom_description',
            'service_hvac_thumbnail',
            'service_hvac_description',
        ],
    ];

    protected $guarded = [];

    public function getValueAttribute($value)
    {
        if ($value && strpos($value, 'data:image') === 0 && $this->property)
        {
            return route('settings.streamImage', $this->property) . "?v=" . (time() + 1);
        }

        return $value;
    }
}
