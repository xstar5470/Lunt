@extends('layout.main')
@section('content')
    <div class="col-sm-8 blog-main">
        <form id="formAdd" onsubmit="return false">
           {{csrf_field()}}
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content"  style="height:300px;" name="content" placeholder="这里是内容"></textarea>
            </div>

            <button type="submit" id="submit" class="btn btn-default">提交</button>
        </form>
        <br>
    </div>

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
@endsection


