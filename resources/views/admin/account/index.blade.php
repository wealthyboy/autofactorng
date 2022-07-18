@extends('admin.layouts.app')
@section('content')

<div class="row">
               <div class="col-lg-6 col-12 d-flex ms-auto">
                  <a href="javascript:;" class="btn btn-icon btn-outline-secondary ms-auto">
                  Export
                  </a>
                  <div class="dropleft ms-3">
                     <button class="btn bg-gradient-dark dropdown-toggle" type="button" id="dropdownImport" data-bs-toggle="dropdown" aria-expanded="false">
                     Today
                     </button>
                     <ul class="dropdown-menu" aria-labelledby="dropdownImport">
                        <li><a class="dropdown-item" href="javascript:;">Yesterday</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Last 7 days</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Last 30 days</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="row mt-4">
               <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <div class="card mb-4">
                     <div class="card-header p-3 pt-2">
                        
                        <div class="text-end pt-1">
                           <p class="text-sm mb-0 text-capitalize">Users</p>
                           <h5 class="mb-0">
                              0
                           </h5>
                        </div>
                     </div>
                     <hr class="dark horizontal my-0">
                     <div class="card-footer p-3">
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <div class="card mb-4">
                     <div class="card-header p-3 pt-2">
                        
                        <div class="text-end pt-1">
                           <p class="text-sm mb-0 text-capitalize">Today's Sales Total</p>
                           <h5 class="mb-0">
                              0
                           </h5>
                        </div>
                     </div>
                     <hr class="dark horizontal my-0">
                     <div class="card-footer p-3">
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <div class="card mb-4">
                     <div class="card-header p-3 pt-2">
                        
                        <div class="text-end pt-1">
                           <p class="text-sm mb-0 text-capitalize">Items Sold Today</p>
                           <h5 class="mb-0">
                              0
                           </h5>
                        </div>
                     </div>
                     <hr class="dark horizontal my-0">
                     <div class="card-footer p-3">
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-sm-6">
                  <div class="card mb-4">
                     <div class="card-header p-3 pt-2">
                       
                        <div class="text-end pt-1">
                           <p class="text-sm mb-0 text-capitalize">All Sales</p>
                           <h5 class="mb-0">
                              0
                           </h5>
                        </div>
                     </div>
                     <hr class="dark horizontal my-0">
                     <div class="card-footer p-3">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <div class="card">
                     <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Sales</h6>
                        <div class="d-flex align-items-center">
                           <span class="badge badge-md badge-dot me-4">
                           <i class="bg-primary"></i>
                           <span class="text-dark text-xs"></span>
                           </span>
                           <span class="badge badge-md badge-dot me-4">
                           <i class="bg-dark"></i>
                           <span class="text-dark text-xs"></span>
                           </span>
                           <span class="badge badge-md badge-dot me-4">
                           <i class="bg-info"></i>
                           <span class="text-dark text-xs"></span>
                           </span>
                        </div>
                     </div>
                     <div class="card-body p-3">
                        <div class="chart">
                           <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
              
            </div>
           


@endsection

@section('inline-scripts')

