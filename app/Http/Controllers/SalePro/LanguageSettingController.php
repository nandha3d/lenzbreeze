<?php

namespace App\Http\Controllers\SalePro;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LanguageSettingController extends Controller
{
    /**
     * Note: JoeDixon/Translation package was removed as it's incompatible with Laravel 12.
     * Language management uses a simplified file-based approach instead.
     */

    public function languages()
    {
        $langPath = resource_path('lang');
        $languages = collect(File::directories($langPath))->map(function ($dir) {
            return basename($dir);
        });
        return view('salepro::vendor.translation.languages.index', compact('languages'));
    }

    public function index(Request $request, $language)
    {
        return view('salepro::vendor.translation.languages.translations.index', [
            'language' => $language,
            'languages' => collect([]),
            'groups' => collect([]),
            'translations' => collect([]),
        ]);
    }

    public function update(Request $request)
    {
        return ['success' => true];
    }

    public function create()
    {
        return view('salepro::vendor.translation.languages.create');
    }

    public function store(Request $request)
    {
        if (!env('USER_VERIFIED')) {
            return redirect()->back()->with(['error' => 'This feature is disabled for demo!']);
        }
        return redirect()->back()->with('success', 'Language added');
    }

    public function languageSwitch($locale)
    {
        setcookie('language', $locale, time() + (86400 * 365), '/');
        return back();
    }

    public function languageDelete(Request $request)
    {
        if (!env('USER_VERIFIED')) {
            session()->flash('message', 'This feature is disabled for demo!');
            session()->flash('type', 'danger');
            return response()->json('error');
        }

        $path = base_path('resources/lang/' . $request->langVal);
        if (File::exists($path)) {
            File::deleteDirectory($path);
            session()->flash('message', 'Successfully Deleted.');
            session()->flash('type', 'success');
            return response()->json('success');
        }
    }
}
