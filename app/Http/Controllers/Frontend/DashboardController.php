<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use facades
use Hash;
use Session;
use Carbon\Carbon;
use Storage;
// use Illuminate\Support\Facades\File;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Photos\Facades\Image;


use Illuminate\Support\Facades\Validator;

// use models
use App\Models\User;
use App\Models\Job;
use App\Models\SavedJob;
use App\Models\EmployeeAppliedJob;
use App\Models\EmployeeBussinessCategory;
use App\Models\TrendingFilter;
use App\Models\Transaction;
use App\Models\IndirectEarning;
use App\Models\DirectEarning;
use App\Models\Withdraw;

class DashboardController extends Controller
{
    public function index(request $request){
        
        $transaction = Transaction::where('sender_id', Auth::user()->id)->first();
        $withdraw = Withdraw::where('user_id', Auth::user()->id)->first();
        $indirect_earning = IndirectEarning::where('user_id', Auth::user()->id)->first();
        $direct_earning = DirectEarning::where('user_id', Auth::user()->id)->first();
        $direct_earning_today = DirectEarning::where('user_id', Auth::user()->id)->whereDate('created_at' ,date('Y-m-d') )->first();
        $indirect_earning_today = IndirectEarning::where('user_id', Auth::user()->id)->whereDate('updated_at' ,date('Y-m-d') )->first();
        
        if(!empty($direct_earning_today && $indirect_earning_today)){

            $total_today = $direct_earning_today->amount  + $indirect_earning_today->amount ;
           
        }
        else{
            $total_today = 0;
        }

        $earning =IndirectEarning::where('user_id', Auth::user()->id)->first();
        
        if($earning && !empty($transaction)){
            $earning->amount += 2;
            $earning->save();
        }elseif(!empty($transaction)){
            $earning =IndirectEarning::create([
                 'user_id' =>  Auth::user()->id,
                 'amount'=> 2,
            ]);
             
        }
        return view('frontend.pages.index',
        compact('transaction','indirect_earning','direct_earning',
        'withdraw','direct_earning_today','indirect_earning_today','total_today'));
    }

    // Employee Details 
    public function updateEmployeeDetailsPage(request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();

            $profileFolder = 'profile';
            if (!Storage::exists($profileFolder)) {
                Storage::makeDirectory($profileFolder);
            }
    
            // upload file
            if ($request->hasFile('profile_image')) {
                $image = Storage::putFile($profileFolder, new File($request->file('profile_image')));
                $data['profile_image'] = $image;
            }

            // add user data into array
            $user_data = [
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'phone_number'         => $data['phone_number'],
                'email'      => $data['email'], 
                'state'          => $data['state'], 
                'address'    => $data['address'],
                'country'    => $data['country'],
               
            ];

             $user = User::find(user()->id)->update($user_data);
             if($user){
                Image::upload($request->image, 'user',user()->id, User::class);
                 return redirect()->route('dashboard')->with('success', 'Profile Updated Successfully!');
             }

        }
    
