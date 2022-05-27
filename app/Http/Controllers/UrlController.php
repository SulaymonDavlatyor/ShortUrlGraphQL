<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{

    public function retrieveUrl($shortUrl)
    {
        $url = Url::where('shortUrl',$shortUrl)->first();
        if($url == null) return response()->json(['Wrong shortUrl'])->setStatusCode(400);
        $url->counter += 1;
        $url->save();
        return  redirect()->away($url->fullUrl);
    }

}
