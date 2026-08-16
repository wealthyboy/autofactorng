@extends('admin.layouts.app')

@section('content')

<div class="card mb-4">
   <div class="card-body p-3">
      <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
         <div>
            <h6 class="mb-1">Dashboard period</h6>
            <div class="text-xs">
               <a class="me-2" href="{{ route('admin_home', ['from' => now()->subDays(6)->format('Y-m-d'), 'to' => now()->format('Y-m-d')]) }}">7 days</a>
               <a class="me-2" href="{{ route('admin_home', ['from' => now()->subDays(29)->format('Y-m-d'), 'to' => now()->format('Y-m-d')]) }}">30 days</a>
               <a class="me-2" href="{{ route('admin_home', ['from' => now()->subDays(89)->format('Y-m-d'), 'to' => now()->format('Y-m-d')]) }}">90 days</a>
               <a href="{{ route('admin_home', ['from' => now()->startOfYear()->format('Y-m-d'), 'to' => now()->format('Y-m-d')]) }}">This year</a>
            </div>
         </div>
         <form method="get" action="{{ route('admin_home') }}" class="row g-2 align-items-end">
            <div class="col-auto"><label class="form-label text-xs mb-1">From</label><input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="form-control"></div>
            <div class="col-auto"><label class="form-label text-xs mb-1">To</label><input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="form-control"></div>
            <div class="col-auto"><button class="btn bg-gradient-dark mb-0">Apply filter</button></div>
         </form>
      </div>
   </div>
</div>

<div class="row">
   @foreach($stats as $key => $stat)


   <div class="col-sm-3 mt-sm-0 mt-4">
      <div class="card">
         <div class="card-body p-3 position-relative">
            <div class="row">
               <div class="col-7 text-start">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold">{{ $key }}</p>
                  <h5 class="font-weight-bolder mb-0">
                     {{ $stat }}
                  </h5>
               </div>
               <div class="col-5">
                  <div class="text-end"><span class="text-xs text-secondary">Selected period</span></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach

</div>

<div class="card mt-4 mb-4">
   <div class="card-header pb-0 d-flex justify-content-between align-items-center">
      <div><h6 class="mb-1">Orders and revenue</h6><p class="text-xs text-secondary mb-0">{{ $from->format('d M Y') }} – {{ $to->format('d M Y') }}, excluding cancelled orders</p></div>
      <a href="{{ route('admin.analytics.orders', ['from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}" class="text-sm">View order analytics</a>
   </div>
   <div class="card-body"><div style="height: 320px"><canvas id="dashboardOrderTrend"></canvas></div></div>
</div>

<!-- Step 1: Create the containing elements. -->

<section id="auth-button"></section>
<section id="view-selector"></section>
<section id="timeline"></section>




