<div class="bg-white w-1/2 rounded-3xl p-5 text-center space-y-2">
    <x-form.label>
        {{ __('posts.new.title') }}
    </x-form.label>

    <x-form.text-input wire:model="post_title" class="w-full"/>

    <x-form.label>
        {{ __('posts.new.description') }}
    </x-form.label>

    <x-form.textbox-input wire:model="post_description" class="w-full h-96 p-2"/>

    <button wire:click="preview" class="px-5 py-2 bg-gray-200 rounded-full">Preview</button>

    @if (strlen($previewed_text) > 0)
        <div class="w-full p-5 shadow-inner shadow-gray-300 rounded-3xl bg-gray-50 text-left">
            {!! $previewed_text !!}
        </div>
    @endif

    <x-form.label>
        {{ __('posts.new.lang_slug') }}
    </x-form.label>

    <x-form.select-input wire:model="post_lang">
        @foreach ($langs as $lang_slug => $lang_name)
            <option value="{{ $lang_slug }}">
                {{ $lang_name }}
            </option>
        @endforeach
    </x-form.select-input>

    <div>
        <x-form.submit-input wire:click="addLanguage">
            {{ __('posts.new.confirm') }}
        </x-form.submit-input>
        @if (session()->has('message'))
            <div class="text-emerald-500">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>