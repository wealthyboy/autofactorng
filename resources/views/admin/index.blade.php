@extends('admin.layouts.app')

@section('content')

<div class="row">
   @foreach($stats as $key => $stat)
   <div class="col-sm-6 mt-sm-0 mt-4">
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
                  <div class="dropdown text-end">
                     <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="text-xs text-secondary">Today</span>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUsers2">
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7 days</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last week</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30 days</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach

</div>

<div class="row mb-4">
   <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
         <div class="card-header pb-0">
            <div class="row">
               <div class="col-lg-6 col-7">
                  <h6>Projects</h6>
                  <p class="text-sm mb-0">
                     <i class="fa fa-check text-info" aria-hidden="true"></i>
                     <span class="font-weight-bold ms-1">30 done</span> this month
                  </p>
               </div>
               <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                     <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-secondary" aria-hidden="true"></i>
                     </a>
                     <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable" style="">
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
                     <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                                 <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">Material XD Version</h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Ryan Tompson" data-bs-original-title="Ryan Tompson">
                                 <img src="../assets/img/team-1.jpg" alt="team1">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Romina Hadid" data-bs-original-title="Romina Hadid">
                                 <img src="../assets/img/team-2.jpg" alt="team2">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Alexander Smith" data-bs-original-title="Alexander Smith">
                                 <img src="../assets/img/team-3.jpg" alt="team3">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Jessica Doe" data-bs-original-title="Jessica Doe">
                                 <img src="../assets/img/team-4.jpg" alt="team4">
                              </a>
                           </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                           <span class="text-xs font-weight-bold"> $14,000 </span>
                        </td>
                        <td class="align-middle">
                           <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                 <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">60%</span>
                                 </div>
                              </div>
                              <div class="progress">
                                 <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                                 <img src="../assets/img/small-logos/logo-atlassian.svg" class="avatar avatar-sm me-3" alt="atlassian">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">Add Progress Track</h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Romina Hadid" data-bs-original-title="Romina Hadid">
                                 <img src="../assets/img/team-2.jpg" alt="team5">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Jessica Doe" data-bs-original-title="Jessica Doe">
                                 <img src="../assets/img/team-4.jpg" alt="team6">
                              </a>
                           </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                           <span class="text-xs font-weight-bold"> $3,000 </span>
                        </td>
                        <td class="align-middle">
                           <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                 <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">10%</span>
                                 </div>
                              </div>
                              <div class="progress">
                                 <div class="progress-bar bg-gradient-info w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                                 <img src="../assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm me-3" alt="team7">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">Fix Platform Errors</h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Romina Hadid" data-bs-original-title="Romina Hadid">
                                 <img src="../assets/img/team-3.jpg" alt="team8">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Jessica Doe" data-bs-original-title="Jessica Doe">
                                 <img src="../assets/img/team-1.jpg" alt="team9">
                              </a>
                           </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                           <span class="text-xs font-weight-bold"> Not set </span>
                        </td>
                        <td class="align-middle">
                           <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                 <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">100%</span>
                                 </div>
                              </div>
                              <div class="progress">
                                 <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                                 <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm me-3" alt="spotify">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">Launch our Mobile App</h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Ryan Tompson" data-bs-original-title="Ryan Tompson">
                                 <img src="../assets/img/team-4.jpg" alt="user1">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Romina Hadid" data-bs-original-title="Romina Hadid">
                                 <img src="../assets/img/team-3.jpg" alt="user2">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Alexander Smith" data-bs-original-title="Alexander Smith">
                                 <img src="../assets/img/team-4.jpg" alt="user3">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Jessica Doe" data-bs-original-title="Jessica Doe">
                                 <img src="../assets/img/team-1.jpg" alt="user4">
                              </a>
                           </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                           <span class="text-xs font-weight-bold"> $20,500 </span>
                        </td>
                        <td class="align-middle">
                           <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                 <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">100%</span>
                                 </div>
                              </div>
                              <div class="progress">
                                 <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                                 <img src="../assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm me-3" alt="jira">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">Add the New Pricing Page</h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Ryan Tompson" data-bs-original-title="Ryan Tompson">
                                 <img src="../assets/img/team-4.jpg" alt="user5">
                              </a>
                           </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                           <span class="text-xs font-weight-bold"> $500 </span>
                        </td>
                        <td class="align-middle">
                           <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                 <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">25%</span>
                                 </div>
                              </div>
                              <div class="progress">
                                 <div class="progress-bar bg-gradient-info w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="25"></div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                                 <img src="../assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm me-3" alt="invision">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">Redesign New Online Shop</h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Ryan Tompson" data-bs-original-title="Ryan Tompson">
                                 <img src="../assets/img/team-1.jpg" alt="user6">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Jessica Doe" data-bs-original-title="Jessica Doe">
                                 <img src="../assets/img/team-4.jpg" alt="user7">
                              </a>
                           </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                           <span class="text-xs font-weight-bold"> $2,000 </span>
                        </td>
                        <td class="align-middle">
                           <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                 <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">40%</span>
                                 </div>
                              </div>
                              <div class="progress">
                                 <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                              </div>
                           </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-4 col-md-6">
      <div class="card h-100">
         <div class="card-header pb-0">
            <h6>Orders overview</h6>
            <p class="text-sm">
               <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
               <span class="font-weight-bold">24%</span> this month
            </p>
         </div>
         <div class="card-body p-3">
            <div class="timeline timeline-one-side">
               <div class="timeline-block mb-3">
                  <span class="timeline-step">
                     <i class="material-icons text-success text-gradient">notifications</i>
                  </span>
                  <div class="timeline-content">
                     <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                     <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                  </div>
               </div>
               <div class="timeline-block mb-3">
                  <span class="timeline-step">
                     <i class="material-icons text-danger text-gradient">code</i>
                  </span>
                  <div class="timeline-content">
                     <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                     <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                  </div>
               </div>
               <div class="timeline-block mb-3">
                  <span class="timeline-step">
                     <i class="material-icons text-info text-gradient">shopping_cart</i>
                  </span>
                  <div class="timeline-content">
                     <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                     <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                  </div>
               </div>
               <div class="timeline-block mb-3">
                  <span class="timeline-step">
                     <i class="material-icons text-warning text-gradient">credit_card</i>
                  </span>
                  <div class="timeline-content">
                     <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                     <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                  </div>
               </div>
               <div class="timeline-block mb-3">
                  <span class="timeline-step">
                     <i class="material-icons text-primary text-gradient">key</i>
                  </span>
                  <div class="timeline-content">
                     <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                     <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                  </div>
               </div>
               <div class="timeline-block">
                  <span class="timeline-step">
                     <i class="material-icons text-dark text-gradient">payments</i>
                  </span>
                  <div class="timeline-content">
                     <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                     <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row mt-4">
   <div class="col-12">
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
                     <tr>
                        <td>
                           <div class="d-flex px-3 py-1">
                              <div>
                                 <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/blue-shoe.jpg" class="avatar me-3" alt="image">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">Denso Horn </h6>
                                 <p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success">8.232</span> orders</p>
                              </div>
                           </div>
                        </td>
                        <td>
                           <p class="text-sm font-weight-normal mb-0">₦17,000</p>
                        </td>

                     </tr>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>




@endsection