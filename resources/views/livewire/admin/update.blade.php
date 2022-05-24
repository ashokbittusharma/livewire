<div class="col-md-12 text-center"> <h4>Update Student Info</h4> </div>
<div class="d-flex justify-content-center flex-nowrap">

<div class="col-md-8">
    <form>
    <input type="hidden" wire:model="student_id">
    <div class="form-group">
        <label for="exampleFormControlInput1">First Name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter First Name" wire:model="first_name">
        @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Last Name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Last Name" wire:model="last_name">
        @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Email Address:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Email Address" wire:model="email">
        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Phone Number:</label>
        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter Phone Number" wire:model="phone">
        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label>Subjects</label>
        <div wire:ignore>
            <select id="category-dropdown" class="form-control" multiple wire:model="subjects">
                @foreach($subjectList as $subject)
                    <option value="{{$subject}}" selected="selected">{{ $subject }}</option>
                @endforeach
            </select>
            @error('subjects') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    
    <div class="form-group">
        <label for="exampleFormControlInput6">Date Of Birthday:</label>
        <input type="date" class="form-control" id="exampleFormControlInput6" placeholder="Date Of Birthday" wire:model="dob">
        @error('dob') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
</form>
</div>
</div>
<script>


        $(document).ready(function() {
            window.initSelectSubjectDrop=()=>{
                $('#category-dropdown').select2({
                    placeholder: 'Select a Subject',
                    allowClear: true});
            }
            initSelectSubjectDrop();
            $('#category-dropdown').on('change', function (e) {
                livewire.emit('selectedCompanyItem', e.target.value)
            });
            window.livewire.on('select2',()=>{
                initSelectSubjectDrop();
            });
        });  
    </script>