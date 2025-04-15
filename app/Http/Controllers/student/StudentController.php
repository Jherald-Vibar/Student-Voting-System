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
        $student = Auth::guard('student')->user();
        $elections = Election::all();
        return view('Election.student-election', compact('elections', 'student'));
    }

    public function studentVoteIndex($eid)
    {
        $election = Election::with('positions.candidates')->findOrFail($eid);
        return view('Election.student-vote', compact('election'));
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
}
