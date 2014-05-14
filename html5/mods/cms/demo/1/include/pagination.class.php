<?php  
/**
 * example:
 * 			$pagination = new Pagination();
 *			$paginationConfig['base_url']   = 'http://10.5.16.99/test/lechen/trunk/easy_union/test.php?';
 *			$paginationConfig['total_rows'] = '1000';
 *			$paginationConfig['num_links']  = '5';
 *			$paginationConfig['cur_page']   = intval($_GET['page']) ? intval($_GET['page']) : 1;
 *			
 *			$pagination->initialize($paginationConfig);
 *			echo 	$pagination->create_links();
 *
 *			Pagination类中的成员变量都可以自定义配置来改变分页的的默认样式
 */
class Pagination {

	//初始化的时候通常需要重新设置过
	var $base_url			= ''; // The page we are linking to
	var $total_rows			= ''; // Total number of items (database results)
	var $per_page			= 10; // Max number of items you want shown per page
	var $num_links			=  2; // Number of "digit" links to show before/after the currently viewed page
	var $cur_page			=  1; // The current page being viewed

	var $prefix				= ''; // A custom prefix added to the path.
	var $suffix				= ''; // A custom suffix added to the path.
	var $first_link			= '1';
	var $next_link			= '下一页';
	var $prev_link			= '上一页';
	var $last_link			= '尾页';
	var $full_tag_open		= '<div class="pb1 clearfix"><div id="pagingBars" class="page_nav">'; //整个分页HTML外包装的头部
	var $full_tag_close		= '</div></div>'; //整个分页HTML外包装的尾部
	var $first_tag_open		= '<li>'; //首页标签外包装的头部
	var $first_tag_close	= '</li><li class="pagebarDot">...</li>'; //首页标签外包装的尾部
	var $last_tag_open		= '<li class="pagebarDot">...</li><li>'; //尾页标签包装的头部
	var $last_tag_close		= '</li>';   //尾页标签包装的尾部
	var $first_url			= ''; // Alternative URL for the First Page.
	var $cur_tag_open		= '<li  class="page_nav_current">';  //当前页标签外包装的头部
	var $cur_tag_close		= '</li>';		 //当前页标签外包装的尾部
	var $next_tag_open		= '<span class="page_nav_next">';			 //下一页标签外包装的头部
	var $next_tag_close		= '</span>';			 //下一页标签外包装的尾部
	var $prev_tag_open		= '<span class="page_nav_prev">';			 //上一页标签外包装的头部
	var $prev_tag_close		= '</span>';				 //上一页标签外包装的尾部
	var $num_tag_open		= '<li>';			 //页码标签外包装的头部
	var $num_tag_close		= '</li>';				 //页码标签外包装的尾部
	var $query_string_segment = 'page';
	var $display_pages		= TRUE;				 //是否显示页码
	var $anchor_class		= '';				 //页码数字样式
	var $show_total_num		= 0; 				 //是否显示总的数据条数
	var $total_num_tag_open = '总数:';
	var $total_num_tag_close = '&nbsp;&nbsp;';
	
	var $page_num_area_tag_open = '<ul>';   //分页数字区标签包装的头部
	var $page_num_area_tag_close = '</ul>'; //分页数字区标签包装的尾部
	var $next_prev_link_together = 1;  //上一页和下一页是否显示在一起
	var $is_show_first_last_link = 1; //是否显示首页和尾页提示
	var $is_show_input_page	= 1; //是否显示页面输入框
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function __construct($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		}

		if ($this->anchor_class != '')
		{
			$this->anchor_class = 'class="'.$this->anchor_class.'" ';
		}

	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
		
	}

	// --------------------------------------------------------------------

	/**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */
	function create_links()
	{
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			return '';
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
			return '';
		}

		$this->num_links = (int)$this->num_links;

		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = 1;
		}

		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $num_pages)
		{
			$this->cur_page = $num_pages;
		}

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
		
		//确保一开始显示时页面的数量是$this->num_links×2个 (页数够的话)
		if($num_pages - $this->cur_page < $this->num_links )
		{
			$start = $start - ($this->num_links - ($num_pages - $this->cur_page));
		}		
		if($start < 1){
			$start = 1;
		}
		if($this->cur_page - $this->num_links<0 )
		{
			$end = $end + ($this->num_links - $this->cur_page);
		}
		if($end > $num_pages)
		{
			$end = $num_pages;
		}
				
		$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';

		// And here we go...
		$output = '';

		if($this->show_total_num == 1)
		{
			$output .= $this->total_num_tag_open.$this->total_rows.$this->total_num_tag_close;
		}
		


		// Render the "previous" link
		if  ($this->prev_link !== FALSE AND $this->cur_page != 1)
		{
			$i = $this->cur_page - 1;

			if ($i == 0 && $this->first_url != '')
			{
				$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}
			else
			{
				$i = ($i == 0) ? '' : $this->prefix.$i.$this->suffix;
				$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$i.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}

		}
		
		if( $this->next_prev_link_together == 1)
		{
			// Render the "next" link
			if ($this->next_link !== FALSE AND $this->cur_page < $num_pages)
			{
				$output .= $this->next_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.($this->cur_page + 1).$this->suffix.'">'.$this->next_link.'</a>'.$this->next_tag_close;
			}			
		}

		// Render the pages
		if ($this->display_pages !== FALSE)
		{
			$output .= $this->page_num_area_tag_open;
			// Render the "First" link
			if  ($this->is_show_first_last_link && $this->first_link !== FALSE && $start > 1)
			{
				$first_url = ($this->first_url == '') ? $this->base_url.'1' : $this->first_url;
				$output .= $this->first_tag_open.'<a '.$this->anchor_class.'href="'.$first_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;
			}			
			// Write the digit links
			for ($loop = $start ; $loop <= $end; $loop++)
			{

				if ($this->cur_page == $loop)
				{
					$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
				}
				else
				{
					$n = $loop;

					if ($n == '' && $this->first_url != '')
					{
						$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.'">'.$loop.'</a>'.$this->num_tag_close;
					}
					else
					{
						$n = ($n == '') ? '' : $this->prefix.$n.$this->suffix;

						$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$n.'">'.$loop.'</a>'.$this->num_tag_close;
					}
				}

			}
			// Render the "Last" link
			if ($this->is_show_first_last_link && $this->last_link !== FALSE && $end < $num_pages)
			{
				$i = $num_pages;
				$output .= $this->last_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$i.$this->prefix.$this->suffix.'">'.$num_pages.'</a>'.$this->last_tag_close;
			}			
			$output .= $this->page_num_area_tag_close;
		}

		if( $this->next_prev_link_together != 1)
		{
			// Render the "next" link
			if ($this->next_link !== FALSE AND $this->cur_page < $num_pages)
			{
				$output .= $this->next_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.($this->cur_page + 1).$this->suffix.'">'.$this->next_link.'</a>'.$this->next_tag_close;
			}
		}


		$output .= '<form action="'.$this->base_url.'" class="page_nav_jump"  method="get" id="pageForm" onsubmit="document.getElementById(\'gotopagebutton\').click(); return false;"> 第 <input type="text" class="text" name="page" id="inputPage" size="3"> 页 <input id="gotopagebutton" onClick="var page = parseInt(this.previousSibling.previousSibling.value); if(page<1 || isNaN(page)){page=1;}else if(page>'.$num_pages.'){page='.$num_pages.';}  location.href=\''.$this->base_url.'\'+page;" type="button" class="submit" value="跳转"> 
					</form>';
		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;

		return $output;
	}
}