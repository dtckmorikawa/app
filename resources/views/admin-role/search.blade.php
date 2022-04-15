@extends("layouts.app")
@section("content")
@include("partials.admin_user_search")

    <div style='' class=''>
        <h2 class="text-center">「{{$query}}」の検索結果</h2>
    </div>

    @forelse($users as $user)
    <div class="" style='max-width:700px; margin: 10px auto; background: #fffbea;border-radius:3px;padding:0;' >
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <dt class="">名前</dt>
                        <dd class="">{{$user->name}}</dd>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <dt class="">所属</dt>
                        <dd class="">{{$user->department}}</dd> 
                    </div>
                    <div class="col-sm-12 col-md-3">   
                        <dt class="">権限</dt>
                    
                        @if ($user->admin === 1)
                            <dd class="">ドキュメント管理者</dd>
                        @elseif ($user->admin === 2)
                            <dd class="">承認者</dd>
                        @else
                            <dd class="">なし</dd>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <a href="{{route("adminrole.edit", $user->id)}}" 
                            class="card-link btn btn-primary">
                            <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                            権限を編集する</a>  
                    </div>
                </div>             
            </div>
        </div>
    @empty
        <div class='alert alert-danger'>検索結果が０です</div>
    @endforelse
    
    <div class='text-center'>
        {{ $users->links() }}
    </div>    
</div>
@endsection