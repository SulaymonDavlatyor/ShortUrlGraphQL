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
        do {
            $shortUrl = Str::random(6);
        } while (Url::where('shortUrl', $shortUrl)->first() != null);

        $url = Url::create(
            [
                'fullUrl' => $args['url'],
                'shortUrl' => $shortUrl,
                'counter' => 0
            ]
        );

        return $url;
    }
}
