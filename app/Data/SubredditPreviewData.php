<?php

namespace App\Data;

use App\Models\Subreddit;
use Carbon\CarbonImmutable;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Smpita\TypeAs\TypeAs;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class SubredditPreviewData extends Data
{
    #[Computed]
    public string $full_permalink;

    public function __construct(
        public Subreddit $subreddit,
        public ?string $subreddit_name,
        public ?string $title,
        public ?string $permalink,
        public ?int $score,
        public ?int $ups,
        public ?CarbonImmutable $created_at,
        public ?string $thumbnail,
        public bool $request_successful,
    ) {
        $this->full_permalink = "https://reddit.com{$this->permalink}";
    }

    public static function fromResponse(Response $response, Subreddit $subreddit): self
    {
        $json = TypeAs::array($response->json());

        $prefix = 'data.children.0.data.';

        return new self(
            subreddit: $subreddit,
            subreddit_name: TypeAs::string(Arr::get($json, "{$prefix}subreddit", $subreddit->url)),
            title: TypeAs::string(Arr::get($json, "{$prefix}title", Arr::get($json, "{$prefix}display_name"))),
            permalink: TypeAs::string(Arr::get($json, "{$prefix}permalink", Arr::get($json, "{$prefix}url"))),
            score: TypeAs::int(Arr::get($json, "{$prefix}score", 0)),
            ups: TypeAs::int(Arr::get($json, "{$prefix}ups", 0)),
            created_at: CarbonImmutable::parse(TypeAs::int(Arr::get($json, "{$prefix}created_utc", Arr::get($json, "{$prefix}created")))),
            thumbnail: TypeAs::string(Arr::get($json, "{$prefix}thumbnail", Arr::get($json, "{$prefix}community_icon"))),
            request_successful: $response->successful(),
        );
    }
}
