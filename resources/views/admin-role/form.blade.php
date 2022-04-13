<div class="form-group">
    <input type="hidden" 
            class="form-control"
            id="target_user_id"
            name="target_user_id" 
            value="{{$target_user->id}}" >
</div>
<div class="form-group">
    <label for="user_name">名前</label>
    <h5 class="form-control" style=''>{{$target_user->name}}</h5>
</div>

<div class="form-group">
    <label for="user_id">社員番号</label>
    <h5 class="form-control" style=''>{{$target_user->id}}</h5>
</div>

<div class="form-group">
    <label for="user_department">所属</label>
    <h5 class="form-control" style=''>{{$target_user->department}}</h5>
</div>

<div class="form-group">
    <label for="role">権限</label>
    <div>
    {{Form::select('admin_value', [
        '0' => 'なし',
        '1' => 'ドキュメント管理者',
        '2' => '承認者'],
        $target_user->admin,
        ['class' => 'form-control']
    )}}
    </div>
</div>