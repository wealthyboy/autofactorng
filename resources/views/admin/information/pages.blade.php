@foreach($page->children as $page)
        <option class="" value="{{ $page->id }}">{{ html_entity_decode($space)}}{{ $page->title }} </option>
    @include('information.pages',['page'=>$category->children,'space'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'])
@endforeach