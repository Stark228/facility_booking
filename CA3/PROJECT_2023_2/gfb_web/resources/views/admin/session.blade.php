<x-admin-component>
    <div class="main-content">
        <div class="row g-10">
            <div class="col-xl-12 col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createsession" style="background-color: #3498db">Add Session</button>
                        <button type="button" class="btn btn-danger" onclick="fireSweetAlertdelete()" style="background-color: red" >Delete</button>                                   
                    </div>
                    <div class="modal fade" id="createsession" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterLabel">Add Session</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.createsession') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-20">
                                            <label class="form-label" for="start_date">Start_date</label>
                                            <input type="date" id="start_date" class="form-control" name="start_date" required/>
                                        </div>
                                        <div class="form-group mb-20">
                                            <label class="form-label" for="end_date">End_date</label>
                                            <input type="date" id="end_date" class="form-control" name="end_date" required/>
                                        </div>
                                        <div class="form-group mb-20">
                                            <label class="form-label" for="start_time">start_time</label>
                                            <select class="form-control"id="start_time" name="start_time">
                                                <option>Select</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-20">
                                            <label class="form-label" for="end_time">end_time</label>
                                            <select class="form-control"id="end_time" name="end_time">
                                                <option>Select</option>
                                            </select>                                        
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" style="background-color: #3498db; color: white">Save</button>
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
                                    <th>Start Time</th>
                                    <th>Ent Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serialNumber = 1;
                                    @endphp
                                    @foreach($subcategorysessions as $sb)
                                    <tr>
                                        <td>
                                            <span class="custom-checkbox">
                                                    <input type="checkbox" id="{{$sb->id}}" name="options[]" value="{{$sb->id}}">
                                            </span>
                                        </td>
                                        <td>{{ $serialNumber }}</td>
                                        <td>{{ $sb->start_date }}</td>
                                        <td>{{ $sb->end_date }}</td>
                                        <td>{{ $sb->start_time }}</td>
                                        <td>{{ $sb->end_time }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility{{ $sb->id }}" style="background-color: #3498db">Edit</button>
                                            <div class="modal fade" id="exampleModalCenterEditFacility{{ $sb->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterLabel">Edit Session</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('session.update', $sb->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="start_date">Start_date</label>
                                                                    <input type="date" id="start_date_{{$sb->id}}" class="form-control" name="start_date" value="{{$sb->start_date}}" required/>
                                                                </div>
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="end_date">End_date</label>
                                                                    <input type="date" id="end_date_{{$sb->id}}" class="form-control" name="end_date" value="{{$sb->end_date}}" required/>
                                                                </div>
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="start_time">start_time</label>
                                                                    <select class="form-control" id="start_time_{{$sb->id}}" name="start_time">
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="end_time">end_time</label>
                                                                    <select class="form-control" id="end_time_{{$sb->id}}" name="end_time">
                                                                    </select>                                        
                                                                </div>
                                                                
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success" style="background-color: #3498db; color: white">Save</button>
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

<!-- Add this script tag to your HTML file -->
<script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Function to populate time dropdown options
function populateTimeDropdown(selectElement, startTime, endTime) {
    selectElement.innerHTML = ''; // Clear previous options
    let currentTime = new Date("2000-01-01 " + startTime); // Set base date for time comparison
    const endTimeObj = new Date("2000-01-01 " + endTime); // End time as Date object

    // Loop to generate options with 15-minute intervals
    while (currentTime <= endTimeObj) {
        const option = document.createElement('option');
        option.text = currentTime.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });
        option.value = currentTime.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });
        selectElement.add(option);
        currentTime.setMinutes(currentTime.getMinutes() + 15); // Increment time by 15 minutes
    }
}

// Get the select elements
const startTimeSelect = document.getElementById('start_time');
const endTimeSelect = document.getElementById('end_time');

// Initial population of dropdowns with default values
populateTimeDropdown(startTimeSelect, '00:00:00', '23:45:00');
populateTimeDropdown(endTimeSelect, '00:00:00', '23:45:00');

