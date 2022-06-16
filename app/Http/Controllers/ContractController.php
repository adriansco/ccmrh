<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        /* $conditions = Condition::all(); */
        return view('contracts.index');
    }

    public function create()
    {
        $groups = Group::get();
        return view('contracts.create', compact('groups'));
    }

    public function store(Request $request)
    {
        return $request->all();
        /* return redirect()->route('contract.index'); */
    }
}
