<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GeneralSettings {
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	protected $ci;

	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;
	public $adjacencyList;
	public $adjacencyCheckboxlist;

	/**
	 * error message (uses lang file)
	 *
	 * @var string
	 **/
	protected $errors = array();
	
	public $members_data;


	public function __construct()
	{
		$this->ci =& get_instance();
		$this->referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "";
		$this->onpage = $_SERVER['REQUEST_URI'];
		$site_info = $this->get_site_settings_info();
		if(empty($site_info)) {
			echo " !!!! Invalid Access !!!";
			exit;
		}
		define('STATE',$site_info['state']);
		define('TYPE', $site_info['type']);
		define('STATENAME', $site_info['state_name']);
		define('DISTRICT',$site_info['district']);
		define('GNAME',$site_info['gapa_napa']);
		define('ADDRESS',$site_info['address']);
		define('SLOGAN', $site_info['slogan']);
		define('WARD', $site_info['ward']);
		define('CALC', $site_info['calculation_setting']);
		define('MODULE',$site_info['module_setting']);
		define('DID',$site_info['d_id']);
		define('GID', $site_info['g_id']);
	}

	public function insert_new_visit() {
		if ($this->check_last_visit() ) :
			$adminfolder=ADMIN_FOLDER;
			$brwurl=site_url($_SERVER['REQUEST_URI']);
			if (stripos($brwurl,$adminfolder) !== false) {
				
			}
			else
			{

			$dataarray=array(
				'ip_adr'=>$_SERVER['REMOTE_ADDR'],
				'referer'=>$this->referer,
				'country'=>'',
				'client'=>$_SERVER['HTTP_USER_AGENT'],
				'visit_date'=> date("Y-m-d"),
				'time'=> date("H:i:s"),
				'on_page'=>$this->onpage
				);
			$this->ci->db->insert('ip2visits',$dataarray);
		}
		endif;
	}



	public function check_last_visit() {	
		
			$this->ci->db->select('time + 0 as times');
			$this->ci->db->from('ip2visits');
			$this->ci->db->where(array('ip_adr'=>$_SERVER['REMOTE_ADDR'],'visit_date'=>date("Y-m-d"),'on_page'=>$this->onpage));
			$this->ci->db->order_by('time','DESC');
			$this->ci->db->limit(1,0);
			$qry=$this->ci->db->get();
			$queryCount=$qry->row();
			// echo $this->ci->db->last_query();
			// exit;
			if($qry->num_rows() >0):
			$last_hour = date("H") - 0; 
				$check_time = date($last_hour."is");
				if ($queryCount->times < $check_time)
					return true;
				else
					return false;
			else:
				return true;
			endif;
		}


		public function timezone_list($name, $default='') {
		static $timezones = null;

		if ($timezones === null) {
			$timezones = [];
			$offsets = [];
			$now = new DateTime();

			foreach (DateTimeZone::listIdentifiers() as $timezone) {
				$now->setTimezone(new DateTimeZone($timezone));
				$offsets[] = $offset = $now->getOffset();
				
				$hours = intval($offset / 3600);
				$minutes = abs(intval($offset % 3600 / 60));
				$gmt_ofset = 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');

				$timezone_name = str_replace('/', ', ', $timezone);
				$timezone_name = str_replace('_', ' ', $timezone_name);
				$timezone_name = str_replace('St ', 'St. ', $timezone_name);

				$timezones[$timezone] = $timezone_name.' (' . $gmt_ofset . ')';
				
			}

			array_multisort($offsets, $timezones);
		}

		$formdropdown = form_dropdown($name, $timezones, trim($default));
		
		return $formdropdown;
	}
	
	
	
	
	public function get_pagination_config(&$config)
	{        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '';
        $config['first_tag_close'] = '';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '';
        $config['last_tag_close'] = '';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';
        $get_vars = $this->ci->input->get();
        if(is_array($get_vars)){
           $config['suffix'] = '?'.http_build_query($get_vars,'','&'); 
        }
        return $config;    
    }
	
	//pagination config for frontend
	public function frontend_pagination_config(&$config)
	{        
        $config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)"><span>';
		$config['cur_tag_close'] = '</span></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
        $get_vars = $this->ci->input->get();
        if(is_array($get_vars)){
           $config['suffix'] = '?'.http_build_query($get_vars,'','&'); 
        }
        return $config;       
    }
	
	public function generate_permission_array($array_perms){
        $formated = array();
        if($array_perms && count($array_perms)>0){
            foreach ($array_perms as $item){
                $formated[$item->code] = $item->name; 
            }
        }
        return $formated;
    }
	
	
	public function get_admin_role_permission($user_type)
	{
        $this->ci->db->select($this->ci->db->dbprefix('admin_permissions').'.code, '.$this->ci->db->dbprefix('admin_permissions').'.name ');
       
	    $this->ci->db->from('admin_permissions');
		
        $this->ci->db->where($this->ci->db->dbprefix('admin_permissions').'.permission_id = '.$this->ci->db->dbprefix('admin_roles_permission').'.permission_id');
		
        $query = $this->ci->db->get_where('admin_roles_permission',array('user_type'=>$user_type));
		
        //echo $this->ci->db->last_query(); exit;
		
        if ($query->num_rows() > 0){
            return $this->generate_permission_array($query->result());
        }else{
            return array();
        }
    }


	//function to log admins activity
	function log_admin_activity($data){
        $this->ci->load->library('user_agent');
        //Extra Info
        $extra_info = '';
        if($this->ci->agent->mobile())
            $extra_info .= 'mobile:'.$this->ci->agent->mobile();
        
		if($data['extra_info'])
		{
            $extra_info .= $data['extra_info'];
        }
		
        $data_log = array('log_user_id' => $data['user_id'], 'log_user_type' => $data['user_type'], 'module_name' => $data['module'], 'module_desc' => $data['module_desc'], 'log_action' => $data['action'], 'log_ip' => $this->ci->input->ip_address(), 'log_platform' => $this->ci->agent->platform(), 'log_browser' => $this->ci->agent->browser().' | '.$this->ci->agent->version(), 'log_agent' => $this->ci->input->user_agent(), 'log_referrer' => $this->ci->agent->referrer(), 'log_extra_info' => $extra_info);
        
		$this->ci->db->insert("log_admin_activity",$data_log);
    }
	
	
	//log admin's login error
	function log_invalid_logins($data){           
        $this->ci->load->library('user_agent');
        $encrypted_pwd = $this->ci->encrypt->encode($data['password'],'kks');
        //Extra Info
        $extra_info = '';
        if($this->ci->agent->mobile())
            $extra_info .= 'mobile:'.$this->ci->agent->mobile();
        
        $data_log = array('log_module' => $data['module'], 'log_username' => $data['username'], 'log_password' => $encrypted_pwd, 'log_ip' => $this->ci->input->ip_address(), 'log_platform' => $this->ci->agent->platform(), 'log_browser' => $this->ci->agent->browser().' | '.$this->ci->agent->version(), 'log_agent' => $this->ci->input->user_agent(), 'log_referrer' => $this->ci->agent->referrer(), 'log_desc' => $data['desc'], 'log_extra_info' => $extra_info);
        $this->ci->db->insert('log_invalid_logins', $data_log);
		//echo $this->ci->db->last_query(); exit;  
    }
	
		
	
	public function string_limit($string,$limit)
	{
		$name = (strlen($string) > $limit) ? substr($string , 0 , $limit).'...' : $string;
     	return $name;
	 }
	
		
	//function to check admin logged in
	public function admin_logged_in()
	{		
		return $this->ci->session->userdata(ADMIN_LOGIN_ID);
	}
	
		
	
	//function to admin logout
	public function admin_logout()
	{		
		// echo "test";;
		// exit;
		$this->ci->db->where('id',$this->ci->session->userdata(ADMIN_LOGIN_ID));
		$this->ci->db->update('members',array('is_login' => '0'));
		$this->ci->session->unset_userdata(ADMIN_LOGIN_ID);
		return true;
	}
	
	//find user real ip address
	public function get_real_ipaddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$ip=$_SERVER['REMOTE_ADDR'];

		return $ip;
	}

	public function get_Mac_Address(){
            ob_start();  
           system('ipconfig /all');  
           $mycomsys=ob_get_contents();  
           ob_clean();  
           $find_mac = "Physical";   
           $pmac = strpos($mycomsys, $find_mac);  
           $macaddress=substr($mycomsys,($pmac+36),17);  
           return $macaddress;  
    }
	
	
	
	//Change & Get Time Zone based on settings
	function get_local_time($time="none")
	{
		if($time!='none')
		return date("Y-m-d H:i:s");
		else
			return date("Y-m-d");
	}
	
	function get_local_time_clock()
	{
		$time=date("H:i:s");				
		$piece = explode(":",$time);

		return $piece[0]*60*60+$piece[1]*60+$piece[2];	
	}
	
	
	//date format only
	//for date in format: 12th march 2014
	function date_formate($date)
	{
		$str_date=strtotime($date);
		$dt_frmt=date("D, dS M Y",$str_date);
		return $dt_frmt;
	}
	
	//for date in format: 12 apr 2014
	function date_format1($date)
	{
		$str_date=strtotime($date);
		$dt_frmt=date("d M Y",$str_date);
		return $dt_frmt;
	}
	
	//for date in format: 12 april 2014
	function date_format2($date)
	{
		$str_date=strtotime($date);
		$dt_frmt=date("d F Y",$str_date);
		return $dt_frmt;
	}
	
	//date & time format only
	function date_time_formate($str)
	{ 		
		$str_date=strtotime($str);			
		$dt_frmt=date("d m Y",$str_date).' '.date("H:i",$str_date);			
		return $dt_frmt;
	}
		
	//long date time format for admin panel only
	function long_date_time_format($str)
	{
		return date('D, M d, Y H:i A',strtotime($str));
	}
	
	//short date time format for admin panel only
	function short_date_format($date)
	{
		return date("d M Y",strtotime($date));
	}
	
	
	public function get_site_settings_info()
	{
		$query = $this->ci->db->get("bms_nagadi_setting");
		if ($query->num_rows() > 0) 
		{
			$data=$query->row_array();				
		}		
		$query->free_result();
		return $data;
	}
	
		function random_number() 
		{
			return mt_rand(100, 999) . mt_rand(100,999) . mt_rand(11, 99);
		} 
		
		function clean_url($str, $replace=array(), $delimiter='-') 
		{
			if( !empty($replace) ) {$str = str_replace((array)$replace, ' ', $str);}
	
			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	
			return $clean;
		}
		
	
	
	function check_float_vlaue($str) 
	{
	  if (preg_match("/^[0-9]+(\.[0-9]{1,2})?$/",$str)) 
	  {return true;} 
	  else 
	  {return false;}	
	}
	
	function check_int_vlaue($str) 
	{
	  if (preg_match("/^[0-9]+$/",$str)) 
	  {return true;} 
	  else 
	  {return false;}	
	}
		
	
		
	public function salt() 
	{
		return substr(md5(uniqid(rand(), true)), 0, '10');
	}
	
	public function generate_username() 
	{
		return substr(md5(uniqid(rand(), true)), 0, '10');
	}
	
	public function hash_password($password, $salt) 
	{
		return  sha1($salt.sha1($salt.sha1($password)));	
	}
	
	
	function create_password($length=8,$use_upper=1,$use_lower=1,$use_number=1,$use_custom="")
	{
		$upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$lower = "abcdefghijklmnopqrstuvwxyz";
		$number = "0123456789";
		$seed_length = '';
		$seed = '';
		$password = '';
		
		if($use_upper)
		{
			$seed_length += 26;
			$seed .= $upper;
		}
		if($use_lower)
		{
			$seed_length += 26;
			$seed .= $lower;
		}
		if($use_number)
		{
			$seed_length += 10;
			$seed .= $number;
		}
		if($use_custom)
		{
			$seed_length +=strlen($use_custom);
			$seed .= $use_custom;
		}
		
		for($x=1;$x<=$length;$x++)
		{
			$password .= $seed{rand(0,$seed_length-1)};
		}
	
		return $password;
	}
	
	public function check_banned_ip()
	{
		//get user ip and check with banned IP address lists.
		$user_ip = $this->get_real_ipaddr();
					
		if($this->check_block_ip($user_ip)!==0)
		{			
			redirect($this->lang_uri('/ipbanned'), 'refresh');exit;
		}
	}

	
	public function get_first_letter($str){
		return substr($str,0,1);
	}

	public function get_user_info($id=false)
	{
		$this->ci->db->select('m.*,md.*');
		$this->ci->db->from('members m');
		$this->ci->db->join('member_details md','md.user_id=m.id','left');
		$this->ci->db->where('m.id',$id);
		$qry=$this->ci->db->get();
		// echo $this->ci->db->last_query();
		// die();
		if($qry->num_rows()>0)
		{
			return $qry->row();
		}
		return false;
	}

	public function get_status_info($status=false)
	{
		if($status=='1')
		{
			return 'Active';
		}
		else if($status=='2')
		{
			return 'InActive';
		}
		else if($status=='3')
		{
			return 'Closed';
		}
		else if($status=='4')
		{
			return 'Suspened';
		}
		// 1=Active,2=InActive,3=Closed,4=Suspened
	}

	public function get_job_status($status)
	{
		
		// echo $status;
		if($status=='1')
		{
			return 'Pending';
		}
		else if($status=='2')
		{
			return 'Live';
		}
		else if($status=='3')
		{
			return 'Closed';
		}
		else if($status=='4')
		{
			return 'Cancel';
		}
			
	}

