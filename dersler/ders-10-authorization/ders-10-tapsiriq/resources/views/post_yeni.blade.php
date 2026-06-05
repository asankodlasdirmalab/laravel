<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Yeni Post Yarat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg border p-6">

                <form method="POST" action="{{ route('posts.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="text-sm text-gray-500">Title</label>

                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm"
                               placeholder="Post adi yaz...">
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-green-600 rounded hover:bg-green-500">
                        Yarat
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
