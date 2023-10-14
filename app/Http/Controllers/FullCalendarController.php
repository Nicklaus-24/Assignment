<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;

class FullCalendarController extends Controller
{
	public function users()
    {
		
		$users = User::all();

		$user_id = $request->input('user_id', []); // Get an array of selected user IDs

        return response()->json(['users' => $users]);
    }



    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('full-calender');
    }

    public function getEvent()
{
    // Fetch events for the current day
    $currentDate = Carbon::now()->toDateString();
    $events = Event::whereDate('start', $currentDate)
                   ->orderBy('start', 'asc')
                   ->get();

     // Convert to array if empty (for @empty in Blade)
    $events = $events->isEmpty() ? [] : $events;

            
   return view('dashboard2', compact('events'));
                }


    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
					'venue'     =>  $request->venue,
					'user_id'=> $request->user_id,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);
				$event->save();

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
					'venue'     =>  $request->venue,
					'participants'=> $request->user_id,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Event::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
	}

}
