<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">Hello {{ Auth::user()->name }}</h1><br>
        @if (Auth::user()->usertype === 'student')
            <h3 class="font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">
                Group: {{ $group->name }} 
            </h3>
        @endif
    
    </x-slot>
    
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
               
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Day</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Start Time</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">End Time</th>
                                @if (Auth::user()->usertype === 'admin' || Auth::user()->usertype === 'student')
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Teacher</th>
                                @endif
                                @if (Auth::user()->usertype === 'admin' || Auth::user()->usertype === 'teacher')
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Group</th>
                                @endif
                                @if (Auth::user()->usertype === 'admin')
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200">
                            @foreach ($timetables as $timetable)
                                <tr>
                                    <td class="border px-4 py-2">{{ $timetable->day }}</td>
                                    <td class="border px-4 py-2">{{ $timetable->start_time }}</td>
                                    <td class="border px-4 py-2">{{ $timetable->end_time }}</td>
                                    @if (Auth::user()->usertype === 'admin' || Auth::user()->usertype === 'student')
                                        <td class="border px-4 py-2">{{ $timetable->teacher->name }}</td>
                                    @endif
                                    @if (Auth::user()->usertype === 'admin' || Auth::user()->usertype === 'teacher')
                                    <td class="border px-4 py-2">{{ $timetable->group->name }}</td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
