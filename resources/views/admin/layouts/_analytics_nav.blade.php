<li class="nav-item">
   <a data-bs-toggle="collapse" href="#analyticsMenu" class="nav-link text-white {{ $helper->active_link(['analytics']) }}" aria-controls="analyticsMenu" role="button" aria-expanded="false">
      <i class="material-symbols-outlined">bar_chart</i>
      <span class="nav-link-text ms-2 ps-1">Analytics</span>
   </a>
   <div class="collapse {{ $helper->active_link(['analytics']) ? 'show' : '' }}" id="analyticsMenu">
      <ul class="nav">
         @foreach([
            ['orders', 'O', 'Orders'], ['products', 'P', 'Products'], ['customers', 'C', 'Customers'],
            ['inventory', 'I', 'Inventory'], ['marketing', 'M', 'Marketing'], ['search', 'S', 'Search'], ['all', 'A', 'All']
         ] as $analyticsLink)
         <li class="nav-item">
            <a class="nav-link text-white {{ request()->is('admin/analytics/'.$analyticsLink[0].'*') ? 'active' : '' }}" href="{{ route('admin.analytics.'.$analyticsLink[0]) }}">
               <span class="sidenav-mini-icon"> {{ $analyticsLink[1] }} </span>
               <span class="sidenav-normal ms-2 ps-1"> {{ $analyticsLink[2] }} </span>
            </a>
         </li>
         @endforeach
      </ul>
   </div>
</li>
