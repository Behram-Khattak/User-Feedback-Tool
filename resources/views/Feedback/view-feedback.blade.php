<x-guest-layout>
    <x-slot:main>
        <div class="container mx-auto">
            <x-alerts />
            @foreach ($feedback as $data)
                <div class="content my-20">

                    <div class="feedback-author">
                        <span class="bg-gray-500 text-white p-3 text-xs rounded-3xl">
                            Author: {{ $data->user->name}}
                        </span>
                    </div>

                    <div class="feedback-title py-6">
                        <h1 class="text-4xl font-extrabold capitalize">
                            {{ $data->title }}
                        </h1>
                    </div>

                    <div class="flex justify-between">
                        <div class="feedback-category pb-8">
                            <span
                                class="border border-black p-1 rounded-2xl text-xs capitalize"
                            >
                                {{ $data->category }}
                            </span>
                        </div>

                        @auth
                            @if ($data->user->id === auth()->user()->id)
                                <div class="feedback-edit" data-modal-target="edit-feedback-modal" data-modal-toggle="edit-feedback-modal">
                                    <small class="edit-feedback text-white cursor-pointer capitalize bg-blue-600 hover:bg-blue-700 rounded-3xl p-2">
                                        edit feedback <i class="fas fa-edit"></i>
                                    </small>
                                </div>
                            @endif
                        @endauth

                        <!-- Edit Feedback Modal -->
                        <div id="edit-feedback-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-4xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-gray-100 rounded-lg shadow dark:bg-gray-700 capitalize">
                                    <!-- Modal header -->
                                        <button type="button"
                                                class="m-4 float-end text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-feedback-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4">
                                        <form class="max-w-2xl mx-auto" action="{{ route('feedbacks.feedback.update', $data->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-5">
                                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">title</label>
                                                <input type="text" id="title" value="{{ $data->title }}" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                            </div>

                                            <div class="mb-5">
                                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">category</label>
                                                <input type="category" id="category" value="{{ $data->category }}" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                            </div>

                                            <div class="mb-5">
                                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">description</label>
                                                <textarea id="description" name="description" class="truncate editor block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your feedback here...">
                                                    {{ $data->description }}
                                                </textarea>
                                            </div>

                                            <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    >
                                                    Edit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="feedback-description shadow-lg rounded-xl bg-gray-100 p-4 overflow-scroll">
                        <p>
                            {!! $data->description !!}
                        </p>
                    </div>
                </div>

                @php
                    $feedbackId = $data->id;
                    $feedbackComments = $data->comments;
                @endphp
            @endforeach

            <div class="comments-section">
                <div class="comments-section-title">
                    <h2 class="text-4xl uppercase font-extrabold text-center">
                        comments
                    </h2>
                </div>

                <x-post-comment :feedback_id="$feedbackId"/>
                <x-comments :feedback_comments="$feedbackComments"/>
            </div>
        </div>
    </x-slot:main>

    {{-- Script Javascript --}}
    <x-slot:script>
        <script type="text/javascript">
            let editors = document.querySelectorAll('.editor');

            editors.forEach(editor => {
                CKEDITOR.replace( editor, {
                    extraPlugins: 'codesnippet'
                });
            });
        </script>
    </x-slot:script>

</x-guest-layout>
