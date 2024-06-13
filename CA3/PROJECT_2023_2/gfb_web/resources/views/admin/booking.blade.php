<x-admin-component>
        <div class="main-content">
            <div class="row g-10">
                <div class="col-xl-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-body">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenter2" style="background-color: #3498db">Book</button>
                        </div>
                        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterLabel">Book Facility</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.createbook') }}" method="POST" enctype="multipart/form-data">
                                            @csrf <!-- Add CSRF token for security -->
                                          
                                            <div class="form-group mb-20">
                                                <label class="form-label">Category</label>
                                                <select name="category_id" id="category" class="form-control" required>
                                                    <option value="">--select--</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group mb-20">
                                                <label class="form-label">Facility</label>
                                                <select name="subcategory_id" id="subcategory" class="form-control" required>
                                                    <option value="">--select--</option>
                                                    <!-- Subcategories will be populated dynamically -->
                                                </select>
                                            </div>
                                           
                                            <div id="dynamicFields" style="display: none">
                                            <div class="form-group mb-20">
                                                <label for="start_date" class="form-label">Date</label>
                                                <input type="date" class="form-control" name="start_date" id="start_date" required/>
                                            </div>
                                        
                                            <div class="form-group mb-20">
                                                <label for="end_time" class="form-label">Time</label>
                                                <select name="time" id="start_time" class="form-control" required>
                                                </select>                                              
                                            </div>
                                            <div class="form-group mb-20">
                                                <label for="additional_requirement" class="form-label">Additional Requirement</label>
                                                <textarea class="form-control" id="additional_requirement" name="additional_requirement" required></textarea>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label for="reason" class="form-label">Reason for Booking</label>
                                                <textarea class="form-control" id="reason" name="reason" required></textarea>
                                            </div>
                                            <div class="form-group mb-20">
                                                <label for="phone_no" class="form-label">Phone Number</label>
                                                <input type="number" class="form-control" id="phone_no" name="phone_no" placeholder="Enter your phone number" required/>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" style="background-color: #3498db; color:white">Book</button>
                                            </div>
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
                            <input type="text" id="searchInput" placeholder="Search...">
                            <select name="category_filter" required>
                                <option>All Category</option>
                                @foreach($categories as $scs)
                                    <option value="{{ $scs->category_name }}">{{ $scs->category_name}}</option>
                                @endforeach
                            </select>
                            
                            <select name="usertype_filter" required>
                                <option>All User</option>
                                @foreach($users as $scs)
                                    <option value="{{ $scs->type }}">{{ $scs->type}}</option>
                                @endforeach
                            </select>
                            
                            <select name="user_filter" required>
                                <option>All Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <select name="status_filter" id="status_filter" required>
                                <option value="all">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="booked">Booked</option>
                            </select>
                            <input type="date" id="filter_date">
                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="{{$bookings->previousPageUrl()}}">Previous</a></li>
                                    {{$bookings->links()}}
                                    <li class="page-item"><a class="page-link" href="{{$bookings->nextPageUrl()}}">Next</a></li>
                                </ul>
                            </nav> --}}
                            
                            
                            <table class="table table-striped table-hover" id="sportsTable">
                                <thead>
                                  <tr>
                                    <th>Sl.No
                                      {{-- <span class="custom-checkbox">
                                                        <input type="checkbox" id="selectAll">
                                                        <label for="selectAll"></label>
                                        </span> --}}
                                    </th>
                                    <th>Facility</th>
                                    <th>Category</th>
                                    <th>User</th>  
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Detail</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $serialNumber = 1;
                                    @endphp
                                    @foreach ($bookings as $booking)
                                  <tr data-date="{{ $booking->start_date }}" data-status="{{$booking->status}}" data-category="{{ $booking->subcategory->category->category_name }}" data-usertype="{{ $booking->user->usertypes->type }}" data-user="{{ $booking->user->role }}"> 
                                    <td>{{ $serialNumber }}
                                      {{-- <span class="custom-checkbox">
                                              <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                              <label for="checkbox1"></label>
                                        </span> --}}
                                    </td>
                                    <td>{{$booking->subcategory->facility_name}}</td>
                                    <td>{{$booking->subcategory->category->category_name}}</td>
                                    <td>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacility{{ $booking->user->id }}" >view</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacility{{ $booking->user->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">User detail</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label">Email</label>
                                                                        <p>{{$booking->user->email}}</p>   
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="resource">Usertype</label>
                                                                        <p>{{$booking->user->usertypes->type}}</p>
                                                                    </div> 
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="resource">Role</label>
                                                                        <p>{{$booking->user->role}}</p>
                                                                    </div>   
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                    </td>
                                    <td>{{$booking->start_date}}</td>
                                    <td>{{$booking->start_time}} <br/>to {{$booking->end_time}}</td>
                                    
                                    <td>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEditFacilitys{{ $booking->id }}" >view</button>
                                                <div class="modal fade" id="exampleModalCenterEditFacilitys{{ $booking->id }}" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterLabel">More detail</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="facility_name">Additional Resource</label>
                                                                        <p>{{$booking->additional_requirement}}</p>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label">Reason</label>
                                                                        <p>{{$booking->reason}}</p>   
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label class="form-label" for="resource">Phone Number</label>
                                                                        <p>{{$booking->phone_no}}</p>
                                                                    </div>   
                                                            </div>   
                                                        </div>
                                                    </div>
                                                </div>
                                    </td>
                                    
                                    <td style="color: {{ $booking->status === 'booked' ? 'green' : 'black' }}">{{$booking->status}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" onclick="fireSweetAlertApprove({{$booking->id}})"  style="background-color: #3498db"><i class="bi bi-check-circle"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="fireSweetAlertReject({{$booking->id}})"  style="background-color: red"><i class="bi bi-x-circle"></i></button>  
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
    
    <script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>

    <script>
      $(document).ready(function() {
    $('#filter_date').on('input', function() {
        var filterDate = $(this).val();

        $('#sportsTable tbody tr').hide(); // Hide all rows initially

        if (filterDate === '') {
            $('#sportsTable tbody tr').show(); // Show all rows if date input is empty
        } else {
            $('#sportsTable tbody tr').each(function() {
                var rowDate = $(this).data('date');

                // Compare the row's date with the filter date
                if (rowDate === filterDate) {
                    $(this).show(); // Show rows matching the filter date
                }
            });
        }
    });
});
     </script>

{{-- disable time=========================================================================================
    ==================================================================================================== --}}
   
{{--         
<script>
        function fetchData() {
            var subfacilityId = document.getElementById('subcategory').value;
            var startDate = document.getElementById('start_date').value;
        
            if (startDate) {
                var url = '/getSubfacilitySessiont/' + subfacilityId + '?start_date=' + startDate;
        
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
        
                        const startSelect = document.getElementById('start_time');
                        startSelect.innerHTML = '';
        
                        var startTime = data.session_start_time;
                        var endTime = data.session_end_time;
                        var slot = data.slot;
                        var bookingStartTimes = data.booking_start_times;
        
                        const bhutanTimeOptions = {
                            timeZone: 'Asia/Thimphu',
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        };
        
                        function generateTimeOptions() {
                            const [startHour, startMin, startSec] = startTime.split(':').map(Number);
                            const [endHour, endMin, endSec] = endTime.split(':').map(Number);
                            const [slotHour, slotMin, slotSec] = slot.split(':').map(Number);

                            let currentTime = new Date();
                            currentTime.setHours(startHour, startMin, startSec);

                            const endTimeObj = new Date();
                            endTimeObj.setHours(endHour, endMin, endSec);

                            const slotIncrement = (slotHour * 60 + slotMin) * 60000;

                            while (currentTime <= endTimeObj) {
                                const option = document.createElement('option');
                                const endTimeRange = new Date(currentTime.getTime() + slotIncrement);

                                if (endTimeRange > endTimeObj) {
                                    break;
                                }

                                const startTimeStr = currentTime.toLocaleTimeString('en-US', {
                                    hour12: false,
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit'
                                });

                                if (!data.booking_start_times.includes(startTimeStr)) {
                                    const label = startTimeStr + ' - ' + endTimeRange.toLocaleTimeString('en-US', {
                                        hour12: false,
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit'
                                    });

                                    const value = startTimeStr + ',' + endTimeRange.toLocaleTimeString('en-US', {
                                        hour12: false,
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit'
                                    });

                                    option.text = label;
                                    option.value = value;

                                    startSelect.add(option);
                                }

                                currentTime = endTimeRange;
                            }
                        }
                       
                                
                        generateTimeOptions();
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
        
        document.getElementById('start_date').addEventListener('change', fetchData);
        </script> --}}
        
<script>
function fetchData() {
    var subfacilityId = document.getElementById('subcategory').value;
    var startDate = document.getElementById('start_date').value;

    if (startDate) {
        var url = '/getSubfacilitySessiont/' + subfacilityId + '?start_date=' + startDate;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const startSelect = document.getElementById('start_time');
                startSelect.innerHTML = '';

                var startTime = data.session_start_time;
                var endTime = data.session_end_time;
                var slot = data.slot;
                var bookingStartTimes = data.booking_start_times;
                var bhutancurrenttime = data.bhutan_current_time;

                const bhutanTimeOptions = {
                    timeZone: 'Asia/Thimphu',
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };

                function generateTimeOptions() {
                const [startHour, startMin, startSec] = startTime.split(':').map(Number);
                const [endHour, endMin, endSec] = endTime.split(':').map(Number);
                const [slotHour, slotMin, slotSec] = slot.split(':').map(Number);

                let currentTime = new Date();
                currentTime.setHours(startHour, startMin, startSec);

                const endTimeObj = new Date();
                endTimeObj.setHours(endHour, endMin, endSec);

                const slotIncrement = (slotHour * 60 + slotMin) * 60000;

                while (currentTime <= endTimeObj) {
                    const option = document.createElement('option');
                    const endTimeRange = new Date(currentTime.getTime() + slotIncrement);

                    if (endTimeRange > endTimeObj) {
                        break;
                    }

                    const startTimeStr = currentTime.toLocaleTimeString('en-US', {
                        hour12: false,
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    });

                    if (!data.booking_start_times.includes(startTimeStr)) {
                        
                        const label = startTimeStr + ' - ' + endTimeRange.toLocaleTimeString('en-US', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        const value = startTimeStr + ',' + endTimeRange.toLocaleTimeString('en-US', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        option.text = label;
                        option.value = value;

                        startSelect.add(option);
                    }

                    currentTime = endTimeRange;
                }
            }
            function generateTimeOptions1() {
                const [startHour, startMin, startSec] = startTime.split(':').map(Number);
                const [endHour, endMin, endSec] = endTime.split(':').map(Number);
                const [slotHour, slotMin, slotSec] = slot.split(':').map(Number);

                let currentTime = new Date();
                currentTime.setHours(startHour, startMin, startSec);

                const endTimeObj = new Date();
                endTimeObj.setHours(endHour, endMin, endSec);

                const slotIncrement = (slotHour * 60 + slotMin) * 60000;

                const bhutanCurrentTime = new Date().toLocaleTimeString('en-US', {
                        hour12: false,
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        timeZone: 'Asia/Thimphu' // Get current time in Bhutan's timezone
                    });

                console.log('bhutanCurrentTime',bhutanCurrentTime)

                while (currentTime <= endTimeObj) {
                    const option = document.createElement('option');
                    const endTimeRange = new Date(currentTime.getTime() + slotIncrement);

                    if (endTimeRange > endTimeObj) {
                        break;
                    }

                    const startTimeStr = currentTime.toLocaleTimeString('en-US', {
                        hour12: false,
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        timeZone: 'Asia/Thimphu' // Set Bhutan's timezone
                    });

                    console.log('startTimeStr',startTimeStr)

                    if (startTimeStr <= bhutanCurrentTime) {
                        currentTime = endTimeRange;
                        continue; // Skip options with startTimeStr <= current time in Bhutan
                    }

                    if (!data.booking_start_times.includes(startTimeStr)) {
                        
                        const label = startTimeStr + ' - ' + endTimeRange.toLocaleTimeString('en-US', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        const value = startTimeStr + ',' + endTimeRange.toLocaleTimeString('en-US', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        option.text = label;
                        option.value = value;

                        startSelect.add(option);
                    }

                    currentTime = endTimeRange;
                }
            }
                
            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate()); // Get today's date without time

            // Convert startDate to a comparable format
            const selectedDate = new Date(startDate);
            const formattedStartDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate());

            if (formattedStartDate.getTime() === today.getTime()) {
                generateTimeOptions1();
            } else {
                generateTimeOptions();
            }  
                
            })
            .catch(error => console.error('Error:', error));
    }
}

document.getElementById('start_date').addEventListener('change', fetchData);
</script>
    {{-- <script>
function fetchData() {
    var subfacilityId = document.getElementById('subcategory').value;
    var startDate = document.getElementById('start_date').value;

    if (startDate) {
        var url = '/getSubfacilitySessiont/' + subfacilityId + '?start_date=' + startDate;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const startSelect = document.getElementById('start_time');
                startSelect.innerHTML = '';

                var startTime = data.session_start_time;
                var endTime = data.session_end_time;
                var slot = data.slot;
                var bookingStartTimes = data.booking_start_times;
                var bhutanCurrentTime = data.bhutan_current_time;
                var startDatew = new Date();

                const bhutanTimeOptions = {
                    timeZone: 'Asia/Thimphu',
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };

                function generateTimeOptions() {
                    const [startHour, startMin, startSec] = startTime.split(':').map(Number);
                    const [endHour, endMin, endSec] = endTime.split(':').map(Number);
                    const [slotHour, slotMin, slotSec] = slot.split(':').map(Number);

                    let currentTime = new Date();
                    currentTime.setHours(startHour, startMin, startSec);

                    const endTimeObj = new Date();
                    endTimeObj.setHours(endHour, endMin, endSec);

                    const slotIncrement = (slotHour * 60 + slotMin) * 60000;

                   
                    while (currentTime <= endTimeObj) {
                                const option = document.createElement('option');
                                const endTimeRange = new Date(currentTime.getTime() + slotIncrement);

                                // Check if the endTimeRange is beyond the session end time
                                if (endTimeRange > endTimeObj) {
                                    break;
                                }

                                const endTimeBhutan = endTimeRange.toLocaleTimeString('en-US', bhutanTimeOptions);

                                // Extract hours and minutes from the time strings for comparison
                                const endTimeBhutanHours = parseInt(endTimeBhutan.slice(0, 2), 10);
                                const endTimeBhutanMinutes = parseInt(endTimeBhutan.slice(3, 5), 10);

                                const bhutanCurrentTimeHours = parseInt(bhutanCurrentTime.slice(11, 13), 10);
                                const bhutanCurrentTimeMinutes = parseInt(bhutanCurrentTime.slice(14, 16), 10);

                                // Compare hours and minutes to determine if the endTimeBhutan is before bhutanCurrentTime
                                if (
                                    endTimeBhutanHours < bhutanCurrentTimeHours ||
                                    (endTimeBhutanHours === bhutanCurrentTimeHours && endTimeBhutanMinutes <= bhutanCurrentTimeMinutes)
                                ) {
                                    currentTime = endTimeRange;
                                    currentTime.setMilliseconds(currentTime.getMilliseconds() + slotIncrement);
                                    continue;
                                }
                        const startTimeStr = currentTime.toLocaleTimeString('en-US', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        if (bookingStartTimes.includes(startTimeStr)) {
                            currentTime = endTimeRange;
                            currentTime.setMilliseconds(currentTime.getMilliseconds() + slotIncrement);
                            continue;
                        }

                        const label = currentTime.toLocaleTimeString('en-US', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        }) + ' - ' + endTimeRange.toLocaleTimeString('en-US', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        const value = startTimeStr + ',' + endTimeRange.toLocaleTimeString('en-US', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        option.text = label;
                        option.value = value;

                        startSelect.add(option);

                        currentTime = endTimeRange;
                        currentTime.setMilliseconds(currentTime.getMilliseconds() + slotIncrement);
                    }

                }

                generateTimeOptions();

            })
            .catch(error => console.error('Error:', error));
    }
}

document.getElementById('start_date').addEventListener('change', fetchData);

        </script> --}}
        
    

    <script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- filter==================================================================================
======================================================================================== --}}
<script>
    $(document).ready(function() {
    // Change event on select dropdown
    $('#status_filter').on('change', function() {
        var selectedStatus = $(this).val();

        $('#sportsTable tbody tr').hide(); // Hide all rows initially

        // Show rows based on the selected status
        if (selectedStatus === 'all') {
            $('#sportsTable tbody tr').show(); // Show all rows if 'All Status' is selected
        } else {
            $('#sportsTable tbody tr[data-status="' + selectedStatus + '"]').show();
        }
    });
});
</script>
<script>
    const categoryFilter = document.querySelector('select[name="category_filter"]');
    const userTypeFilter = document.querySelector('select[name="usertype_filter"]');
    const userFilter = document.querySelector('select[name="user_filter"]');
    const sportsTableRows = document.querySelectorAll('#sportsTable tbody tr');

    categoryFilter.addEventListener('change', filterTable);
    userTypeFilter.addEventListener('change', filterTable);
    userFilter.addEventListener('change', filterTable);

    function filterTable() {
        const selectedCategory = categoryFilter.value;
        const selectedUserType = userTypeFilter.value;
        const selectedUserRole = userFilter.value;

        sportsTableRows.forEach(row => {
            const categoryValue = row.getAttribute('data-category');
            const userTypeValue = row.getAttribute('data-usertype');
            const userRoleValue = row.getAttribute('data-user');

            const categoryMatch = selectedCategory === 'All Category' || selectedCategory === categoryValue;
            const userTypeMatch = selectedUserType === 'All User' || selectedUserType === userTypeValue;
            const userRoleMatch = selectedUserRole === 'All Role' || selectedUserRole === userRoleValue;

            if (categoryMatch && userTypeMatch && userRoleMatch) {
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
        const categoryName = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Adjust the nth-child value based on your table structure
        
        // Check if the category name contains the filter text
        if (categoryName.includes(filter)) {
          row.style.display = ''; // Show the row if it matches the filter
        } else {
          row.style.display = 'none'; // Hide the row if it doesn't match
        }
      });
    });
  </script>
    {{-- form display=====================================================================================
    ================================================================================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var subcategoryField = document.getElementById('subcategory');
            var dynamicFields = document.getElementById('dynamicFields');
    
            // dynamicFields.style.display = 'none';
            // Listen for changes in the category select
            subcategoryField.addEventListener('change', function () {
                // Check if both category and subcategory are selected
                if (subcategoryField.value !== '') {
                    // Display the dynamic fields if both are selected
                    dynamicFields.style.display = 'block';
                } else {
                    // Hide the dynamic fields if one or both are not selected
                    dynamicFields.style.display = 'none';
                }
            });
        });
    </script>

    {{-- disable date=========================================================================================
    ==================================================================================================== --}}

<script>
document.getElementById('subcategory').addEventListener('change', function() {
    var subcategoryId = this.value;
    // Perform an AJAX request to fetch subcategory session dates
    fetch('/getSubcategorySession/' + subcategoryId)
        .then(response => response.json())
        .then(data => {
            const startDateInput = document.getElementById('start_date');
            
            startDateInput.min = data.start_date;
            startDateInput.max = data.end_date;
            startDateInput.min = data.currentDate;
        })
        .catch(error => console.error('Error:', error));
});

</script>
    


    
{{-- aprove================================================================================================
====================================================================================================== --}}
    <script>
        function fireSweetAlertApprove(id) {
            Swal.fire({
                title: 'Are you sure you want to Approve this booking?', 
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d9534f',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(`/admin/booking/confirm/${id}`)
                        .then((response) => {
                            console.log('Axios success', response.data);
                            
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Approved',
                                timer: 1500,
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
    {{-- reject===============================================================================================
    ===================================================================================================== --}}
    <script>
        function fireSweetAlertReject(id) {
    Swal.fire({
        title: 'Are you sure you want to Reject this booking?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Yes, Reject it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Enter reason for rejection:',
                input: 'textarea',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (reason) => {
                    return axios({
                        method: 'delete',
                        url: `booking/delete/${id}`,
                        data: {
                            bookingId: id,
                            rejectionReason: reason // Pass the entered reason along with the ID
                        }
                    })
                    .then((response) => {
                        console.log('Axios success', response.data);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Rejected',
                            timer: 1500,
                            showConfirmButton: false
                        });   
                    })
                    .catch((error) => {
                        console.log('Axios error', error);
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        );
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }
    });
}

    </script>
   {{-- <script>
    function fireSweetAlertReject(id) {
        Swal.fire({
            title: 'Are you sure you want to Reject this booking?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d9534f',
            confirmButtonText: 'Yes, Reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios({
                    method: 'delete',
                    url: `booking/delete/${id}`, // Use backticks for proper interpolation
                    data: { bookingId: id }
                })
                .then((response) => {
                    console.log('Axios success', response.data);
                    
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Rejected',
                        timer: 1500,
                        showConfirmButton: false
                    });   
                })
                .catch((error) => {
                    console.log('Axios error', error);
                    Swal.fire('Error!', error.response.data.message, 'error');
                });
            }
        })
    }
</script> --}}
{{-- book form=======================================================================
================================================================================ --}}
<script>
    // Fetch the subcategories corresponding to each category
    const subcategoriesByCategory = {
        @foreach($categories as $category)
            "{{ $category->id }}": [
                @foreach($category->subcategories as $subcategory)
                    @if($subcategory->ed == 'enable')
                        { id: "{{ $subcategory->id }}", name: "{{ $subcategory->facility_name }}" },
                    @endif
                @endforeach
            ],
        @endforeach
    };

    // Function to populate subcategory dropdown based on selected category
    document.getElementById('category').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategoryDropdown = document.getElementById('subcategory');

        // Clear previous options
        subcategoryDropdown.innerHTML = '<option value="">--select--</option>';

        // Populate subcategories for the selected category
        if (categoryId && subcategoriesByCategory[categoryId]) {
            subcategoriesByCategory[categoryId].forEach(subcategory => {
                const option = document.createElement('option');
                option.value = subcategory.id;
                option.text = subcategory.name;
                subcategoryDropdown.appendChild(option);
            });
        }
    });
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
