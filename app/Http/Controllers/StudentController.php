<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Student;
use App\Parents;
use App\User;
use Auth;
class StudentController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = User::find(Auth::id())->role->name;
        return view('pages.students',compact('role'));
    }

    /* pass all student data filter by required */
    public function getAllStudent(Request $request){
        try{
            if(isset($request->studentAge)){
                $age= self::subtracDate($request->studentAge);
                $students = Student::with('class')->whereYear('dob','<=',$age)->get();
            }else if(isset($request->class) && isset($request->year)){
                $students = Student::whereHas('class', function ($query) use ($request) {
                    $query->where([['name', $request->class],['year',$request->year]]);
                })->with('class')->get();
            }else if(isset($request->studentAge) && isset($request->parentAge)){
                $studentAge= self::subtracDate($request->studentAge);
                $parentAge= self::subtracDate($request->parentAge);
                $students = Student::with('class')->whereHas('parents', function ($query) use ($parentAge) {
                    $query->whereYear('dob','<=', $parentAge);
                })->whereYear('dob','<=',$studentAge)->get();
            }else{
                $students = Student::with('class')->get();
            }
         return response()->json(['success'=>true,'students'=>$students],200);
        } catch (QueryException $e) {
            return response()->json($e->getMessage(), 400);
        }  
    }

    static function subtracDate($age)
    {
        $date = date("Y");
        return $date - $age;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = User::find(Auth::id())->role->name;
        if($role == 'admin'){
            return view('pages.studentForm');
        }else{
            return view('pages.index');
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $role = User::find(Auth::id())->role->name;
       if($role == 'admin'){

       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'class' => 'required',
            'dob' => 'required',
            'city' => 'required|max:255',
        ]);
            $student = new Student;
            $student->name = $request->name;
            $student->class_id = $request->class;
            $student->dob = $request->dob;
            $student->city = $request->city;
            $student->save();
        return redirect()->route('student.show',$student->id);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::with('class','parents')->find($id);
        return view('pages.studentDetails',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    $role = User::find(Auth::id())->role->name;
        if($role == 'admin'){
            Student::where('id',$id)->delete();
            $students = Student::with('class')->get();
            return response()->json(['success'=>true,'students'=>$students],200);
        }else{
            return view('pages.index');
        }
    }
}
