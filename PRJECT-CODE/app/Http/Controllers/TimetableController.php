<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller
{
    // Show the timetables for the logged-in teacher
    public function index()
    {
        $timetables = Auth::user()->timetables()->with('group')->get(['day', 'start_time', 'end_time']);
        return view('admin.timetable.index', compact('timetables'));
    }
    public function show()
    {
        $groups = Group::with('timetables.teacher')->get();
        return view('admin.timetable.show', compact('groups'));
    }
    // Show the form for creating a new timetable
    public function create()
    {
        // Retrieve the list of teachers and subjects to populate dropdowns in the form
        $teachers = \App\Models\User::where('usertype', 'teacher')->get();
        $groups = Group::all();
        return view('admin.timetable.create', compact('teachers','groups'));
    }

    // Store a newly created timetable in the database
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'teacher_id' => 'required',
            'group_id' => 'required',
        ]);

        // Create the timetable
        $timetable = new Timetable();
        $timetable->day = $validatedData['day'];
        $timetable->group_id = $request->group_id;
        $timetable->start_time = $validatedData['start_time'];
        $timetable->end_time = $validatedData['end_time'];
        $timetable->teacher_id = $request->teacher_id;
        $timetable->save();

        return redirect()->back()->with('success', 'Timetable created successfully.');
    }
   // Show the form for editing the specified timetable
public function edit($id)
{
    // Retrieve the timetable based on the provided ID
    $timetable = Timetable::findOrFail($id);

    // Retrieve the list of teachers and groups to populate dropdowns in the form
    $teachers = \App\Models\User::where('usertype', 'teacher')->get();
    $groups = Group::all();

    return view('admin.timetable.edit', compact('timetable', 'teachers', 'groups'));
}



// Update the specified timetable in the database
public function update(Request $request, $id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'day' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'teacher_id' => 'required',
        'group_id' => 'required',
    ]);

    // Find the timetable based on the provided ID
    $timetable = Timetable::findOrFail($id);

    // Update the timetable
    $timetable->day = $validatedData['day'];
    $timetable->group_id = $request->group_id;
    $timetable->start_time = $validatedData['start_time'];
    $timetable->end_time = $validatedData['end_time'];
    $timetable->teacher_id = $request->teacher_id;
    $timetable->save();

    return redirect()->back()->with('success', 'Timetable updated successfully.');
}
public function destroy($id)
{
    // Find the timetable based on the provided ID
    $timetable = Timetable::findOrFail($id);

    // Delete the timetable
    $timetable->delete();

    return redirect()->back()->with('success', 'Timetable deleted successfully.');
}
}
    