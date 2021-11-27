<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\CustList;

class ListsController extends Controller
{
    public function index()
    {
        $lists = Auth::user()->lists;
        return view('dashboard', compact('lists'));
    }
    public function add()
    {
    	return view('add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
    	$task = new Task();
    	$task->description = $request->description;
    	$task->user_id = Auth::id();
    	$task->save();
    	return redirect('/dashboard');
    }

    public function edit(Task $task)
    {

    	if (Auth::id() == $task->user_id)
        {
                return view('edit', compact('task'));
        }
        else {
             return redirect('/dashboard');
         }
    }

    public function update(Request $request, Task $task)
    {
    	if(isset($_POST['delete'])) {
    		$task->delete();
    		return redirect('/dashboard');
    	}
    	else
    	{
            $this->validate($request, [
                'description' => 'required'
            ]);
    		$task->description = $request->description;
	    	$task->save();
	    	return redirect('/dashboard');
    	}
    }
}
