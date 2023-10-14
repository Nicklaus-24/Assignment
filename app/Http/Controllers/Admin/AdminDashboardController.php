<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Event;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class AdminDashboardController extends AdminBaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $totalAssignments = Assignment::paginate(10);
        $totalProjects = Assignment::count();
        $assignedAssignments = Assignment::where('status','Assigned')->count();
        $unassignedAssignments = Assignment::where('status','Unassigned')->count();
        $membersAssigned = User::count();
        $currentDate = Carbon::now()->toDateString();
        $events = Event::whereDate('start', $currentDate)->orderBy('start', 'asc')
                       ->get();

           // Fetchiing assignments and grouping them by request_type
        $assignmentsByRequestType = Assignment::select('request_type', DB::raw('count(*) as count'))
         ->groupBy('request_type')
         ->get();

         // Converting  the data to a format suitable for the chart
         $data = [];
         foreach ($assignmentsByRequestType as $assignment) {
         $data[] = [
          'label' => $assignment->request_type,
          'count' => $assignment->count,
         ];
        }

         // Fetching all users and their assigned tasks count with status = "In Progress"
         $users = User::withCount(['assignments' => function ($query) {
         $query->where('status', 'In Progress');
         }])->get();

         // Preparing the data for the chart
         $userNames = $users->pluck('firstname')->toArray();
         $taskCounts = $users->pluck('assignments_count')->toArray();

           // Fetching the number of completed tasks for each request type
           $requestTypes = Assignment::select('request_type')
             ->where('status', 'Completed')
            ->groupBy('request_type')
            ->get();

             $requestTypeLabels = $requestTypes->pluck('request_type')->toArray();
             $completedTaskCounts = [];

            foreach ($requestTypes as $requestType) {
           $completedTaskCounts[] = Assignment::where('request_type', $requestType->request_type)
           ->where('status', 'Completed')
           ->count();
           }
 

       return view('dashboard2', compact('users','totalAssignments','totalProjects','assignedAssignments','unassignedAssignments','membersAssigned','events','data','userNames','taskCounts','requestTypeLabels','completedTaskCounts'));
    }


    
    


    public function users()
    {

     $users = User::orderBy('created_at', 'desc')->get();
    $membersAssigned = User::count();
    return view('pages.all_users',compact('users','membersAssigned'));

    }

    public function show(User $user)
     {
    return view('pages.user_show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.add_member');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'staffnumber'=>'required',
            'email' => 'required|email|unique:users',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required|min:8',
        ]);

        $password = $request->input('password');
        $hashedPassword = Hash::make($password);

        $user = new User();
        $user->staffnumber = $request->input('staffnumber');
        $user->email = $request->input('email');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->password = $hashedPassword;
        $user->email_verified_at = now();
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Send an email to the new member with their login credentials

        return redirect()->route('allMembers')->with('success', 'Member added successfully');
    }
    /**
     * Display the specified resource.
     */
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