// Event listeners for changing default dropdown options
startTimeSelect.addEventListener('change', function () {
    populateTimeDropdown(endTimeSelect, this.value, '23:45:00');
});

// endTimeSelect.addEventListener('change', function () {
//     populateTimeDropdown(startTimeSelect, '00:00:00', this.value);
// });
</script>

{{-- edit time===================================================================================================
======================================================================================================= --}}
<script>
    function populateTimeDropdown(selectElement, startTime, endTime) {
        selectElement.innerHTML = ''; // Clear previous options
        let currentTime = new Date("2000-01-01 " + startTime);
        const endTimeObj = new Date("2000-01-01 " + endTime);
    
        while (currentTime <= endTimeObj) {
            const option = document.createElement('option');
            option.text = currentTime.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });
            option.value = currentTime.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });
            selectElement.add(option);
            currentTime.setMinutes(currentTime.getMinutes() + 15);
        }
    }
    
    @foreach ($subcategorysessions as $sb)
        const startTimeSelect_{{$sb->id}} = document.getElementById('start_time_{{$sb->id}}');
        const endTimeSelect_{{$sb->id}} = document.getElementById('end_time_{{$sb->id}}');
        
        populateTimeDropdown(startTimeSelect_{{$sb->id}}, '00:00:00', '23:45:00');
        populateTimeDropdown(endTimeSelect_{{$sb->id}}, '00:00:00', '23:45:00');
        
        startTimeSelect_{{$sb->id}}.addEventListener('change', function () {
            populateTimeDropdown(endTimeSelect_{{$sb->id}}, this.value, '23:45:00');
        });
        
        // endTimeSelect_{{$sb->id}}.addEventListener('change', function () {
        //     populateTimeDropdown(startTimeSelect_{{$sb->id}}, '00:00:00', this.value);
        // });
    @endforeach
</script>


{{-- date=========================================================================================
============================================================================================= --}}
<script>
    // Function to get the current date in Bhutan's time zone (UTC+6)
    function getCurrentDateInBhutan() {
        const currentDate = new Date();
        currentDate.setUTCHours(currentDate.getUTCHours() + 6);
        return currentDate.toISOString().split('T')[0];
    }

    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    startDateInput.min = getCurrentDateInBhutan();
    endDateInput.min = getCurrentDateInBhutan();

    // Update end_date dynamically when start_date changes
    startDateInput.addEventListener('input', function() {
        endDateInput.min = this.value;

        // Ensure end_date is not before start_date
        if (endDateInput.value < this.value) {
            endDateInput.value = this.value;
        }
        endDateInput.min = this.value;
    });

    // Update start_date dynamically when end_date changes
    endDateInput.addEventListener('input', function() {
        startDateInput.max = this.value;
    });
</script>

{{-- edit date=========================================================================
=============================================================================== --}}
<script>
    // Function to set date constraints dynamically
    function setDynamicDateConstraints(id) {
        // Function to get the current date in Bhutan's time zone (UTC+6)
        function getCurrentDateInBhutan() {
            const currentDate = new Date();
            currentDate.setUTCHours(currentDate.getUTCHours() + 6);
            return currentDate.toISOString().split('T')[0];
        }

        const startDateInput = document.getElementById('start_date_' + id);
        const endDateInput = document.getElementById('end_date_' + id);

        startDateInput.min = getCurrentDateInBhutan();
        endDateInput.min = getCurrentDateInBhutan();

        // Update end_date dynamically when start_date changes
        startDateInput.addEventListener('input', function() {
            endDateInput.min = this.value;

            // Ensure end_date is not before start_date
            if (endDateInput.value < this.value) {
                endDateInput.value = this.value;
            }
            endDateInput.min = this.value;
        });

        // Update start_date dynamically when end_date changes
        endDateInput.addEventListener('input', function() {
            startDateInput.max = this.value;
        });
    }

    // Call the function for each item in the loop
    @foreach($subcategorysessions as $sb)
        setDynamicDateConstraints('{{$sb->id}}');
    @endforeach
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
                url: 'session/delete',
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