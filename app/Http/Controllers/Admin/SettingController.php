<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;

class SettingController extends Controller
{
    const DEFAULT_PHOTO_SIZE = ['width' => 320, 'height' => 320];

    public function index()
    {
        return view('admin.settings.index');
    }

    public function form($criteria)
    {
        // return $criteria;

        if(!array_key_exists($criteria, Setting::CRITERIA)) {
            return abort(404);
        }

        // return
        $settings = $this->getSettings($criteria);

        $photo_size = Setting::PHOTO_SIZES[$criteria] ?? self::DEFAULT_PHOTO_SIZE;

        return view('admin.settings.' . $criteria, compact('settings', 'photo_size'));
    }

    protected function getSettings($criteria)
    {
        return Setting::query()
            ->whereIn('property', Setting::CRITERIA[$criteria] ?? [])
            ->pluck('value', 'property')
            ->toArray();
    }

    public function save(Request $request)
    {
        // return $request;

        try {
            foreach ($request->settings as $property => $value) {
                Setting::updateOrCreate(
                    ['property' => $property],
                    [
                        'value' => $value instanceof UploadedFile
                            ? $this->getPhotoStringData($value, $request->criteria)
                            : $value,
                    ]
                );
            }

            return back()->with('message', 'Updated successfully!');
        } catch (\Throwable $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    protected function resolveCriteriaPhotoSize($criteria = null): array
    {
        return Setting::PHOTO_SIZES[$criteria] ?? self::DEFAULT_PHOTO_SIZE;
    }

    protected function getPhotoStringData($file, $criteria = null): string
    {
        // dd($file, $criteria);
        
        if(!is_file($file) || !$file->isValid()) {
            return '';
        }

        // dd($file, $criteria);

        $photoSize = $this->resolveCriteriaPhotoSize($criteria);

        // dd($photoSize);

        $image = Image::read($file);

        $image = $image->cover($photoSize['width'], $photoSize['height'])
            ->toWebp()
            ->toDataUri();

        return $image;
    }
}
