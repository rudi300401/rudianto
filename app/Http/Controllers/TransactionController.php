<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.transaction');
    }

    public function api()
     {
        $transactions = Transaction::all();

        // foreach ($transactions as $key => $transaction ) {
        //     $transaction -> date = convert_date ($transaction->created_at);
        // }

        $datatables = datatables()->of($transactions)
                                    ->addColumn('date', function ($transaction) {
                                        return convert_date ($transaction->created_at);
                                    })->addIndexColumn();
                                    

                                    return $datatables->make(true);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                '  member_id' =>  ['required'],
                'date_start'  => ['required'],
                'date_end'  => ['required'],
                'name'  => ['required'],
                'how_many_days'  => ['required'],
                'total_book'  => ['required'],
                'total_payment'  => ['required'],
                'status'  => ['required'],
                'created_at'  => ['required'],
        ]);

        Transaction::create($request->all());

        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('admin.transaction');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request,[
                '  member_id' =>  ['required'],
                'date_start'  => ['required'],
                'date_end'  => ['required'],
                'name'  => ['required'],
                'how_many_days'  => ['required'],
                'total_book'  => ['required'],
                'total_payment'  => ['required'],
                'status'  => ['required'],
                'created_at'  => ['required'],
        ]);

        $transaction->update($request->all());

        return redirect('transactions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
    }
}