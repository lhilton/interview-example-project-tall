<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Website;
use App\Notifications\WebsiteDown;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class WebsiteHealthCheck implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Not strictly needed, but demonstrating an example where we may have
        // massive rows of users and are concerned about the impact of that.
        User::chunk(25, [$this, 'handleUsers']);
    }

    /**
     * @param  Collection<int, User>  $users
     */
    public function handleUsers(Collection $users): void
    {
        $users->each([$this, 'handleUser']);
    }

    public function handleUser(User $user): void
    {
        // Keeping life simple for this project. Nominally I would want to use some combination of additional queued
        // job(s) or at least chunk the website data such that I could use the Http pool feature for concurrent requests
        $downSites = $user->websites->reject([$this, 'isWebsiteUp']);

        if ($downSites->count()) {
            $user->notify(new WebsiteDown($downSites));
        }
    }

    public function isWebsiteUp(Website $website): bool
    {
        try {
            // Again, just recognizing the nature of this project. Reducing the connect timeout to this short
            // of a value makes the job much easier to test and understand for code review purposes.
            $result = Http::timeout(1)->connectTimeout(1)->get($website->url);
        } catch (Exception $exception) {
            return false;
        }

        return $result->successful();
    }
}
