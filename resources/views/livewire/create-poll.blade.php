<div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Create New Poll</h2>
        <p class="text-gray-500 text-sm mt-1">Create interactive polls for your audience</p>
    </div>

    <form wire:submit.prevent="createPoll" class="space-y-6">
        <!-- Poll Title Field -->
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Poll Title
                </span>
            </label>
            <div class="relative">
                <input
                    type="text"
                    wire:model.live="title"
                    placeholder="Enter your poll question..."
                    class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-gray-700 placeholder-gray-400"
                >
                <div class="absolute left-3 top-3 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            @error('title')
                <div class="flex items-center gap-2 text-red-500 text-sm mt-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Options Section -->
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">
                    Poll Options
                </label>
                <button
                    type="button"
                    wire:click.prevent="addOption"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 active:bg-blue-700 transition duration-200 font-medium"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Option
                </button>
            </div>

            <div class="space-y-4">
                @foreach ($options as $index => $option)
                    <div class="option-item bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-blue-300 transition duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">
                                Option {{ $index + 1 }}
                                <span class="text-xs text-gray-500 ml-2">({{ strlen($option) }} chars)</span>
                            </label>
                            @if(count($options) > 2)
                                <button
                                    type="button"
                                    wire:click.prevent="removeOption({{ $index }})"
                                    class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-50 transition duration-200"
                                    title="Remove option"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                        <div class="flex gap-3">
                            <div class="flex-1 relative">
                                <input
                                    type="text"
                                    wire:model.live="options.{{ $index }}"
                                    placeholder="Enter option {{ $index + 1 }}..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-gray-700 placeholder-gray-400"
                                >
                            </div>
                        </div>
                        @error("options.{$index}")
                            <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-gray-200">
            <button
                type="submit"
                class="w-full inline-flex justify-center items-center gap-3 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 active:scale-95 transition-all duration-200 transform shadow-lg hover:shadow-xl"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Create Poll
            </button>
        </div>
    </form>
</div>
