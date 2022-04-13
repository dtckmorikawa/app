<div class="" style='max-width:700px; margin: 10px auto; background: #fffbea;border-radius:3px;padding:0;' >
    
    <div style='padding:10px;'>
        <h3 class=''><a href='{{route('book.view',['bookSlug'=>$book->slug])}}'>{{$book->book_name}}</a></h3>
        <h5 class=''>{{$book->book_description}}</h5>
    </div>
    
    <div class='text-center'>
            <a href="{{route('book.view',['bookSlug'=>$book->slug])}}" class="btn btn-primary">表示</a>
    </div>
</div>
