<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;


use DB; //keknya db juga udah bisa si


class StudentRegController extends Controller
{
	public function StudentRegView()
	{
		$data['years'] = StudentYear::all();
		$data['classes'] = StudentClass::all();
	
		$data['year_id'] = StudentYear::orderBy('id', 'desc')->value('id');
		$data['class_id'] = StudentClass::orderBy('id', 'desc')->value('id');
	
		// Mengambil data Student beserta relasinya
		$data['allData'] = Student::with(['studentYear', 'studentClass', 'student'])
			->where('year_id', $data['year_id'])
			->where('class_id', $data['class_id'])
			->get();
	
		return view('backend.student.student_reg.student_view', $data);
	}
	

    public function StudentClassYearWise(Request $request)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;

        $data['allData'] = Student::where('year_id', $request->year_id)
            ->where('class_id', $request->class_id)
            ->get();

        return view('backend.student.student_reg.student_view', $data);
    }
	public function StudentRegAdd()
{
    $data['years'] = StudentYear::all();
    $data['classes'] = StudentClass::all();
    
    return view('backend.student.student_reg.student_add', $data);
}


    public function StudentRegStore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first();

            if ($student == null) {
                $firstReg = 0;
                $studentId = $firstReg + 1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            } else {
                $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student + 1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            }

            $final_id_no = $checkYear . $id_no;
            $user = new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Student';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            $user->save();

            // Simpan ke tabel students
            $student = new Student();
            $student->user_id = $user->id;
            $student->year_id = $request->year_id;
            $student->class_id = $request->class_id;

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $student->image = $filename;
            }

            $student->save();
        });

        $notification = array(
            'message' => 'Student Registration Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

	public function StudentRegEdit($student_id)
	{
		$data['years'] = StudentYear::all();
		$data['classes'] = StudentClass::all();
	
		// Ambil data student berdasarkan user_id atau student_id
		$data['editData'] = Student::with('student')
			->where('user_id', $student_id)
			->first(); // Mengambil data siswa
	
		return view('backend.student.student_reg.student_edit', $data);
	}
	
	


	public function StudentRegUpdate(Request $request, $student_id)
	{
		DB::transaction(function () use ($request, $student_id) {
			// Update data di tabel users
			$user = User::where('id', $student_id)->first();
			$user->name = $request->name;
			$user->fname = $request->fname;
			$user->mname = $request->mname;
			$user->mobile = $request->mobile;
			$user->address = $request->address;
			$user->gender = $request->gender;
			$user->religion = $request->religion;
			$user->dob = date('Y-m-d', strtotime($request->dob));
	
			// Simpan user tanpa menyimpan gambar di tabel users
			$user->save();
	
			// Update data di tabel students
			$student = Student::where('id', $request->id)->where('user_id', $student_id)->first();
			$student->year_id = $request->year_id;
			$student->class_id = $request->class_id;
	
			if ($request->file('image')) {
				$file = $request->file('image');
				
				// Hapus gambar lama di tabel students
				@unlink(public_path('upload/student_images/' . $student->image));
	
				$filename = date('YmdHi') . $file->getClientOriginalName();
				$file->move(public_path('upload/student_images'), $filename);
				
				// Simpan gambar baru di tabel students
				$student->image = $filename;
			}
	
			$student->save();
		});
	
		$notification = array(
			'message' => 'Student Registration Updated Successfully',
			'alert-type' => 'success'
		);
	
		return redirect()->route('student.registration.view')->with($notification);
	}
	

    public function StudentRegDelete($student_id)
    {
        $student = Student::where('user_id', $student_id)->first();
        if ($student) {
            $student->delete();
        }

        $user = User::find($student_id);
        if ($user) {
            if (!empty($user->image)) {
                @unlink(public_path('upload/student_images/' . $user->image));
            }
            $user->delete();
        }

        $notification = array(
            'message' => 'Student Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }
}
