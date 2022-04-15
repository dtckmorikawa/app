@extends("layouts.app")

@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
    {{ session('flash_message') }}
</div>
@endif

@section("content")
    <h5>管理者 - ロールの編集</h5>
    <form method='post' action='{{route("adminrole.update",$target_user->id)}}' enctype="multipart/form-data" >
        @csrf
        @method("patch")
        @include("admin-role.form", ['target_user' => $target_user])<br>
        <input type="hidden" id="user_role" name="user_role" />
        <input style="margin: 20px 0px 50px 0px;" id='rolesub' type='submit' class='btn btn-primary' value='更新' >
    </form>
@endsection