        return view('frontend.pages.userprofile.profile');
    }

    public function settings()
    {
        return view('frontend.pages.userprofile.settings');
    }

    // Employee Check Password is Correct or Not
    public function chkCurrentpassword(request $request){
        $data=$request->all();
        if(Hash::check($data['current_pwd'],Auth::user()->password)){
            return "true";
        }
        else{
            return "false"; 
        }
    }

    // Employee Update Password   
    public function updatepassword(request $request)
    {
        $data=$request->all();
        // check if the the current password is correct
        if(Hash::check($data['current_pwd'],Auth::user()->password)){
            // Check if new password is matching
        if($data ['new_pwd'] == $data['confirm_pwd']){
            User::where('id',Auth::user()->id)->update(
                ['password'=>bcrypt($data['new_pwd'])
            ]);
            session::flash('success_message', 'your password has been updated Successfully');
        }else{
            session::flash('error_message', 'New password and Confirm passwrd is not match');
        }
        }else{
        session::flash('error_message', 'your current passwod is uncorrect');
        }
        return redirect()->back();
    }

    //  Employee Notification
    public function notifications()
    {
        $notifications = unserialized_notification(user()->get_notification);
        return view('frontend.pages.userprofile.notifications', compact('notifications'));
    }

    // employed saved jobs
    public function savedjob()
    {
       return view('frontend.pages.userprofile.savedjobs');
    }

    // Employee Search job
    public function job_search(Request $request)
    {
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

            $jobs =  Job::with('user')
            ->where('job_approval', 1)
            ->Where('title', 'like', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->get();

            if(count($jobs) > 0)
            {
                $this->trending_filter($query);
                return response()->json([
                    'success' => true,
                    'count' => count($jobs),
                    'jobs' => $jobs
                ]);
            }

            return response()->json([
                'success' => false,
                'count' => count($jobs),
                'jobs' => $jobs
            ]);
        }
    }

    // Employee Ctegory job Search 
    public function category_job_search(Request $request)
    {
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');

            $jobs =  Job::with('user')
            ->where('job_approval', 1)
            ->Where('title', 'like', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->get();

            if(count($jobs) > 0)
            {
                $this->categorytrending_filter($query);
                return response()->json([
                    'success' => true,
                    'count' => count($jobs),
                    'jobs' => $jobs
                ]);
            }

            return response()->json([
                'success' => false,
                'count' => count($jobs),
                'jobs' => $jobs
            ]);
        }
    }
     
    function categorytrending_filter($query)
    {
       $filter = TrendingFilter::Where('title', 'like', '%'.$query.'%')->first();
       if(!empty($filter)){
            $filter->count += 1;
       }else{
           $filter = new TrendingFilter();
           $filter->title = $query;
       }
       $filter->save();
    }
    
    public function apply_job(Request $request )
    {

        if(request()->ajax()){
            $user = Auth::user();
            $job = Job::find($request->job_id);
            $saved_job = EmployeeAppliedJob::where([
                    ['user_id', $user->id],
                    ['job_id', $request->job_id],
                ])->first();
            if(empty($saved_job)){
                $user->applied_jobs()->attach($request->job_id);
                notifications(
                    $job->id, 
                    $job->employer_id, 
                    EmployeeAppliedJob::class, 
                    "applied on job ". $job->title ." at: (". date('d-M-y') .")"
                );
                return response()->json([
                    'method' => 'create',
                    'message' => 'Job applied Successfully!', 
                    'success' => true,
                ], 200);
            }else{
                $user->applied_jobs()->detach($request->job_id);
                return response()->json([
                    'method' => 'delete',
                    'message' => 'Job removed Successfully!', 
                    'success' => true,
                ], 200);
            }
        }


        
    }

    public function savejob(Request $request){

        if(request()->ajax()){
            $user = Auth::user();
            $saved_job = SavedJob::where([
                    ['user_id', $user->id],
                    ['job_id', $request->job_id],
                ])->first();
            if(empty($saved_job)){
                $user->saved_jobs()->attach($request->job_id);
                return response()->json([
                    'method' => 'create',
                    'message' => 'Job saved Successfully!', 
                    'success' => true,
                ], 200);
            }else{
                $user->saved_jobs()->detach($request->job_id);
                return response()->json([
                    'method' => 'delete',
                    'message' => 'Job removed Successfully!', 
                    'success' => true,
                ], 200);
            }
        }
    }

    public function job_details($slug)
    {
        $job = Job::with('user')->select()->where('slug', $slug)->first();
        //  dd($job);
        if (empty($job)) {
            return back()->with('error','Not Found.');
        }

        $timeCheck = Carbon::now();
       return view('frontend.pages.find_job',compact('job','timeCheck'));
       
    }

    public function category($slug)
    {
        $category = EmployeeBussinessCategory::where('slug', $slug)->first();
        $trends = TrendingFilter::orderBy('count' ,'DESC')->paginate(10);
        $jobs = Job::with('user')
        ->orderBy('id','DESC')
        ->where('job_approval', 1)
        ->where('business_cat_id', $category->id)
        ->paginate(20);

       return view('frontend.pages.category',compact('jobs','category','trends'));
    }

    // Home page Trending filter
    function trending_filter($query)
    {
       $filter = TrendingFilter::Where('title', 'like', '%'.$query.'%')->first();
       if(!empty($filter)){
            $filter->count += 1;
       }else{
           $filter = new TrendingFilter();
           $filter->title = $query;
       }
       $filter->save();
    }
}
