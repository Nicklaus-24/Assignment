<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ChatRoom;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AssignmentNotification;


class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Retrieve the authenticated user
        $user = Auth::user();

    // Get the assignments assigned to the user
       $assignments = $user->assignments;
       $assignments = Assignment::orderBy('created_at', 'desc')
                    ->paginate(10);
      
       //$assignments = Assignment::orderBy('created_at', 'desc')->get();
        //$assignment_Count = Assignment::count();

        return view('pages.tables', compact('assignments'));
    }
      

    public function adminIndex()
    {
        $assignments = Assignment::orderBy('created_at', 'desc')->paginate(10);
        $assignment_Count = Assignment::count();

        return view('pages.admin_assignments', compact('assignments', 'assignment_Count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $users = User::all(); 
        return view('pages.createassignment',  compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'org_name' => 'required',
        'request_type' => 'required',
        'attachment' => 'required|mimes:jpeg,png,pdf|max:2048',
        'description' => 'required',
        'date_request_received' => 'required',
        'status' => 'required',
    ]);

    // Handle file upload
    $attachmentPath = null; 

    if ($request->hasFile('attachment')) {
        $attachment = $request->file('attachment');
        $attachmentPath = $attachment->store('attachments', 'public');
    }

    // Save the assignment in the database
    $assignment = new Assignment();
    $assignment->org_name = $request->org_name;
    $assignment->request_type = $request->request_type;
    $assignment->file_type = $attachment->getClientOriginalExtension();
    $assignment->description = $request->description;
    $assignment->date_request_received = $request->date_request_received;
    $assignment->status = $request->status;
    $assignment->attachment = $attachmentPath;
    $assignment->save();

//      // Create a new chat room
// $chatRoom = new ChatRoom();
// $chatRoom->assignment_id = $assignment->id;
// // Set other chat room properties

// // Save the chat room to the database
// $chatRoom->save();

// // Associate the chat room with the assignment
// $assignment->chatRoom()->associate($chatRoom);
// $assignment->save();

    // Attach members if the status is "Assigned"
    if ($request->status === 'Assigned' && $request->has('members_assigned')) {
        $membersAssigned = $request->members_assigned;
        $assignment->users()->attach($membersAssigned);
    }

   // Retrieve the assigned user IDs from the assignment_user pivot table
$assignedUserIds = DB::table('assignment_user')
->where('assignment_id', $assignment->id)
->pluck('user_id');

// Retrieve the users
$users = User::whereIn('id', $assignedUserIds)->get();

// Loop through the users and send notifications
foreach ($users as $user) {
// Create a new instance of the notification
$notification = new AssignmentNotification($assignment);

// Send the notification to the users
$user->notify($notification);
}

    // Check if the authenticated user is using the 'admin' guard
    // if (auth()->guard('admin')->check()) {
        // If the user is an admin, redirect to the admin assignment view
        return redirect()->route('admin_assignments')->with('success', 'Assignment added successfully.');
    // } else {
    //     // If the user is not an admin, redirect to the tables view
    //     return redirect()->route('tables')->with('success', 'Assignment added successfully.');
    // }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assignment = Assignment::findOrFail($id);
        // $assignment = Assignment::with('chatRoom')->get();
    
        return view('pages.assignment_show', compact('assignment'));
    }

    public function Usershow(string $id)
    {
        $assignment = Assignment::findOrFail($id);
    
        return view('pages.user_view_details', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $users = User::all();
        return view('pages.assignEdit', compact('assignment','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    
     

     public function assignUpdate(Request $request, $id)
     {
         $request->validate([
             'org_name' => 'required',
             'request_type' => 'required',
             'description' => 'required',
             'date_request_received' => 'required',
             'status' => 'required',
             'members_assigned' => 'required|array',
             'new_attachment' => 'nullable|file'
         ]);
     
         $assignment = Assignment::findOrFail($id);
         $assignment->org_name = $request->input('org_name');
         $assignment->request_type = $request->input('request_type');
         $assignment->description = $request->input('description');
         $assignment->date_request_received = $request->input('date_request_received');
         $assignment->status = $request->input('status');
     
         // Check if the remove attachment option is selected
         if ($request->has('remove_attachment')) {
             // Remove the current attachment
             if ($assignment->attachment) {
                 Storage::disk('public')->delete($assignment->attachment);
                 $assignment->attachment = null;
             }
         }
     
         // Handle attachment update
         if ($request->hasFile('new_attachment')) {
             // Remove the current attachment (optional)
             if ($assignment->attachment) {
                 Storage::disk('public')->delete($assignment->attachment);
             }
     
             // Upload and store the new attachment
             $newAttachment = $request->file('new_attachment');
             $newAttachmentPath = $newAttachment->store('attachments', 'public');
             $assignment->attachment = $newAttachmentPath;
         }
     
         // Update members assigned
         $membersAssigned = $request->input('members_assigned');
         $assignment->users()->sync($membersAssigned);

         if (count($membersAssigned) > 0) {
            $assignment->status = 'Assigned';
        } else {
            $assignment->status = 'Unassigned';
        }
     
         $assignment->save();
     
         return redirect()->route('assignment_show', $assignment->id)->with('success', 'Assignment updated successfully.');
     }


     public function updateStatus(Request $request, $id)
     {
         $request->validate([
             'status' => 'required|in:In Progress,Completed'
         ]);
     
         $assignment = Assignment::findOrFail($id);
     
        //  // Check if the assignment is in the correct status flow
        //  if ($assignment->status === 'Assigned' && ($request->input('status') === 'In Progress' || $request->input('status') === 'Completed')) {
             $assignment->status = $request->input('status');
             $assignment->save();
     
             return redirect()->back()->with('status', 'Status updated successfully.');
        //  }
     
         // Invalid status update attempted
         return redirect()->back()->withErrors(['status' => 'Invalid status update attempted.']);
     }
     


         public function deleteAttachment(Request $request, $id)
     {
           $assignment = Assignment::findOrFail($id);

       if ($assignment->attachment) {
        // Delete the attachment file
        Storage::disk('public')->delete($assignment->attachment);

        // Remove the attachment reference from the assignment
        $assignment->attachment = null;
        $assignment->save();

        return redirect()->route('assignment_edit', $assignment->id)->with('status', 'Attachment deleted successfully.');
       }

    return redirect()->route('assignEdit', $assignment->id)->with('status', 'No attachment found.');
}



       public function assignedAssignments(){

       $assignedAssignments = Assignment::where('status', 'Assigned')
                               ->orderBy('created_at','desc')
                               ->paginate(10);

       return view('pages.assigned_assignments', compact('assignedAssignments'));
       }

       public function unassigned(){

        $unassignedAssignments = Assignment::where('status','Unassigned')
                               ->orderBy('created_at','desc')
                               ->paginate(10);
        return view('pages.unassigned_assignments',compact('unassignedAssignments'));
       }

     
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    



}
