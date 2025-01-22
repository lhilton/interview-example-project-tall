<?php

namespace App\Livewire\Subreddit;

use App\Data\SubredditPreviewData;
use App\Models\Subreddit;
use App\Models\User;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Smpita\TypeAs\TypeAs;

class Index extends Component
{
    public string $url = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.subreddit.index', ['previews' => $this->getPreviews()]);
    }

    /**
     * @return Collection<int, SubredditPreviewData>
     */
    protected function getPreviews(): Collection
    {
        $subs = TypeAs::class(User::class, auth()->user())->subreddits;

        $responses = Http::timeout(5)
            ->pool(fn (Pool $pool) => $subs->map(fn (Subreddit $sub) => $pool->as((string) $sub->id)->get($sub->json_top_url)));

        $previews = collect();

        foreach ($responses as $subreddit_id => $response) {
            $previews->push(SubredditPreviewData::from($response, $subs->where('id', $subreddit_id)->first()));
        }

        return $previews->sortByDesc('score');
    }

    public function remove(Subreddit $subreddit): void
    {
        $subreddit->delete();
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

                    $result = null;

                    try {
                        $result = Http::timeout(5)->get(Subreddit::makeJsonUrl($this->url));
                    } catch (Exception $exception) {
                        $fail($error);
                    }

                    if (! $result?->successful()) {
                        $fail($error);
                    }
                },
            ],
        ]);

        auth()->user()?->subreddits()->create($validated);

        $this->url = '';
    }
}