public function get_job_status_info($status)
	{
		// echo $status;
		if($status=='1')
		{
			return 'Rejected';
		}
		else if($status=='2')
		{
			return 'Pending';
		}
		else if($status=='3')
		{
			return 'Shortlisted';
		}
		else if($status=='4')
		{
			return 'Waiting';
		}
		else if($status=='5')
		{
			return 'blocked';
		}
	}

	 
	public function get_menu_by_location($location=false,$fpt=false)
	{
			$this->ci->db->select('p.*');
			$this->ci->db->from('pages p');
			$this->ci->db->where(array('p.status'=>'1'));
			if($location)
			{
				$this->ci->db->where(array($location=>'Y'));
			}
			if($fpt)
			{
			$this->ci->db->where(array('footer_page_type'=>$fpt));	
			}
			$this->ci->db->order_by('display_order','ASC');	
			$qry=$this->ci->db->get();
			// echo $this->db->last_query();
			// die();
			if($qry->num_rows()>0)
			{
				$result=$qry->result();
				return $result;
			}
			return false;
	}

	

	public function unix_to_date_format($date=false,$time=false,$monthformat=false)
	{
		if($monthformat)
		{
			if($time)
				{

			return date("Y-M-d h:i:s A",$date);	
				}
		
			return date("Y-M-d",$date);
		}
		else
		{
			if($time)
				{

			return date("Y-m-d h:i:s A",$date);	
				}
		
			return date("Y-m-d",$date);
		}
		
	}

	public function get_left_days($date1=false,$date2=false)
	{

		$days=$date1-$date2;
		if($days>0)
		{
			$result=floor($days/86400);
			return $result;	
		}
		return 'Closed';
		
	}

		
