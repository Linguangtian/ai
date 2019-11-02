<?php  

	/**
	* 会员管理控制器
	*/
	class MemberAction extends CommonAction{

		//会员列表
		public function check(){
			
			$map = $this -> _search();
			$pid=I('get.pid',0,'intval');
			if(!empty($pid)){
				$map['parent_id'] = array('eq',$pid);	
			}
			$type=$_POST['type'];
			$typename=$_POST['typename'];
			
	        if (!empty($type) && !empty($typename)) {
				if($type ==1){
					$map['username']=	$typename;
				}elseif($type ==2){
					$map['truename']=$typename;	
				}

	        }			
			if (method_exists($this, '_search_filter')) {
				$this -> _search_filter($map);
			}
			$name = $this -> getActionName();
			
			
			$model = D($name);
			if (!empty($model)) {
				$this -> _list($model, $map);
			}
			$this->display();
		}
		
		
		
			//已封
		public function lockuser(){
			
			$map = $this -> _search();
			$map['lock'] = array('eq',1);
			$type=$_POST['type'];
			$typename=$_POST['typename'];
			
	        if (!empty($type) && !empty($typename)) {
				if($type ==1){
					$map['username']=	$typename;
				}elseif($type ==2){
					$map['truename']=$typename;	
				}
	        }			
			if (method_exists($this, '_search_filter')) {
				$this -> _search_filter($map);
			}
			$name = $this -> getActionName();
			
			$model = D($name);
			if (!empty($model)) {
				$this -> _list($model, $map);
			}

			$this->display();
		}



		public function gaward(){

				$product=M('product')->where("is_on=0")->select();
				$this->assign('product',$product);
				$this->display();
			
	    }
		public function gawardpost(){
			
				$username=I('post.username');
				$num=I('post.num',0,'intval');
				

				if(empty($username)){
					$this->error('请输入会员账号');	
				}
				if(empty($num)){
						$this->error('请选择机器人');
					}	
				
				$userinfo=M('member')->where(array('id'=>$username))->find();
				$product = M("product");
		
				//查询机器人信息
				$data = $product ->where(array('id'=>$num))-> find();
				// var_dump($data);exit;
				if(empty($userinfo)){
					$this->error('没有该会员,请正确输入');	
				}else{
			$map = array();
			$map['kjbh'] = 'Z' . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
			$map['user'] = $userinfo['username'];
			$map['user_id'] = $userinfo['id'];
			$map['project']= $data['title'];
			$map['sid'] = $data['id'];
			$map['yxzq'] = $data['yxzq'];		
			$map['sumprice'] = $data['price'];
			$map['addtime'] = date('Y-m-d H:i:s');	
			$map['imagepath'] = $data['thumb'];
			$map['lixi']	= $data['gonglv'];
			$map['shouyi'] =  $data['shouyi'];
			$map['zt'] =  1;	
			$map['UG_getTime'] =  time();		  
			M('order')->add($map);
			M("member")->where(array("id"=>$userinfo['id']))->setInc("mygonglv",$map['lixi']);		
			//$product->where(array("id"=>$id))->setDec("stock");
			//$parentpath = M("member")->where(array("username"=>$userinfo['username']))->getField("parentpath");
			add_award_log($userinfo['id'],1,0,1,$num);
			$mai['username'] = $userinfo['username'];
			$mai['number'] = $num;
			$mai['addtime'] = time();
			M('mai_log')->add($mai);
				$this->success("执行成功！");
				}
			
	    }

		//封号解封处理
		public function editFeng(){
			$lock = I('get.lock',0,'intval');
			$id = I('get.id',0,'intval');
			M('member')->where(array('id'=>$id))->save(array("lock"=>$lock));
            $this->success('设置成功！',U(GROUP_NAME.'/Member/check'));

		}
		/**
		 * 金币充值
		 * @return [type] [description]
		 */
		public function addJinbi(){
			$member = M('member')->where(array('id'=>I('get.id',0,'intval')))->find();
			
			$map['desc'] = '平台充值';
			$map['member'] = $member['username'];
			$list = M("jinbidetail")->where($map)->order("id desc")->select();
			$this->assign('list',$list);	
            $this->assign('member',$member);			
			$this->display();
		}

		/**
		 * 金币充值处理函数
		 * @return [type] [description]
		 */
		public function addJinbiHandle(){
			$userid = I('post.id',0,'intval');
			 $jinbi  = I('post.money',0,'intval');
			
			$member = M('member')->where(array('id'=>$userid))->find();
			if($jinbi>0){
		        M('member')->where(array('id'=>$userid))->setInc('money',$jinbi);
				//写入充值记录
				$data            = array();
				$data['member']  = $member['username'];
				$data['adds']     = $jinbi;
				$data['balance'] = $member['money'] + $jinbi;
				$data['addtime'] = time();
				$data['desc']    = '平台充值';
				M('jinbidetail')->add($data);
				$this->success('充值成功！',U(GROUP_NAME.'/Member/check'));
			}elseif($jinbi<0){
				$oldjinbi =$member['money'];
				$jinbi =abs($jinbi);
                 M('member')->where(array('id'=>$userid))->setDec('money',$jinbi);
				$data = array();
				$data['member']  = $member['username'];
				$data['reduce']  = $jinbi;
				$data['balance'] = (floatval($oldjinbi) - floatval($jinbi));
				$data['addtime'] = time();
				$data['desc']    = '平台充值';
				M('jinbidetail')->add($data);		
                $this->success('扣除成功！',U(GROUP_NAME.'/Member/check'));				
				
			}
			
		}

		//编辑会员
		public function editMember(){
			$member = M('member')->where(array('id'=>I('id')))->find();
			$this->assign('member',$member);
			$this->display();
		}

		//编辑会员处理函数
		public function editMemberHandle(){
			$password = I('password');
			$truename = I('truename');
			
			$id = I('id');
			unset($_POST['id']);
			if ($password!= '') {
				$_POST['password'] = md5($password);
			}else{
				unset($_POST['password']);
			}

			if ($truename != '') {
				$_POST['truename'] = $truename;
			}else{
				unset($_POST['truename']);
			}
			if (M('member')->where(array('id'=>$id))->save($_POST)) {
				$this->success('编辑成功！',U(GROUP_NAME.'/Member/check'));
			}else{
				$this->error('数据没有更改！',U(GROUP_NAME.'/Member/check'));
			}
		}

		/**
		 * 后台直接跳转到会员前台
		 * @return [type] [description]
		 */
		public function inMember(){
			$username = I('get.u');
			$uid = M('member')->where(array('username'=>$username))->getField('id');
			session('mid',$uid);
			session('username',$username);
			session('usersecondlogin','1');
			session('member','adminlogin');
			$this->redirect('Index/Index/index');
		}

		//删除会员
		public function deleteMember(){
			$member = M('member');
			$minfo = $member->where(array('id'=>I('get.id',0,'intval')))->find();
			if ($member->where(array('id'=>$_GET['id'],'status'=>0))->delete()) {
				alert('删除成功！',U(GROUP_NAME.'/Member/uncheck'));
			}else{
				alert('删除失败！',U(GROUP_NAME.'/Member/uncheck'));
			}			
		}
		
	    //树形图
		public function shu_list(){
			Vendor('Tree.tree');
			$menu = new tree;
				$menu->icon = array('│ ','├─ ','└─ ');
				$menu->nbsp = '&nbsp;&nbsp;&nbsp;';
				$result = M('member')->field('id,username,parentcount,parent')->select();
				foreach($result as $k=>$v){
					 
					 $arr[$v['username']] = $v;
					 $arr[$v['username']]['parentid_node'] = ($v['parent'])? ' class="child-of-node-'.$v['parent'].'"' : '';
				}
				$str  = "<tr id='node-\$username' \$parentid_node>
							<td style='padding-left:30px;'>\$spacer 会员编号：\$username (直推人数：\$parentcount)</td>
						</tr>";
			     
				$menu->init($arr);
				$categorys = $menu->get_tree(NULL, $str);		
                $this->assign('categorys',$categorys);					
			    $this->display();
		}

		public function awardlist(){


			$Data = M('member_award_log'); // 实例化Data数据对象
			import("@.ORG.Util.Page");// 导入分页类
			$map = array();
			if (isset($_POST['id']) && $_POST['id']!='') {
				$map['user_id'] = array("eq",$_POST['id']);
			}

			$count      = $Data->where($map)->count();// 查询满足要求的总记录数
			$Page       = new Page($count,30);// 实例化分页类 传入总记录数


			$list = $Data->where($map)->order('add_time desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();
			foreach($list as $k=>$v){
				$list[$k]['username'] = M('member')->where("id ={$v['user_id']}")->getField('username');
				if($v['send_style']==1){
					$list[$k]['as_name']=M('product')->where("id ={$v['num']}")->getField('title');
				}else{
					$list[$k]['as_name']=$v['num'];
				}

			}
			$show       = $Page->show();// 分页显示输出
			$this->assign('page',$show);// 赋值分页输出
			$this->assign('list',$list);// 赋值数据集
			$this->display(); // 输出模板

		}

		public function shuadan(){

			$this->display();
			
	    }
		public function addshuadan(){
			$number = $_POST['number'];
			$member = M('member')->where("robotcount > 0")->setInc('logincount',$number);
			if($member){
				alert('执行成功！',U(GROUP_NAME.'/Member/shuadan'));
			}
		}
		public function fafangshouyi(){
			
			$member = M('member')->where("robotcount > 0")->select();
			foreach($member as $k=>$v){
				$username = $v['username'];
				$product = M('order') ->where(array('zt'=>1,'user'=>$username))-> select();
					foreach($product as $k=>$s){

						$order=M('order')->where(array('id'=>$s['id'],'zt'=>1,'user'=>$username))->find();

						//算出已经结算的时间
						$a_time=$order['UG_getTime']-strtotime($order['addtime']);

						//本次将要结算的时间
						$n_time=time()-$order['UG_getTime'];

						$time=0;//参加计算的时间；
						$data=array();
						$data['UG_getTime']=time();
						$is_over=1;
						if($a_time+$n_time > $order['yxzq']*3600){

						$time=($order['yxzq']*3600)-$a_time;
						$data['zt']=2;
						//扣除我的
						M('member')->where(array('username'=>$username))->setDec('robotcount');
						$is_over=0;

					}else{
						$time=$n_time;
					}

						$shouyi=($time/3600)*$order['shouyi'];//本次收益

						M('order')->where(array('id'=>$s['id'],'zt'=>1,'user'=>$username))->setInc('already_profit',$shouyi);
						M('order')->where(array('id'=>$s['id'],'zt'=>1,'user'=>$username))->save($data);


                        $user_info = M('member')->where(array('username'=>$username))->find();
                        if($shouyi>0&&$user_info['parent']){
                            $one = $shouyi * C('ONE');
                            M("member")->where(array('username'=>$user_info['parent']))->setInc('money',$one);
                            account_log($user_info['parent'],$one,'1级用户收益分成',1,3,1,0,$user_info['uername']);
                            $parent = M('member')->where(array('username'=>$user_info['parent']))->find();
                            if($parent['parent']){
                                $two = $shouyi * C('TWO');
                                M("member")->where(array('username'=>$parent['parent']))->setInc('money',$two);
                                account_log($parent['parent'],$two,'2级用户收益分成',1,3,1,0,$parent['uername']);
                            }
                        }

                        M('member')->where(array('username'=>$username))->setInc("money",$shouyi);
						account_log($username,$shouyi,'机器人收益',1,1,1,$order['id']);
					}
					alert('成功！',U(GROUP_NAME.'/Shop/orderlist'));
			}

		}

	}

?>