<x-admin-component>
        <!-- main sidebar -->
        <div class="main-content">
            <div class="row g-10">
                <div class="col-xl-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-body">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterFacility" style="background-color: #3498db">Add Facility</button>
                            <button type="button" class="btn btn-danger" onclick="fireSweetAlertdelete()" style="background-color: red" >Delete</button>                                   
                        </div>
                    
                
                        <div class="modal fade" id="exampleModalCenterFacility" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterLabel">Add Facility</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.createsubfacility') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="facility_name">Facility Name</label>
                                                <input type="text" class="form-control" id="facility_name" name="facility_name" placeholder="Facility Name" required/>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label">Category</label>
                                                <select name="category_id" class="form-control" required>
                                                    <option>--select--</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>    
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="resource">Resources</label>
                                                <input type="text" class="form-control" id="resource" name="resource" placeholder="Resources" required/>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label">Session</label>
                                                <select name="subcategorysession_id" class="form-control" id="subcategorysessionSelect" required>
                                                    <option value="">Select</option>
                                                    @foreach($subcategorysessions as $scs)
                                                        <option value="{{ $scs->id }}" data-start="{{ $scs->start_time }}" data-end="{{ $scs->end_time }}">
                                                            {{ $scs->start_date}} to {{ $scs->end_date}}<br/>
                                                            {{ $scs->start_time}} to {{ $scs->end_time}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label">Time Slot</label>
                                                <select class="form-control" id="timedropdown" name="slot">                                                    
                                                </select>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="method">Booking Method</label>&nbsp;
                                                <input  class="form-control" type="radio" name="method" value="auto" {{ old('method') == 'auto' ? 'checked' : '' }} required />&nbsp;Auto&nbsp;
                                                <input class="form-control" type="radio" name="method" value="matual" {{ old('method') == 'mutual' ? 'checked' : '' }} required />&nbsp;Manual
                                            </div>
                                            <div class="form-group mb-20">
                                                <label class="form-label" for="image">Facility Image</label>
                                                <input type="file" class="form-control" id="image" name="image">
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
                                
                             <input type="text" id="searchInput" placeholder='Search...'> 
                            
                            <select name="category_filter" required>
                                <option>All Category</option>
                                @foreach($categories as $scs)
                                    <option value="{{ $scs->category_name }}">{{ $scs->category_name}}</option>
                                @endforeach
                            </select>
                            
                            <select name="method_filter" required>
                                <option>All Method</option>
                                <option value="auto">auto</option>
                                <option value="matual">manual</option>
                            </select>
                            
                            <select name="session_filter" style="width: 130px" required>
                                <option>All Session</option>
                                @foreach($subcategorysessions as $scs)
                                    <option value="{{ $scs->id }}">
                                        {{$scs->start_date}}-{{$scs->end_date}}
                                        {{$scs->start_time}}-{{$scs->end_time}}
                                    </option>
                                @endforeach
                            </select>
                            <table class="table table-striped table-hover" id="sportsTable">
                                <thead>
                                  <tr>
                                    <th>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="selectAll">
                                        </span>
                                    </th>
                                    <th>Sl.No</th>
                                    <th>Facility Image</th>
                                    <th>Facility Name</th>
                                    <th>Detail</th>
                                    <th>Disable</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $serialNumber = 1;
                                    @endphp
                                    @foreach($subcategories as $subcategory)

                                  <tr data-category="{{ $subcategory->category->category_name }}" data-method="{{ $subcategory->method }}" data-session="{{ $subcategory->subcategorysession_id }}">
                                    <td>
                                        <span class="custom-checkbox">
                                                <input type="checkbox" id="{{$subcategory->id}}" name="options[]" value="{{$subcategory->id}}">
                                        </span>
                                      </td>
                                    <td>{{ $serialNumber }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $subcategory->image)) }}" alt="Facility Image" style="border-radius: 0"/>                                            
                                    </td>
                                    <td>{{ $subcategory->facility_name }}</td>
                                    <td>
                                        <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility1{{ $subcategory->id }}" >view</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacility1{{ $subcategory->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">Detail</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>

                                                            </div>
                                                            <div class="modal-body">  
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="facility_name">Category</label>
                                                                    <p>{{$subcategory->category->category_name}}</p>
                                                                </div> 
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="facility_name">Time Slot</label>
                                                                    <p>{{$subcategory->slot}}</p>
                                                                </div> 
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="facility_name">Method</label>
                                                                    <p>{{$subcategory->method}}</p>
                                                                </div> 
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="facility_name">Status</label>
                                                                    <p>{{$subcategory->ed}}</p>
                                                                </div> 
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="facility_name">Session</label>
                                                                    <p>
                                                                        @if(!empty($subcategory->subcategorysession))
                                                                            {{ $subcategory->subcategorysession->start_date ?? '' }} - {{ $subcategory->subcategorysession->end_date ?? '' }}
                                                                            {{ $subcategory->subcategorysession->start_time ?? '' }} - {{ $subcategory->subcategorysession->end_time ?? '' }}
                                                                        @else
                                                                            <!-- Handle case where $subcategory->subcategorysession is null -->
                                                                            <!-- You can display a default message or handle it according to your requirements -->
                                                                            No session available
                                                                        @endif
                                                                    </p>
                                                                </div>   
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label" for="facility_name">Resource</label>
                                                                    <p>{{$subcategory->resource}}</p>
                                                                </div> 
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            @if($subcategory->ed === 'enable')
                                            <span class="slider1 round" onclick="fireSweetAlerted({{$subcategory->id}})"></span>
                                            @else
                                            <span class="slider round" onclick="fireSweetAlerted({{$subcategory->id}})"></span>
                                            @endif
                                        </label>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility{{ $subcategory->id }}" style="background-color: #3498db">Edit</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacility{{ $subcategory->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Facility</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('facility.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="facility_name">Facility Name</label>
                                                                        <input type="text" class="form-control" id="facility_name" name="facility_name" value="{{$subcategory->facility_name}}" placeholder="Facility Name" required/>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label">Category</label>
                                                                        <select name="category_id" class="form-control" required>
                                                                            <option >--select--</option>
                                                                            @foreach($categories as $category)
                                                                                <option value="{{ $category->id }}"{{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                                            @endforeach
                                                                        </select>    
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="resource">Resources</label>
                                                                        <input type="text" class="form-control" id="resource" name="resource" value="{{$subcategory->resource}}" placeholder="Resources" required/>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label">Session</label>
                                                                        <select name="subcategorysession_id" class="form-control subcategorysessionSelect_{{$subcategory->id}}" required>
                                                                            <option>--select--</option>
                                                                            @foreach($subcategorysessions as $scs)
                                                                                <option value="{{ $scs->id }} "{{ $subcategory->subcategorysession_id == $scs->id ? 'selected' : '' }} data-start="{{ $scs->start_time }}" data-end="{{ $scs->end_time }}">
                                                                                    {{ $scs->start_date}} to {{ $scs->end_date}}<br/>
                                                                                    {{ $scs->start_time}} to {{ $scs->end_time}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label">Time Slot</label>
                                                                        <select class="form-control timedropdown_{{$subcategory->id}}" id="timedropdown{{$subcategory->id}}" name="slot">                                                    
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="method">Booking Method</label>
                                                                        <input class="form-control" type="radio" name="method" value="auto" {{ $subcategory->method == 'auto' ? 'checked' : '' }} required />&nbsp;Auto&nbsp;
                                                                        <input class="form-control" type="radio" name="method" value="matual" {{ $subcategory->method == 'matual' ? 'checked' : '' }} required />&nbsp;Manual
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="image">Facility Image</label>
                                                                        <input type="file" class="form-control" id="image" name="image">
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
    </div>

    <style>
        .switch {
          position: relative;
          display: inline-block;
          width: 50px;
          height: 25px;
        }
        
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        .slider:before {
          position: absolute;
          content: "";
          height: 18px;
          width: 20px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }
        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }
        
        .slider.round:before {
          border-radius: 50%;
        }
        .slider1 {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #2196F3;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        .slider1:before {
          position: absolute;
          content: "";
          height: 18px;
          width: 20px;
          left: 26px;
          bottom: 4px;
          background-color: #fff;
          -webkit-transition: .4s;
          transition: .4s;
         
        }
        /* Rounded sliders */
        .slider1.round {
          border-radius: 34px;
        }
        
        .slider1.round:before {
          border-radius: 50%;
        }
        </style>


<!-- Add this script tag to your HTML file -->
<script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function fireSweetAlerted(id) {
    const selectedCategoryIds = id;
console.log('id',selectedCategoryIds)
    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.put(`facilities/toggleStatus/${selectedCategoryIds}`)
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
        }
    });
}
</script>
{{-- time-==================================================================================
===================================================================================== --}}
{{-- <script>
 function populateTimeDropdown(selectElement) {
    selectElement.innerHTML = '<option value="">select</option>';

    let currentTime = new Date('2000-01-01T00:00:00');
    const endTime = new Date('2000-01-01T23:45:00');

    while (currentTime <= endTime) {
        const option = document.createElement('option');
        option.text = currentTime.toTimeString().substring(0, 5); // Extract HH:mm from the time string
        option.value = currentTime.toTimeString().substring(0, 5);
        selectElement.add(option);
        currentTime.setMinutes(currentTime.getMinutes() + 15);
    }
}

// Usage example - get the select element by its ID
const timeDropdown = document.getElementById('timedropdown');

// Call the function to populate the dropdown
populateTimeDropdown(timeDropdown);
</script> --}}
<script>
    document.getElementById('subcategorysessionSelect').addEventListener('change', function() {
    var selectedSession = this.options[this.selectedIndex];
    var startTime = selectedSession.getAttribute('data-start');
    var endTime = selectedSession.getAttribute('data-end');

    function timeToMinutes(timeString) {
        var timeParts = timeString.split(':');
        var hours = parseInt(timeParts[0], 10);
        var minutes = parseInt(timeParts[1], 10);
        if (hours === 24) {
            hours = 0;
        }
        return hours * 60 + minutes;
    }

    var startMinutes = timeToMinutes(startTime);
    var endMinutes = timeToMinutes(endTime);
    var timeDifference = endMinutes - startMinutes;

    function minutesToTime(minutes) {
        var hours = Math.floor(minutes / 60);
        var remainingMinutes = minutes % 60;
        var remainingSeconds = (minutes % 1) * 60;
        var hoursString = String(hours).padStart(2, '0');
        var minutesString = String(remainingMinutes).padStart(2, '0');
        return hoursString + ':' + minutesString;
    }

    var timeDifferenceFormatted = minutesToTime(timeDifference);

    var timedropdown = document.getElementById('timedropdown');
    timedropdown.innerHTML = '';

    var endTimee = new Date('1970-01-01 ' + timeDifferenceFormatted);
    console.log('endTimee',endTimee);

    var currentTime = new Date('1970-01-01 00:15:00');
    while (currentTime <= endTimee) {
        var hours = ('0' + currentTime.getHours()).slice(-2);
        var minutes = ('0' + currentTime.getMinutes()).slice(-2);
        var timeString = hours + ':' + minutes;

        var option = document.createElement('option');
        option.text = timeString;
        option.value = timeString;
        timedropdown.appendChild(option);

        currentTime.setMinutes(currentTime.getMinutes() + 15);
    }
    
    // Select the first option by default
    timedropdown.selectedIndex = 0;
});

