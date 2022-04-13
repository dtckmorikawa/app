<ul>

    @foreach($childs as $child)

        <li>
        @if($child->deleted == 0)
                <a href="{{ $url = route('book.view', ['id' => $child->title]) }}"
                    target="_blank">{{ $child->title }}</a>
            @else
                {{ $child->title }}
            @endif

            @if(count($child->childs))

                @include('hierarchy.bookManageChild',['childs' => $child->childs])

            @endif

        </li>

    @endforeach

</ul>