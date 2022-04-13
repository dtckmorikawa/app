@extends("blogetc_admin::layouts.admin_layout")
@section("content")


    <h5>管理者 - ブックを追加</h5>

    <form method='post' action='{{route("adminbook.store")}}'  enctype="multipart/form-data" >

        @csrf
        @include("admin-book.form", ['book' => new \App\Books()])

        <input type='submit' class='btn btn-primary' value='保存' >

    </form>

@endsection