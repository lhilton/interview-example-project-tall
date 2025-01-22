<?php

namespace App\Livewire\Subreddit;

use App\Data\SubredditPreviewData;
use App\Models\Subreddit;
use Closure;
use Exception;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public string $url = '';

    #[Layout('layouts.app')]
    public function render()
    {
        $subs = auth()->user()->subreddits;

        $responses = Http::timeout(5)
            ->pool(fn (Pool $pool) => $subs->map(fn (Subreddit $sub) => $pool->get($sub->json_top_url)));

        $previews = collect();

        foreach ($responses as $response) {
            $previews->push(SubredditPreviewData::from($response));
        }

        return view('livewire.subreddit.index', [
            'subreddits' => $subs,
            'previews' => $previews->sortByDesc('score'),
        ]);
    }

    public function save(): void
    {
        $validated = $this->validate([
            'url' => [
                'required',
                'max:255',
                'unique:subreddits,url',
                function (string $attribute, mixed $value, Closure $fail) {
                    $error = "The {$attribute} must be a valid subreddit, the part after https://reddit.com/r/";
                    try {
                        $result = Http::timeout(5)->get(Subreddit::makeJsonUrl($this->url));
                    } catch (Exception $exception) {
                        $fail($error);
                    }

                    if (! $result->successful()) {
                        $fail($error);
                    }
                },
            ],
        ]);

        auth()->user()->subreddits()->create($validated);

        $this->url = '';
    }
}
