@extends("Admin.master")

@section("content")
    <div class="row my-5">
        <div class="col-12 mb-4">
            <h4 class="text-center text-info">Issue Tickets And Developer Assign</h4>
        </div>
        <div class="col-8">
            @if(session('message'))
                <span class="text-success mb-3"> {{ session('message') }} </span>
            @endif
            <div class="">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($issues as $issue)
                            <tr>
                                <td>{{ $issue->id }}</td>
                                <td>{{ $issue->title }}</td>
                                <td>{{ $issue->issue_type->type }}</td>

                                @if($issue->is_resolved)
                                    <td>
                                        <span class="badge text-bg-success">resolved</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge text-bg-warning">pending</span>
                                    </td>
                                @endif
                                <td>
                                    <span class="btn btn-info btn-sm px-3 detail_btn" id="{{ $issue->id }}" data="{{ $issue->id }}" >Detail</span>
                                    @if(!$issue->is_resolved)
                                        <a href="{{ route('status.update',$issue->id) }}" class="btn btn-sm btn-success">
                                            resolve
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $issue->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4">
            <div class="" id="detailDiv"></div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $(document).ready(function(){
            $(".detail_btn").click(function () {

                var id = $(this).prop("id");

                $.ajax({
                    type : "GET",
                    url  : "/admin/issue-ticket/detail/"+id ,
                    success: function (response) {

                        $("#detailDiv").html(response);

                    },
                    error: function(e){
                        console.log(e.responseText);
                    },
                    statusCode: {
                        404: () => alert( "page not found" )
                    },
                })
            });
        });
    </script>
@endsection
