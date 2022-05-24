<div class="col-md-12 text-center"> <h4>Add Student Info</h4> </div>
<div class="d-flex justify-content-center flex-nowrap">

<div class="col-md-8">
<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">First Name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter First Name" wire:model="first_name">
        @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Last Name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Enter Last Name" wire:model="last_name">
        @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">Email Address:</label>
        <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Enter Email Address" wire:model="email">
        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput4">Phone Number:</label>
        <input type="number" class="form-control" id="exampleFormControlInput4" placeholder="Enter Phone Number" wire:model="phone">
        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label>Subjects</label>
        <div wire:ignore>
            <select id="category-dropdown" class="form-control" multiple wire:model="subjects">
                @foreach($subjectList as $subject)
                    <option value="{{$subject}}">{{ $subject }}</option>
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
    <button wire:click.prevent="store()" class="btn btn-success">Save</button>
</form> 
</div>
</div>
<script>
        $(document).ready(function () {
            $('#category-dropdown').select2();
            $('#category-dropdown').on('change', function (e) {
                let data = $(this).val();
                 @this.set('subjects', data);
            });
            window.livewire.on('productStore', () => {
                $('#category-dropdown').select2();
            });
        });  
    </script>