var ctx1 = document.getElementById("chart-line").getContext("2d");
         var ctx2 = document.getElementById("chart-doughnut").getContext("2d");
         
         var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
         
         gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
         gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
         gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors
         
         var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);
         
         gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
         gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
         gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors
         
         // Line chart
         new Chart(ctx1, {
           type: "line",
           data: {
             labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
             datasets: [{
                 label: "Organic Search",
                 tension: 0.4,
                 borderWidth: 0,
                 pointRadius: 2,
                 pointBackgroundColor: "#e91e63",
                 borderColor: "#e91e63",
                 borderWidth: 3,
                 backgroundColor: gradientStroke1,
                 data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                 maxBarThickness: 6
               },
               {
                 label: "Referral",
                 tension: 0.4,
                 borderWidth: 0,
                 pointRadius: 2,
                 pointBackgroundColor: "#3A416F",
                 borderColor: "#3A416F",
                 borderWidth: 3,
                 backgroundColor: gradientStroke2,
                 data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                 maxBarThickness: 6
               },
               {
                 label: "Direct",
                 tension: 0.4,
                 borderWidth: 0,
                 pointRadius: 2,
                 pointBackgroundColor: "#17c1e8",
                 borderColor: "#17c1e8",
                 borderWidth: 3,
                 backgroundColor: gradientStroke2,
                 data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
                 maxBarThickness: 6
               },
             ],
           },
           options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
               legend: {
                 display: false,
               }
             },
             interaction: {
               intersect: false,
               mode: 'index',
             },
             scales: {
               y: {
                 grid: {
                   drawBorder: false,
                   display: true,
                   drawOnChartArea: true,
                   drawTicks: false,
                   borderDash: [5, 5]
                 },
                 ticks: {
                   display: true,
                   padding: 10,
                   color: '#9ca2b7'
                 }
               },
               x: {
                 grid: {
                   drawBorder: false,
                   display: true,
                   drawOnChartArea: true,
                   drawTicks: true,
                   borderDash: [5, 5]
                 },
                 ticks: {
                   display: true,
                   color: '#9ca2b7',
                   padding: 10
                 }
               },
             },
           },
         });
         
         
         // Doughnut chart
         new Chart(ctx2, {
           type: "doughnut",
           data: {
             labels: ['Atlassian', 'Jira', 'Slack', 'Spotify', 'Adobe'],
             datasets: [{
               label: "Projects",
               weight: 9,
               cutout: 60,
               tension: 0.9,
               pointRadius: 2,
               borderWidth: 2,
               backgroundColor: ['#2152ff', '#3A416F', '#f53939', '#a8b8d8', '#e91e63'],
               data: [25, 13, 12, 37, 13],
               fill: false
             }],
           },
           options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
               legend: {
                 display: false,
               }
             },
             interaction: {
               intersect: false,
               mode: 'index',
             },
             scales: {
               y: {
                 grid: {
                   drawBorder: false,
                   display: false,
                   drawOnChartArea: false,
                   drawTicks: false,
                 },
                 ticks: {
                   display: false
                 }
               },
               x: {
                 grid: {
                   drawBorder: false,
                   display: false,
                   drawOnChartArea: false,
                   drawTicks: false,
                 },
                 ticks: {
                   display: false,
                 }
               },
             },
           },
         });
      </script>
      <script src="../../assets/js/plugins/chartjs.min.js"></script>
      <script>
         var ctx1 = document.getElementById("chart-line").getContext("2d");
         var ctx2 = document.getElementById("chart-doughnut").getContext("2d");
         
         var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
         
         gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
         gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
         gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors
         
         var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);
         
         gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
         gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
         gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors
         
         // Line chart
         new Chart(ctx1, {
           type: "line",
           data: {
             labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
             datasets: [{
                 label: "Organic Search",
                 tension: 0.4,
                 borderWidth: 0,
                 pointRadius: 2,
                 pointBackgroundColor: "#e91e63",
                 borderColor: "#e91e63",
                 borderWidth: 3,
                 backgroundColor: gradientStroke1,
                 data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                 maxBarThickness: 6
               },
               {
                 label: "Referral",
                 tension: 0.4,
                 borderWidth: 0,
                 pointRadius: 2,
                 pointBackgroundColor: "#3A416F",
                 borderColor: "#3A416F",
                 borderWidth: 3,
                 backgroundColor: gradientStroke2,
                 data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                 maxBarThickness: 6
               },
               {
                 label: "Direct",
                 tension: 0.4,
                 borderWidth: 0,
                 pointRadius: 2,
                 pointBackgroundColor: "#17c1e8",
                 borderColor: "#17c1e8",
                 borderWidth: 3,
                 backgroundColor: gradientStroke2,
                 data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
                 maxBarThickness: 6
               },
             ],
           },
           options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
               legend: {
                 display: false,
               }
             },
             interaction: {
               intersect: false,
               mode: 'index',
             },
             scales: {
               y: {
                 grid: {
                   drawBorder: false,
                   display: true,
                   drawOnChartArea: true,
                   drawTicks: false,
                   borderDash: [5, 5]
                 },
                 ticks: {
                   display: true,
                   padding: 10,
                   color: '#9ca2b7'
                 }
               },
               x: {
                 grid: {
                   drawBorder: false,
                   display: true,
                   drawOnChartArea: true,
                   drawTicks: true,
                   borderDash: [5, 5]
                 },
                 ticks: {
                   display: true,
                   color: '#9ca2b7',
                   padding: 10
                 }
               },
             },
           },
         });
         
         
         // Doughnut chart
         new Chart(ctx2, {
           type: "doughnut",
           data: {
             labels: ['Atlassian', 'Jira', 'Slack', 'Spotify', 'Adobe'],
             datasets: [{
               label: "Projects",
               weight: 9,
               cutout: 60,
               tension: 0.9,
               pointRadius: 2,
               borderWidth: 2,
               backgroundColor: ['#2152ff', '#3A416F', '#f53939', '#a8b8d8', '#e91e63'],
               data: [25, 13, 12, 37, 13],
               fill: false
             }],
           },
           options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
               legend: {
                 display: false,
               }
             },
             interaction: {
               intersect: false,
               mode: 'index',
             },
             scales: {
               y: {
                 grid: {
                   drawBorder: false,
                   display: false,
                   drawOnChartArea: false,
                   drawTicks: false,
                 },
                 ticks: {
                   display: false
                 }
               },
               x: {
                 grid: {
                   drawBorder: false,
                   display: false,
                   drawOnChartArea: false,
                   drawTicks: false,
                 },
                 ticks: {
                   display: false,
                 }
               },
             },
           },
         });
$(document).ready(function() {
});
@stop