</script>
{{-- <script>
    function populateTimeDropdown(selectElement) {
       selectElement.innerHTML = '<option value="">select</option>';
   
       let currentTime = new Date('2000-01-01T00:00:00');
       const endTime = new Date('2000-01-01T23:45:00');

       while (currentTime <= endTime) {
           const option = document.createElement('option');
           option.text = currentTime.toTimeString().substring(0, 5); // Extract HH:mm from the time string
           option.value = currentTime.toTimeString().substring(0, 5);
           selectElement.add(option);
           currentTime.setMinutes(currentTime.getMinutes() + 15);
       }
   }
   
   // Usage example - get the select element by its ID
   const timeDropdown = document.getElementById('timedropdown');
   
   // Call the function to populate the dropdown
   populateTimeDropdown(timeDropdown);
   </script> --}}
   @foreach($subcategories as $subcategory)
   <script>
    document.querySelector('.subcategorysessionSelect_{{$subcategory->id}}').addEventListener('change', function() {
    var selectedSession = this.options[this.selectedIndex];
    var startTime = selectedSession.getAttribute('data-start');
    var endTime = selectedSession.getAttribute('data-end');

    function timeToMinutes(timeString) {
        var timeParts = timeString.split(':');
        var hours = parseInt(timeParts[0], 10);
        var minutes = parseInt(timeParts[1], 10);
        if (hours === 24) {
            hours = 0;
        }
        return hours * 60 + minutes;
    }

    var startMinutes = timeToMinutes(startTime);
    var endMinutes = timeToMinutes(endTime);
    var timeDifference = endMinutes - startMinutes;

    function minutesToTime(minutes) {
        var hours = Math.floor(minutes / 60);
        var remainingMinutes = minutes % 60;
        var remainingSeconds = (minutes % 1) * 60;
        var hoursString = String(hours).padStart(2, '0');
        var minutesString = String(remainingMinutes).padStart(2, '0');
        return hoursString + ':' + minutesString;
    }

    var timeDifferenceFormatted = minutesToTime(timeDifference);

    var timedropdown = document.querySelector('.timedropdown_{{$subcategory->id}}');
    timedropdown.innerHTML = '';

    var endTimee = new Date('1970-01-01 ' + timeDifferenceFormatted);
    console.log('endTimee',endTimee);

    var currentTime = new Date('1970-01-01 00:15:00');
    while (currentTime <= endTimee) {
        var hours = ('0' + currentTime.getHours()).slice(-2);
        var minutes = ('0' + currentTime.getMinutes()).slice(-2);
        var timeString = hours + ':' + minutes;

        var option = document.createElement('option');
        option.text = timeString;
        option.value = timeString;
        timedropdown.appendChild(option);

        currentTime.setMinutes(currentTime.getMinutes() + 15);
    }
    
    // Select the first option by default
    timedropdown.selectedIndex = 0;
});

