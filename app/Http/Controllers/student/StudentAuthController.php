<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Google\Client;
use Google_Client;
use Google_Service;
use Google_Service_Sheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentAuthController extends Controller
{
    public function login() {
        if (!Auth::guard('student')->check()) {
            return view('auth.student-login');
        }
        return view('students.home');
    }

    public function register() {
        return view('auth.student-register');
    }


    public function authenticate(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if ($validated->fails()) {
            return back()->withErrors($validated)->withInput();
        }

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            return redirect()->intended('student/student-home');
        }


        return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput();
    }

    public function verify() {
        return view('auth.student-verification');
    }


    public function verification(Request $request)
    {


        $validated = $request->validate([
            'student_number' => 'required'
        ]);

        $studentNumber = $validated['student_number'];

        $credentialsPath = storage_path('app/google/credentials.json');
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$credentialsPath");


        $client = new Google_Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/spreadsheets.readonly');


        $service = new Google_Service_Sheets($client);


        $spreadsheetId = '1IIJZI0bNvlW2apmXvrksdVNocxSqiToSpOndxL6RC5o';
        $range = 'Students!E6:M683';

        try {

            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();



            if (empty($values)) {
                return response()->json(['message' => 'No data found.']);
            }


            $found = false;
            foreach ($values as $row) {
                if ($row[0] == $studentNumber) {
                    $found = true;
                    $fullName = trim($row[2] . ' ' . $row[3] . ' ' . $row[1]);
                    $gmail = $row[4] ?? null;
                    break;
                }
            }


            if (!$found) {
                return redirect()->back()->with('error', 'Student Number Not Found');
            }

            return redirect()->route('register', compact('fullName', 'gmail'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Google Sheets: ' . $e->getMessage()]);
        }
    }


    public function store(Request $request)
    {

        if (Student::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'The email address is already registered.'])->withInput();
        }


        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'year' => ['required', 'integer'],
            'section' => ['required', 'string'],
        ]);


        dd($request->all());

        try {
            $student = Student::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'year' => $validated['year'],
                'section' => $validated['section'],
            ]);


            Auth::guard('student')->login($student);


            return redirect()->route('student.home')->with('success', 'Registration successful! Welcome, ' . $student->name . '.');

        } catch (\Exception $e) {

            return view('auth.student-register')->with(['error' => 'An error occurred during registration. Please try again.']);
        }
    }


    public function logout() {
        Auth::guard('student')->logout();
        return redirect()->route('login');
    }

    public function useGoogleClient()
    {
        $credentialsPath = storage_path('app/google/credentials.json');
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$credentialsPath");


        $client = new Google_Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/spreadsheets.readonly');


        $service = new Google_Service_Sheets($client);


        $spreadsheetId = '1IIJZI0bNvlW2apmXvrksdVNocxSqiToSpOndxL6RC5o';
        $range = 'Students!E6:M683';

        try {

            $response = $service->spreadsheets_values->get($spreadsheetId, $range);


            $values = $response->getValues();

            if (empty($values)) {
                return response()->json(['message' => 'No data found.']);
            } else {
                return view('Student_list', ['data' => $values]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Google Sheets: ' . $e->getMessage()]);
        }
    }

    public function studentList() {
        return view('Student_list');
    }
}
