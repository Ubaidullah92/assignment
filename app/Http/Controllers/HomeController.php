<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Student;
use DateTime;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function sendEmail($email){
        $students = Student::with('class','parents')->get();
        foreach($students as $student){
            
            $date_1 = new DateTime( $student->dob);
            $date_2 =new DateTime( date( 'Y-m-d' ) );
            $interval = $date_2->diff( $date_1 );
            $student['age'] = $interval->y;
        }   
        $data = [
            'email' => $email, 
            'students' => $students,
            'from' => 'u122195@gmail.com', 
            'from_name' => 'Assignment',
        ];
        Mail::send('pages.detail_mail', $data, function ($message) use ($data) {
            $message->to($data['email'])->from($data['from'], $data['from_name'])->subject('Student Details!');
        }); 
    }
}
