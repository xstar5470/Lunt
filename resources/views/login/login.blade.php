<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
    <meta name="keywords" content="">
    <meta name="content" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <link type="text/css" rel="stylesheet" href="/css/login.css">
    <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/sweetalert.js')}}"></script>
</head>
<body class="login_bj" >
<div class="zhuce_body">
    <div class="zhuce_kong login_kuang">
    	<div class="zc">
        	<div class="bj_bai">
            <h3>登录</h3>
       	  	  <form onsubmit="return false" id="formAdd">
                  {{csrf_field()}}
                <input name="nickname" type="text" class="kuang_txt" placeholder="账号">
                <input name="password" type="password" class="kuang_txt" placeholder="密码">
                <input name="登录" type="button" class="btn_zhuce btn_login" value="登录">
                  <div>
                    <input name="is_remember" type="checkbox" value="1" ><span>记住我</span>
                  </div>
                </form>
            </div>
        	<div class="bj_right">
            	<p>使用以下账号直接登录</p>
                <a href="#" class="zhuce_qq">QQ登录</a>
                <a href="#" class="zhuce_wb">微博登录</a>
                <a href="#" class="zhuce_wx">微信登录</a>
                <p>已有账号？<a href="#">立即登录</a></p>
            
            </div>
        </div>
        <P>Lunt.com&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;欢迎您</P>
    </div>

</div>
<script>
    $('.btn_login').click(function(){
        $.ajax({
            url:'/login',
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
</body>
</html>