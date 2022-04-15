<ul>

    @foreach($childs as $child)

        <li>
        @if($child->deleted == 0)
                <a href="{{ $url = route('blogetc.single', ['id' => $child->title]) }}"
                    target="_blank">{{ $child->title }}</a>
            @else
                {{ $child->title }}
            @endif

            @if(count($child->childs))

                @include('hierarchy.manageChild',['childs' => $child->childs])

            @endif

        </li>

    @endforeach

</ul>