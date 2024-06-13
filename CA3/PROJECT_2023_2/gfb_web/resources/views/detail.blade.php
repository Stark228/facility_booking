<x-app-layout>
<br><br>
        <!-- ======= Portfolio Details Section ======= -->
        <section id="portfolio-details" class="portfolio-details">
          <div class="container">
    
            <div class="row gy-4">
    
              <div class="col-lg-8">
                <div class="portfolio-details-slider">
                  <div class="align-items-center">
                    <div class="swiper-slide">
                       
                        @if($subcategory->team && $subcategory->team->image)
                        <iframe id="if" src="{{ asset('storage/' . str_replace('public/', '', $subcategory->team->image)) }}" width="100%" height="855px"></iframe>
                    @else
                    <img src="{{ asset('storage/' . str_replace('public/', '', $subcategory->image)) }}" alt="Facility Image" class="img-fluid" />                                            
                    @endif                                                              
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="col-lg-4">
                <div class="portfolio-info">
                  <h3>Facility information</h3>
                  <ul>
                    <li><strong>Name</strong>: {{ $subcategory->facility_name }}</li>
                    <li><strong>Category</strong>: {{ $subcategory->category->category_name }}</li>
                    <li><strong>Resources</strong>: {{ $subcategory->resource }}</li>
                    <li><strong>Available from</strong>: {{ $subcategory->subcategorysession->start_time }} to {{ $subcategory->subcategorysession->end_time }}</li>
                  </ul>
                </div>
                <div class="card" style="margin-top: 5px">
                  <div class="card-body">
                    <form class="row g-3" action="{{ route('subcategory.createbook', ['subcategory' => $subcategory->id]) }}" method="POST" enctype="multipart/form-data">
                      @csrf 
                      <!-- Your form fields here -->
                      <input type="hidden" name="subcategory_id" id="sub" value="{{ $subcategory->id }}">

                      {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
                      <div class="col-12">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required>
                      </div>
                      
                      <div class="col-12">
                        
                          <label for="end_time" class="form-label">Time</label>
                          <select name="time" id="start_time" class="form-control" required>
                          </select>                                              
                   
                      </div>
                      
                      <div class="col-12">
                        <label for="additional_requirement" class="form-label">Additional Requirement</label>
                        <textarea class="form-control" id="additional_requirement" name="additional_requirement" rows="3" required></textarea>
                      </div>
                      <div class="col-12">
                        <label for="reason" class="form-label">Reason for Booking</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                      </div>
                      <div class="col-12">
                        <label for="phone_no" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" id="phone_no" name="phone_no" placeholder="Enter your phone number"  pattern="[0-9]{8,}" required/>
                      </div>
                      
                      <div class="text-center">
                          <button type="submit" class="btn btn-primary" style="color: rgb(255, 255, 255);background-color:#3498db">Submit</button>
                      </div>
                      
                  </form>
                  
                  <!-- Bootstrap Modal for Confirmation -->
                  <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  Are you sure you want to book this facility?
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #3498db; color:white">Cancel</button>
                                  <button type="button" id="confirmSubmit" class="btn btn-primary" style="background-color: #3498db; color:white">Confirm</button>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                   

      
                  </div>
                </div>
                




                
              </div>
    
            </div>
    
          </div>
        </section><!-- End Portfolio Details Section -->
        <script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>  
        
{{-- disable time=========================================================================================
    ==================================================================================================== --}}
    
        {{-- <script>
          function fetchData() {
              var subfacilityId = document.getElementById('sub').value;
              var startDate = document.getElementById('start_date').value;
          
              if (startDate) {
                  var url = '/ugetSubfacilitySessiont/' + subfacilityId + '?start_date=' + startDate;
          
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
                          console.log('bhutanCurrentTime', bhutanCurrentTime)
          
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
                  <script>
                    function fetchData() {
                        var subfacilityId = document.getElementById('sub').value;
                        var startDate = document.getElementById('start_date').value;
                    
                        if (startDate) {
                            var url = '/ugetSubfacilitySessiont/' + subfacilityId + '?start_date=' + startDate;
                    
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
 {{-- date disable=================================================================================
 =============================================================================================      --}}
  <script>
    var subcategoryId = document.getElementById('sub').value;;
    console.log('sub', subcategoryId);

    fetch('/ugetSubcategorySession/' + subcategoryId)
        .then(response => response.json())
        .then(data => {
            console.log("data", data);
            const startDateInput = document.getElementById('start_date');
            
            startDateInput.min = data.start_date;
            startDateInput.max = data.end_date;
            startDateInput.min = data.currentDate;
            
        })
        .catch(error => console.error('Error:', error));
</script>

{{-- pop-up=================================================================================
======================================================================================= --}}
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
</x-app-layout>

 