<span>
    <a wire:click="read('post')" class="btn btn-secondary btn-sm">
        <button class="read-button absolute top-0 right-0 px-4 py-2" type="button">
            <i class="{{ $post->isReadBy(Auth::guard('admin')->user()->id) ? 'fa-solid fa-square-check' : 'fa-regular fa-square' }}" style="color: #000000;"></i>
        </button>
    </a>
</span>