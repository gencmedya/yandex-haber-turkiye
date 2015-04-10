<?ob_start();
setlocale(LC_ALL, "tr_TR.UTF-8") ;
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Thurs, 31 Jul 2014 05:00:00 GMT");
header("Content-Type: application/rss+xml; charset=UTF-8");
function yandex_haber_tr_formatchar($text)
{
	$re=array(
		'&' => '&amp;',
		'<' => '&lt;',
		'>' => '&gt;',
		"'" => '&apos;',
		'"' => '&quot;',
	);
	$text = strtr($text,$re);
	$re=array(
		'&amp;quot;'=>'&quot;',
		'&amp;#' => '&#'
	);
	return strtr($text,$re);
}
function cleat_title($title)
{
$search = array ("'<script[^>]*?>.*?</script>'si",  
                 "'<[\/\!]*?[^<>]*?>'si",           
                 "'([\r\n])[\s]+'",                 
                 "'&(quot|#34);'i",                 
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i"
);
$replace = array ("",
                  "",
                  "\\1",
                  "\"",
                  "&",
                  "<",
                  ">",
                  " ",
                  chr(161),
                  chr(162),
                  chr(163),
                  chr(169)
);
return preg_replace($search, $replace, $title);
}
function yandex_haber_tr_strip_wrap($text, $limit=200)
{
	$text=mb_substr($text,0,$limit);
	if(mb_substr($text,mb_strlen($text)-1,1) && mb_strlen($text)==$limit)
	{
		$textret=mb_substr($text,0,mb_strlen($text)-mb_strlen(strrchr($text,' ')));
		if(!empty($textret))
		{
			return $textret;
		}
	}
	return $text;
}
$cfg=get_option('yandex_haber_tr');
$category=array();
foreach($cfg['category'] as $k=>$v)
{
 	$category[]=$v;
}
echo '<?xml version="1.0" encoding="utf-8"?>';?>
<rss version="2.0"
xmlns:rss="http://www.w3.org/2001/XMLSchema"
xmlns:yandex="http://haber.yandex.com.tr"
xmlns:access="http://www.bloglines.com/about/specs/fac-1.0"
xmlns:admin="http://webns.net/mvcb/"
xmlns:ag="http://purl.org/rss/1.0/modules/aggregation/"
xmlns:annotate="http://purl.org/rss/1.0/modules/annotate/"
xmlns:app="http://www.w3.org/2007/app"
xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:audio="http://media.tangent.org/rss/1.0/"
xmlns:blogChannel="http://backend.userland.com/blogChannelModule"
xmlns:cc="http://web.resource.org/cc/"
xmlns:cf="http://www.microsoft.com/schemas/rss/core/2005"
xmlns:company="http://purl.org/rss/1.0/modules/company"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:conversationsNetwork="http://conversationsnetwork.org/rssNamespace-1.0/"
xmlns:cp="http://my.theinfo.org/changed/1.0/rss/"
xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:dcterms="http://purl.org/dc/terms/"
xmlns:email="http://purl.org/rss/1.0/modules/email/"
xmlns:ev="http://purl.org/rss/1.0/modules/event/"
xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0"
xmlns:fh="http://purl.org/syndication/history/1.0"
xmlns:foaf="http://xmlns.com/foaf/0.1"
xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#"
xmlns:georss="http://www.georss.org/georss"
xmlns:geourl="http://geourl.org/rss/module/"
xmlns:g="http://base.google.com/ns/1.0"
xmlns:gml="http://www.opengis.net/gml"
xmlns:icbm="http://postneo.com/icbm"
xmlns:image="http://purl.org/rss/1.0/modules/image/"
xmlns:indexing="urn:atom-extension:indexing"
xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
xmlns:kml20="http://earth.google.com/kml/2.0"
xmlns:kml21="http://earth.google.com/kml/2.1"
xmlns:kml22="http://www.opengis.net/kml/2.2"
xmlns:l="http://purl.org/rss/1.0/modules/link/"
xmlns:mathml="http://www.w3.org/1998/Math/MathML"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:openid="http://openid.net/xmlns/1.0"
xmlns:opensearch10="http://a9.com/-/spec/opensearchrss/1.0/"
xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/"
xmlns:opml="http://www.opml.org/spec2"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
xmlns:ref="http://purl.org/rss/1.0/modules/reference/"
xmlns:reqv="http://purl.org/rss/1.0/modules/richequiv/"
xmlns:rss090="http://my.netscape.com/rdf/simple/0.9/"
xmlns:rss091="http://purl.org/rss/1.0/modules/rss091#"
xmlns:rss1="http://purl.org/rss/1.0/"
xmlns:rss11="http://purl.org/net/rss1.1#"
xmlns:search="http://purl.org/rss/1.0/modules/search/"
xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
xmlns:ss="http://purl.org/rss/1.0/modules/servicestatus/"
xmlns:str="http://hacks.benhammersley.com/rss/streaming/"
xmlns:sub="http://purl.org/rss/1.0/modules/subscription/"
xmlns:svg="http://www.w3.org/2000/svg"
xmlns:sx="http://feedsync.org/2007/feedsync"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/"
xmlns:thr="http://purl.org/rss/1.0/modules/threading/"
xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:wiki="http://purl.org/rss/1.0/modules/wiki/"
xmlns:xhtml="http://www.w3.org/1999/xhtml"
xmlns:xlink="http://www.w3.org/1999/xlink"
xmlns:xrd="xri://$xrd*($v*2.0)">
<channel>
	<title><?=yandex_haber_tr_formatchar(cleat_title(get_bloginfo_rss('name')))?></title>
	<link><?=yandex_haber_tr_formatchar(htmlspecialchars(get_bloginfo_rss('url'),ENT_QUOTES))?></link>
	<description><?=htmlspecialchars(get_bloginfo_rss('description'),ENT_QUOTES)?></description>
	<image>
		<title><?=yandex_haber_tr_formatchar(cleat_title($cfg['alt']))?></title>
		<link><?=yandex_haber_tr_formatchar(htmlspecialchars($cfg['link']))?></link>
		<url><?=yandex_haber_tr_formatchar(htmlspecialchars($cfg['url']))?></url>
	</image>
   <?
   $posts_per_page=-1;
   if(!empty($cfg['count']))
   {
   		$posts_per_page=$cfg['count'];
   }
    $args=array(
		'cat'=>implode(',',$category),
		'posts_per_page'=>-1,
		'post_status'=>'publish'
	);
    query_posts($args);
	$options['description']=true;
	if (have_posts())
	{
		global $more;
		$more =1;
		while (have_posts())
		{
		the_post();
		$titleitem=cleat_title(get_the_title());
		?>
	<item>
		<title><?=yandex_haber_tr_formatchar(yandex_haber_tr_strip_wrap($titleitem))?></title>
		<link><?=yandex_haber_tr_formatchar(htmlspecialchars(get_permalink(),ENT_QUOTES))?></link>
		<description><?=yandex_haber_tr_formatchar(apply_filters('the_excerpt_rss',get_the_excerpt(true)))?></description>
		<yandex:genre>article</yandex:genre>
		<?php
		$categories = get_the_category($post->ID);
		 echo "<category>".yandex_haber_tr_formatchar(htmlspecialchars(strip_tags(get_the_category_by_ID($categories[0]->term_id), ENT_QUOTES)))."</category>\n"; ?>
		<?php rss_enclosure(); ?>

		<?
		preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content, $post_images);
		if(!empty($post_images[1]) && count($post_images[1])>0)
		{
			foreach($post_images[1] as $pi_k=>$pi_v)
			{
            	$image_info=getimagesize($pi_v);
            	$image_name=basename($pi_v);
            	$image_path=str_replace($image_name,'',$pi_v);
            	?><enclosure url="<?=$image_path.urlencode($image_name)?>" type="<?=$image_info['mime']?>"/><?
			}
		}
		?>
		<pubDate><?php
			$gmt_offset = get_option('gmt_offset');
			$gmt_offset = ($gmt_offset>9)?$gmt_offset.'00':('0'.$gmt_offset.'00');
			echo mysql2date('D, d M Y H:i:s +'.$gmt_offset, get_date_from_gmt(get_post_time('Y-m-d H:i:s', true)), false); ?></pubDate><?
			$content = apply_filters('the_content_rss', $post->post_content);
			$content=preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content );
			$content=preg_replace( '/<script\b[^>]*>(.*?)<\/script>/i', '', $content );
			?>
			<yandex:full-text><?=yandex_haber_tr_formatchar(htmlspecialchars(strip_tags($content,ENT_QUOTES)))?></yandex:full-text>
	</item>
	<?
		}
	}
	else
	{
	}
	?>
</channel>
</rss>