public function getBannerList()
	{

	 		$this->ci->db->select('b.*');
			$this->ci->db->from('banners b');
			$this->ci->db->where(array('bnr_status'=>'Y'));
			$this->ci->db->order_by('bnr_order','ASC');
			$qry=$this->ci->db->get();
			// echo $this->ci->db->last_query();
			// die();
			if($qry->num_rows()>0)
			{
				return $qry->result();
			}
			return false;
	}


		
public function get_faq_info_by_category_id($cat_id=false)
  {
   $this->ci->db->select('f.*,fc.name as catname');
		$this->ci->db->from('faq f');
		if($cat_id)
		{
			$this->ci->db->where('f.category_id',$cat_id);
		}
		$this->ci->db->join('faq_category fc','fc.id=f.category_id','left');
		$this->ci->db->order_by("f.display_order", "ASC"); 		

		$query = $this->ci->db->get();

		if ($query->num_rows() > 0)
		{
		 return $data=$query->result();
		} 
		return false;
  }

 public function get_latest_news($id=false,$limit=false,$offset=false,$column_sear=false,$order_by=false,$order='ASC',$notice=false)
 {
 	$this->ci->db->select('n.*');
    $this->ci->db->from('news n');
    $this->ci->db->where('n.status',"1");
    
    if($id)
    {
      $this->ci->db->where('n.id',$id);
    }
    if($notice)
    {
    	//$curdate = date('Y-m-d');
		//$this->$ci->db->where("end_date >=", $curdate);
		$this->ci->db->where("end_date >=", $notice);
    }
    if($column_sear)
	{
		$this->ci->db->where($column_sear,null,false);
	}
    if($limit)
    {
    	$this->ci->db->limit($limit);
    }
    if($offset)
    {
    	$this->ci->db->offset($offset);
    }

    if($order_by && $order)
    {
    	$this->ci->db->order_by($order_by,$order);
    }
    else
    {
    	$this->ci->db->order_by('n.date','DESC');
    }
    
    $query=$this->ci->db->get();
    //echo $this->ci->db->last_query(); die();
    if($query->num_rows() >0)
     {
      $result=$query->result();
      return $result;
     }
     return false;
 }

 public function get_count_table_rows($id=false,$fields=false,$table=false)
{
	$qry=$this->ci->db->get_where($table,array($fields=>$id));
	if($qry->num_rows()>0)
	{
		return $qry->num_rows();
	}
	return 0;

}

	public function get_tbl_data($select,$table=false,$where=false,$order=false,$order_by='ASC')
	{
		$this->ci->db->select($select);
		if($where)
		{
				$this->ci->db->where($where,null,false);
		}
		if($order)
		{
				$this->ci->db->order_by($order,$order_by);
		}
		$qry=$this->ci->db->get($table);
		// echo $this->ci->db->last_query();
		// exit;
		if($qry->num_rows()>0)
		{
			return $qry->result();
		}
		return false;

	}
