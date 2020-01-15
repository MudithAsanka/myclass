<?php

namespace App\Http\Controllers;

use App\Classlist;
use App\Http\Requests\UserUpdate;
use App\Student;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:student');
        $this->middleware('auth');
    }


    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function notifications()
    {
        return view('student.notifications');
    }

    public function payments()
    {
        $id = Auth::user()->id;
        $created_at = DB::table('students')->where('user_id', $id)->value('created_at');

        $start = new \DateTime($created_at);
        //dd($start);
        //$start = (new \DateTime('2019-01-01'));
        //$end = (new \DateTime('2019-12-01'));
        $end = (new \DateTime(Carbon::now()));
        $interval = \DateInterval::createFromDateString('1 month');
        $period = new \DatePeriod($start, $interval, $end);
        $months = array();
        foreach ($period as $dt)
        {
            $months[] = $dt->format("F Y");
        }
        $endmonth = $end->format("F Y");

        $classlists = null;
        return view('student.payments', compact('months','endmonth','classlists'));
    }

    public function paymentMonthFilterPost(Request $request)
    {
        //$id = Auth::user()->id;
        $user_id = Auth::user()->id;
        $id = DB::table('students')
            ->where('user_id',$user_id)->value('id');
        $endmonth = $request->time;

        $created_at = DB::table('students')->where('user_id', $user_id)->value('created_at');
        $start = new \DateTime($created_at);
        $end = (new \DateTime(Carbon::now()));
        $interval = \DateInterval::createFromDateString('1 month');
        $period = new \DatePeriod($start, $interval, $end);
        $months = array();
        foreach ($period as $dt)
        {
            $months[] = $dt->format("F Y");
        }

        $paymentsDetails = DB::table('payments')
            ->where([['student_id','=', $id],['payment_time','=',$request->time]])
            ->join('teachers','teacher_id','=','teachers.id')
            ->select('teachers.*')
            ->get();
        $classlists = DB::table('classlists')
            ->where('student_id',$id)
            ->join('teachers', 'teacher_id', '=', 'teachers.id')
            ->select('teachers.*')
            ->get();
        //dd($paymentsDetails);
        if($request->teacherarray == null)
        {
             return view('student.payments',compact('classlists','paymentsDetails','months','endmonth'));
        }
        else
        {
            $teachersDetails = array();
            $totalAmount = 0;
            foreach ($request->teacherarray as $teacher)
            {
                $teachersDetails[] = Teacher::find($teacher);
                $classFees = DB::table('teachers')->where('id',$teacher)->value('class_fees');
                $totalAmount = $totalAmount + $classFees;
            }


            return view('student.newPayment')
                ->with('teachersarray',$request->teacherarray)
                ->with('time',$request->time)
                ->with('teachersDetails', $teachersDetails)
                ->with('totalAmount',$totalAmount);

        }
        //return view('student.payments',compact('classlists','paymentsDetails','months','endmonth'));
        //return redirect()->back()->with('paymentsDetails','classlists');
        /*
        if($paymentsDetails != null){
            dd($paymentsDetails);
            //return redirect()->back()->with('null');
        }else{
            echo 'not null';
            dd($paymentsDetails);
            //return redirect()->back()->with('paymentsDetails');
        }
        */

    }


    /*
    public function paymentsPost(Request $request)
    {
        $user_id = Auth::user()->id;
        $student_id = DB::table('students')->where('user_id',$user_id)->value('id');
        //dd($request->all());
        return view('student.newPayment');
    }
    */

    public function newPaymentPost(Request $request)
    {
        //$id = Auth::user()->id;
        //$teacherlist = Classlist::where('student_id', $id);
        /*
        $teacherslist = DB::table('classlists')->where('student_id', $id)->pluck('teacher_id');
        $teachers = array();
        foreach ($teacherslist as $teacherlist)
        {
            //$teachers[] = DB::table('teachers')->where('id', $teacherlist)->pluck('subject');
            $teachers[] = DB::table('teachers')->where('id', $teacherlist)->get();
        }
        $counts = count($teachers);
        foreach ($counts as $count)
        {
            $newlist = $teachers[$count];
        }
        */

        /*
        $classlists = DB::table('classlists')
            ->where('student_id',$id)
            ->join('teachers', 'teacher_id', '=', 'teachers.id')
            ->select('teachers.*')
            ->get();
        return view('student.newPayment')->with('classlists',$classlists);

        if($request->teacherarray == null)
        {
            return redirect()->back()->with('error', "Please select classes to pay");
        }
        else
        {
            dd($request->all());
        }
        */
    }

    public function profile()
    {

        return view('student.profile');
    }

    public function profilePost(UserUpdate $request)
    {
        $user = Auth::user();

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        if($request['password'] != "")
        {
            if(!(Hash::check($request['password'], Auth::user()->password))){
                return redirect()->back()->with('error', "Your Current Password does not match with the password you provided");
            }
            if(strcmp($request['password'], $request['new_password']) == 0){
                return redirect()->back()->with('error', "New password cannot be same as your current password");
            }
            $validation = $request->validate([
                'password' => 'required',
                'new_password' => 'required|string|min:6|confirmed'
            ]);
            $user->password = bcrypt($request['new_password']);
            $user->save();
            return redirect()->back()->with('success', "Password changed successfully");
        }

        return back();
    }
}
