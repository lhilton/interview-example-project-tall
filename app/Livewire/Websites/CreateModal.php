<?php

namespace App\Livewire\Websites;

use App\Models\Tag;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CreateModal extends Component
{
    use InteractsWithBanner;

    public bool $isOpen = false;

    public string $name = '';

    public string $url = '';

    public string $description = '';

    /**
     * @var mixed[]
     */
    public array $websiteTags = [];

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.websites.create-modal', ['tags' => Tag::all()]);
    }

    public function open(): void
    {
        $this->name = '';
        $this->url = '';
        $this->description = '';
        $this->isOpen = true;
    }

    public function cancel(): void
    {
        $this->isOpen = false;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'url' => 'required|max:2048|url',
            'description' => 'nullable|string',
        ]);

        if ($website = auth()->user()?->websites()->create($validated)) {
            $website->tags()->sync($this->websiteTags);

            $this->redirectRoute('website.view', ['website' => $website->id]);
        } else {
            $this->dangerBanner('Failed to create website, unknown error.');
        }
    }
}
