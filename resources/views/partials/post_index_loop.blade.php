<div class="" style='max-width:200px; margin: 10px auto; background: #fffbea;border-radius:3px;padding:0;' >

    {{--<div class='text-center'>--}}
    <div class='text-center'>
        <?=$post->image_tag("medium", true, ''); ?>
    </div>
    
    <div style='padding:10px;'>
        <h5 class=''><a href='{{$post->url()}}'>{{$post->title}}</a></h3>
        {{--<h5 class=''>{{$post->subtitle}}</h5>--}}
        <p>{!! $post->generate_introduction(50) !!}</p>
    </div>

</div>