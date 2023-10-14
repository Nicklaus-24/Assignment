<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    
    public function index()
    {
        $userId = Auth::user();

    // Get the assignments assigned to the user
$assignments = auth()->user()->assignments;

// Get the number of assignments assigned to the user
$assignmentsAssignedToUser = $assignments->count();

// Get the number of assignments in progress for the user
$assignmentsInProgress = $assignments->where('status', 'In Progress')->count();

// Get the number of assignments assigned only to the user (not in progress or completed)
$assignmentsAssignedOnly = $assignments->where('status', 'Assigned')->count();

// Get the number of assignments completed by the user
$assignmentsCompleted = $assignments->where('status', 'Completed')->count();

$currentDate = Carbon::now()->toDateString();
        $userId = auth()->user()->id;
        $events = Event::whereDate('start', $currentDate)->orderBy('start', 'asc')
        ->get();

        return view('dashboard.index', compact('assignmentsAssignedToUser','assignmentsInProgress','assignmentsAssignedOnly','assignmentsCompleted','events'));
    }

    

    //calendar events
    public function createEvent(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
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
    
    public function getEvents(Request $request)
    {
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
    }

    public function retrieveEvents()
    {
        // Fetch events for the current day
        $currentDate = Carbon::now()->toDateString();
        $events = Event::whereDate('start', $currentDate)
                       ->orderBy('start', 'asc')
                       ->get();
    
         // Convert to array if empty (for @empty in Blade)
        $events = $events->isEmpty() ? [] : $events;
    

        return view('dashboard', compact('events'));
      }


    public function assignProgress(){
          $assignmentsInProgress = Assignment::where('status', 'In Progress')
                                  ->orderBy('created_at','desc')
                                  ->paginate(10);
 
        return view('pages.assignments_progress', compact('assignmentsInProgress'));
        }
 
        public function assignCompleted(){
          $assignmentsCompleted = Assignment::where('status', 'Completed')
                                ->orderBy('created_at','desc')
                                 ->paginate(10);
         return view('pages.assignments_completed',compact('assignmentsCompleted'));
        }
}
