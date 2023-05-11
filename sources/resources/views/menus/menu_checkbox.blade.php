@foreach($data['menu'] as $menu)
    <ul style="list-style-type: none;">
        <li>
        <input type="checkbox"><b>{{$menu->label}}</b>
        @if(count($menu->children) > 0)
        @foreach($menu->children as $submenu) 
        <ul style="list-style-type: none;">
            <li>
            <input type="checkbox">{{$submenu->label}}
            </li>
        </ul>
        @endforeach
        @endif
        </li>
    </ul>
@endforeach