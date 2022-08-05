<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Categories
                </div>
            </div>
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-800 rounded-lg">⤶  categories table</a>
            </div>
        </div>
    </div>
<div class="container bg-gray-100 m-3 p-8 rounded-lg">
    <form enctype="multipart/form-data" action="{{ route('admin.categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- <div class="grid md:grid-cols-2 md:gap-6"> --}}
            <div class="relative z-0 mb-6 w-full group">
            <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" {{ $category->name }} " value="{{ $category->name }}" required="">
            <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
        {{-- </div> --}}
    </div>


        <div class="grid md:grid-cols-2 md:gap-6 mt-8 mb-4">
            <div class="relative z-0 mb-6 w-full group">
                <div class="mb-6 w-16 h-16 mx-2 my-4">
                    <img src="{{ Storage::url($category->image) }}" class="h-16 w-16 rounded-2xl" alt="">
                </div>

            <input name="image" id="image" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"  id="image" type="file" value="{{ $category->image }}">
            <label for="image" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Upload the image here !</label>

        </div>
    </div>

        {{-- <div class="grid md:grid-cols-2 md:gap-6"> --}}
        <div class="relative z-0 mb-6 w-full group">
            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"  required="" placeholder="" value="{{ $category->description }}"> {{ $category->description }} </textarea>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Description</label>
            {{-- </div> --}}
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">UPDATE</button>
    </form>
</div>



</x-admin-layout>

