<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function studentElection () {
        $title = "Election";
        $student = Auth::guard('student')->user();
        $elections = Election::all();
        return view('students.student-election', compact('elections', 'student', 'title'));
    }

    public function studentVoteIndex($eid)
    {
        $title = "Voting Page";
        $election = Election::with('positions.candidates')->findOrFail($eid);
        return view('students.student-vote', compact('election', 'title'));
    }

    public function voteStore(Request $request, $eid) {
        $student = Auth::guard('student')->user();
        $validator = Validator::make($request->all(), [
            'votes' => 'required|array',
            'votes.*' => 'required|exists:candidates,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $votedAt = Carbon::now();

        $election = Election::findOrFail($eid);



        foreach ($request->input('votes') as $positionId => $candidateId) {

            $votesExist = Vote::where('student_id', $student->id)->where('position_id', $positionId)->where('election_id', $eid)->count();

            if($votesExist > 0) {
                return redirect()->back()->with('error', "You voted in this position");
            }

            if ($votedAt->lessThan(Carbon::parse($election->start_date))) {
                return redirect()->back()->with('error' ,'Voting has not started yet.');
            }

            if ($votedAt->greaterThan(Carbon::parse($election->end_date))) {
                return redirect()->back()->with('error' ,'Voting has ended');
            }

            Vote::create([
                'student_id' => $student->id,
                'election_id' => $eid,
                'position_id' => $positionId,
                'candidate_id' => $candidateId,
                'voted_at' => $votedAt,
            ]);
        }

        return redirect()->back()->with('success', "Voted Successfully!");
    }

    public function electionsWinner() {
        $title = "Election Winner";
        $elections = Election::with('positions.candidates.votes')->get();

        $notEndYet = $elections->contains(function ($election) {
            return $election->end_date > Carbon::now();
        });

        return view('students.student-winner', compact('title', 'elections', 'notEndYet'));
    }
}
