@extends("layout/main")
@section("content")
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title">{{$post->title}}</h2>
                    @can('update',$post)
                    <a style="margin: auto"  href="/posts/{{$post->id}}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endcan


                    @can('delete',$post)
                    <a style="margin: auto"  href="javascript:void(0)" onclick="del({{$post->id}})">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    @endcan
                </div>

                <p class="blog-post-meta">{{$post->created_at}} by <a href="#"></a></p>

                <p>{!!$post->content !!}<p>
                <div>


                </div>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                {{--<ul class="list-group">--}}
                    {{--@foreach($post->comments as $comment)--}}
                        {{--<li class="list-group-item">--}}
                            {{--<h5>{{$comment->created_at->toFormattedDateString()}} by {{$post->user->name}}</h5>--}}
                            {{--<div>--}}
                                {{--{{$comment->content}}--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="/posts/{{$post->id}}/comment" method="post">
                        {{csrf_field()}}
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            <button class="btn btn-default" type="submit">提交</button>
                        </li>
                    </form>

                </ul>
            </div>

        </div><!-- /.blog-main -->
        <script>
            function del(id){
                swal({
                    title: '确定删除？',
                    text: '删除后将找不回数据',
                    type: 'info',
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: false
                }, function () {
                    $.ajax({
                        url:"/posts/"+id+"/delete",
                        type:"POST",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        success:function(data){
                            if(data.code == 0){
                                swalreload('删除成功','/posts');
                            }else{
                                swal(data.message, '', 'error');
                            }
                        },
                        error:function(){
                            swal('请求超时，稍后再试', '', 'error');
                        }
                    })
                });

            }
        </script>
@stop



