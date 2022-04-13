<!DOCTYPE html>

<html>

<head>

    <title>トピック相関図</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">

</head>

<body>

<div class="container">

    <div class="panel panel-primary">

        <div class="panel-heading">トピック相関図</div>

        <div class="panel-body">

            <div class="row">

                <div class="col-md-6">

                    <ul id="tree1">

                        @foreach($hierarchies as $hierarchy)

                            <li>
                                @if($hierarchy->deleted == 0)
                                    <a href="{{ $url = route('blogetc.single', ['id' => $hierarchy->title]) }}"
                                        target="_blank">{{ $hierarchy->title }}</a>
                                @else
                                    {{ $hierarchy->title }}
                                @endif

                                @if(count($hierarchy->childs))

                                    @include('hierarchy.manageChild',['childs' => $hierarchy->childs])

                                @endif

                            </li>

                        @endforeach

                    </ul>

                </div>

                <div class="col-md-6">

                {{--<h3>Add New Category</h3>

                    <form role="form" id="category" method="POST" action="{{ route('add.book.hierarchy') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                        <label>Title:</label>

                        <input type="text" id="title" name="title" value="" class="form-control" placeholder="Enter Title">
                        @if ($errors->has('title'))
                            <span class="text-red" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif

                    </div>


                    <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">

                        <label>Category:</label>
                        <select id="parent_id" name="parent_id" class="form-control">
                            <option value="0">Select</option>
                            @foreach($allHierarchies as $rows)
                                    <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('parent_id'))
                            <span class="text-red" role="alert">
                                <strong>{{ $errors->first('parent_id') }}</strong>
                            </span>
                        @endif

                    </div>


                    <div class="form-group">

                        <button type="submit" class="btn btn-success">Add New</button>

                    </div>
                    </form>
                </div>--}}
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/treeview.js') }}"></script>

</body>

</html>