<div class="row mb-4 row mt-4">
   <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card mb-4">
         <div class="card-header pb-0">
            <div class="row">
               <div class="col-lg-6 col-7">
                  <h6>Recent Orders</h6>

               </div>
               <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                     <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-secondary" aria-hidden="true"></i>
                     </a>
                     <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body px-0 pb-2">
            <div class="table-responsive">
               <table class="table align-items-center mb-0">
                  <thead>

                  </thead>
                  <tbody>
                     @foreach($statistics['orders'] as $order)

                     <tr>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">{{null !== $order->user ? $order->user->fullname() : $order->fullName() }}</h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">{{ optional($order->orderEmail)->email ?? $order->email }}</h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">{{ $order->created_at->format('d-m-y') }}</h6>
                              </div>
                           </div>
                        </td>

                     </tr>
                     @endforeach


                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <div class="card mb-4">
         <div class="card-header pb-0">
            <h6>Top Buyers</h6>
         </div>
         <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
               <table class="table align-items-center mb-0">
                  <thead>
                     <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Value</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($statistics['top_buyers'] as $top_buyer)
                     <tr>
                        <td>
                           <div class="d-flex px-3 py-1">

                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">{{ $top_buyer->first_name }} - {{ $top_buyer->email }}</h6>
                                 <p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success">{{ $top_buyer->order_count}}</span> orders</p>
                              </div>

                           </div>
                        </td>
                        <td>
                        </td>
                     </tr>
                     @endforeach

                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="card mb-4">
         <div class="card-header pb-0">
            <h6>Top Selling Products</h6>
         </div>
         <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
               <table class="table align-items-center mb-0">
                  <thead>
                     <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Value</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($statistics['top_product'] as $top_product)
                     <tr>
                        <td>
                           <div class="d-flex px-3 py-1">

                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">{{ $top_product->product_name }} </h6>
                                 <p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success">{{ $top_product->count}}</span> orders</p>
                              </div>
                              <div>
                                 {{$top_product->qty}}
                              </div>
                           </div>
                        </td>
                        <td>
                        </td>
                     </tr>
                     @endforeach

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-4 col-md-6">
      <div class="card h-100">
         <div class="card-header pb-0">
            <h6>Activity</h6>
         </div>
         <div class="card-body p-3">
            <div class="timeline timeline-one-side">
               @foreach($statistics['activities'] as $activity)
               <div class="timeline-block mb-3">
                  <span class="timeline-step">
                     <i class="material-symbols-outlined">
                        local_activity
                     </i>
                  </span>
                  <div class="timeline-content">
                     <h6 class="text-dark text-sm font-weight-bold mb-0"></h6>
                     <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ optional($activity->user)->name }} - {{ $activity->action }}</p>
                     <p class="text-info font-weight-bold text-xs mt-1 mb-0">{{ $activity->created_at }}</p>

                  </div>
               </div>
               @endforeach

            </div>
         </div>
      </div>
   </div>
</div>





@endsection

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
@endsection

@section('inline-scripts')

const dashboardOrderCanvas = document.getElementById('dashboardOrderTrend');
if (dashboardOrderCanvas && typeof Chart !== 'undefined') {
   new Chart(dashboardOrderCanvas, {
      type: 'line',
      data: {
         labels: @json($statistics['order_trend']['labels']),
         datasets: [
            { label: 'Revenue (₦)', data: @json($statistics['order_trend']['revenue']), borderColor: '#e91e63', backgroundColor: 'rgba(233,30,99,.08)', yAxisID: 'revenue', tension: .35, fill: true },
            { label: 'Orders', data: @json($statistics['order_trend']['orders']), borderColor: '#344767', backgroundColor: '#344767', yAxisID: 'orders', tension: .35 }
         ]
      },
      options: { responsive: true, maintainAspectRatio: false, interaction: { mode: 'index', intersect: false }, scales: { revenue: { beginAtZero: true }, orders: { beginAtZero: true, position: 'right', grid: { drawOnChartArea: false }, ticks: { precision: 0 } } } }
   });
}

gapi.analytics.ready(function() {

// Step 3: Authorize the user.

var CLIENT_ID = '{{ config('services.goggle.client_id') }}';

gapi.analytics.auth.authorize({
container: 'auth-button',
clientid: CLIENT_ID,
});

// Step 4: Create the view selector.

var viewSelector = new gapi.analytics.ViewSelector({
container: 'view-selector'
});

// Step 5: Create the timeline chart.

var timeline = new gapi.analytics.googleCharts.DataChart({
reportType: 'ga',
query: {
'dimensions': 'ga:date',
'metrics': 'ga:sessions',
'start-date': '30daysAgo',
'end-date': 'yesterday',
},
chart: {
type: 'LINE',
container: 'timeline'
}
});

// Step 6: Hook up the components to work together.

gapi.analytics.auth.on('success', function(response) {
viewSelector.execute();
});

viewSelector.on('change', function(ids) {
var newIds = {
query: {
ids: ids
}
}
timeline.set(newIds).execute();
});
});

@stop
