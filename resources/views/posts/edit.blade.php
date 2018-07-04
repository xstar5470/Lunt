@extends("layout/main")
@section("content")
        <div class="col-sm-8 blog-main">
            <form onsubmit="return false" id="formAdd">
                {{ csrf_field() }}
                <input type="hidden" value="{{$post->id}}" name="post_id">
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$post->title}} ">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea id="content" name="content"  style="height:300px;"  placeholder="这里是内容">{!! $post->content !!}</textarea>
                </div>

                <button type="submit" id="submit" class="btn btn-default">提交</button>
            </form>
            <br>
            <script>
                var ue_text = UE.getEditor('content');
                $('#submit').click(function(){
                    $.ajax({
                        url:'/posts',
                        type:"POST",
                        data:new FormData($('#formAdd')[0]),
                        contentType:false,
                        processData:false,
                        dataType:'Json',
                        success:function(data){
                            console.log(data.code);
                            if(data.code == 0){
                                swalreload(data.message,'/posts');
                            }else{
                                swal(data.message,'','error');
                            }
                        },
                        error:function(){
                            swal("链接超时",'','error');
                        }
                    })
                })
            </script>
        </div><!-- /.blog-main -->
@stop


