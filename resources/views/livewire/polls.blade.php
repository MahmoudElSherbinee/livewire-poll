<div class="space-y-6">
    <div class="flex items-center justify-between mb-2">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Available Polls</h2>
            <p class="text-gray-500 text-sm">Total: {{ $polls->count() }} poll(s)</p>
        </div>
        <div class="text-sm text-gray-500">
            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ now()->format('M d, Y') }}
        </div>
    </div>

    @forelse ($polls as $poll)
        <div
            class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
            <!-- Poll Header -->
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $poll->title }}</h3>
                    </div>

                    <!-- Poll Stats -->
                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            {{ $poll->totalVotes() }} total votes
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $poll->options->count() }} options
                        </span>
                    </div>
                </div>
            </div>

            <!-- Options List -->
            <div class="space-y-4">
                @foreach ($poll->options as $option)
                    @php
                        $percentage =
                            $poll->totalVotes() > 0
                                ? round(($option->votes->count() / $poll->totalVotes()) * 100, 1)
                                : 0;
                        $colors = ['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-yellow-500', 'bg-pink-500'];
                        $color = $colors[$loop->index % count($colors)];
                    @endphp

                    <div class="relative group">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-700">{{ $option->name }}</span>
                            <span
                                class="text-sm font-semibold {{ $percentage > 0 ? 'text-gray-800' : 'text-gray-400' }}">
                                {{ $option->votes->count() }} votes ({{ $percentage }}%)
                            </span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden mb-3">
                            <div class="h-full {{ $color }} rounded-full transition-all duration-500 ease-out"
                                style="width: {{ $percentage }}%"></div>
                        </div>

                        <!-- Vote Button -->
                        <button wire:click="addVote({{ $option->id }})"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-blue-400 active:scale-[0.98] transition-all duration-200 group-hover:shadow-md">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span class="font-medium text-gray-700">Vote for this option</span>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Poll Footer -->
            <div class="mt-6 pt-4 border-t border-gray-200 flex items-center justify-between text-sm text-gray-500">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Created {{ $poll->created_at->diffForHumans() }}
                </span>
                <div class="flex items-center gap-2">
                    <div class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></div>
                    <span>Live Poll</span>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16 bg-white rounded-xl shadow border border-gray-200">
            <div class="mb-4">
                <svg class="w-20 h-20 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Polls Available</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">
                There are no polls created yet. Be the first to create an engaging poll!
            </p>
            <div class="h-1 w-24 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full mx-auto"></div>
        </div>
    @endforelse
</div>
