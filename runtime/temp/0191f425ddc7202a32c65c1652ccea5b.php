<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"C:\xampp\htdocs\pro\public/../application/index\view\index\index.html";i:1558967331;}*/ ?>
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
</style>
</head>
<body>
		<div id="app">
		<div class="modal" v-if="isModalshow">
							<div class="modal-content">
										<span class="btn" @click="getType(1)">领取</span>
										<span class="btn" @click="getType(0)">清退</span>
							</div>
		</div>	
		<div class="app-location app-main">
			<h2>无纸化仓库管理</h2>
			<div class="line"><span></span></div>
			<h4>当前仓库:<?php echo $store['sname']; ?></h4>
			<h4>进行的操作:{{type? '领取':'清退'}}</h4>
			<el-form :inline="true" :model="userInfo" class="demo-form-inline" :rules="rules" ref="ruleForm">
					<el-form-item label="学号" prop="sno">
							<el-input v-model="userInfo.sno" placeholder="" @blur="snoBlur"></el-input>
					</el-form-item>
					<el-form-item label="姓名" prop="uname">
						<el-input v-model="userInfo.uname" placeholder=""></el-input>
					</el-form-item>
			</el-form>
			<el-form ref="user" class="master_user" :model="master_user" :rules="rules">
				<el-table size="mini" :data="master_user.data" border style="width: 100%" highlight-current-row>
						<!-- <el-table-column type="index"></el-table-column> -->
						<el-table-column v-for="(v,i) in master_user.columns" :prop="v.field" :label="v.title" :width="v.width">
								<template slot-scope="scope">
										<el-form-item v-if="scope.row.isSet" :rules="rules[v.field]" :prop="'data.'+scope.$index+'.'+[v.field]" >
												<el-input size="mini" placeholder="请输入内容" v-model="scope.row[v.field]">
												</el-input>
										</el-form-item>
										<span v-else>{{scope.row[v.field]}}</span>
								</template>
						</el-table-column>
						<el-table-column label="操作" width="100">
								<template slot-scope="scope">
										<!-- <span class="el-tag el-tag--info el-tag--mini" style="cursor: pointer;" @click="pwdChange(scope.row,scope.$index,true)">
												{{scope.row.isSet?'保存':"修改"}}
										</span> -->
										<span v-if="scope.row.isSet" class="el-tag el-tag--danger el-tag--mini" style="cursor: pointer;" @click="pwdChange(scope.row,scope.$index,false)">
												删除
										</span>
										<!-- <span v-else class="el-tag  el-tag--mini" style="cursor: pointer;" @click="pwdChange(scope.row,scope.$index,false)">
												取消
										</span> -->
								</template>
						</el-table-column>
				</el-table>
			</el-form>		
				<div class="submit addInfo" @click="addInfo"><input type="submit"  value="添加"></div>
				<div class="submit" @click="final"><input type="submit"  value="签名提交"></div>
			</div>		
				<div class="canvasWrap" style="display:none;">
						<div id="signature">
				</div>
				<div class="bar">
						<button  @click="clear"><span class="fa fa-trash-o" style="margin-right:.5em"></span>清除</button>
						<button  @click="formSubmit"><span class="fa fa-plus-square" style="margin-right:.5em"></span>签名提交</button>
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
			data() {
				const checkSerialnum = (rule,value,callback)=>{
					  let i = rule.field.split('.')[1];
						if(value=="" &&this.master_user.data[i].serialdes){
							callback(new Error('请输入资产编号'));	
						}
						callback();
				};
				const checkSerialdes = (rule,value,callback)=>{
						let i = rule.field.split('.')[1];
						if(value==""&&this.master_user.data[i].serialnum){
								callback(new Error('请输入资产描述'));				
						}
						callback();
				}
				const checkPartIntr = (rule,value,callback)=>{
						let i = rule.field.split('.')[1];
						if(value==""&&this.master_user.data[i].count){
								callback(new Error('请输入配件描述'));	
						}
						callback();
				};
				const checkCount = (rule,value,callback)=>{
						let i = rule.field.split('.')[1];
						if(this.master_user.data[i].partIntr && value==""){
								callback(new Error('请输入数量'));				
						}
						callback();
				}		
				return {
					isModalshow:true,
					userInfo:{
							uname:'',
							sno:''
					},
					type:0,
					master_user: {
						sel: null,//选中行  
						columns: [
									{ field: "serialnum", title: "资产编号", width: 120 },
									{ field: "serialdes", title: "资产描述", width: 150 },
									{ field: "partIntr", title: "配件描述", width: 120 },
									{ field: "count", title: "配件数量", width: 100 },
									{ field: "remarks", title: "备注" }
						],
						data: []
					},
					rules:{
							uname:[
									{required:true, message:'请输入姓名', trigger:'blur'}
							],
							sno:[
									{required:true, message:'请输入学号',trigger:'blur'}
							],
							serialnum:[
									{validator:checkSerialnum, trigger:'blur'}		
							],
							serialdes:[
									{validator:checkSerialdes, trigger:'blur'}		
							],
							partIntr:[
									{validator:checkPartIntr, trigger:'blur'}		
							],
							count:[
										{validator:checkCount, trigger:'blur'}		
							]
					},
					Strokes:0
			}	
        },
		mounted() {
						let self  = this;
						//this.$refs.multipleTable.toggleRowSelection(this.tableData[0],true);
						$("#signature").on('change',function(){
									self.Strokes++;
						})		
						let j = {id:0,"serialnum": "", "serialdes": "", "partIntr": "", "count": "", "remarks": "", "isSet": true, "_temporary": true };
						this.master_user.data.push(JSON.parse(JSON.stringify(j)));
						this.master_user.sel = JSON.parse(JSON.stringify(j));		
				},	
        methods: {
					addInfo(){
						// for (let i of app.master_user.data) {
						// 				if (i.isSet) return this.$message.warning("请先保存当前编辑项");
						// }
						let j = {id:0,"serialnum": "", "serialdes": "", "partIntr": "", "count": "", "remarks": "", "isSet": true, "_temporary": true };
						this.master_user.data.push(j);
						this.master_user.sel = JSON.parse(JSON.stringify(j));
					},
					readMasterUser() {
                    app.master_user.data.map(i => {
                        // i.id = generateId.get();//模拟后台插入成功后有了id
                        i.isSet=false;//给后台返回数据添加`isSet`标识
                        return i;
                    });
					},
					snoBlur(){
						$.ajax({
							url:'/index/index/selectBysno',
							data:{
								stusno:app.userInfo.sno	
							},
							success:function(data){
								console.log(data);
								if(data){
									app.userInfo.uname = data.uname;
								}
							}		
						})
					},
					pwdChange(row, index, cg) {
                    //点击修改 判断是否已经保存所有操作
                    // for (let i of app.master_user.data) {
                    //     if (i.isSet && i.id != row.id) {
                    //         app.$message.warning("请先保存当前编辑项");
                    //         return false;
                    //     }
                    // }
                    //是否是取消操作
                    if (!cg) {
                        if (!app.master_user.sel.id) app.master_user.data.splice(index, 1);
                        return row.isSet = !row.isSet;
                    }
                    //提交数据
                    if (row.isSet) {
												//检查数据是否有效
														app.$refs["user"].validate((valid)=>{
																	if(valid){
																				let data = JSON.parse(JSON.stringify(app.master_user.sel));
																				for (let k in data) {
																					if(!data['serialnum']&&!data['serialdes']&&!data['partIntr']&&!data['count']){
																						app.$message({
																							type:'error',
																							message:`请填写${this.type?'领取':'清退'}信息!`	
																						})
																						return false;
																					}
																					row[k] = data[k];
																				}
																				
																				app.$message({
																						type: 'success',
																						message: "保存成功!"
																				});
																				//然后这边重新读取表格数据
																				app.readMasterUser();
																				row.isSet = false;	
																	}
														})	
														return false;
													
                    } else {
                        app.master_user.sel = JSON.parse(JSON.stringify(row));
                        row.isSet = true;
                    }
					},
					getType(type){
								this.type = type;
								this.isModalshow = false;
					},
					clear(){
								this.Strokes = 0 ;
								$("#signature").jSignature("reset");
					},
					formSubmit(){
						if(this.Strokes<2){
										toastr.error('请完善签名!');
										return false;
								}
						let base =	 $("#signature").jSignature("getData", "image")[0];	
						let datapair = $("#signature").jSignature("getData", "image")[1];
						console.log(datapair);
						let info = {
									datapair:datapair,
									tableData:app.master_user.data,
									userInfo:app.userInfo,
									type:app.type,
									columns:app.master_user.columns,
									base64:"data:"+base+","+datapair
						}
						var self =	this;
						$.ajax({
								url:'/index/Upload',
								type:'POST',
								data:{
										data:JSON.stringify(info)
								},
								success:function(data){
											if(data="succ"){
														toastr.info('上传成功!');
														setTimeout(function(){
																sessionStorage.setItem('data',JSON.stringify(info));
																location.href='/index/Result';
																
														},1000)
													
														// $(".canvasWrap").fadeOut('slow',function(){
														// 			let j = {id:0,"serialnum": "", "serialdes": "", "partIntr": "", "count": "", "remarks": "", "isSet": true, "_temporary": true };
														// 			app.master_user.data=[j]
														// 			app.master_user.sel = JSON.parse(JSON.stringify(j));
														// });
													
											}
								}	
						})
					},
					final(){
						this.$refs["ruleForm"].validate((valid)=>{
									if(valid){
										this.$refs["user"].validate((valid)=>{
													if(valid){
														let data = 	this.master_user.data
														for (let k in data) {
																	if(!data[k]['serialnum']&&!data[k]['serialdes']&&!data[k]['partIntr']&&!data[k]['count']){
																		app.$message({
																			type:'error',
																			message:`请填写${this.type?'领取':'清退'}信息!`	
																		})
																		return false;
																	}
														}
														$(".canvasWrap").fadeIn('fast',function(){
																	var width =  document.documentElement.clientWidth,height= document.documentElement.clientHeight;
																$("#signature").jSignature({
																	height:height,width:width,color:"#000",signatureLine:false,lineWidth:6
																})
														})
													}				
												
										})		
									}
									return false;
							})
							return false;
						
						}
        }
    })
</script> 
</body>
</html>