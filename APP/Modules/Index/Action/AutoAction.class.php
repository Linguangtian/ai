<?php  
	/**
	 * 自动统计
	 */



	Class AutoAction extends Action{

        private function count_cost($id){
            $res=0;
            $db     =   Db::getInstance(C('RBAC_DB_DSN'));
            $sql='select id,cost_money from ds_member where parent_id='.$id;
            $son_list=$db-> query($sql);
            if(count($son_list)>0){
                foreach ($son_list as $item){
                    $res+=$item['cost_money'];
                    $res+=$this->count_cost($item['id']);
                }
            }else{
                $res=$son_list['cost_money'];
            }
            return $res;
        }



        public function index(){



            $db     =   Db::getInstance(C('RBAC_DB_DSN'));
            $sql='select id,username,parentcount,total_cost from ds_member ';
            $member_list=$db-> query($sql);


           foreach ($member_list as $key=>$li){
               if($li['parentcount']<direct_line) continue;
               $todate=date('Y-m-d');
               if($li['total_cost']>=team_cost){
                   $sql='select username from ds_member where parent_id='.$li['id'];
                   $son_list=$db-> query($sql);
                    if($son_list){
                        foreach ($son_list as $item){
                            $todate_income_money = M('todate_income_money')->where(array('member'=>$item['username'],'time'=>$todate))->find();
                            if($todate_income_money['income_money']>0){
                                //加入收益
                                $money=$todate_income_money['income_money']*prize_size;
                                $c_size=prize_size*100;
                                M("member")->where(array('username'=>$li['username']))->setInc('money',$money);
                                account_log($li['username'],$money,'团队'.$c_size.'%奖励',1,99,1,0,$item['username']);
                                //团队收益累计
                                $team_income_total =M("team_income_total")->where(array('username'=>$li['username']))->find();
                                if($team_income_total){
                                    M("team_income_total")->where(array('username'=>$li['username']))->setInc('team_income_total',$money);
                                }else{
                                    $team_income_total = M('team_income_total');
                                    $data['member']=$li['username'];
                                    $data['team_income_total']=$money;
                                    $team_income_total->add($data);
                                }

                            }
                        }
                    }
               } else{
                   //统计最新团队收益
                   $count_cost=$this->count_cost($li['id']);


                   if($count_cost>0){

                       $sql='update ds_member set update_cost='.time().',total_cost='.$count_cost.' where id='.$li['id'];

                        $db-> query($sql);
                   }


               }

           }
        }

    }
?>