

<x-admin-component>
    

<!-- main sidebar -->
<div class="main-content">
    

    <div class="row g-10">
        <div class="col-xl-6 col-lg-6">
            <div class="panel">
                <div class="panel-body">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('admin_assets/images/all facility 1.png') }}" class="d-block w-100" alt="slide image">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>All Facilities</h5>
                                    <h3>{{ $subcategorycount}}</h3>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('admin_assets/images/all category.png') }}" class="d-block w-100" alt="slide image">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>All Category</h5>
                                    <h3>{{ $categorycount}}</h3>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('admin_assets/images/all booking.png')}}" class="d-block w-100" alt="slide image">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>All Bookings</h5>
                                    <h3>{{ $bookingcount }}</h3>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="panel mb-10">
                <div class="panel-heading">
                    <span>Recent Bookings</span>
                   <a href="{{ url ('admin/booking')}}"> <button type="button" class="btn btn-outline-primary" >View more</button> </a>                       
                </div>
                
                <div class="panel-body">
                    <div class="list-group" style="height: 220px; overflow-y: scroll;">
                        <!-- <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">12200051.gcit@rub.edu.bt</p>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">Football Ground</p>
                        </a> -->   
                        @foreach ($bookings as $b) 
                        <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">{{ $b->user->email }}</p>
                                <!-- <small>3 days ago</small> -->
                            </div>
                            <p class="mb-1">{{ $b->subcategory->facility_name}}</p>
                        </a>
                        @endforeach
                        
                        
                      
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="panel col-xl-12 col-lg-12 mb-10 mt-10">
            <div class="panel-heading">
                <span>Booking</span>
            </div>
        </div>

    <div class="panel mb-10 mt-10">
        <div class="col-xl-12 col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <div id="chart"></div>
                </div>
            </div> 
        </div>
    </div>
    <div class="panel col-xl-12 col-lg-12 mb-10 mt-10">
        <div class="panel-heading">
            <span>Total</span>
        </div>
    </div>
    
<div class="panel mb-10 mt-10">
    <div class="col-xl-12 col-lg-12">
        <div class="panel">
            <div class="panel-body">
                <section class="section">
                    <div class="row mb-2">
                        <div class="col-12 col-md-3">
                            <div class="card card-statistic" style="background-color: #3498db; border-radius: 30px;color:white">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-center' >
                                            <h3 class='card-title'>Total Users:&nbsp;{{$usercount}}</h3>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card card-statistic" style="background-color: #3498db; border-radius: 30px;color:white">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-center' >
                                            <h3 class='card-title'>Total Category:&nbsp;{{ $categorycount}}</h3>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card card-statistic" style="background-color: #3498db; border-radius: 30px;color:white">
                                <div class="card-body p-0" >
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-center'>
                                            <h3 class='card-title'>Total Facility:&nbsp;{{ $subcategorycount}}</h3>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card card-statistic"style="background-color: #3498db; border-radius: 30px; color:white">
                                <div class="card-body p-0" >
                                    <div class="d-flex flex-column" >
                                        <div class='px-3 py-3 d-flex justify-content-center' >
                                            <h3 class='card-title'>Total Booking:&nbsp;{{ $bookingcount }} </h3>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>
        </div> 
    </div>
</div>


    <div class="col-xl-6 col-lg-6">
        <div class="panel mb-10">
            <div class="panel-heading">
                <span>Facility in each Category</span>
            </div>
            <div class="panel-body">
                <div class="list-group" style="height: 220px; ">
                   
                    
                    <div id="chart1"></div>
                  
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="panel mb-10">
            <div class="panel-heading">
                <span>Users in each Usertype</span>
            </div>
            <div class="panel-body">
                <div class="list-group" style="height: 220px;">
                   
                    <div id="chart2"></div>
                    
            
                    
                </div>
            </div>
        </div>
    </div>
    <div class="panel mb-10 mt-10">
        <div class="col-xl-12 col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <div id="chart3"></div>
                </div>
            </div> 
        </div>
    </div>
    
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    const data = @json($bookingData);
    const data1 = @json($categor);
    const data2 = @json($userCounts);
    const userTypes = @json($userTypes);
    // Rendering the bar chart
    const categories = data.map(item => item.subcategory.facility_name);
    const counts = data.map(item => item.count);

    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Bookings Count',
            data: counts
        }],
        xaxis: {
            categories: categories,
            title: {
                text: 'Facility Names'
            }
        },
        yaxis: {
            title: {
                text: 'Number of Bookings'
            }
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    // Rendering the pie chart
    const labels = data1.map(category => category.category_name);
    const counts1 = data1.map(category => category.subcategories_count);

    var options1 = {
        chart: {
            type: 'pie',
            height: 230
        },
        series: counts1,
        labels: labels,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
    chart1.render();
    const labels2 = data2.map(item => userTypes[item.usertype_id]);
    const counts2 = data2.map(item => item.count);

    var options2 = {
        chart: {
            type: 'pie',
            height: 230
        },
        series: counts2,
        labels: labels2,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    }

    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
    chart2.render();

    
</script>
{{-- <script>
    const dataFromBackend = @json($linechart);

// Group bookings by day of the week and count bookings for each day
const bookingsByDay = {};
dataFromBackend.forEach(item => {
    const date = new Date(item.created_at); // Assuming 'created_at' holds the booking date
    const dayOfWeek = date.getDay(); // Get the day of the week (0 for Sunday, 1 for Monday, ..., 6 for Saturday)

    // Store bookings count and facility name for each day
    if (!bookingsByDay[dayOfWeek]) {
        bookingsByDay[dayOfWeek] = {
            count: 0,
            facilities: {}
        };
    }

    // Count bookings for the day
    bookingsByDay[dayOfWeek].count++;

    // Store facility name
    if (!bookingsByDay[dayOfWeek].facilities[item.facility_name]) {
        bookingsByDay[dayOfWeek].facilities[item.facility_name] = 0;
    }
    bookingsByDay[dayOfWeek].facilities[item.facility_name]++;
});

// Get labels for each day of the week (Sunday to Saturday)
const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

// Initialize arrays for labels, counts, and facility names
const labels3 = daysOfWeek;
const counts3 = [];
const facilitiesData = {};

// Populate counts3 with the booking counts for each day and facilitiesData with counts per facility
daysOfWeek.forEach((day, index) => {
    const bookings = bookingsByDay[index] || { count: 0, facilities: {} };
    counts3.push(bookings.count);

    // Store facility data for each day
    for (const [facility, count] of Object.entries(bookings.facilities)) {
        if (!facilitiesData[facility]) {
            facilitiesData[facility] = new Array(daysOfWeek.length).fill(0);
        }
        facilitiesData[facility][index] = count;
    }
});

// Generate series data for each facility
const seriesData = Object.keys(facilitiesData).map(facility => ({
    name: facility,
    data: facilitiesData[facility]
}));

// Your ApexCharts options
const options3 = {
    // ... (other options)
    series: seriesData, // Use seriesData for the line chart series
    xaxis: {
        categories: labels3 // Use labels3 for x-axis labels
        // ... (other x-axis properties)
    }
    // ... (other options)
};

// Render the chart in the #chart3 element using ApexCharts
const chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
chart3.render();
</script> --}}
</x-admin-component>
