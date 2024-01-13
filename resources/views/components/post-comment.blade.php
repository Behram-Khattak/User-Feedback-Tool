<style scoped>
    .cke_chrome {
        border: none;
    }
</style>

<div class="post-comment mt-8 mb-20 mx-auto">
    <form action="{{ route('comments.comment.store') }}" method="POST">
        @csrf

        <x-errors />

        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="bg-white rounded-t-lg dark:bg-gray-800">
                <input type="hidden" name="feedbacks_id" value="{{ $feedbackId }}">
                <textarea id="comment" name="comment" rows="4" class="editor w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
            </div>
        </div>

        <button type="submit"
                class="float-end inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
            Post comment
        </button>
    </form>
</div>
