<?php

namespace App\Livewire\Websites;

use App\Models\Tag;
use App\Models\Website;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Layout;
use Livewire\Component;

class View extends Component
{
    use InteractsWithBanner;

    public Website $website;

    public string $name = '';

    public string $url = '';

    public string $description = '';

    /**
     * @var mixed[]
     */
    public array $websiteTags = [];

    public function mount(Website $website): void
    {
        $this->website = $website;
        $this->website->load('tags');
        $this->name = $this->website->name;
        $this->url = $this->website->url;
        $this->description = $this->website->description ?? '';
        $this->websiteTags = $this->website->tags()->pluck('id')->toArray();
    }

    #[Layout('layouts.app')]
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.websites.view', ['tags' => Tag::all()]);
    }

    public function cancel(): void
    {
        $this->redirectIntended(route('dashboard'));
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'url' => 'required|max:2048|url',
            'description' => 'nullable|string',
        ]);

        $this->website->update($validated);

        $this->website->tags()->sync($this->websiteTags);

        $this->banner('Website updated successfully.');
    }
}
