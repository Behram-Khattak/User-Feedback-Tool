<div>
    @forelse ($feedbacks as $feedback)
        <div class="feedback shadow-lg bg-gray-100 rounded-xl p-5 my-6">
            <div class="feedback-options flex align-items-center float-end">

                @auth
                    @if ($feedback->user->id === auth()->user()->id)
                        <div class="feedback-delete">
                            <a href="{{ route('feedbacks.feedback.delete', $feedback->id) }}"
                                class="text-red-600 hover:text-red-700 cursor-pointer">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="feedback-author mb-4">
                <span class="bg-gray-500 text-white p-2 text-xs rounded-2xl">
                    Author: {{ $feedback->user->name }}
                </span>
            </div>

            <div class="feedback-category mb-4">
                <span
                    class="border border-black p-1 rounded-2xl text-xs capitalize"
                >
                    {{ $feedback->category }}
                </span>
            </div>

            <div class="feedback-title mb-1">
                <h2 class="text-xl">
                    <a href="{{ route('feedbacks.feedback.show', [$feedback->id, $feedback->slug]) }}" class="underline text-gray-500 hover:text-black">
                        {{ $feedback->title }}
                    </a>
                </h2>
            </div>
        </div>

    @empty
        <span class="capitalize">no feedbacks yet !</span>
    @endforelse

    <div class="load-more-btn text-center">
        <button type="button" wire:click="load" class="w-full capitalize text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            load more...
        </button>
    </div>

</div>
