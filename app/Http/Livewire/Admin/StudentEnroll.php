<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\StudentEnrollment;
use Livewire\WithPagination;

class StudentEnroll extends Component
{
    use WithPagination;
    public $students, $first_name, $last_name, $email, $phone, $subjects =[], $dob, $student_id;
    public $updateMode = false;
    public $subjectList = [
        'Math',
        'English',
        'Science',
        'Economics',
        'Physics',
        'Chemistry'
    ];
    protected $listeners = [
        'selectedSubjectItem',
    ];
    
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.admin.student-enroll', [
            'studentsInfo' => StudentEnrollment::where('first_name','like', $searchTerm)->paginate(5)
        ])->layout('layouts.admin.base');
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
        $this->subjects = '';
        $this->dob = '';
        $this->emit('productStore');
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
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'subjects' => 'required',
            'dob' => 'required',
        ]);
        $inputData = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subjects' => json_encode($this->subjects),
            'dob' => $this->dob,
        ];
        StudentEnrollment::create($inputData);
  
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
        $this->subjects = json_decode($studentEnroll->subjects);
        $this->dob = $studentEnroll->dob;
  
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
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'subjects' => 'required',
            'dob' => 'required',
        ]);
  
        $student = StudentEnrollment::find($this->student_id);
        $student->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subjects' => $this->subjects,
            'dob' => $this->dob,
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
        $this->resetInputFields();
        $this->updateMode = false;
        session()->flash('message', 'Student Info Deleted Successfully.');
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function selectedSubjectItem($item)
    {
        if ($item) {
            $this->emit('selectedSubject', $item);
        }
        else
            $this->subjects = null;
    }

}