</script>
   {{-- <script>
       document.querySelector('.subcategorysessionSelect_{{$subcategory->id}}').addEventListener('change', function() {
           var selectedSession = this.options[this.selectedIndex];
           var startTime = selectedSession.getAttribute('data-start');
           var endTime = selectedSession.getAttribute('data-end');

           // Clear previous options
           document.querySelector('.timedropdown_{{$subcategory->id}}').innerHTML = '';

           // Calculate time slots
           var startTimeObj = new Date('1970-01-01 ' + startTime);
           var endTimeObj = new Date('1970-01-01 ' + endTime);
           var timeDifference = (endTimeObj - startTimeObj) / (1000 * 60); // in minutes

           // Generate time options
           var currentTime = startTimeObj;
           var dropdown = document.querySelector('.timedropdown_{{$subcategory->id}}');
           while (currentTime <= endTimeObj) {
               var hours = ('0' + currentTime.getHours()).slice(-2);
               var minutes = ('0' + currentTime.getMinutes()).slice(-2);
               var timeString = hours + ':' + minutes;
               
               var option = document.createElement('option');
               option.text = timeString;
               option.value = timeString;
               dropdown.appendChild(option);

               // Increment by 15 minutes for the next interval
               currentTime.setMinutes(currentTime.getMinutes() + 15);
           }
       });
   </script> --}}
