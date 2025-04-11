<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List of Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="col-span-6 card flex flex-col bg-white border border-gray-300">
                    <div class="border-b p-6 flex gap-x-4 items-center">
                        <button class="btn-theme btn-styles rounded-lg pop-up-create">
                            <i class="fa-solid fa-plus mr-2"></i> Compose
                        </button>

                        <form method="POST" action="{{ route('product.destroy') }}">
                            @csrf
                            @method('DELETE')
                            
                            <input type="hidden" name="ids" id="checked-ids">
                            
                            <x-button-dark class="delete-btn" type="submit">
                                <i class="fa fa-trash mr-2"></i>
                                Delete
                            </x-button-dark>

                        </form>

                    </div>
                    <div class="border-b p-6">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass w-4 h-4 text-gray-500" aria-hidden="true"></i>
                            </div>
                            {{-- <x-input-search id="search" placeholder="Search Blog title..."></x-input-search> --}}
                        </div>
                    </div>
                    <div class="relative overflow-x-scroll">
                        <table wire:loading.class="opacity-50" class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <input type="checkbox" class="w-4 h-4 rounded checkbox-all">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="cursor-pointer">
                                            ID
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Banner
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created at
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($products as $product)
                                <tr class="bg-white border-b">
                                    <td scope="row" class="px-6 py-4">
                                        <input type="checkbox" value="{{ $product->id }}" class="w-4 h-4 rounded checkbox">
                                    </td>
                                    <td scope="row" class="px-6 py-4">
                                        <a href="">Edit</a>
                                    </td>
                                    <td scope="row" class="px-6 py-4">
                                        {{ $product->id }}
                                    </td>
                                    <td scope="row" class="px-6 py-4">
                                        <a href="" target="_blank">{{ $product->name }}</a>
                                    </td>
                                    <td scope="row" class="px-6 py-4">
                                        <div class="w-10 h-10 overflow-hidden rounded-md">
                                            <img class="img-responsive" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                        </div>    
                                    </td>
                                    <td>
                                        {{ $product->created_at }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="pl-6 p-3 text-left">No Products</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <x-partials.pop-up>
        <form method="post" enctype="multipart/form-data" action="{{ route('product.store') }}" class="mt-6 space-y-6">
            @csrf
            @method('post')

            <div>
                <div class="w-full mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="w-full mb-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
        
                <div class="w-full mb-4">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div class="w-full mb-4">
                    <x-input-label for="image" :value="__('Product Image')" />
                    <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" required>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
        
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </div>

        </form>
    </x-partials.pop-up>
</x-app-layout>