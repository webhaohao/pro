<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"C:\xampp\htdocs\pro\public/../application/index\view\login\index.html";i:1559558259;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>学生登录</title>
<link href="__PUBLIC__/css/mui.min.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__PUBLIC__/css/toastr.min.css">
<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css">
<meta name="keywords" content="App Loction Form,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements"./>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</script>
<!--webfonts-->
<!-- <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800' rel='stylesheet' type='text/css'> -->
<!--//webfonts-->
</head>
<style>
		.swiper-container{
			    margin-top:3em;
		}
		.swiper-container span{
				font-size:10em;
				color:#fff;
				display:block;
		}
		.swiper-container .swiper-slide{
				margin-bottom:2em;
		}
		.swiper-container .swiper-slide a{
			cursor: pointer;
		}
		.databaseName{
			font-size:1.5em;
			color:#fff;
			margin-top:1em;
		}
		.line{
			margin-bottom:2em;		
		}
		.login{
			width:70%;
			position: absolute;
			top:50%;
			left:50%;
			transform:translate(-50%,-50%);
		}
		.login input[type="submit"]{
			width:50%;
			padding:5px 10px;
		}
		.app-location input[type="password"]{
			background:none;
			border:1px solid #fff;	
			padding-left:2em;
		}
		.modal{
			 width:100%;
			 height:100%;
			 background:rgba(0,0,0,.7);
			 position: fixed;
			 left:0;
			 overflow: hidden;
			 top:0%;
			 display:flex;
			 justify-content:center;
			 align-items:center;
			 display:none;
		}
</style>
<body>
	  <h1></h1>
		<div class="app-location">
			<h2>无纸化仓库管理</h2>
			<div class="line"><span></span></div>
			<input type="submit" value="请选择仓库">
				<div class="swiper-container">
								<div class="swiper-wrapper">
										 <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<div class="swiper-slide">
												<a href="<?php echo $vo['id']; ?>">		
													<span class="fa fa-database"></span>
													<p class="databaseName"><?php echo $vo['sname']; ?></p>
												</a>	
											</div>
										 <?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
				</div>
		</div>
		<div class="modal">
			<div class="app-location login">
				<div class="line"><span></span></div>
				<form action="/index/login" method="post">
					<input type="hidden" value="" name="storeid">
					<input type="password" placeholder="请输入密码" name="pwd">
					<div class="submit"><input type="submit"  value="登录" ></div>
					<div class="clear"></div>
					<div class="new">
						<!-- <h3><a href="#">Forgot password ?</a></h3>
						<h4><a href="#">New here ? Sign Up</a></h4> -->
						<div class="clear"></div>
					</div>
				</form>
			</div>
		</div>
		<!--start-copyright-->
				<div class="copy-right">
					<p>Copyright &copy; 2019.<a target="_blank" href="#"></a></p>
			</div>
		<!--//end-copyright-->
		<script src="__PUBLIC__/js/jquery.js"></script>
		<script src="__PUBLIC__/js/toastr.min.js"></script>
		<script>
				$(function(){
					$(".swiper-wrapper a").on('click',function(e){
							e.preventDefault();
							var id = $(this).attr('href');
							$("input[name='storeid']").val(id);
							$(".modal").fadeIn();
					})
					$(".modal").on('click',function(e){
						var _con = $(".login"); 
						if(!_con.is(e.target) && _con.has(e.target).length === 0){ 
							$(this).fadeOut();
						}
						
					})
					$(".login input[type=submit]").on('click',function(e){
							e.preventDefault();
							if($.trim($("input[name='pwd']").val())){
								var d={
									id:$("input[name='storeid']").val(),
								 	pwd:$("input[name='pwd']").val()
								}
								$.ajax({
									url:'/index/login/login',
									data:d,
									type:'POST',
									success:function(data){
										console.log(data);
										if(data=="succ"){
											toastr.info('登录成功!');
											location.href="/index/index?storeid="+d.id;
										}
										else{
											toastr.error('密码错误!');
										}
									}
								})	
							}
							else{
										toastr.error('请输入密码!');	
							}
						
					})	
				})
		</script>
</body>
</html>