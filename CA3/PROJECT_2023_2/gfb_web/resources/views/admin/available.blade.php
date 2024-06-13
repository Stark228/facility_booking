<x-admin-component>
    <!-- main sidebar -->
    <div class="main-content">
        <div class="row g-10">
            <div class="col-xl-12 col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" style="background-color: #3498db">Disable Facility</button>
                        <button type="button" class="btn btn-danger" onclick="fireSweetAlertdelete()" style="background-color: red" >Delete</button>                                   
                    </div>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterLabel">Add Category</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('subcategory.createavailability', ['subcategory' => $subcategory->id]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf <!-- Add CSRF token for security -->
                                            <input type="hidden" name="subcategory_id" value="{{ $subcategory->id }}">

                                            <div class="form-group mb-20">
                                                <label class="form-label" for="start_date">Start date</label>
                                                <input type="date" class="form-control" name="start_date" required/>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="end_date">End date</label>
                                                <input type="date" class="form-control" name="end_date" required/>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="start_time">Start time</label>
                                                <input type="time" class="form-control" name="start_time" required/>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="end_time">End time</label>
                                                <input type="time" class="form-control" name="end_time" required/>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="reason">Reason</label>
                                                <input type="text" class="form-control" name="reason" required/>
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
                                    <table class="table table-striped table-hover" id="sportsTable">
                                        <thead>
                                          <tr>
                                            <th>
                                                <span class="custom-checkbox">
                                                    <input type="checkbox" id="selectAll">
                                                </span>
                                            </th>
                                            <th>Sl.No</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <th>Reason</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $serialNumber = 1;
                                            @endphp
                                            @foreach($availabilities->where('subcategory_id', $subcategory->id) as $a)
                                          <tr>
                                            <td>
                                                <span class="custom-checkbox">
                                                    <input type="checkbox" id="{{ $a->id }}" name="options[]" value="{{ $a->id }}">
                                                </span>
                                            </td>
                                            <td>{{ $serialNumber }}</td>
                                            <td>{{ $a->start_date }}</td>
                                            <td>{{ $a->end_date }}</td>
                                            <td>{{ $a->start_time }}</td>
                                            <td>{{ $a->end_time }}</td>
                                            <td>{{ $a->reason }}</td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility{{ $a->id }}" style="background-color: #3498db">Edit</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacility{{ $a->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Facility</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('a.update', ['subcategory' => $subcategory->id, 'id' => $a->id]) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="subcategory_id" value="{{ $subcategory->id }}">

                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="start_date">Start date</label>
                                                                        <input type="date" class="form-control" name="start_date" value="{{$a->start_date}}" required/>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="end_date">End date</label>
                                                                        <input type="date" class="form-control" name="end_date" value="{{$a->end_date}}" required/>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="start_time">Start time</label>
                                                                        <input type="time" class="form-control" name="start_time" value="{{$a->start_time}}" required/>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="end_time">End time</label>
                                                                        <input type="time" class="form-control" name="end_time" value="{{$a->end_time}}" required/>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="reason">Reason</label>
                                                                        <input type="text" class="form-control" name="reason" value="{{$a->reason}}" required/>
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


{{-- checkbox===============================================================================
    ======================================================================================== --}}
<script>
  $(document).ready(function () {
    $("#selectAll").change(function () {
      $("input[name='options[]']").prop("checked", $(this).prop("checked"));
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
                url: 'adelete',
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