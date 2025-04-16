<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Poll;
use App\Models\Position;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function home() {
        $title = "Home";
        $students = Student::has('votes')->with('votes')->get();
        $totalStudents = Student::count();
        $totalElections = Election::count();
        return view('admin.admin-home', compact('students', 'title', 'totalStudents', 'totalElections'));
    }

    public function index() {
        $title = "Election";
        $elections = Election::with('positions.candidates')->get();
        return view('Election.election-index', compact('title', 'elections'));
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

    public function electionView($id) {
        $title = "Position Page";
        $election = Election::findOrFail($id);
        $positions = Position::where('election_id', $election->id)->get();
        return view('Election.election-position-view', compact('election', 'positions', 'title'));
    }

    public function positionStore(Request $request, $id) {
        $election = Election::findOrFail($id);

        $validator = Validator::make($request->all(), [
        'title' => 'required|unique:positions,title,NULL,id,election_id,' . $election->id,
        'description' => 'required',
        ]);


        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $validated = $validator->validated();

            Position::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'election_id' => $election->id,
            ]);

            return redirect()->back()->with('success', "Position created successfully!");
            } catch (\Exception $e) {

                return redirect()->back()->with('error', "An error occurred while creating the position. Please try again.");
        }
    }

    public function candidatesIndex($electionId, $positionId) {
        $title = "Candidate Page";
        $election = Election::findOrFail($electionId);
        $position = Position::findOrFail($positionId);
        $students = Student::all();
        $candidates = $position->candidates;
        return view('Election.position-view', compact('election', 'position', 'students', 'candidates', 'title'));
    }


    public function candidatesStore(Request $request, $pid, $eid) {
        $election = Election::findOrFail($pid);
        $position = Position::findOrFail($eid);

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:png,jpg,jpeg,jfif',
            'student_id' => 'required|unique:candidates,student_id,NULL,id,position_id,' . $position->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();


            $file->move(public_path('candidate_images'), $fileName);


            $validated['image'] = $fileName;
        }


        try {
            Candidate::create([
                'student_id' => $request->student_id,
                'election_id' => $election->id,
                'position_id' => $position->id,
                'image' => $validated['image'],
            ]);
            return redirect()->back()->with('success', "Candidate Created Successfully!");
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', $e);
        }


    }

    public function  resultView() {
        $title = "Track Election Vote";
        $elections = Election::all();
        return view('Election.election-result', compact('elections', 'title'));
    }

    public function resultAll($eid) {
        $title = "Voting Tally";
        $election = Election::findOrFail($eid);
        $candidates = Candidate::with(['votes', 'position'])
        ->where('election_id', $election->id)
        ->get();
        return view('Election.election-result-all', compact('election', 'candidates', 'title'));
    }

    public function electionWinner() {
        $title = "Election Winner";
        $elections = Election::with('positions.candidates.votes')->get();

        $notEndYet = $elections->contains(function ($election) {
            return $election->end_date > Carbon::now();
        });

        return view('Election.election-winner', compact('elections', 'notEndYet', 'title'));
    }

    public function editForm($id) {
        $title = "Election Edit";
        $election = Election::findOrFail($id);
        return view('Election.election-edit', compact('election', 'title'));
    }

    public function update(Request $request, $id) {
        $election = Election::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if($validator->fails()) {
            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();


        $election->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'] ?? $election->start_date,
            'end_date' => $validated['end_date'] ?? $election->end_date,
        ]);


        if (is_array($request->positions)) {
            foreach ($request->positions as $id => $position) {
                if ($id == 'new') {
                    foreach ($position as $pos) {
                        $election->positions()->create(['title' => $pos]);
                    }
                } else {
                    $positionModel = Position::find($id);
                    if ($positionModel) {
                        $positionModel->title = $position;
                        $positionModel->save();
                    }
                }
            }
        }

        if ($request->filled('removed_positions')) {
            $election->positions()->whereIn('id', $request->removed_positions)->delete();
        }
        return redirect()->route('election-index')->with('success', "Election/Position Updated Successfully!");

    }

    public function electionDelete($id)
    {
        try {
            $election = Election::findOrFail($id);
            $election->delete();

            return redirect()->back()->with('success', 'Election Successfully Deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting election: ' . $e->getMessage());
        }
    }


    public function positionDelete($id)
    {
        try {
            $position = Position::findOrFail($id);
            $position->delete();

            return redirect()->route('election-position')->with('success', 'Position Successfully Deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting position: ' . $e->getMessage());
        }
    }

}
