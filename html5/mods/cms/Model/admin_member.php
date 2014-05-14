<?php
class admin_member{
	public $table;
	public $db;
	public $id;
	public $menu;
	
	function __construct($table,$id=0){
		$this->table=$table;
		$this->db=new Dbclass(SYS_ROOT.DB_NAME);
		//$this->mem=MEMCACHE?new Memcached(MEMCACHE):null;
		$this->tpl=new Template();
		$this->id=$id;
		$this->menu='system';
	}

	function Index(){
        $admin_name   = isset( $_POST ['name']) ? $_POST ['name'] : "";  
        $page         = isset ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1; 
        $pageQuery    ='';
        $pageSize     = 1;  
        $current_page = $page;
        $pageCursor   = ($current_page - 1) * $pageSize;     
        $where        ='1=1';
        if(!empty($admin_name))
        {
            $where.=" AND admin_name like '%".$admin_name."%'"; 
            $pageQuery .='&name='.$admin_name;
        }
        $url ='index.php?c=admin_member&m=index'. $pageQuery; 
        $totalCounts= $this->_getmemberInts($where); 
        if ($totalCounts > $pageSize) {
            $pageConfig ['base_url']   = $url;
            $pageConfig ['total_rows'] = $totalCounts;
            $pageConfig ['cur_page']   = $current_page;
            $pageConfig ['per_page']   = $pageSize;
            $pageConfig ['num_links']  = 5;
            $pagination = new Pagination ( $pageConfig );
            $pageStr = $pagination->create_links ();
            $this->tpl->smarty->assign ( 'page_str', $pageStr );
        }
        $limit = $pageCursor.','.$pageSize;  
		$member_list=$this->db->getlist(TB.'admin',$where,'*',$limit,'admin_id DESC');
        $this->tpl->smarty->assign('member_list',$member_list);   
		$this->tpl->smarty->display('member_index.html');
		
	}
    function add(){
        if(isset($_POST['is_submit'])&&($_POST['is_submit']==1))
        {
         $admin_name    = $_POST ['admin_name'] ? $_POST ['admin_name'] : Base::showmessage(' 请输入用户名');  
         $admin_passwd1 = $_POST ['admin_passwd1'] ? $_POST ['admin_passwd1'] : Base::showmessage(' 请输入密码');
         $admin_passwd  = $_POST ['admin_passwd'] ? $_POST ['admin_passwd'] : Base::showmessage(' 请输入确认密码'); 
         $admin_email   = $_POST ['admin_email'] ? $_POST ['admin_email'] : "";      
         $admin_status  = isset ( $_GET ['admin_status'] ) ? intval ( $_GET ['admin_status'] ) : 0;   
         if($admin_passwd1 != $admin_passwd)
         {
           Base::showmessage('两次密码输入不一样'); 
           exit;  
         } 
         $data['admin_name']   =  $admin_name;
         $data['admin_passwd'] =  $admin_passwd;
         $data['admin_email']  =  $admin_email; 
         $data['admin_status'] =  $admin_status; 
         $data['admin_create_time'] =  time (); 
         if($this->db->add_one(TB.'admin',$data))
         {
            Base::execmsg('用户添加','index.php?c=admin_member&m=index',TRUE); 
            exit;  
         } 
         else
         {
            Base::execmsg('用户添加','index.php?c=admin_member&m=index',false); 
            exit;    
         }
        }

        $this->tpl->smarty->display('member_add.html');
        
    }
    function update(){
        $id = intval ( $_GET ['id'] );
        if (empty ( $id )) {
            Base::showmessage ( 'ID不能为空' );
        }
        if(isset($_POST['is_submit'])&&($_POST['is_submit']==1))
        {
         $admin_name    = $_POST ['admin_name'] ? $_POST ['admin_name'] : Base::showmessage(' 请输入用户名');  
         $admin_passwd1 = $_POST ['admin_passwd1'] ? $_POST ['admin_passwd1'] : '';
         $admin_passwd  = $_POST ['admin_passwd'] ? $_POST ['admin_passwd'] : ''; 
         $admin_email   = $_POST ['admin_email'] ? $_POST ['admin_email'] : "";      
         $admin_status  = isset ( $_GET ['admin_status'] ) ? intval ( $_GET ['admin_status'] ) : 0;   
         if(!empty($admin_passwd) and !empty($admin_passwd1))
         {
            if($admin_passwd1 != $admin_passwd)
            {
               Base::showmessage('两次密码输入不一样'); 
               exit;  
            }
            $data['admin_passwd'] =  $admin_passwd; 
         }
 
         $data['admin_name']   =  $admin_name;
         $data['admin_email']  =  $admin_email; 
         $data['admin_status'] =  $admin_status;  
         if($this->db->updatelist(TB.'admin',$data,'admin_id',$id))
         {
            Base::execmsg('用户修改','index.php?c=admin_member&m=index',TRUE); 
            exit;  
         } 
         else
         {
            Base::execmsg('用户修改','index.php?c=admin_member&m=index',false); 
            exit;    
         }
        }
        $member_info=$this->db->get_one(TB.'admin','admin_id ='.$id,'*',1,'admin_id DESC'); 
        $this->tpl->smarty->assign('member_info',$member_info);  
        $this->tpl->smarty->assign('sites',1); 
        $this->tpl->smarty->display('member_add.html');
        
    }
	function Top(){
		$this->tpl->smarty->display('top.html');
		
	}
	function Left(){
		$menu= require('data/menu.php');

			foreach($menu as $key=>$val){
				if($this->menu==$val['value']){
					$display_title=$val['title']['name'];
					$this->tpl->smarty->assign('display_title',$display_title);
					foreach($val['items'] as $ikey=>$ival){
						$data[$ikey]['name']=$ival['name'];
						$data[$ikey]['url']='index.php?c='.$ival['c'].'&m='.$ival['m'];
					}
					$menu=$data;
					break;
				}else{
					continue;
				}
			}

		
		$this->tpl->smarty->assign('menu',$menu);
		$this->tpl->smarty->display('menu.html');
	}
	function Main(){
	    print_r($_SESSION['admin']['menu']);exit;
		$this->tpl->smarty->display('main.html');
		
	}
    
    function _getmemberInts($where ='')
      {
        $sql="SELECT count( * ) AS count_int FROM cms_admin WHERE ".$where;
        $code_ints = $this->db->get_one(TB.'admin',$where,'count( * ) AS count_int',1,'admin_id DESC');
        $code_int =$code_ints['count_int'];
        return $code_int;
    }
}

?>