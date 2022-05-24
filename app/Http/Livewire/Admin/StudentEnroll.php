<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\StudentEnrollment;

class StudentEnroll extends Component
{

    public $students, $first_name, $last_name, $email, $phone, $student_id;
    public $updateMode = false;

    public function render()
    {
        $this->studentsInfo = StudentEnrollment::all();
        return view('livewire.admin.student-enroll');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $validatedDate = $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
  
        StudentEnrollment::create($validatedDate);
  
        session()->flash('message', 'Student Enrolled Successfully.');
  
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $studentEnroll = StudentEnrollment::findOrFail($id);
        $this->student_id = $id;
        $this->first_name = $studentEnroll->first_name;
        $this->last_name = $studentEnroll->last_name;
        $this->email = $studentEnroll->email;
        $this->phone = $studentEnroll->phone;
  
        $this->updateMode = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update()
    {
        $validatedDate = $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
  
        $student = StudentEnrollment::find($this->student_id);
        $student->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Student Info Updated Successfully.');
        $this->resetInputFields();
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        StudentEnrollment::find($id)->delete();
        session()->flash('message', 'Student Info Deleted Successfully.');
    }
}
