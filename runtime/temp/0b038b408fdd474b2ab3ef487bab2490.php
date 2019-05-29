<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"C:\xampp\htdocs\pro\public/../application/index\view\login\index.html";i:1559138579;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>学生登录</title>
<link href="__PUBLIC__/css/mui.min.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		.databaseName{
			font-size:1.5em;
			color:#fff;
			margin-top:1em;
		}
		.line{
			margin-bottom:2em;		
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
												<a href="<?php echo url('login/login',array('id'=>$vo['id'])); ?>">		
													<span class="fa fa-database"></span>
													<p class="databaseName"><?php echo $vo['sname']; ?></p>
												</a>	
											</div>
										 <?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
				</div>
		</div>
		<!--start-copyright-->
				<div class="copy-right">
					<p>Copyright &copy; 2019.<a target="_blank" href="#"></a></p>
			</div>
		<!--//end-copyright-->
</body>
</html>