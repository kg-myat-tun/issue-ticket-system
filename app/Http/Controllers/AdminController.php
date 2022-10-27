<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\IssueAssignDeveloper;
use App\Models\IssueTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //authentication start
    public function login(Request $request)
    {
        if (session("isSignIn")){
            return redirect()->route("home");
        }
        return view("Admin.login");
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session([
                    'isSignIn' => true,
                    'email' => $user->email,
                    'name' => $user->fullname,
                    'user_id' => Crypt::encrypt($user->guid),
                ]);

                $user->update();

                return redirect()->route('home');
            }
        }

        return redirect()->back()
            ->withErrors([
                'email' => 'Invalid login credentials',
                'password' => 'Invalid login credentials'
            ])->withInput();;

    }
    //authentication end

    //home
    public function home(Request $request)
    {
        $issues = IssueTicket::with("issue_type")->orderBy("created_at")->get();
        return view("Admin.home",compact("issues"));
    }

    public function ticketDetail(Request $request)
    {
        $ticket = IssueTicket::where("id",$request->id)->with("issue_type","issue_assign_developer")->first();
        if (isset($ticket))
        {
            $developers = Developer::all()->sortByDesc("created_at");
            return view("Admin.ticket-detail", compact("ticket","developers")) ;
        }
        return false ;
    }

    public function assignDeveloper(Request $request)
    {
        $request->validate([
            'ticket_id'     => 'required|exists:issue_tickets,id',
            'developer'     => 'required|array',
            'developer.*'   => "required|exists:developers,id"
        ]);
        $ticket_id = $request->ticket_id;
        foreach ($request->developer as $dev)
        {
            $is_exist_dev = IssueAssignDeveloper::where([["issue_ticket_id",$ticket_id],["developer_id",$dev]])->first();

            if (!isset($is_exist_dev))
            {
                $assign_dev = new IssueAssignDeveloper();
                $assign_dev->issue_ticket_id = $ticket_id;
                $assign_dev->developer_id    = $dev ;
                $assign_dev->save();
            }
        }

        return redirect()->back()->with("message","Developers are successfully assigned!");

    }

    public function statusUpdate(Request $request)
    {
        $ticket = IssueTicket::find($request->id);
        $ticket->is_resolved = "1" ;
        $ticket->update();

        return redirect()->back()->with("message","Status is successfully updated!");
    }

}
