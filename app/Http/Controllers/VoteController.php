<?php

namespace App\Http\Controllers;

use App\Models\Votes;
use App\Models\UserVote;
use App\Models\Elections;
use App\Models\UserVotes;
use Illuminate\Http\Request;
use App\Models\CandidatesTeam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    function main()
    {
        $pemilu = Elections::with('candidates.members.user')->get();
        return view('vote.index', compact(['pemilu']));
    }
    function show($name)
    {
        
        $pemilu = Elections::with('candidates.members.user')->get();
        $teams = Elections::with('candidates.members.user')->where('name',$name)->first();
        return view('vote.show', compact(['pemilu','teams']));
    }
    function create($id){

        if (!Auth::check()) {
            return back()->withErrors(['message' => 'Anda belum login']);
        }
        $candidates = CandidatesTeam::with('election')->where('id',$id)->first();
        $user_vote = UserVotes::where('user_id',Auth::user()->id)->where('election_id',$candidates->election->id)->first();
        if($user_vote){
            return back()->withErrors(['message' => 'Anda sudah melakukan voting']);
        }
        // dd($user_vote);
        DB::beginTransaction();
    try {
        Votes::create([
            'user_id'=>Auth::user()->id,
            'candidates_team_id'=>$id
        ]);
        UserVotes::create([
            'user_id'=>Auth::user()->id,
            'election_id'=>$candidates->election->id,
            'has_voted'=>1
        ]);
        DB::commit();
        return redirect()->route('voting.show',$candidates->election->name)->with('success','Terimakasih sudah ikut serta demokrasi ini ya!');
    }catch (\Exception $e) {
        DB::rollBack();
        Log::error('vote gagal: ' . $e->getMessage(), [
            'stack' => $e->getTraceAsString()
        ]);
        return redirect()->route('voting.show',$candidates->election->name)->with('error','vote gagal');
    }
    }
}
