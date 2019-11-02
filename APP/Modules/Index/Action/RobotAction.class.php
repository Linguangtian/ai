<?php  
	//消息相关控制器
	Class RobotAction extends CommonAction{


		public function index(){

			$user_id=session('mid');
			$count = M('order') ->where(array('user_id'=>$user_id,'zt'=>1))->count();
			$minfo = M('member')->where(array('id'=>$user_id))->find();
			$id =  1;
			$data = M("product") -> find($id);
			$id = $data['id'];
			$title=C('title');
            $this->assign('title',$title);
			$this -> assign('data',$data);
			$this -> assign('id',$id);
			$this -> assign('minfo',$minfo);
			$this -> assign('count',$count);
			$this -> display();
		}
		//商品详情
		public function pcontent(){

			$id =  I('get.id',0,'intval');
			$product = M("product");

			$data = $product -> find($id);
			if(empty($data)){
				alert('信息不存在',U('Index/Shop/plist'));
			}
			$jiazhi = $data['yxzq'] * $data['shouyi'];

			$id = $data['id'];
			$this -> assign('data',$data);
			$this -> assign('jiazhi',$jiazhi);
			$this -> assign('id',$id);

			$this->display();
		}

		//订单提交
		public function buy(){
			//var_dump($_POST); die();
			$id =  I('post.id',0,'intval');
			$number =  I('post.number',0,'intval');
			$product = M("product");
			//查询机器人信息
			$data = $product -> find($id);
			
			if(empty($data)){
				alert('机器人不存在',U('Index/index'));
			}
			$jiaqian = $data['price'] * $number;
			$letter = M('type')->where(array('id'=>$data['tid']))->getField('name');
			//判断 是否已经达到限购数量
			$my_gounum=M("order")->where(array("user"=>session('username'),"sid"=>$id))->count();
			if($my_gounum >=$data['xiangou']){
				echo '<script>alert("已经达到租赁机器人的上限！");window.history.back(-1);</script>';
				die;
			}

			$jinbi = getMemberField('money');

			$username = session('username');
			if($jinbi < $jiaqian){
				alert('账户余额不足,请先进行充值',U('wallet/change'));
			}

			M("member")->where(array('username'=>session('username')))->setDec('money',$jiaqian);
			M("member")->where(array('username'=>session('username')))->setInc('cost_money',$jiaqian);
			account_log(session('username'),$jiaqian,'购买'.$data['title'],0);
			if($number == 1){
				$map = array();
				$map['kjbh'] = $letter . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
				$map['user'] = $username;

				$map['user_id'] = session('mid');
				$map['project']= $data['title'];
				$map['sid'] = $data['id'];
				$map['yxzq'] = $data['yxzq'];
				$map['shouyi'] = $data['shouyi'];
				$map['sumprice'] = $data['price'];
				$map['addtime'] = date('Y-m-d H:i:s');
				$map['imagepath'] = $data['thumb'];
				$map['zt'] =  1;
				$map['UG_getTime'] =  time();
				if(M('order')->add($map)){
					M('member')->where(array('username'=>$username))->setInc('robotcount');
					/*$one = $jiaqian * C('ONE');
					$two = $jiaqian * C('TWO');
					$ones = $jiaqian * C('ONES');
					$twos = $jiaqian * C('TWOS');

					$parent = getMemberField('parent');



                    $parent1 = M('member')->where(array('username'=>$parent))->getField('parent');
				
					$parentcount = M('order')->where(array('user'=>$parent))->count();

					$parentcount1 = M('order')->where(array('user'=>$parent1))->count();
				
					if($parentcount > 0){
					
						M("member")->where(array('username'=>$parent))->setInc('money',$one);
						account_log($parent,$one,'推荐1级奖励',1,2,1,0,$username);
					
					}else{
						M("member")->where(array('username'=>$parent))->setInc('money',$ones);
						account_log($parent,$ones,'推荐1级奖励',1,2,1,0,$username);
					}
				
					if($parentcount1 > 0){
						M("member")->where(array('username'=>$parent1))->setInc('money',$two);
						account_log($parent1,$two,'推荐2级奖励',1,2,1,0,$username);
					
					}else{
						M("member")->where(array('username'=>$parent1))->setInc('money',$twos);
						account_log($parent1,$twos,'推荐2级奖励',1,2,1,0,$username);
					}*/

					$product->where(array("id"=>$id))->setDec("stock",$number);
				}
			}elseif($number == 2){
				$map = array();
				$map['kjbh'] = $letter . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
				$map['user'] = $username;
				$map['user_id'] = session('mid');
				$map['project']= $data['title'];
				$map['sid'] = $data['id'];
				$map['yxzq'] = $data['yxzq'];
				$map['shouyi'] = $data['shouyi'];
				$map['sumprice'] = $data['price'];
				$map['addtime'] = date('Y-m-d H:i:s');
				$map['imagepath'] = $data['thumb'];
				$map['zt'] =  1;
				$map['UG_getTime'] =  time();
				M('order')->add($map);
				$map1 = array();
				$map1['kjbh'] = $letter . 1 . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
				$map1['user'] = $username;
				$map1['user_id'] = session('mid');
				$map1['project']= $data['title'];
				$map1['sid'] = $data['id'];
				$map1['yxzq'] = $data['yxzq'];
				$map1['shouyi'] = $data['shouyi'];
				$map1['sumprice'] = $data['price'];
				$map1['addtime'] = date('Y-m-d H:i:s');
				$map1['imagepath'] = $data['thumb'];
				$map1['zt'] =  1;
				$map['UG_getTime'] =  time();
				if(M('order')->add($map1)){
					M('member')->where(array('username'=>$username))->setInc('robotcount');
                    /*	$one = $jiaqian * C('ONE');
                       $two = $jiaqian * C('TWO');
                       $ones = $jiaqian * C('ONES');
                       $twos = $jiaqian * C('TWOS');
                       $parent = getMemberField('parent');
                      $parent1 = M('member')->where(array('username'=>$parent))->getField('parent');

                           $parentcount = M('order')->where(array('user'=>$parent))->count();
                           $parentcount1 = M('order')->where(array('user'=>$parent1))->count();

                           if($parentcount > 0){

                               M("member")->where(array('username'=>$parent))->setInc('money',$one);
                               account_log($parent,$one,'推荐1级奖励',1,2,1,0,$username);

                           }else{
                               M("member")->where(array('username'=>$parent))->setInc('money',$ones);
                               account_log($parent,$ones,'推荐1级奖励',1,2,1,0,$username);
                           }

                           if($parentcount1 > 0){
                               M("member")->where(array('username'=>$parent1))->setInc('money',$two);
                               account_log($parent1,$two,'推荐2级奖励',1,2,1,0,$username);

                           }else{
                               M("member")->where(array('username'=>$parent1))->setInc('money',$twos);
                               account_log($parent1,$twos,'推荐2级奖励',1,2,1,0,$username);
                           }
                       */
					$product->where(array("id"=>$id))->setDec("stock",$number);
				}
				
			}elseif($number == 3){
				
				
				$map = array();
				$map['kjbh'] = $letter . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
				$map['user'] = $username;
				$map['user_id'] = session('mid');
				$map['project']= $data['title'];
				$map['sid'] = $data['id'];
				$map['yxzq'] = $data['yxzq'];
				$map['shouyi'] = $data['shouyi'];
				$map['sumprice'] = $data['price'];
				$map['addtime'] = date('Y-m-d H:i:s');
				$map['imagepath'] = $data['thumb'];
				$map['zt'] =  1;
				$map['UG_getTime'] =  time();
				M('order')->add($map);
				$map1 = array();
				$map1['kjbh'] = $letter . 1 . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
				$map1['user'] = $username;
				$map1['user_id'] = session('mid');
				$map1['project']= $data['title'];
				$map1['sid'] = $data['id'];
				$map1['yxzq'] = $data['yxzq'];
				$map1['shouyi'] = $data['shouyi'];
				$map1['sumprice'] = $data['price'];
				$map1['addtime'] = date('Y-m-d H:i:s');
				$map1['imagepath'] = $data['thumb'];
				$map1['zt'] =  1;
				$map1['UG_getTime'] =  time();
				M('order')->add($map1);
				$map2 = array();
				$map2['kjbh'] = $letter . 2 . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
				$map2['user'] = $username;
				$map2['user_id'] = session('mid');
				$map2['project']= $data['title'];
				$map2['sid'] = $data['id'];
				$map2['yxzq'] = $data['yxzq'];
				$map2['shouyi'] = $data['shouyi'];
				$map2['sumprice'] = $data['price'];
				$map2['addtime'] = date('Y-m-d H:i:s');
				$map2['imagepath'] = $data['thumb'];
				$map2['zt'] =  1;
				$map2['UG_getTime'] =  time();
				if(M('order')->add($map2)){
					M('member')->where(array('username'=>$username))->setInc('robotcount');
					/*$one = $jiaqian * C('ONE');
					$two = $jiaqian * C('TWO');
					$ones = $jiaqian * C('ONES');
					$twos = $jiaqian * C('TWOS');
					$parent = getMemberField('parent');
					$parent1 = M('member')->where(array('username'=>$parent))->getField('parent');
				
					$parentcount = M('order')->where(array('user'=>$parent))->count();
					$parentcount1 = M('order')->where(array('user'=>$parent1))->count();
				
					if($parentcount > 0){
					
			            M("member")->where(array('username'=>$parent))->setInc('money',$one);
						account_log($parent,$one,'推荐1级奖励',1,2,1,0,$username);
					
					}else{
				        M("member")->where(array('username'=>$parent))->setInc('money',$ones);
						account_log($parent,$ones,'推荐1级奖励',1,2,1,0,$username);
					}
				
					if($parentcount1 > 0){
						M("member")->where(array('username'=>$parent1))->setInc('money',$two);
						account_log($parent1,$two,'推荐2级奖励',1,2,1,0,$username);

					}else{
						M("member")->where(array('username'=>$parent1))->setInc('money',$twos);
						account_log($parent1,$twos,'推荐2级奖励',1,2,1,0,$username);
					}
				*/
					$product->where(array("id"=>$id))->setDec("stock",$number);
				}
				
				
			}
			
			$mai['username'] = $username;
			$mai['number'] = $number;
			$mai['addtime'] = time();
			M('mai_log')->add($mai);
			
			
			alert('机器人购买成功',U('Robot/robot'));
		}


		public function robot(){
			$zt=I('get.zt',1,'intval');
			$user_id=session('mid');
			$order = M("order");
			$count = $order ->where(array('user_id'=>$user_id,'zt'=>$zt))->count();
			$orders = $order->where(array('user_id'=>$user_id,'zt'=>$zt)) ->order('id desc') -> select();
			$jiesuan_time=C('jiesuan_time');
			if(empty($jiesuan_time)){
				$jiesuan_time=24;
			}
			foreach($orders as $k=>$v){
				$a_time = (time()-strtotime($v['addtime']))/3600;
				$orders[$k]['a_time']=round($a_time,2);
				if(time()-$v['UG_getTime'] < $jiesuan_time*3600){
					$orders[$k]['is_jiesuan']=0;
				}else{
					$orders[$k]['is_jiesuan']=1;//可以结算
				}
			}
			$sum = $order ->where(array('user_id'=>$user_id))->sum('already_profit');
			$jiesuan_time = C('jiesuan_time');
			$this -> assign("jiesuan_time",$jiesuan_time);
			$this -> assign("count",$count);
			$this -> assign("zt",$zt);
			$this -> assign("sum",$sum);
			$this -> assign("orders",$orders);
			$this -> display();
		}




	}
?>