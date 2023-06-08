
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('students.update', $student->id) }}">
                    @csrf
                    @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="name">
                                {{ __('Name') }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="name" name="name" type="text" value="{{ old('name', $student->name) }}" required>
                           </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="email">
                                {{ __('Email') }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" value="{{ $student->email }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="group" class="block text-gray-700 font-bold mb-2">Group:</label>
                            <select name="group" id="group" class="border rounded w-full py-2 px-3">
                                <option value="">Select Group</option>
                                    @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" @if ($student->group && $group->id == $student->group->id) selected @endif>{{ $group->name }}</option>
                        @endforeach
</select>
</select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-violet-700 hover:bg-violet-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('save Changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
