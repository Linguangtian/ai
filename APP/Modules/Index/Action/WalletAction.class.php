<?php  
	//消息相关控制器
	Class WalletAction extends CommonAction{


		public function index(){
			$member = M('member');
			$username = session('username');
			$minfo = $member->where(array('username'=>$username))->find();
			$this->assign('minfo',$minfo);
			$this->display();
		}
		public function change(){
			$member = M('member');
			$username = session('username');
			$minfo = $member->where(array('username'=>$username))->find();
			$this->assign('minfo',$minfo);
			$this->display();
		}

		//银行卡列表
		public function card(){
			$id = session('mid');
			$list = M('bankcard')->where(array('userid'=>$id))->select();
			$this->assign('list',$list);
			$this->display();
		}
		//添加银行卡
		public function addcard(){
			$username = session('username');
			$truename = M('member')->where(array('username'=>$username))->getField('truename');
			$list = M('bank')->select();
			$this->assign('list',$list);
			$this->assign('truename',$truename);
			$this->display();
		}
		//添加银行卡执行
		public function addcardpost(){

			$id = I('post.id','','intval');
			$card = I('post.card');
			$userid = session('mid');
			$count = M('bankcard')->where(array('userid'=>$userid))->count();
			$bankcard = M('bankcard')->where(array('card'=>$card))->select();

			if(empty($id)){
				$this->ajaxReturn(array('info'=>'请选择银行名称','url'=>U('Index/wallet/addcard')));
			}
			if(empty($card)){
				$this->ajaxReturn(array('info'=>'请输入银行卡号','url'=>U('Index/wallet/addcard')));
			}
			if(!empty($bankcard)){
				$this->ajaxReturn(array('info'=>'该账号已绑定，请换卡绑定！','url'=>U('Index/wallet/addcard')));
			}

			if($count > 3){
				$this->ajaxReturn(array('info'=>'每个账号最多绑定3张卡','url'=>U('Index/wallet/addcard')));
			}

			$bank = M('bank')->where(array('id'=>$id))->find();
			$data['userid'] = session('mid');
			$data['abbr'] = $bank['abbr'];
			$data['name'] = $bank['name'];
			$data['card'] = $card;
			$data['images'] = $bank['images'];
			$result = M('bankcard')->add($data);
			if(!empty($result)){
				$this->ajaxReturn(array('result'=>1,'info'=>'银行卡添加成功','url'=>U('Index/wallet/card')));
			}else{
				$this->ajaxReturn(array('result'=>0,'info'=>'银行卡添加失败','url'=>U('Index/wallet/addcard')));
			}
		}
		//提现
		public function withdrawn(){
			$bank = M('bankcard')->where(array('userid'=>session('mid')))->count();
			if($bank == 0){
				alert('请先绑定银行卡！',U('Index/wallet/card'));
			}
			//是否开启提现功能
			if (C('WITHDRAW_STATUS') == 'off') {
				alert('提现暂未开放',U('Index/Index/personal'));
			}
			$tx_time=C('tx_time');
			if(!empty($tx_time)){
				$tx_time_arr=explode('-',$tx_time);
				$s_time=strtotime(date("Y-m-d ".$tx_time_arr[0]));
				$o_time=strtotime(date("Y-m-d ".$tx_time_arr[1]));
				if(time() < $s_time || time() > $o_time){
					alert('提现时间为'.$tx_time,U('Index/Index/personal'));
					exit;
				}
			}
			$money = M('member')->where(array('username'=>session('username')))->getField('money');
			$list = M('bankcard')->where(array('userid'=>session('mid')))->select();
			$this->assign('list',$list);
			$this->assign('money',$money);
			$this->display();
		}
		//提现执行
		public function withpost(){
			if (IS_POST) {
				$card = I('post.card');
				$txmoney = I('post.txmoney');

				//当前会员余额
				$mode = M('bankcard')->where(array('card'=>$card))->getField('name');
				$balance = M('member')->where(array('id'=>session('mid')))->getField('money');
				//余额不足
				if ($txmoney > $balance) {
					alert('对不起，您的可用余额不足，请快去充值',U('Index/wallet/withdrawn'));
				}
				if ($card == '') {
					alert('请选择提现方式！',U('Index/wallet/withdrawn'));
				}
				if ($txmoney == 0) {
					alert('请正确填写提现金额！',U('Index/wallet/withdrawn'));
				}
				//是否开启提现功能
				if (C('WITHDRAW_STATUS') == 'off') {
					alert('提现暂未开放',U('Index/wallet/withdrawn'));
				}
				$tx_time=C('tx_time');
				if(!empty($tx_time)){
					$tx_time_arr=explode('-',$tx_time);
					$s_time=strtotime(date("Y-m-d ".$tx_time_arr[0]));
					$o_time=strtotime(date("Y-m-d ".$tx_time_arr[1]));
					if(time() < $s_time || time() > $o_time){
						alert('提现时间为'.$tx_time,U('Index/wallet/withdrawn'));
						exit;
					}
				}
				//一次性提现最少额度
				if($txmoney < C('WITHDRAW_MIN')){
					alert('您输入的提现金额小于最少提现金额，请输入至少'. C('WITHDRAW_MIN').'提现额',U('Index/wallet/withdrawn'));
				}
				//设置提现整数倍
				if (C('WITHDRAW_INT') > 0) {
					if ($txmoney % C('WITHDRAW_INT') != 0) {
						alert('您输入的提现金额必须为'. C('WITHDRAW_INT').'的整数倍',U('Index/wallet/withdrawn'));
					}
				}
				//提现手续费点位、手续费上限、手续费下限	设置提现的时候要扣除的手续费即x%
				if (C('WITHDRAW_TAX')>0) {
					$withdrawtaxnum = $txmoney * (C('WITHDRAW_TAX') / 100);
				}
				$withdrawtaxnum = intval($withdrawtaxnum);
				$txmoney = intval($txmoney);
				//正式处理
				$balance = $balance - $txmoney;
				$data['username'] = session('username');
				$data['mode'] = $mode;
				$data['amount'] =  $txmoney;
				$data['charge'] =  $withdrawtaxnum;
				$data['payment'] =  $txmoney - $withdrawtaxnum;
				$data['card'] = $card;
				$data['addtime'] = time();
				$data['balance'] = $balance;
				$data['remark'] = '申请提现'.$txmoney.'元,扣除'. $withdrawtaxnum .'作为手续费扣除';

				if (M('emoneydetail')->data($data)->add()) {
					M('member')->where(array('username'=>session('username')))->setDec('money',$txmoney);
					account_log($data['username'],$txmoney,' 提现',0);
					M('member')->where(array('username'=>session('username')))->setInc('dongjie',$txmoney);
					account_log4($data['username'],$txmoney,' 提现冻结',1);
					alert('提现成功！',U('Index/wallet/withdrawn'));
				}else{
					alert('提现失败！',U('Index/wallet/withdrawn'));
				}
			}
		}
		//提现记录
		public function withdrawnlog(){
			$emoneydetail = M('emoneydetail');
			$username = session('username');

			$list = $emoneydetail->where(array('username'=>$username,'type'=>0))->select();

			$list1 =$emoneydetail -> where(array('username' =>$username,'type'=>1))-> select();

			$list2 =$emoneydetail -> where(array('username' =>$username,'type'=>2))-> select();


			$this->assign('list',$list);
			$this->assign('list1',$list1);
			$this->assign('list2',$list2);
			$this->display();
		}
		//余额明细记录
		public function yuelog(){
			$data = M('jinbidetail');
			import('ORG.Util.Page');
			$map['member']  = session('username');
			$count = $data->where($map)->count();
			$page = new Page($count,30);
			$page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
			$show = $page->show();// 分页显示输出
			$list = $data->where($map)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
			$money = M('member')->where(array('username'=>session('username')))->getField('money');
			$this->assign('money',$money);
			$this->assign('list',$list);
			$this->assign('page',$show);
			$this->display();
		}
		//推广奖励
		public function tgaward(){

			$data = M('jinbidetail');
			import('ORG.Util.Page');
			$map['member']  = session('username');
			$map['type'] = array("eq",2);
			$count = $data->where($map)->count();
			$page = new Page($count,30);
			$page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
			$show = $page->show();// 分页显示输出
			$list = $data->where($map)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
			$this->assign('list',$list);
			$this->assign('page',$show);
			$this->display();
		}

		//充值记录
		public function rechargelog(){
			$username = session('username');
			$Dao = new Model();
			$list = $Dao->query("select * from codepay_order where pay_id=$username and status = 2");

			$this->assign('list', $list );

			$this->display();
		}

		//激活码充值
		public function onlinerecharge(){
			$username = session('username');
			$this->assign('username',$username);
			$this->display();
		}

		public function order(){
			date_default_timezone_set('PRC');
			$pay_id = $_GET['id'];
			$price = (float)$_GET['money'];
			$param = empty($_GET['module'])?'PersonalSet':$_GET['module'];
			$type = (int)$_GET['type'];

			$codepay_config['id'] = '74617';
			$codepay_config['key'] = 'Avz2xLKnYqVyKKcQzxKDKF9uWh1rkkdS';
			$codepay_config['chart'] = strtolower('utf-8');
			header('Content-type: text/html; charset=' . $codepay_config['chart']);
			//是否启用免挂机模式 1为启用. 未开通请勿更改否则资金无法及时到账
			$codepay_config['act'] = "0"; //认证版则开启 一般情况都为0
			$codepay_config['page'] = 4; //支付页面展示方式
			$codepay_config['style'] = 1;
			//二维码超时设置  单位：秒
			$codepay_config['outTime'] = 360;//360秒=6分钟 最小值60  不建议太长 否则会影响其他人支付
			$codepay_config['min'] = 0.01;
			$codepay_config['pay_type'] = 1;
			define('HTTPS', false);  //是否HTTPS站点 false为HTTP true为HTTPS
			$codepay_config['host'] = ($this->isHTTPS() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
			$codepay_config['path'] = $codepay_config['host'] . dirname($_SERVER['REQUEST_URI']); //API安装路径 最终为http://域名/codepay
			$codepay_path = $codepay_config['path']; //资源存放路径
			$codepay_config['return_url'] = "http://kj.ekaabb.com.cn/codepay/notify.php"; //自动生成跳转地址
			$codepay_config['go_time'] = 3;
			$codepay_config['go_url'] =  $_SERVER[''] == '80' ? '/' : '//'.$_SERVER['SERVER_NAME'];
			$codepay_config['notify_url'] = "http://kj.ekaabb.com.cn/index.php/index/personal_set/notify"; //自动生成通知地址 优先级最高不传入则为系统设置里设置

			//$time = time();
			//$sql="INSERT INTO `codepay_order` (`pay_id`, `money`, `price`, `type`, `param`, `pay_tag`, `status`, `creat_time`)values($pay_id,$price,$price,$type,'$param','保证金',0,$time)";
			//M()->execute($sql);
			//$orderid = M()->getLastInsID();


			//构造要请求的参数数组，无需改动
			$parameter = array(
				"id" => (int)$codepay_config['id'],//平台ID号
				"type" => $type,//支付方式
				"price" => (float)$price,//原价
				"pay_id" => $pay_id, //可以是用户ID,站内商户订单号,用户名
				"param" => $param,//自定义参数
				"act" => (int)$codepay_config['act'],//此参数即将弃用
				"outTime" => (int)$codepay_config['outTime'],//二维码超时设置
				"page" => (int)$codepay_config['page'],//订单创建返回JS 或者JSON
				"return_url" => $codepay_config["return_url"],//付款后附带加密参数跳转到该页面
				"notify_url" => $codepay_config["notify_url"],//付款后通知该页面处理业务
				"style" => (int)$codepay_config['style'],//付款页面风格
				"pay_type" => $codepay_config['pay_type'],//支付宝使用官方接口
				"user_ip" => $this->getIp(),//付款人IP
				"qrcode_url" => $codepay_config['qrcode_url'],//本地化二维码
				"chart" => trim(strtolower($codepay_config['chart']))//字符编码方式
				//其他业务参数根据在线开发文档，添加参数.文档地址:https://codepay.fateqq.com/apiword/
				//如"参数名"=>"参数值"
			);

			$back = $this->create_link($parameter, $codepay_config['key']);

			switch ((int)$type) {
				case 1:
					$typeName = '支付宝';
					break;
				case 2:
					$typeName = 'QQ';
					break;
				default:
					$typeName = '微信';
			}
			//准备传给前端输出的JSON
			$user_data = array("return_url" => $parameter["return_url"],
				"type" => $parameter['type'], "outTime" => $parameter["outTime"], "codePay_id" => $parameter["id"], "logoShowTime" => 2);
			$user_data["qrcode_url"] = $codepay_config["qrcode_url"];
			$user_data["logoShowTime"] = 2;

			if ($parameter['page'] != 3) { //只要不为3 返回JS 就去服务器加载资源
				$parameter['page'] = "4"; //设置返回JSON
				$back = $this->create_link($parameter, $codepay_config['key'],$codepay_config['gateway']); //生成支付URL
				if (function_exists('file_get_contents')) { //如果开启了获取远程HTML函数 file_get_contents
					$codepay_json = file_get_contents($back['url']); //获取远程HTML
				} else if (function_exists('curl_init')) {
					$ch = curl_init(); //使用curl请求
					$timeout = 5;
					curl_setopt($ch, CURLOPT_URL, $back['url']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					$codepay_json = curl_exec($ch);
					curl_close($ch);
				}
			}

			if (empty($codepay_json)) { //如果没有获取到远程HTML 则走JS创建订单
				$parameter['call'] = "callback";
				$parameter['page'] = "3";
				$back = $this->create_link($parameter, $codepay_config['key'],'https://codepay.fateqq.com/creat_order/?');
				$codepay_html = '<script src="' . $back['url'] . '"></script>'; //JS数据
			} else { //获取到了JSON
				$codepay_data = json_decode($codepay_json);
				$qr = $codepay_data ? $codepay_data->qrcode : '';
				$codepay_html = "<script>callback({$codepay_json})</script>"; //JSON数据
			}

			$this->assign('typeName',$typeName);
			$this->assign('type',$type);
			$this->assign('price',$price);
			$this->assign('user_data',json_encode($user_data));
			$this->assign('codepay_html',$codepay_html);
			$this->display();
		}

		//主动判断是否HTTPS
		public function isHTTPS()
		{
			if (defined('HTTPS') && HTTPS) return true;
			if (!isset($_SERVER)) return FALSE;
			if (!isset($_SERVER['HTTPS'])) return FALSE;
			if ($_SERVER['HTTPS'] === 1) {  //Apache
				return TRUE;
			} elseif ($_SERVER['HTTPS'] === 'on') { //IIS
				return TRUE;
			} elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
				return TRUE;
			}
			return FALSE;
		}

		public function getIp()
		{ //取IP函数
			static $realip;
			if (isset($_SERVER)) {
				if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
					$realip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
				}
			} else {
				if (getenv('HTTP_X_FORWARDED_FOR')) {
					$realip = getenv('HTTP_X_FORWARDED_FOR');
				} else {
					$realip = getenv('HTTP_CLIENT_IP') ? getenv('HTTP_CLIENT_IP') : getenv('REMOTE_ADDR');
				}
			}
			return $realip;
		}

		public function create_link($params, $codepay_key, $host = "")
		{
			ksort($params); //重新排序$data数组
			reset($params); //内部指针指向数组中的第一个元素
			$sign = '';
			$urls = '';
			foreach ($params AS $key => $val) {
				if ($val == '') continue;
				if ($key != 'sign') {
					if ($sign != '') {
						$sign .= "&";
						$urls .= "&";
					}
					$sign .= "$key=$val"; //拼接为url参数形式
					$urls .= "$key=" . urlencode($val); //拼接为url参数形式
				}
			}

			$key = md5($sign . $codepay_key);//开始加密
			$query = $urls . '&sign=' . $key; //创建订单所需的参数
			$apiHost = ($host ? $host : "http://api2.fateqq.com:52888/creat_order/?"); //网关
			$url = $apiHost . $query; //生成的地址
			return array("url" => $url, "query" => $query, "sign" => $sign, "param" => $urls);
		}


		public function notify(){
			exit('success');
		}



	}
?>