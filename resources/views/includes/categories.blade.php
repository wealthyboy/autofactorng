
<div class="nav-dropdown">
    <ul>
        @foreach($category->children  as $category)
            <li class="nav-menu-item">
                <a href="/products/{{ $category->slug }}">{{ $category->name }}</a>            
            </li>
        @endforeach
    </ul>
</div>

   
  



