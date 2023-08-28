<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Member;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $member = member::with('user')->get();
        // $books = Book::with('Publisher')->get();
        // $Books = Book::with ('Catalog')->get();

        // no 1
        // $data1 = Member::select('*')
        // ->join('users','users.member_id','=','members.id')
        // ->get();

        // mo 2
        // $data2 = member::select('*')
        // ->join('users','users.member_id','=','members.id', 'transactions.member.id')
        // ->where('users.id', NULL)
        // ->get();

        // no 3
        // $data3 = Transaction::select('members.id',)
        // ->rightJoin('members', 'member_id', '=', 'transactions.member_id')
        // ->where('transactions.member_id', NULL)
        // ->get();

        // no 4
        // $data4 = Member::select('members.id','members.name', 'members.phone_number')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->orderBy('members.id', 'asc')
        // ->get();

        // no 5
        // $data5 = Member::select('members.id', 'members.name', 'members.phone_number')
        //     ->join('transactions', 'members.id', '=', 'member_id')
        //     ->groupBy('members.id', 'members.name', 'members.phone_number')
        //     ->havingRaw('COUNT(members.id) > 1')
        //     ->get();

        // no 6
        // $data6 = Member::select('members.name', 'members.phone_number', 'members.address', 'members.created_at', 'members.updated_at')
        //      ->get();

        // no 7
        // $data7 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
        //     ->join('transactions', 'members.id', '=', 'member_id')
        //     ->whereMonth('transactions.date_end', '=', 6) // Filter transactions with return date in June
        //     ->get();

        // no 8
        // $data8 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
        //     ->join('transactions', 'members.id', '=', 'member_id')
        //     ->whereMonth('transactions.date_end', '=', 5) 
        //     ->get();

        // return $data8;
        return view('home');
    }
}
