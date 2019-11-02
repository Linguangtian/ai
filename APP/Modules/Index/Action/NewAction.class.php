<?php  
	
	Class NewAction extends CommonAction{

		//资讯详细页
		public function index(){
			$zaobao = M('announce')->where(array('tid'=>1))->order('addtime desc')->select();
			$this->assign('zaobao',$zaobao);
			$this->display();
		}

		public function newsdetails(){

			$news_id=I('get.news_id',0,'intval');

			if(empty($news_id)){
				$this->error('页面不存在！');
			}
			$new=M('announce')->where("id = {$news_id}")->find();
			$this->assign('new',$new);
			$this->display('newsview');

		}
		public function about(){
			$about = M('about')->where(array('id'=>1))->find();
			$this->assign('about',$about);
			$this->display();
		}

		public function wenda(){
			$wenda = M('announce')->where(array('tid'=>2))->order('addtime desc')->select();
			$this->assign('wenda',$wenda);
			$this->display();
		}

	}