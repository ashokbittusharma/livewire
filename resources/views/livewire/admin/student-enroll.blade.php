<div>
  
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  
    @if($updateMode)
        @include('livewire.admin.update')
    @else
        @include('livewire.admin.create')
    @endif
    <hr>
    <div class="form-group">
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Search" wire:model="searchTerm" >
      </div> 
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subjects</th>
                <th>DOB</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($studentsInfo))
                @foreach($studentsInfo as $key => $student)
                <tr>
                    <td> {{$key + 1}}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->subjects }}</td>
                    <td>{{ date('d-m-Y', strtotime($student->dob)) }}</td>
                    <td>
                    <button wire:click="edit({{ $student->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $student->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                {{ $studentsInfo->links() }}
                @endforeach
            @else
               <tr>
                    <td colspan="6">No records found!</td>
                    
                </tr>
            @endif 
            
        </tbody>
    </table>
</div>