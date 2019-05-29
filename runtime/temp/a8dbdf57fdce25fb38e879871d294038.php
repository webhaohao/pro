<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"C:\xampp\htdocs\pro\public/../application/index\view\result\index.html";i:1558934475;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>首页</title>
<link href="__PUBLIC__/css/mui.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css">
 <!-- 引入样式 -->
<link rel="stylesheet" href="__PUBLIC__/css/elementui.css">
<link rel="stylesheet" href="__PUBLIC__/css/toastr.min.css">
<link href="__PUBLIC__/css/style.css" rel='stylesheet' type='text/css'/>
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="App Loction Form,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements"./>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
<!-- <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800' rel='stylesheet' type='text/css'> -->
<!--//webfonts-->
<style>
	.tb-edit .el-table__row .el-input {
   	 	display:none;
	}
	.el-input__inner{
			padding:0px 2px;
	}
	.tb-edit .current-row .el-input {
			display: block;
	}
	.tb-edit .current-row .el-input+span {
			display: none;
	}
	.demo-form-inline{
			text-align:center;
	}
	.demo-form-inline .el-form-item__label{
			color:#fff;
	}
	.el-table td, .el-table th{
			text-align:center;
	}
	.el-table th>.cell{
			text-align:center;
	}
	input[type=text]{
			margin-bottom:0px;
	}
	h4{
		color:#fff;font-size:1.2em;line-height:2;margin-bottom:1em;
	}
	.master_user .el-form-item{
			margin-top:20px;
	}
	.title{
		margin-top:1em;
	}
	.base64{
		background:#fff;
		margin-top:1em;	
	}
	.base64 img{
		width:50%;
	}
	h5{
		color:#fff;
	}
</style>
</head>
<body>
		<div id="app">
		<div class="app-location app-main">
			<h5 class="title">{{content}}</h5>
			<h2>无纸化仓库管理</h2>
			<div class="line"><span></span></div>
			<h4>当前仓库:<?php echo $store['sname']; ?></h4>
			<h4>{{type? '领取列表':'清退列表'}}</h4>

			<el-table size="mini" :data="tableData" border style="width: 100%" highlight-current-row>
				<!-- <el-table-column type="index"></el-table-column> -->
				<el-table-column v-for="(v,i) in columns" :prop="v.field" :label="v.title" :width="v.width">
						<template slot-scope="scope">
								<span>{{scope.row[v.field]}}</span>
						</template>
				</el-table-column>
			</el-table>
			<h4 class="title">电子签名照片</h4>
			<div class="base64">
					<img :src="base64" alt="">
			</div>
		</div>
	<!--start-copyright-->
   		<div class="copy-right">
				<p>Copyright &copy; 2019.<a target="_blank" href="#"></a></p>
		</div>
	</div>
	<!--//end-copyright-->
	<script src="__PUBLIC__/js/vue.js"></script>
	<!-- 引入组件库 -->
	<script src="__PUBLIC__/js/elementui.js"></script>
	<script src="__PUBLIC__/js/jquery.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/jSignature.min.js"></script>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="__PUBLIC__/js/flashcanvas.js"></script>
	<![endif]-->
	<script src="__PUBLIC__/js/toastr.min.js"></script>
	<script src="__PUBLIC__/js/common.js"></script>
	<script>
    var app = new Vue({
        el: '#app',
        data: {
					userInfo:{
							uname:'',
							sno:''
					},
					type:0,
					columns:[],
					tableData:[],
					base64:'',
					totalTime:30,
					content:''
        },
		mounted() {
					let data =JSON.parse(sessionStorage.getItem('data'));
					console.log(data);
					this.type = data.type;
					this.columns=data.columns;
					this.tableData=data.tableData;
					console.log(data.base64);
					this.base64 =data.base64;
					let clock = window.setInterval(()=>{
							this.totalTime--;
							this.content = this.totalTime+'秒自动跳转到首页';
							if(this.totalTime<=0){
								window.clearInterval(clock);
								location.href='/index/index';
							}	
					},1000)
		},	
        methods: {
        }
    })
</script> 
</body>
</html>