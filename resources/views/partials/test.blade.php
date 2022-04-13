
{{--Structured Posts--}}
@php
if($structured_posts){
    $titleList = array_column($structured_posts, 'id', 'title');
    echo "<script>console.log('" . json_encode($titleList) . "');</script>";
}
@endphp
{{-- book structure --}}
<ul id="structure" class="serialization block">
@if($chapters)
    @foreach($chapters as $key1 => $value1)
        @if(is_array($value1))
            <li><ul>
                @foreach($value1 as $key2 => $value2)
                    @if(is_array($value2))
                        <ul>
                            @foreach($value2 as $key3 => $value3)
                                @if(is_array($value3))
                                    <ul>
                                        @foreach($value3 as $key4 => $value4)
                                            <li post_id="{{$value4}}"><p>
                                                   {{array_search($value4, $titleList)}} 
                                            </p></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <li post_id="{{$value3}}"><p>
                                        {{array_search($value3, $titleList)}} 
                                    </p><ul></ul></li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <li post_id="{{$value2}}"><p>
                            {{array_search($value2, $titleList)}}
                        </p><ul></ul></li>
                    @endif
                @endforeach
            </ul></li>
        @else
           <li post_id="{{$value1}}"><p>{{array_search($value2, $titleList)}}</p><ul></ul></li>
        @endif
    @endforeach
@else
    <ul>
    </ul>
@endif
</ul>