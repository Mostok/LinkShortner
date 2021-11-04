<?php

namespace App\Http\Controllers;

use App\Models\Shorten;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ShortenController extends Controller
{
    public function linkGenerating(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|active_url'
        ]);

        $link = Shorten::firstOrCreate(
            ['original_url' => $validatedData['url']],
            ['code' => Str::random(5)]
        );
        return $link;
    }

    public function redirect(Request $request, $code)
    {
        $link = Shorten::where('code', $code)->first();
        if (empty($link)) {
            abort(404);
        }
        return Redirect::to($link->original_url);
    }
}
