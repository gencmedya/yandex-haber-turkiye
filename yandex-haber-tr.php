<?
/*
 Plugin Name: Yandex Haber Türkiye
 Plugin URI: http://gencmedya.com/
 Description: Yandex Haber Türkiye 1.0 Bileşeni ile haberlerinizi Yandex Türkiye Haber de yayınlatabilirsiniz.
 Author: Genç Medya
 Author URI: http://gencmedya.com/
 Version: 1.0
 */
if ('yandex-haber-tr.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Bu dosyaya doğrudan erişemezsiniz. Teşekkurler');
define('YANDEX_HABER_TR_VERSION', '1.0');
define('YANDEX_HABER_TR_FOLDER_NAME', dirname(plugin_basename(__FILE__)));
define('YANDEX_HABER_TR_PATH', plugin_dir_path(__FILE__));
define('YANDEX_HABER_TR_URL', plugin_dir_url(__FILE__));



class yandex_haber_tr
{
	var $cfg=array();
	function yandex_haber_tr()
	{
		add_action('do_feed_yandex', array(&$this,'feed'),1);
		add_action('init', array(&$this,'init'));
        add_action('activate_yandex-haber-tr/yandex-haber-tr.php',array(&$this,'activate'));
        add_action('deactivate_yandex-haber-tr/yandex-haber-tr.php',array(&$this,'deactivate'));
		add_action('admin_menu', array(&$this,'menu'));
	}
	function feed($comments)
	{
    	if (!$comments)
    	{
        	global $wp_query;
	    	if($wp_query->query_vars['feed']=='yandex')
	    	{
		   		function filter_where($where = '') {
					$today_date = get_the_date('Y-m-d');
					$where .= " AND post_date >= '" . date('Y-m-d', strtotime('-7 days')) . "' AND post_date <= '" . date('Y-m-d', strtotime('+1 days')) . "'";
					return $where;
				}
		   		add_filter('posts_where', 'filter_where');
            	load_template( YANDEX_HABER_TR_PATH.'/template.php');
	    	}
		}
	}
	function category($categoryId=false){
        $full=false;
        $ret='<ul>';
        $args=array(
        	'hide_empty'=>0,
        	'hierarchical'=>0,
        	'parent'=>0
        );
        if($categoryId)
        {
        	$args['parent']=$categoryId;
        }
    	$category = get_categories( $args );
        foreach($category as $k=>$v)
    	{
        	$checked='';
        	if(isset($this->cfg['category'][$v->cat_ID]))
        	{
        		$checked=' checked';
        	}
        	$ret.='<li><div><input autocomplete="off" id="yandex_haber_trcat'.$v->cat_ID.'" name="yandex_haber_tr_category['.$v->cat_ID.']" type="checkbox" value="'.$v->cat_ID.'"'.$checked.'> <label for="yandex_haber_trcat'.$v->cat_ID.'">'.$v->name.'</label></div>';
            $ret.=$this->category($v->cat_ID);
        	$ret.='</li>';
    	}
        $ret.='</ul>';
        if($ret!='<ul></ul>')
        {
        	$full=$ret;
        }
        if(!$categoryId)
        {
        	$ret='<div class="yandex-haber-tr-category">'.$ret.'</div>';
        }
    	return $ret;
    }
    function init()
    {
    	$this->cfg=get_option('yandex_haber_tr');

    	if(is_admin() && !empty($_POST['yandex_haber_tr_update']))
    	{
    		if(!empty($_POST['yandex_haber_tr_category']))
    		{
            	$this->cfg['category'] = $_POST['yandex_haber_tr_category'];
    		}
    		else
    		{
             	$this->cfg['category']=array();
    		}
    		if(!empty($_POST['yandex_haber_tr']))
    		{
    			if(!empty($_POST['yandex_haber_tr']['url']) && trim($_POST['yandex_haber_tr']['url'])!=$this->cfg['url'])
    			{
    				$this->cfg['url']=trim($_POST['yandex_haber_tr']['url']);
    			}
                elseif(empty($_POST['yandex_haber_tr']['url']))
    			{
                	$this->cfg['url']='';
    			}
    			if(!empty($_POST['yandex_haber_tr']['alt']) && trim($_POST['yandex_haber_tr']['alt'])!=$this->cfg['alt'])
    			{
    				$this->cfg['alt']=trim($_POST['yandex_haber_tr']['alt']);
    			}
                elseif(empty($_POST['yandex_haber_tr']['alt']))
    			{
                	$this->cfg['alt']='';
    			}
    			if(!empty($_POST['yandex_haber_tr']['link']) && trim($_POST['yandex_haber_tr']['link'])!=$this->cfg['link'])
    			{
    				$this->cfg['link']=trim($_POST['yandex_haber_tr']['link']);
    			}
    			elseif(empty($_POST['yandex_haber_tr']['link']))
    			{
                	$this->cfg['link']='';
    			}
    			if(!empty($_POST['yandex_haber_tr']['count']) && trim($_POST['yandex_haber_tr']['count'])!=$this->cfg['count'])
    			{
    				$this->cfg['count']=trim($_POST['yandex_haber_tr']['count']);
    			}
    			elseif(empty($_POST['yandex_haber_tr']['count']))
    			{
                	$this->cfg['count']=0;
    			}
    		}
    		update_option( 'yandex_haber_tr', $this->cfg);
            $this->cfg=get_option('yandex_haber_tr');
    	}
    }
    
	function activate()
	{
    	$cfg=array(
    		'url'=>'',
    	    'alt'=>get_bloginfo('name'),
    	    'link'=>get_bloginfo('url'),
    	    'category'=>array()
    	);
    	add_option( 'yandex_haber_tr', $cfg);
	}
	function deactivate()
	{
    	delete_option('yandex_haber_tr');
	}
	function menu()
	{
    	add_options_page('Yandex Haber Turkiye', 'Yandex Haberler', 10, __FILE__, array(&$this,'config'));
	}
	function config()
	{
    	include "config.php";
	}
}
$yandex_haber_tr = new yandex_haber_tr();
?>