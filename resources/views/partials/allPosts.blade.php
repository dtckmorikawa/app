{{--Categories Filter--}}
<div class="btn">
    <ul class="ddmenu">
        <li><a href="#">選択してください</a>
            <ul>
                @foreach($categories as $category)
                    <li><a href="" data-filter="{{ $category->category_name }}">{{ $category->category_name }}</a></li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>

<ul class="all-posts-sortable block list">
    @forelse($posts as $post)
        @foreach($post->categories as $cat)
            <li draggable="true"
                data-category="{{$cat->category_name}}"
                catid="{{$cat->id}}" 
                post_id="{{$post->id}}" 
                post_slug={{$post->slug}}>
                <p>{{ $post->title }}</p>
                <ul></ul>
            </li>
        @endforeach
    @empty
        <li >まだトピックがありません。</li>
    @endforelse
</ul>