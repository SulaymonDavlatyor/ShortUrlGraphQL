<?php

namespace App\GraphQL\Mutations;

use App\Models\Url;
use Illuminate\Support\Str;

final class createShortUrl
{
    /**
     * @param null $_
     * @param array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $fullUrl = $args['url'];
        
        if(!preg_match('/^https:\/\//',$fullUrl) &&
           !preg_match('/^http:\/\//',$fullUrl)) throw new Exception('Incorrect url , Url must start with https or http');
        
        do {
            $shortUrl = Str::random(6);
        } while (Url::where('shortUrl', $shortUrl)->first() != null);

        $url = Url::create(
            [
                'fullUrl' => $fullUrl,
                'shortUrl' => $shortUrl,
                'counter' => 0
            ]
        );

        return $url;
    }
}
