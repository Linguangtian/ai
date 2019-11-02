<?php  
	
	Class IndexAction extends CommonAction{


		//首页
		public function index(){

			$user_id=session('mid');
			$username = session('username');
			$count = M('order') ->where(array('user_id'=>$user_id,'zt'=>1))->count();
			$sum = M('order') ->where(array('user_id'=>$user_id))->sum('already_profit');
			if($sum==0){
				$sum = 0;
			}
			$minfo = M('member')->where(array('id'=>$user_id))->find();
			$s_time=strtotime(date("Y-m-d 00:00:01"));
			$o_time=strtotime(date("Y-m-d 23:59:59"));
			$data_f=M("jinbidetail")->where("member = {$username} and type = 1 and addtime > {$s_time} and addtime < {$o_time}")->sum('adds');
			if($data_f==0){
				$data_f = 0;
			}
			
			$id =  1;
			$data = M("product") -> find($id);
			$id = $data['id'];
			$mai_log = M('mai_log') ->select();
			$title=C('title');
            $this->assign('title',$title);
			
			$this -> assign('mai_log',$mai_log);
			$this -> assign('data',$data);
			$this -> assign('id',$id);
			
			
			$this->assign('data_f',$data_f);
			$this->assign('minfo',$minfo);
			$this -> assign("count",$count);
			$this -> assign("sum",$sum);
			$this -> display();
		}
		
		//我的收益
		public function shouyi(){
			$user_id=session('mid');
			$member = M('member');
            $order = M('order');
			$username = session('username');
			$minfo = $member->where(array('username'=>$username))->find();
			$sum = M("order") ->where(array('user_id'=>$user_id))->sum('already_profit');
			$count = $order ->where(array('user_id'=>$user_id,'zt'=>1))->count();

			
			$this -> assign("count",$count);
			$this -> assign("sum",$sum);
			$this->assign('minfo',$minfo);
			$this->display();
		}
		
		
		//个人信息
		public function personal(){


			$user_id=session('mid');
			$member = M('member');
			$username = session('username');
			$minfo = $member->where(array('username'=>$username))->find();
			
			$sum = M("order") ->where(array('user_id'=>$user_id))->sum('already_profit');
		
			if($sum==0){
				$sum = 0;
			}
			$count = $member->where(array('parent'=>$username))->count();
			if($count==0){
				$count = 0;
			}
			
			$product = M('order') ->where(array('zt'=>1,'user'=>$username))-> select();

			foreach($product as $k=>$v){

				$order=M('order')->where(array('id'=>$v['id'],'zt'=>1,'user'=>$username))->find();

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

				M('order')->where(array('id'=>$v['id'],'zt'=>1,'user'=>$username))->setInc('already_profit',$shouyi);
				M('order')->where(array('id'=>$v['id'],'zt'=>1,'user'=>$username))->save($data);

				if($shouyi>0&&$minfo['parent']){
                    $one = $shouyi * C('ONE');
                    $two = $shouyi * C('TWO');
                    M("member")->where(array('username'=>$minfo['parent']))->setInc('money',$one);
                    account_log($minfo['parent'],$one,'1级用户收益分成',1,3,1,0,$minfo['username']);
                    $parent = M('member')->where(array('username'=>$minfo['parent']))->find();
                    if($parent['parent']){
                        M("member")->where(array('username'=>$parent['parent']))->setInc('money',$two);
                        account_log($parent['parent'],$two,'2级用户收益分成',1,3,1,0,$minfo['username']);

                    }

                }


				M('member')->where(array('username'=>$username))->setInc("money",$shouyi);
				account_log($username,$shouyi,'机器人收益',1,1,1,$order['id']);
			}
			$title=C('title');
            $this->assign('title',$title);
			$this->assign('count',$count);
			$this->assign("sum",$sum);
			$this->assign('minfo',$minfo);
			$this->display();
		}
		//我的团队
		public function team(){
            $db     =   Db::getInstance(C('RBAC_DB_DSN'));

			$member = M('member');
			$username = session('username');

            $minfo = M('member')->where(array('username'=>$username))->find();
			$list = $member->where(array('parent'=>$username))->field('username,id,money,truename')->select();

			foreach($list as $key=>&$v){
                $sql='select sum(adds) as royalty_one  from ds_jinbidetail where member='.$username.' and type=3 and tgaward='.$v['username'];

                $res=$db->query($sql);
                $royalty_one=$res['0']['royalty_one'];
                $v['royalty_one']=$royalty_one>0?$royalty_one:0;

                $son=$member -> where(array('parent' => $v['username'])) ->field('username,id,money,truename') -> select();
                foreach ($son as &$li){
                    $sql='select sum(adds) as royalty_one  from ds_jinbidetail where member='.$username.' and type=3  and tgaward='.$li['username'];
                    $res=$db->query($sql);
                    $royalty_one=$res['0']['royalty_one'];
                    $li['royalty_two']=$royalty_one>0?$royalty_one:0;
                }
                $list1[]=$son;
			}

            $jinbi_log='';
            $is_team=0;
			if($minfo['parentcount']>=direct_line&&$minfo['total_cost']>=team_cost){
                //团队奖励记录
                $jinbi_log = M('jinbidetail')->where(array('username'=>$username,'type'=>99))->field('desc,addtime,tgaward,adds')->select();
                $is_team=1;
                foreach ($jinbi_log as &$log_list){
                    $log_list['time']=date('Y-m-d',$log_list['addtime']);
                }

            }

            $tuandui='';
            if($minfo['parentcount']>=direct_line){
                if($minfo['total_cost']>=team_cost){
                    $tuandui='团队总消费已超过：'.team_cost.'元';
                }else{
                    $tuandui='团队总消费：'.$minfo['total_cost'].'元';
                }

            }

            $this->assign('minfo',$minfo);
            $this->assign('tuandui',$tuandui);

			$this->assign('list',$list);
			$this->assign('jinbilog',$jinbi_log);
			$this->assign('isteam',$is_team);

			$this->assign('list1',$list1);
			$this->display();
		}
		//推广码
		public function tgm(){

			header ( "Content-type: text/html; charset=utf-8");

			$e_keyid=encrypt(session('mid'),'E','xyb8888');

			$e_keyid=str_replace('/','AAABBB',$e_keyid);

			$tuiguangma = "http://".$_SERVER['SERVER_NAME'].U('Index/Sem/regSem',array('u'=>$e_keyid));
			$erwei = M("member")->where(array('username'=>session('username')))->getField("erwei");

			if(!$erwei){
				Vendor('phpqrcode.phpqrcode');
				//生成二维码图片
				$object = new QRcode;
				$level=3;
				$size=8;
				$errorCorrectionLevel =intval($level) ;//容错级别
				$matrixPointSize = intval($size);//生成图片大小
				$path = "Public/erwei/";
				// 生成的文件名
				$fileName = $path.session('username').'.png';
				$object->png($tuiguangma,$fileName, $errorCorrectionLevel, $matrixPointSize, 2);
				
				import('ORG.Util.Image');
				$Image = new Image();

				define('THINKIMAGE_WATER_CENTER', 5);
				$Image->water(PUBLIC_PATH.'/inviteback.jpg',$fileName,$fileName,100,array(335,950));
				$erwei = '/'.$fileName;

				M("member")->where(array('username'=>session('username')))->setField("erwei",$erwei);
			}
			$this->assign('erwei',$erwei);
			$adurl=C('adurl');
			$adurl2=str_replace('[adurl]',$tuiguangma,$adurl);

			$this->assign('tuiguangma',$tuiguangma);
			$this->assign('adurl2',$adurl2);
			$this->display();
		}

		//密码修改
		public function updatePass(){

			$this->display();
		}
		//执行密码修改
		public function updatePasspost(){

				$old_password = I('post.old_password','','strval');
				if(empty($old_password)){
					$this->ajaxReturn(array('result'=>0,'info'=>'原密码不能为空!'));
				}
				$db = M('member');
				$newpwd = I('post.newpwd','','strval');
				$newpwd1 = I('post.newpwd1','','strval');
				if (empty($newpwd)  || empty($newpwd1)) {
					$this->ajaxReturn(array('result'=>0,'info'=>'新登陆密码或确认密码不能为空'));
				}
				if(!preg_match("/^[a-zA-Z\d_]{6,}$/",I('post.newpwd'))){
					$this->ajaxReturn(array('result'=>0,'info'=>'新密码长度不能小于6位!'));
				}
				if ($newpwd !=$newpwd1) {
					$this->ajaxReturn(array('result'=>0,'info'=>'两次密码输入不一样!'));
				}
				$where = array('id'=>session('mid'));
				$old = $db->where($where)->getField('password');
				if ($old != MD5($old_password)) {
					$this->ajaxReturn(array('result'=>0,'info'=>'原登陆密码错误'));
				}
				if ($db->where($where)->save(array('password'=>MD5($newpwd)))) {
					$this->ajaxReturn(array('result'=>1,'info'=>'登陆密码修改成功','url'=>U('Index/index/index')));
				}else{
					$this->ajaxReturn(array('result'=>0,'info'=>'登陆密码修改失败','url'=>U('Index/index/index')));
				}

		}

		//退出系统
		public function logout(){
			//添加日志
			$desc = '会员'. session('account') .'退出';
			write_log(session('account'),'member',$desc);
			session('mid',null);
			session('username',null);
			session('member',null);
			session('usersecondlogin',null);
			$this->redirect(GROUP_NAME.'/Login/index');
		}



}
?>