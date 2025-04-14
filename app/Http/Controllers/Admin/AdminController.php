<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Poll;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function home() {
        $students = Student::all();
        return view('admin.admin-home', compact('students'));
    }

    public function index() {
        $page = "Admin";
        $elections = Election::all();
        return view('Election.election-index', compact('page', 'elections'));
    }


    public function electionStore(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $validated = $validator->validated();

        Election::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        return redirect()->back()->with('success', "Election Created Successfully!");
    }
}