@endforeach
{{-- <script>
    function populateTimeDropdown(selectElement) {
        selectElement.innerHTML = '<option value="">select</option>';
    
        let currentTime = new Date('2000-01-01T00:00:00');
        const endTime = new Date('2000-01-01T23:45:00');
    
        while (currentTime <= endTime) {
            const option = document.createElement('option');
            option.text = currentTime.toTimeString().substring(0, 5); // Extract HH:mm from the time string
            option.value = currentTime.toTimeString().substring(0, 5);
            selectElement.add(option);
            currentTime.setMinutes(currentTime.getMinutes() + 15);
        }
    }
    
    // Usage example - get the select element by its dynamically generated ID
    @foreach($subcategories as $subcategory)
        var selectElement{{$subcategory->id}} = document.getElementById('timedropdown{{$subcategory->id}}');
        populateTimeDropdown(selectElement{{$subcategory->id}});
    @endforeach
    </script> --}}

{{-- multi-disable================================================================================
============================================================================================= --}}
<script>
    function fireSweetAlertdisable() {
        const checkboxes = document.querySelectorAll('input[name="options[]"]:checked');
        
        if (checkboxes.length === 0) {
            Swal.fire('Error!', 'Please select at least one category to delete', 'error');
            return;        
        } else {
            const selectedSubcategories = Array.from(checkboxes).map(checkbox => checkbox.value);
            const hiddenInput = document.querySelector('input[name="subcategory_id[]"]');
            hiddenInput.value = selectedSubcategories.join(',');

            const modal = new bootstrap.Modal(document.getElementById('exampleModalCenter'));
            modal.show();
        }
    }
</script>



{{-- filter==================================================================================
======================================================================================== --}}
<script>
   // Get reference to filter select elements
const categoryFilter = document.querySelector('select[name="category_filter"]');
const methodFilter = document.querySelector('select[name="method_filter"]');
const sessionFilter = document.querySelector('select[name="session_filter"]');
const sportsTableRows = document.querySelectorAll('#sportsTable tbody tr');

// Event listeners for changes in filter options
categoryFilter.addEventListener('change', filterTable);
methodFilter.addEventListener('change', filterTable);
sessionFilter.addEventListener('change', filterTable);

// Function to filter table data based on selected filters
function filterTable() {
  const selectedCategory = categoryFilter.value;
  const selectedMethod = methodFilter.value;
  const selectedSession = sessionFilter.value;

  sportsTableRows.forEach(row => {
    const categoryValue = row.getAttribute('data-category');
    const methodValue = row.getAttribute('data-method');
    const sessionValue = row.getAttribute('data-session');

    const categoryMatch = selectedCategory === 'All Category' || selectedCategory === categoryValue;
    const methodMatch = selectedMethod === 'All Method' || selectedMethod === methodValue;
    const sessionMatch = selectedSession === 'All Session' || selectedSession === sessionValue;

    if (categoryMatch && methodMatch && sessionMatch) {
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
                url: 'facilities/delete',
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