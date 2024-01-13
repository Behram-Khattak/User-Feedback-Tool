<section class="bg-white dark:bg-gray-900 pb-20 antialiased">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <span class="text-gray-600 dark:text-white">Discussions ({{ $feedbackComments->count() }})</span>
        </div>

        @forelse ($feedbackComments as $comments)
            @if (! $comments->parent_id)
                <article class="p-6 text-base bg-gray-100 rounded-lg dark:bg-gray-900">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{ $comments->user->name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400"><time>{{ $comments->created_at->format('M-d-Y') }}</time></p>
                        </div>
                    </footer>
                    <p class="text-gray-500 dark:text-gray-400">
                        {!! $comments->comment !!}
                    </p>

                    <div class="comment-modification flex">
                    @auth
                        @if ($comments->user->id != auth()->user()->id)

                            {{-- comment reply section --}}
                                <div class="reply" x-data="{ open: false }">
                                    <button type="button"
                                            x-on:click="open = ! open"
                                            class="text-xs capitalize mt-4 bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
                                        <i class="fas fa-reply"></i>
                                    </button>

                                    <div class="comment-reply-form my-4" x-show="open">
                                        <form action="{{ route('comments.comment.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="feedbacks_id" value="{{ $comments->feedbacks_id }}" />
                                            <input type="hidden" name="parent_id" value="{{ $comments->id }}" />
                                            <textarea id="reply" name="comment" rows="4" class="editor w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>

                                            <button type="submit"
                                                class="float-end inline-flex items-center mt-4 py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                                Reply
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            {{-- comment reply section --}}
                        @endif

                        @if ($comments->user->id === auth()->user()->id)
                            {{-- edit comment section --}}
                                <div class="edit-comment mx-4">
                                    <div x-data="{ open: false }">
                                        <button type="button"
                                                x-on:click="open = ! open"
                                            class="text-xs capitalize mt-4 bg-yellow-300 text-white p-2 rounded hover:bg-yellow-400">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <div class="edit-comment-form my-4" x-show="open">
                                            <form action="{{ route('comments.comment.update', $comments->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <x-errors />

                                                <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                                    <div class="bg-white rounded-t-lg dark:bg-gray-800">
                                                        <input type="hidden" name="feedbacks_id" value="{{ $comments->feedbacks_id }}">
                                                        <textarea id="comment" name="comment" rows="4" class="editor w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required>
                                                            {!! $comments->comment !!}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <button type="submit"
                                                        class="float-end inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                                    Edit Comment
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            {{-- edit comment section --}}


                            {{-- delete comment section --}}
                                <div class="delete-comment">
                                    <a href="{{ route('comments.comment.delete', $comments->id) }}" type="button"
                                        class="text-xs capitalize mt-4 bg-red-400 text-white p-2 rounded hover:bg-red-800">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            {{-- delete comment section --}}
                        @endif
                    @endauth
                    </div>
                </article>

                @elseif ($comments->parent_id)
                <article class="py-6 pl-12 text-base bg-whit rounded-lg dark:bg-gray-900">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{ $comments->user->name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400"><time>{{ $comments->created_at->format('M-d-Y') }}</time></p>
                        </div>
                    </footer>
                    <p class="text-gray-500 dark:text-gray-400">
                        {!! $comments->comment !!}
                    </p>

                    <div class="comment-modification flex my-4">

                    @auth
                        @if ($comments->user->id != auth()->user()->id)

                            {{-- comment reply section --}}
                                <div class="reply" x-data="{ open: false }">
                                    <button type="button"
                                            x-on:click="open = ! open"
                                            class="text-xs capitalize mt-4 bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
                                        <i class="fas fa-reply"></i>
                                    </button>

                                    <div class="comment-reply-form my-4" x-show="open">
                                        <form action="{{ route('comments.comment.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="feedbacks_id" value="{{ $comments->feedbacks_id }}" />
                                            <input type="hidden" name="parent_id" value="{{ $comments->id }}" />
                                            <textarea id="reply" name="comment" rows="4" class="editor w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>

                                            <button type="submit"
                                                class="float-end inline-flex items-center mt-4 py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                                Reply
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            {{-- comment reply section --}}
                        @endif

                        @if ($comments->user->id === auth()->user()->id)
                            {{-- edit comment section --}}
                                <div class="edit-comment mx-4">
                                    <div x-data="{ open: false }">
                                        <button type="button"
                                                x-on:click="open = ! open"
                                            class="text-xs capitalize mt-4 bg-yellow-300 text-white p-2 rounded hover:bg-yellow-400">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <div class="edit-comment-form my-4" x-show="open">
                                            <form action="{{ route('comments.comment.update', $comments->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <x-errors />

                                                <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                                    <div class="bg-white rounded-t-lg dark:bg-gray-800">
                                                        <input type="hidden" name="feedbacks_id" value="{{ $comments->feedbacks_id }}">
                                                        <textarea id="comment" name="comment" rows="4" class="editor w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required>
                                                            {!! $comments->comment !!}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <button type="submit"
                                                        class="float-end inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                                    Edit Comment
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            {{-- edit comment section --}}


                            {{-- delete comment section --}}
                                <div class="delete-comment">
                                    <a href="{{ route('comments.comment.delete', $comments->id) }}" type="button"
                                        class="text-xs capitalize mt-4 bg-red-400 text-white p-2 rounded hover:bg-red-800">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            {{-- delete comment section --}}
                        @endif
                    @endauth
                    </div>
                    <hr>
                </article>
            @endif
        @empty

        @endforelse
    </div>
  </section>
