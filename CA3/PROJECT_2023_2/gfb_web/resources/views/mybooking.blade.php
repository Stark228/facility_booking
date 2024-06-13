<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- ======= Portfolio Section ======= -->
                    <section id="portfolio" class="portfolio">
                        <div class="container">
                            
                    
                            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    
                                
                                    @foreach ($bookings as $booking)

                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                    <div class="portfolio-wrap">
                                    <img src="{{ asset('user_dashboard/img/c.png') }}" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <h4>{{$booking->subcategory->facility_name}}</h4>
                                        
                                    </div>
                                </div>
                                <div class="portfolio-info mt-2" data-aos="fade-up" data-aos-delay="400">
                                    <div><strong>Facility</strong>: {{$booking->subcategory->facility_name}}</div>

                                      <div><strong>Category</strong>: {{$booking->subcategory->category->category_name}}</div>

                                      <div><strong>Resource</strong>: {{$booking->subcategory->resource}}</div>
                                      <div><strong>Date</strong>: {{$booking->start_date}}</div>
                                      <div><strong>Time</strong>: {{$booking->start_time}} to {{$booking->end_time}}</div>
                                      <div class="btn btn-primary" style="background-color: #3498db"><strong>Status</strong>: {{ $booking->status }}</div>
                                      @if($booking->status === 'pending')
                                        <button type="button" class="btn btn-danger" onclick="fireSweetAlertReject({{$booking->id}})"  style="background-color: red">Cancel</button>  
                                    @endif
                                   
                                </div>
                            </div>
                                @endforeach
                              
                    
                                
                    
                            </div>
                           
                        </div>
                    </section><!-- End Portfolio Section -->
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        function fireSweetAlertReject(id) {
            Swal.fire({
                title: 'Are you sure you want to Cancel this booking?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d9534f',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Use Axios to perform the delete request
                    axios({
                        method: 'delete',
                        url: `bookings/delete/${id}`,
                    })
                    .then((response) => {
                        console.log('Axios success', response.data);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                        Swal.fire({
                            icon: 'success',
                            title: 'Booking Cancelled',
                            timer: 1500,
                            showConfirmButton: false
                        });   
                    })
                    .catch((error) => {
                        console.log('Axios error', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    });
                }
            });
        }
    </script>
</x-app-layout>
