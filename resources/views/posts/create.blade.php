<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1"
                                :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <textarea id="content" name="content" rows="10"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ft_image" :value="__('Featured Image')" />
                            <input id="ft_image" name="ft_image" type="file"
                                class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('ft_image')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select name="category_id" class="block w-full mt-1 text-gray-500 border-gray-300 rounded">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option class="text-gray-500" value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-12">
                            <x-input-label :value="__('Tags')" />
                            @foreach ($tags as $tag)
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="border-gray-300 rounded">
                                    <span class="ml-2 text-gray-700">{{ $tag->tag_name }}</span>
                                </label>
                            @endforeach
                        </div>


                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_published"
                                    class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500"
                                    {{ old('is_published') ? 'checked' : '' }} />
                                <span class="ml-2">{{ __('Publish Immediately') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create Post') }}</x-primary-button>

                            <a href="{{ route('posts.index') }}"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
