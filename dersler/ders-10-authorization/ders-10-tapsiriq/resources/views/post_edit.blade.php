<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Editləmə
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg border p-6">

                <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="text-sm text-gray-500">ID</label>
                        <p class="text-xl font-semibold">{{ $post->id }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Ad</label>

                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <input type="text"
                               name="title"
                               value="{{ old('title', $post->title) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="border p-4 rounded bg-gray-50">
                        <h3 class="text-sm text-gray-500 mb-2">Yaradan</h3>

                        <p><span class="font-semibold">Name:</span> {{ $post->user->name }}</p>
                        <p><span class="font-semibold">Email:</span> {{ $post->user->email }}</p>
                        <p><span class="font-semibold">User ID:</span> {{ $post->user_id }}</p>
                    </div>


                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 t rounded hover:bg-blue-500">
                        Yenilə
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
