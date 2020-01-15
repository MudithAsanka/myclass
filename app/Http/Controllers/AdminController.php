<?php

namespace App\Http\Controllers;

use App\Classlist;
use App\Http\Requests\UserUpdate;
use App\Student;
use App\Teacher;
use App\User;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:admin');
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function students()
    {
        $classlists = Classlist::all();
        $students = Student::all();
        return view('admin.students', compact('students', 'classlists'));
    }

    public function teachers()
    {
        $teachers = Teacher::all();
        return view('admin.teachers', compact('teachers'));
    }

    public function payments()
    {
        $students = Student::all();
        return view('admin.payments', compact('students'));
    }

    public function messages()
    {
        return view('admin.messages');
    }

    public function profile()
    {
        return view('admin.profile');
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

    public function newStudent()
    {
        $teachers = Teacher::all();
        $statement = DB::select("SHOW TABLE STATUS LIKE 'students'");
        $nextId = $statement[0]->Auto_increment;
        return view('admin.newStudent', compact('nextId','teachers'));
    }

    public function newStudentPost(Request $request)
    {
        $statement2 = DB::select("SHOW TABLE STATUS LIKE 'users'");
        $nextuserId = $statement2[0]->Auto_increment;

        $statement = DB::select("SHOW TABLE STATUS LIKE 'students'");
        $nextId = $statement[0]->Auto_increment;

        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'contact_no' => 'required'
        ]);
        if($request->teacherarray == null)
        {
            return redirect()->back()->with('error', "Please select classes");
        }
        else {

            $student = new Student;
            $user = new User;

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = bcrypt(strtolower(preg_replace('/\s+/', '', $request['name'])));
            $user->admin = false;
            $user->teacher = false;
            $user->student = true;
            $user->save();

            $student->user_id = $nextuserId;
            $student->name = $request['name'];
            $student->address = $request['address'];
            $student->email = $request['email'];
            $student->contact_no = $request['contact_no'];
            $student->save();

            foreach ($request->teacherarray as $teacherarray) {
                $classlist = new Classlist;
                $classlist->student_id = $nextId;
                $classlist->teacher_id = $teacherarray;
                $classlist->save();
            }

            return redirect()->back()->with('success', "New Student added successfully");
        }
    }

    public function editStudent($id)
    {
        $student = Student::findOrFail($id);
        $teachers = Teacher::all();
        $teachers_id = DB::table('classlists')->where('student_id',$id)->pluck('teacher_id');
        return view('admin.editStudent', compact('student','teachers','teachers_id'));
    }

    public function editStudentPost(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'contact_no' => 'required'
        ]);

        if($request->teacherarray == null)
        {
            return redirect()->back()->with('error', "Please select classes");
        }
        else {

            $classlist1 = Classlist::where('student_id', $id);
            $classlist1->delete();


            $student = Student::findOrFail($id);
            $student->name = $request['name'];
            $student->address = $request['address'];
            //$user = User::where('email', $student->email);
            //$user->email = $request['email'];
            //$user->save();
            //$previousemail = DB::table('students')->where('id',$id)->value('email');
            //$user = User::where('email',$previousemail)->first();
            //$user->save();
            //$previousemail = $student->email;
            //$user = User::where('email',$previousemail)->first();
            //$user->save();
            $student->email = $request['email'];
            $student->contact_no = $request['contact_no'];
            $student->save();



            foreach ($request->teacherarray as $teacherarray) {
                $classlist = new Classlist;
                $classlist->student_id = $id;
                $classlist->teacher_id = $teacherarray;
                $classlist->save();
            }

            return redirect()->back()->with('success', "Student details updated successfully");
        }

    }


    public function newTeacher()
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'teachers'");
        $nextId = $statement[0]->Auto_increment;
        //$nextId = DB::table('students')->max('id') + 1;
        return view('admin.newTeacher', compact('nextId'));
    }

    public function newTeacherPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'contact_no' => 'required',
            'subject' => 'required|string',
            'class_fees' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?/'
        ]);

        $teacher = new Teacher;
        $teacher->name = $request['name'];
        $teacher->address = $request['address'];
        $teacher->email = $request['email'];
        $teacher->contact_no = $request['contact_no'];
        $teacher->subject = $request['subject'];
        $teacher->class_fees = $request['class_fees'];
        $teacher->save();

        return redirect()->back()->with('success', "New Teacher added successfully");

    }

    public function editTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.editTeacher', compact('teacher'));

    }

    public function editTeacherPost(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'contact_no' => 'required',
            'subject' => 'required|string',
            'class_fees' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?/'
        ]);
        $teacher = Teacher::findOrFail($id);
        $teacher->name = $request['name'];
        $teacher->address = $request['address'];
        $teacher->email = $request['email'];
        $teacher->contact_no = $request['contact_no'];
        $teacher->subject = $request['subject'];
        $teacher->class_fees = $request['class_fees'];
        $teacher->save();

        return redirect()->back()->with('success', "Teacher details updated successfully");
    }

    public function deleteTeacher($id)
    {
        $classlist = Classlist::where('teacher_id', $id);
        $classlist->delete();
        $teacher = Teacher::findOrFail($id)->delete();

        return back();
    }

    public function deleteStudent($id)
    {
        $classlist = Classlist::where('student_id', $id);
        $classlist->delete();
        $student = Student::findOrFail($id)->delete();
        return back();
    }
}
