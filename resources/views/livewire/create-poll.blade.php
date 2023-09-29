<div>
    <form>
        <label>Poll Title</label>

        {{-- title si riferisce alla proprietà di CreatePoll.php --}}
        <input type="text" wire:model.live="title" />

        Current title: {{ $title }}
    </form>
</div>
