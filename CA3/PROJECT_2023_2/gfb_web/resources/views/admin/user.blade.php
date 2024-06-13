<x-admin-component>
        <div class="main-content">
            <div class="row g-10">
                



            <div class="col-xl-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-body">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" style="background-color: #3498db">Add User</button>
                            {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenter999" style="background-color: #3498db">Add Mutiple User</button> --}}

                            <button type="button" class="btn btn-danger" onclick="fireSweetAlertdelete()" style="background-color: red">Delete User</button>
                        </div>
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterLabel">Add User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                                <form action="{{ route('admin.createuser') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <!-- Name -->
                                                    <div class="form-group mb-20">
                                                        <label class="form-label" for="name">Name</label>
                                                        <input class="form-control" type="text" name="name" required autocomplete="name" />   
                                                    </div>
                                                    <!-- Email Address -->
                                                    <div class="form-group mb-20">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input class="form-control" type="email" name="email" required autocomplete="username" />    
                                                    </div>
                                                    <!-- User Type -->
                                                    <div class="form-group mb-20">
                                                        <label class="form-label" for="usertype_id">User Type</label>
                                                        <select name="usertype_id" class="form-control" required>
                                                            <option>--select--</option>
                                                            @foreach($usertypes as $usertype)
                                                                <option value="{{ $usertype->id }}">{{ $usertype->type }}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                <div class="form-group mb-20">
                                                    <label class="form-label" for="role">User Role:</label>&nbsp;
                                                    <input  class="form-control" type="radio" name="role" value="user" {{ old('role') == 'user' ? 'checked' : '' }} required autocomplete="role">&nbsp;User&nbsp;
                                                    <input class="form-control" type="radio" name="role" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }} required autocomplete="role">&nbsp;Admin
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" style="background-color: #3498db; color:white">
                                                            Add
                                                        </button>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="modal fade" id="exampleModalCenter999" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterLabel">Add Mutiple User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                                <form action="{{ route('admin.createMultipleuser') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                   
                                                    <div class="form-group mb-20">
                                                        <label class="form-label" for="usertype_id">User Type</label>
                                                     
                                                           
                                                            @foreach($usertypes as $usertype)
                                                            @if($usertype->type !== 'admin')
                                                                <li>{{ $usertype->type }}</li>
                                                                @endif
                                                            @endforeach
                                                      
                                                    </div>
                                                    <div class="form-group mb-20">
                                                        <label class="form-label" for="usertype_id">Require Excel</label>
                                                        
                                                      
                                                    </div>
                                                <div class="form-group mb-20">
                                                    <label class="form-label" for="role">Upload Excel File</label>
                                                    <p>Name and Email</p>
                                                    <input type="file" name="excel_file">
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" style="background-color: #3498db; color:white">
                                                            Add
                                                        </button>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                </div>
                <div class="panel mb-10 mt-10">
                    <div class="col-xl-12 col-lg-12">
                        <div class="panel">
                            <div class="panel-body">
                                <input type="text" id="searchInput" placeholder="Search...">
                                <select name="usertype_filter" required>
                                    <option>All Usertype</option>
                                    @foreach($usertypes as $category)
                                        <option value="{{ $category->type }}">{{ $category->type }}</option>
                                    @endforeach
                                </select> 
                                <select name="role_filter"  required>
                                    <option>All Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                              
                                
                                
                                <table class="table table-striped table-hover" id="sportsTable">
                                    <thead>
                                    <tr>
                                        <th>
                                            <span class="custom-checkbox">
                                                <input type="checkbox" id="selectAll">
                                            </span>
                                        </th>
                                        <th>Sl_No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $serialNumber = 1;
                                    @endphp

                                    @foreach($users as $user)
                                    <tr data-role="{{ $user->role }}" data-usertype="{{ $user->usertypes->type }}">
                                        @if($user->role !== 'admin')
                                        <td>
                                            <span class="custom-checkbox">
                                                <input type="checkbox" id="{{$user->id}}" name="options[]" value="{{$user->id}}">
                                            </span>
                                        </td>
                                        @else
                                        <td>
                                           
                                        </td>
                                        @endif
                                        <td>{{ $serialNumber }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->usertypes->type }}</td>
                                        <td>{{ $user->role }}</td> 
                                        <td>
                                            @if($user->role !== 'admin')
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility{{ $user->id }}" style="background-color: #3498db">Edit</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacility{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Facility</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <!-- Name -->
                                                                        <div class="form-group mb-20">
                                                                            <label class="form-label" for="name">Name</label>
                                                                            <input class="form-control" type="text" name="name" value="{{$user->name}}" required autocomplete="name" />   
                                                                        </div>
                                                                        <!-- Email Address -->
                                                                        <div class="form-group mb-20">
                                                                            <label class="form-label" for="email">Email</label>
                                                                            <input class="form-control" type="email" name="email" value="{{$user->email}}" required autocomplete="username" />    
                                                                        </div>
                                                                        <!-- User Type -->
                                                                        <div class="form-group mb-20">
                                                                            <label class="form-label" for="usertype_id">User Type</label>
                                                                            <select name="usertype_id" class="form-control" required>
                                                                                <option>--select--</option>
                                                                                @foreach($usertypes as $usertype)
                                                                                    <option value="{{ $usertype->id }}" {{ $user->usertype_id == $usertype->id ? 'selected' : '' }}>{{ $usertype->type }}</option>
                                                                                @endforeach
                                                                            </select> 
                                                                        </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="role">User Role:</label>&nbsp;
                                                                        <input  class="form-control" type="radio" name="role" value="user" {{ $user->role == 'user' ? 'checked' : '' }} required autocomplete="role">&nbsp;User&nbsp;
                                                                        <input class="form-control" type="radio" name="role" value="admin" {{ $user->role == 'admin' ? 'checked' : '' }} required autocomplete="role">&nbsp;Admin
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success" style="background-color: #3498db; color:white">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility{{ $user->id }}" style="background-color: #3498db">Edit</button>
                                                <button type="button" class="btn btn-danger" onclick="fireSweetAlertdeleteadmin({{$user->id}})" style="background-color: red">Delete</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacility{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Facility</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <!-- Name -->
                                                                        <div class="form-group mb-20">
                                                                            <label class="form-label" for="name">Name</label>
                                                                            <input class="form-control" type="text" name="name" value="{{$user->name}}" required autocomplete="name" />   
                                                                        </div>
                                                                        <!-- Email Address -->
                                                                        <div class="form-group mb-20">
                                                                            <label class="form-label" for="email">Email</label>
                                                                            <input class="form-control" type="email" name="email" value="{{$user->email}}" required autocomplete="username" />    
                                                                        </div>
                                                                        <!-- User Type -->
                                                                        <div class="form-group mb-20">
                                                                            <label class="form-label" for="usertype_id">User Type</label>
                                                                            <select name="usertype_id" class="form-control" required>
                                                                                <option>--select--</option>
                                                                                @foreach($usertypes as $usertype)
                                                                                    <option value="{{ $usertype->id }}" {{ $user->usertype_id == $usertype->id ? 'selected' : '' }}>{{ $usertype->type }}</option>
                                                                                @endforeach
                                                                            </select> 
                                                                        </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="role">User Role:</label>&nbsp;
                                                                        <input  class="form-control" type="radio" name="role" value="user" {{ $user->role == 'user' ? 'checked' : '' }} required autocomplete="role">&nbsp;User&nbsp;
                                                                        <input class="form-control" type="radio" name="role" value="admin" {{ $user->role == 'admin' ? 'checked' : '' }} required autocomplete="role">&nbsp;Admin
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success" style="background-color: #3498db; color:white">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                        </td>   
                                    </tr>
                                        @php
                                            $serialNumber++;
                                        @endphp
                                    @endforeach           
                                    </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>       
        </div>

<!-- Add this script tag to your HTML file -->
<script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- filter==================================================================================
======================================================================================== --}}
<script>
    // Get reference to filter select elements
    const roleFilter = document.querySelector('select[name="role_filter"]');
    const userTypeFilter = document.querySelector('select[name="usertype_filter"]');
    const sportsTableRows = document.querySelectorAll('#sportsTable tbody tr');

    // Event listeners for changes in filter options
    roleFilter.addEventListener('change', filterTable);
    userTypeFilter.addEventListener('change', filterTable);

    // Function to filter table data based on selected filters
    function filterTable() {
        const selectedRole = roleFilter.value;
        const selectedUserType = userTypeFilter.value;

        sportsTableRows.forEach(row => {
            const roleValue = row.getAttribute('data-role');
            const userTypeValue = row.getAttribute('data-usertype');

            const roleMatch = selectedRole === 'All Role' || selectedRole === roleValue;
            const userTypeMatch = selectedUserType === 'All Usertype' || selectedUserType === userTypeValue;

            if (roleMatch && userTypeMatch) {
                row.style.display = ''; // Show the row if it matches the filters
            } else {
                row.style.display = 'none'; // Hide the row if it doesn't match
            }
        });
    }
</script>

{{-- search=================================================================================
======================================================================================== --}}

<script>
    // Get the input element
    const searchInput = document.getElementById('searchInput');
    
    // Add event listener for input changes
    searchInput.addEventListener('input', function() {
      const filter = searchInput.value.toLowerCase(); // Get user input and convert to lowercase
      
      // Get all table rows except the header row
      const rows = document.querySelectorAll('#sportsTable tbody tr');
      
      // Loop through each row and hide/show based on the filter
      rows.forEach(row => {
        const categoryName = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Adjust the nth-child value based on your table structure
        
        // Check if the category name contains the filter text
        if (categoryName.includes(filter)) {
          row.style.display = ''; // Show the row if it matches the filter
        } else {
          row.style.display = 'none'; // Hide the row if it doesn't match
        }
      });
    });
  </script>
{{-- checkbox===============================================================================
    ======================================================================================== --}}
    <script>
        $(document).ready(function () {
         $("#selectAll").change(function () {
           var visibleCheckboxes = $("#sportsTable").find("input[name='options[]']:visible");
           visibleCheckboxes.prop("checked", $(this).prop("checked"));
         });
       
         $("input[name='options[]']").change(function () {
           if (!$(this).prop("checked")) {
             $("#selectAll").prop("checked", false);
           }
         });
       });
       </script>

{{-- delete=======================================================================
============================================================================= --}}
<script>
    function fireSweetAlertdelete() {
       const selectedCategoryIds = [];
 
       // Use attribute selector to select checkboxes by id
       $('input[name="options[]"]:checked').each(function () {
          selectedCategoryIds.push($(this).val());
       });
       console.log('Selected Category IDs:', selectedCategoryIds);
 
       if (selectedCategoryIds.length === 0) {
          Swal.fire('Error!', 'Please select at least one category to delete', 'error');
          return;
       }
 
       Swal.fire({
          title: 'Are you sure?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#5cb85c',
          cancelButtonColor: '#d9534f',
          confirmButtonText: 'Yes, delete it!'
       }).then((result) => {
          if (result.isConfirmed) {
             console.log('Before Axios call');
             axios({
                method: 'delete',
                url: 'user/delete',
                data: { categoryIds: selectedCategoryIds }
             })
             .then((response) => {
                console.log('Axios success', response.data);
                
                setTimeout(() => {
                        location.reload();
                    }, 1500);
                Swal.fire({
                        icon: response.data.icon,
                        title: response.data.message,
                        text: response.data.message,
                        showConfirmButton: false
                    });   
             })
             .catch((error) => {
                console.log('Axios error', error);
                Swal.fire('Error!', error.response.data.message, 'error');
             });
             console.log('After Axios call');
          }
       });
    }
 </script>
 <script>
    function fireSweetAlertdeleteadmin(id) {
       Swal.fire({
          title: 'Are you sure?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#5cb85c',
          cancelButtonColor: '#d9534f',
          confirmButtonText: 'Yes, delete it!'
       }).then((result) => {
          if (result.isConfirmed) {
             console.log('Before Axios call');
             axios({
                method: 'delete',
                url: '/user/deleteadmin/'+id,
             })
             .then((response) => {
                console.log('Axios success', response.data);
                
                setTimeout(() => {
                        location.reload();
                    }, 1500);
                Swal.fire({
                        icon: response.data.icon,
                        title: response.data.message,
                        text: response.data.message,
                        showConfirmButton: false
                    });   
             })
             .catch((error) => {
                console.log('Axios error', error);
                Swal.fire('Error!', error.response.data.message, 'error');
             });
             console.log('After Axios call');
          }
       });
    }
 </script>
 <script>
    function fireSweetAlertdeleteadmin(id) {
    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('/admin/user/deleteadmin/' + id)
            .then((response) => {
                console.log('Axios success', response.data);
                
                setTimeout(() => {
                        location.reload();
                    }, 1500);
                Swal.fire({
                        icon: response.data.icon,
                        title: response.data.message,
                        text: response.data.message,
                        showConfirmButton: false
                    });   
             })
             .catch((error) => {
                console.log('Axios error', error);
                Swal.fire('Error!', error.response.data.message, 'error');
             });
             console.log('After Axios call');
        }
    });
}
 </script>

{{-- 
pop-up==============================================================
=================================================================== --}}
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            position: 'top',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
</x-admin-component>