// public function get_tbl_data_result($select,$table=false,$where=false,$order=false,$order_by='ASC')
// {
// 	$this->ci->db->select($select);
// 	if($where)
// 	{
// 			$this->ci->db->where($where,null,false);
// 	}
// 	if($order)
// 	{
// 			$this->ci->db->order_by($order,$order_by);
// 	}
// 	$qry=$this->ci->db->get($table);
// 	// echo $this->ci->db->last_query();
// 	// exit;
// 	if($qry->num_rows()>0)
// 	{
// 		return $qry->result();
// 	}
// 	return false;

// }







public function get_all_blog_comment($id=false,$limit=false,$offset=false,$type=false)
{
	$this->ci->db->order_by('id','desc');
	$this->ci->db->limit($limit,$offset);
	$qry=$this->ci->db->get_where('blog_comment',array('blog_id'=>$id,'type'=>$type));
	if($qry->num_rows()>0)
	{
		return $qry->result();
	}
	return false;
}

 public function get_cms_pages_info_by_slug($slug=false)
  {
    $this->ci->db->select('p.*,');
    $this->ci->db->from('cms_others p');

    if($slug)
    {
      $this->ci->db->where(array('p.cms_type'=>$slug));
    }
    $query=$this->ci->db->get();
    if($query->num_rows() >0)
     {
      $result=$query->result();
      return $result;
     }
     return false;

  }

