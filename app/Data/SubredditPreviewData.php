<?php

namespace App\Data;

use Carbon\CarbonImmutable;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class SubredditPreviewData extends Data
{
    #[Computed]
    public string $full_permalink;

    public function __construct(
        public string $subreddit,
        public string $title,
        public string $permalink,
        public int $score,
        public CarbonImmutable $created_at,
        public ?string $image_url,
        public bool $request_successful,
    ) {
        $this->full_permalink = "https://reddit.com{$this->permalink}";
    }

    public static function fromResponse(Response $response): self
    {
        $json = $response->json();
        $prefix = 'data.children.0.data.';

        return new self(
            subreddit: Arr::get($json, "{$prefix}subreddit"),
            title: Arr::get($json, "{$prefix}title"),
            permalink: Arr::get($json, "{$prefix}permalink"),
            score: Arr::get($json, "{$prefix}score"),
            created_at: CarbonImmutable::parse(Arr::get($json, "{$prefix}created_utc")),
            image_url: Arr::get($json, "{$prefix}preview.images.0.source.url"),
            request_successful: $response->successful(),
        );
    }
}
