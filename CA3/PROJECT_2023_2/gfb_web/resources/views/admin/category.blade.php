<x-admin-component>
    <!-- main sidebar -->
    <div class="main-content">
        <div class="row g-10">
            <div class="col-xl-12 col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" style="background-color: #3498db">Add Category</button>
                        <button type="button" class="btn btn-danger" onclick="fireSweetAlertdelete()" style="background-color: red" >Delete</button>  
                    </div>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterLabel">Add Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.createfacility') }}" method="POST" enctype="multipart/form-data">
                                            @csrf <!-- Add CSRF token for security -->
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="category_name">Category Name</label>
                                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" required/>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="description">Description</label>
                                                <input type="text" class="form-control" id="description" name="description" placeholder="Description" required/>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="image">Category Image</label>
                                                <input type="file" class="form-control" id="image" name="image" required/>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" style="background-color: #3498db; color:white">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="panel mb-10 mt-10">
                        <div class="col-xl-12 col-lg-12">
                            <div class="panel">
                                <div class="panel-body">
                                    
                                        <input type="text" id="searchInput" placeholder="Search..." onkeyup="myFunction()">
                                    <table class="table table-striped table-hover" id="sportsTable">
                                        <thead>
                                          <tr>
                                            <th>
                                                <span class="custom-checkbox">
                                                    <input type="checkbox" id="selectAll">
                                                </span>
                                            </th>
                                            <th>Sl.No</th>
                                            <th>Category Image</th>
                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                          </tr>
                                        </thead>
                                        

                                        <tbody>
                                           
                                            @php
                                            $serialNumber = 1;
                                            @endphp
                                            @foreach($categories as $category)
                                          <tr>
                                            <td>
                                                <span class="custom-checkbox">
                                                    <input type="checkbox" id="{{ $category->id }}" name="options[]" value="{{ $category->id }}">
                                                </span>
                                            </td>
                                            <td>{{ $serialNumber }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . str_replace('public/', '', $category->image)) }}" alt="Facility Image" style="border-radius: 0"/>                                            
                                            </td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility1{{ $category->id }}">view</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacility1{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">Description</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                    <div class="form-group mb-20">
                                                                        <p>{{$category->description}}</p>
                                                                    </div>
                                             
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility{{ $category->id }}" style="background-color: #3498db">Edit</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacility{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Category</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="category_name">Category Name</label>
                                                                        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required/>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="description">Description</label>
                                                                        <input type="text" class="form-control" id="description" name="description" value="{{ $category->description }}" required/>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="image">Category Image</label>
                                                                        <input type="file" class="form-control" id="image" name="image"/>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success" style="background-color: #3498db; color:white">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                          </tr>
                                                @php
                                                    $serialNumber++;
                                                @endphp
                                          @endforeach
                                            </div>
                                        </tbody>
                                       
                                        </table>  
                            </div>    
                        </div>
                    </div>
            </div>
        </div>  
    </div>
</div>
<!-- Add this script tag to your HTML file -->
<script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        const categoryName = row.querySelector('td:nth-child(4)').textContent.toLowerCase(); // Adjust the nth-child value based on your table structure
        
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
                url: 'category/delete',
                data: { categoryIds: selectedCategoryIds }
             })
             .then((response) => {
                console.log('Axios success', response.data);
                
                setTimeout(() => {
                        location.reload();
                    }, 1500);
                Swal.fire({
                        icon: 'success',
                        title: 'Success!',
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

{{-- ================================================================================= --}}
{{-- pop-up --}}
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