public function get_testimonial_record($id=false)
 {
 		$this->ci->db->select('t.*');
		$this->ci->db->from('testimonial t');
		$this->ci->db->where('t.is_display','1');
		if($id)
		{
			$this->ci->db->where('t.id',$id);
		}
		$this->ci->db->order_by("t.display_order", "ASC"); 		
		$query = $this->ci->db->get();
		if ($query->num_rows() > 0)
		{
		 return $data=$query->result();
		} 
		return false;
 }

 public function get_our_team_record($id=false)
 {
 		$this->ci->db->select('t.*');
		$this->ci->db->from('our_team t');
		$this->ci->db->where('t.is_display','1');
		if($id)
		{
			$this->ci->db->where('t.id',$id);
		}
		$this->ci->db->order_by("t.display_order", "ASC"); 		
		$query = $this->ci->db->get();
		if ($query->num_rows() > 0)
		{
		 return $data=$query->result();
		} 
		return false;
 }

 public function get_seo($page_id=false)
 {

 		$this->ci->db->select('s.*');
		$this->ci->db->from('seo s');
		if($page_id)
		{
			$this->ci->db->where('s.seo_pages_id',$page_id);
		}
		
		$query = $this->ci->db->get();
		if ($query->num_rows() > 0)
		{
		 return $data=$query->row();
		} 
		return false;

 }

 public function get_other_cms_list_by_slug($id=false,$slug=false,$limit=false,$offset=false)
 {
 		$this->ci->db->select('c.*');
		$this->ci->db->from('cms_others c');
		$this->ci->db->where('is_display','1');
		if($id)
		{
			$this->ci->db->where('c.id',$id);
		}
		if($slug)
		{
			$this->ci->db->where('c.cms_type',$slug);	
		}
		
		$this->ci->db->order_by("c.display_order", "ASC"); 		
		if($limit)
		{
			$this->ci->db->limit($limit);
		}
		$query = $this->ci->db->get();


		if ($query->num_rows() > 0)
		{
		 return $data=$query->result();
		} 
		return false;

 }

 



 public function get_country_list()
 {
 		$this->ci->db->select('*');
		$this->ci->db->from('countries');
		$query = $this->ci->db->get();
		if ($query->num_rows() > 0)
		{
		 return $data=$query->result();
		} 
		return false;
 }

 public function get_all_news($id=false,$limit=false,$offset=false,$column_sear=false,$order_by=false,$sort=false)
 {
 	$this->ci->db->select('n.*');
    $this->ci->db->from('news n');
    if($id)
    {
      $this->ci->db->where('news_id',$id);
    }
    if($column_sear)
    {
    	$this->ci->db->where($column_sear,null,false);
    }
    if($limit)
    {
    	$this->ci->db->limit($limit);
    }

    if($offset)
    {
    	$this->ci->db->limit($offset);
    }
    
    $this->ci->db->order_by($order_by, $sort); 	
    $query=$this->ci->db->get();

    // echo $this->db->last_query();
    // die();
    if($query->num_rows() >0)
     {
      $result=$query->result();
      return $result;
     }
     return false;
 }

public function update_views($id=false,$table=false)
	{
		$where=array('id'=>$id);
		$qry=$this->ci->db->get_where($table,$where);
		$rslt=$qry->row();
		$views=$rslt->views+1;
		$data=array('views'=>$views);
		
		if($this->ci->db->update($table,$data,$where))
		{
			//echo $this->ci->db->last_query();die();
			return $this->ci->db->affected_rows();
		}
		
		return false;
	}

public function get_page_content_by_page_code($page_code=false)
{
	$query=$this->ci->db->get_where('pages',array('slug'=>$page_code));
	// echo $this->ci->db->last_query();
	// die();
	if($query->num_rows()>0)
	{
		return $query->row();
	}	
	return false;
}

