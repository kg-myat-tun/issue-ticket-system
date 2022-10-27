<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\IssueTicket;
use App\Models\IssueType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $types = IssueType::all();
        $issues = IssueTicket::with("issue_type")->orderBy("created_at")->get();
        return view("User.index",compact('types','issues'));
    }

    public function storeTicket(StoreTicketRequest $request)
    {
        $validated  = $request->validated(); //validate request

        $ticket = new IssueTicket();
        $ticket->title = $request->title ;
        $ticket->issue_type_id = $request->type ;
        $ticket->save();

        return redirect()->back()->with("message","Your issue ticket is successfully opened!");
    }

}
