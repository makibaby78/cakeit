<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                @csrf
                @method('post')
            
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="flex flex-wrap mb-4">
                        <div class="w-full md:w-1/2 pr-2">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="w-full md:w-1/2 pl-2">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>
            
                    <div class="flex flex-wrap mb-4">
                        <div class="w-full md:w-1/2 pr-2">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="w-full md:w-1/2 pl-2">
                            <x-input-label for="image" :value="__('Product Image')" />
                            <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" required>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    </div>
            
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>