public function get_advertisement($limit=false,$offset=false,$column_sear=false,$order=false,$order_by='ASC')
{
	$curdate=date('Y-m-d');
	$this->ci->db->select('*');
    $this->ci->db->from('advertisement ');
    if($column_sear)
    {
      $this->ci->db->where($column_sear);
    }
     $this->ci->db->where("start_date <'".$curdate."' and end_date >'".$curdate."'");
     $this->ci->db->where('status','1');
    if($limit)
    {
      $this->ci->db->limit($limit);
    }
    if($offset)
    {
      $this->ci->db->offset($offset);
    }

    if($order)
    {
      $this->ci->db->order_by($order, $order_by); 
    }
    $query = $this->ci->db->get();
    // echo $this->ci->db->last_query();
    // die();
    $result=$query->result();

    if($result)
    {
    	
        $temp='';              
    	foreach ($result as $key => $val) {
    		$temp.='<div class="swiper-slide"
                       '.$val->description.'</div>';
    	}
    	
    	return $temp;
    }
    return false;
}

 
  	public function get_menu($srchcol=false)
  	{ 
    	if($srchcol)
    	{
      		$this->ci->db->where($srchcol);
   	 	}
    	$query = $this->ci->db->get("modu_modules");
    	// echo $this->ci->db->last_query();
    	// die();
    	if ($query->num_rows() > 0) 
    	{
      		$data=$query->result();   
      		return $data;   
    	}   
    	return false;
  	}

  	public function menu_premission_main($parent, $level, $location=false, $filename=false, $first_call = true,$groupid=false) {
  		$groupArray=$this->get_permissionlist($groupid);

  		// print_r($groupArray);
 
		$usergroup=$this->ci->session->userdata(USER_GROUP);

	   	if($first_call == true): 
	        $this->ci->db->select('*');
	        $this->ci->db->from('modu_modules m');
	     
	        $this->ci->db->where(array('m.modu_parentmodule'=>0));
	       
	        $this->ci->db->order_by('m.modu_order','ASC');  
	        $qry=$this->ci->db->get();
	        $this->adjacencyCheckboxlist .= '<ul class="checktree">';  

	    else:
	    $this->ci->db->select('*');
	        $this->ci->db->from('modu_modules m');
	        $this->ci->db->where(array('m.modu_parentmodule'=>$parent));
	        $this->ci->db->order_by('m.modu_order','ASC');  
	        $qry=$this->ci->db->get();
	        // echo $this->db->last_query();
	        // die();
	        $this->adjacencyCheckboxlist .= "\n".'<ul>';
	    endif;

	    $oMenus=$qry->result();
	    // echo $this->ci->db->last_query();
	    // echo "<br>";
	    // echo "<pre>";
	    // print_r($oMenus);
	    // exit;
	 
	    foreach ($oMenus as $menu) :
	        $this->ci->db->select('*');
	        $this->ci->db->from('modu_modules m');
	        //  $this->ci->db->join('mope_modulespermission p','p.mope_moduleid=m.modu_moduleid','INNER');
	        // $this->ci->db->where(array('p.mope_hasaccess'=>1,'mope_usergroupid'=>$usergroup));
	        $this->ci->db->where(array('m.modu_parentmodule'=>$menu->modu_moduleid));
	        $this->ci->db->order_by('m.modu_order','ASC');  
	        $qry_sub=$this->ci->db->get();
	        // $this->ci->db->last_query();
	        // die();
	        $submenu_total=$qry_sub->result();

	        // echo count($submenu_total);
	        $ckd='';
	        if(!empty($groupArray)):
	        if(in_array($menu->modu_moduleid,$groupArray))
	        {
	          $ckd='checked=checked';
	        }
	        else
	        {
	          $ckd='';
	        }
	      endif;

        $other_att='';
        $menu_url = base_url($menu->modu_modulelink);
        $menu_name=$menu->modu_displaytext;
        $active = "";
        $target = '';
        $sub_class='';
        $caret='';
          	if(count($submenu_total)>0)
            {
             	$sub_class='';
         	}

            // foreach ($submenu_total as $ksm => $subtot) {
            // 	// echo $subtot->modu_moduleid."<br>";
            //   	$sub_sub_menu = $this->check_sub_menu($subtot->modu_moduleid);
            //   	if(count($sub_sub_menu) >0)
            //   	{
            //   		if($menu->modu_parentmodule!=0)
            //   		{  
            //   		$sub_class='dropdown-submenu';
            //   		}
            //     }
            // }
     
        if($menu->modu_parentmodule=='0')
        {
          	$class_menu_item='';
        }
        else
        {
          	$class_menu_item='';
        }
        if(count($submenu_total) > 0):
        
           $this->adjacencyCheckboxlist .= "\n".'<li class="'.$sub_class.' "><input  class="perm-check" type="checkbox" '.$ckd.' data-module_id='.$menu->modu_moduleid.'   />&nbsp;<strong>'.stripslashes($menu_name).'</strong>   ';
                // if($menu->link=='login' && empty($this->session->userdata('loggedin')))
                // {

                $this->menu_premission_main($menu->modu_moduleid, $level+1, $location, $filename, false,$groupid);
                // }
                $this->adjacencyCheckboxlist .= '</li>'."\n";
       
        else:
               $this->adjacencyCheckboxlist .= "\n".'<li class=" '.$sub_class.' "><span class="inline-check"><input class="perm-check"  type="checkbox" '.$ckd.' data-module_id='.$menu->modu_moduleid.'  />&nbsp;'.stripslashes($menu->modu_displaytext).'</span><span class="inline-check mw_100"><input  type="checkbox" />&nbsp;Create</span><span class="inline-check mw_100"><input  type="checkbox" />&nbsp;Edit</span><span class="inline-check mw_100"><input  type="checkbox" />&nbsp;Delete</span></li>'."\n";
        endif;


    endforeach;

    $this->adjacencyCheckboxlist .= "</ul>\n";
        
      // var_dump( $this->adjacencyCheckboxlist);exit;
    
      return $this->adjacencyCheckboxlist;
   }

   	public function get_permissionlist($groupid)
   	{
    	$arrayPer=array();
    	$this->ci->db->select('*');
        $this->ci->db->from('mope_modulespermission');
        $this->ci->db->where(array('mope_usergroupid'=>$groupid,'mope_hasaccess'=>1));
        $permission_list=$this->ci->db->get()->result();
    	if($permission_list)
    	{
      		foreach ($permission_list as $kp=>$per) {
       			$arrayPer[]=$per->mope_moduleid;
      		}
      		return $arrayPer;
    	}
    	return false;
   	}

   	public function check_sub_menu($id=false) {
        $this->ci->db->select('*');
        $this->ci->db->from('modu_modules m');
        $this->ci->db->where(array('modu_parentmodule'=>$id));
        $qry=$this->ci->db->get();
        // echo $this->ci->db->last_query();
        // die();
        if($qry->num_rows()>0)
        {
          return $qry->num_rows();
        }
        return false;
    }

    public function get_currenttime()
	{
		return date('H:i:s');
	}

	 //Function to fetch main navigation
		public function menu_adjacency_main($parent, $level, $location, $filename=false, $first_call = true) {
		if($first_call == true):	
				$this->ci->db->select('*');
				$this->ci->db->from('menu m');
				$this->ci->db->where(array($location=>'Y','menu_status'=>'1','menu_parent'=>'0'));
				$this->ci->db->order_by('menu_order','ASC');	
				$qry=$this->ci->db->get();
				$this->adjacencyList .= "<ul class='menuzord-menu'>";	
				// $oMenus=$qry->result();
				// echo "<pre>";
				// print_r($oMenus);
				// exit;
		else:
		$this->ci->db->select('*');
				$this->ci->db->from('menu m');
				$this->ci->db->where(array($location=>'Y','menu_status'=>'1','menu_parent'=>$parent));
				$this->ci->db->order_by('menu_order','ASC');	
				$qry=$this->ci->db->get();
				$this->adjacencyList .= "\n".'<ul class="dropdown">';
				

		endif;

		$oMenus=$qry->result();
		// echo "<pre>";
		// print_r($oMenus);
		// exit;

		foreach ($oMenus as $menu) :
				$this->ci->db->select('*');
				$this->ci->db->from('menu m');
				$this->ci->db->where(array('menu_status'=>'1','menu_parent'=>$menu->menu_id));
				$this->ci->db->order_by('menu_order','ASC');	
				$qry_sub=$this->ci->db->get();
				$this->ci->db->last_query();
				$submenu_total=$qry_sub->num_rows();
				
				$active = "";
				$target = '';
				if($menu->menu_type == 'custom' ):
					$url = parse_url($menu->menu_alias);
					if(in_array("https", $url) || in_array("http", $url)): //contains http
							$menu_alias = base_url().$menu->menu_url ;
							$target = 'target="_blank"';
					else:
						 	$menu_url = base_url().$menu->menu_url;
							$target = '';
							$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$linkarra = explode('/', $actual_link);
							$coun = sizeof($linkarra);
							for ($x=0; $x<$coun; $x++):
							 
								 	 if($linkarra[$x]==''):


								 	 	 	$active= 'active';
								 	 endif;	

							 endfor;

					endif;
				
				elseif($menu->menu_type == 'page' && $menu->menu_tpl == "default" ):
					$menu_url = base_url().$menu->menu_alias;
					$target = '';
					$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$linkarra = explode('/', $actual_link);
					$coun = sizeof($linkarra);
							for ($x=0; $x<$coun; $x++):
							 
								 	 if($linkarra[$x]=='page'):
								 	 	if($linkarra[$x+1]==$menu->menu_alias):

								 	 		$active= 'active';
								 	 	endif;	
								 	 	 	
								 	 endif;	

							 endfor;
 

					 // var_dump ($linkarra);exit;


				elseif( $menu->menu_type == 'post' && $menu->menu_tpl == 'default' ):
					$active = ($this->getActiveNav() == "post")? true:false;
					$menu_url = base_url()."pages/".$menu->menu_alias;

					
					elseif( $menu->menu_type == 'newss' && $menu->menu_tpl == 'default' ):
					$active = ($this->getActiveNav() == "newss")? true:false;
					$menu_url = base_url()."news";

					elseif( $menu->menu_type == 'gallery' && $menu->menu_tpl == 'default' ):
					$active = ($this->getActiveNav() == "gallery")? true:false;
					$menu_url = base_url()."galleries";

				

					else:
					$menu_url = '#';
					
				endif;
				// echo $menu->menu_parent;
				// exit;
				// echo "<br>";
				$nav_parent = $this->getMenuByID($menu->menu_parent);
				// print_r($nav_parent);
				// exit;
				if(is_object($nav_parent)){
					// var_dump($nav_parent);exit;
					$nav_parent_alias = $nav_parent->menu_alias;
				}
				else {
					$nav_parent_alias ="";
				}
				// echo $submenu_total;
				// exit;
				if($menu->menu_parent=='0')
				{
					$class_menu_item='menu__item';
				}
				else
				{
					$class_menu_item='';
				}
				if($submenu_total > 0):
																										
								$this->adjacencyList .= "\n".'<li><a class="dropdown-toggle"  href="#"  data-toggle="dropdown">'.stripslashes($menu->menu_title).'</a>';
								$this->menu_adjacency_main($menu->menu_id, $level+1, $location, $filename, false);
								$this->adjacencyList .= '</li>'."\n";
					
				else:
						   $this->adjacencyList .= "\n".'<li class="'.$class_menu_item.'" ><a class="menu__link" rel="'.$nav_parent_alias.'" id="'.$menu->menu_alias.'" href="'.$menu_url.'" '.$target.' title="'.stripslashes(strip_tags($menu->menu_title)).'">'.stripslashes($menu->menu_title).'</a></li>'."\n";
				endif;


		endforeach;

		$this->adjacencyList .= "</ul>\n";
				
			// var_dump( $this->adjacencyList);exit;
		
			return $this->adjacencyList;
		}	
 public function getMenuByID($id=false) {
		 		$this->ci->db->select('*');
				$this->ci->db->from('menu m');
				$this->ci->db->where(array('menu_status'=>'1','menu_id'=>$id));
				$qry=$this->ci->db->get();
				// echo $this->ci->db->last_query();
				// die();
				if($qry->num_rows()>0)
				{
					return $qry->result();
				}
				return false;
		}

	public function getActiveNav() {
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL); 
		return explode('/', $url)[0];
	}

	public function get_pages_info_by_slug($slug=false)
  	{
	    $this->ci->db->select('p.*,m.menu_title');
	    $this->ci->db->from('pages p');
	    $this->ci->db->join('menu m','m.menu_id=p.menu_id','LEFT');
	    if($slug)
	    {
	      $this->ci->db->where(array('m.menu_alias'=>$slug));
	    }
	    $query=$this->ci->db->get();
	    if($query->num_rows() >0)
	    {
	      	$result=$query->result();
	      	return $result;
	    }
	    return false;
	}

	/*date convert */
	public function EngToNepDateConv($date=false) {
        try {
        	$this->ci->db->select('need_bsdate');
        	$this->ci->db->from('need_nepequengdate');
        	$this->ci->db->where('need_addate',$date);
        	$query=$this->ci->db->get();
        	// echo $this->ci->db->last_query();
        	// die();
        	if($query->num_rows()>0)
        	{
        		$result= $query->row();
        		return $result->need_bsdate;
        	}
        	return false;

        } catch (Exception $e) {
            return array();
        }
	}

	public function NepToEngDateConv($date=false)
	{
	 	try {
        	$this->ci->db->select('need_addate');
        	$this->ci->db->from('need_nepequengdate');
        	$this->ci->db->where('need_bsdate',$date);
        	$query=$this->ci->db->get();
        	if($query->num_rows()>0)
        	{
        		$result= $query->row();
        		return $result->need_addate;
        	}
        	return false;

        } catch (Exception $e) {
            return array();
        }
    }

    public function getNepaliMonthName($month){
		$monthname = "";

		switch($month){
			case "01": $monthname = "Baisakh"; break;
			case "02": $monthname = "Jestha"; break;
			case "03": $monthname = "Ashad"; break;
			case "04": $monthname = "Shrawan"; break;
			case "05": $monthname = "Bhadra"; break;
			case "06": $monthname = "Ashwin"; break;
			case "07": $monthname = "Kartik"; break;
			case "08": $monthname = "Mangir"; break;
			case "09": $monthname = "Poush"; break;
			case "10": $monthname = "Magh"; break;
			case "11": $monthname = "Falgun"; break;
			case "12": $monthname = "Chaitra"; break;
		}
		return $monthname;
	}

}