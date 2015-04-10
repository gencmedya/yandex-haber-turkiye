<?
$blog_url=get_bloginfo('url');
if(substr($blog_url, strlen($blog_url)-1,1)!='/')
{
	$blog_url.='/';
}
$blog_url.='?feed=yandex';
?>
<style>
.yandex-haber-tr-description {
padding:6px;
color:#232323;
background:#FFFFE1;
}
.yandex-haber-tr-atention {
color:#ff0000;
font-size:12px !important;
}
.yandex-haber-tr-description-atention {
padding:6px;
background:#FFFFE1;
color:#DD5730;
border:1px solid #DD5730;
}
.yandex-haber-tr-description-atention span {
color:#232323;
}
input.yandex-haber-tr-field {
width:80%;
}
.yandex-haber-tr-category {
margin:22px 0px;
}
.yandex-haber-tr-category li ul {
padding:0px 0px 0px 15px;
}
.yandex-haber-tr-category li {
margin:4px 0px !important;
}
</style>
<div class="wrap">
<h2>Yandex Haber Türkiye Bileşeni (v.<?=YANDEX_HABER_TR_VERSION?>)</h2><br /> 
<?php echo '<img src="' . plugins_url( 'yandex-haber-tr/bayrak.gif' , dirname(__FILE__) ) . '" title="Ne Mutlu Türküm Diyene" style="position: absolute; right: 5px; bottom: 5px;"> ';?>
Yandexe göndereceğiniz link : <a class="yandex-haber-tr-atention"  target="_blank" href="<?=$blog_url?>">RSS Linkiniz</a>
<p class="yandex-haber-tr-description">Eklenti Yandex Türkiye için son yedi gün içindeki iletileri yada seçtiğiniz kadar haberi bellekte tutar. Mesajların tüm başlıkları 200 karakterden uzun olmamalıdır.Haberin tamamını depolar.Tüm görüntüler, mesajlar yayınlanmaktadır önerilen Yandex Türkiye rss sidir.</p>
<p class="yandex-haber-tr-description-atention">Lütfen daha fazla Wordpress eklentisinin Türkçesi için destek verin beğenelim <a href="https://www.twitter.com/gencmedya" target="_blank">@gencmedya</a> - <a href="https://www.facebook.com/gencmedyacom" target="_blank">Genç Medya Facebook</a></p>
<form name="" action="" method="post">
<input name="yandex_haber_tr_update" type="hidden" value="1" autocomplete="on"/>
<strong>Sitenizin Resmi:(Yandex'de Görünecek simge) sitenizde bulunan bir resim linki.</strong>
<p>
<input class="yandex-haber-tr-field" name="yandex_haber_tr[url]" type="text" value="<?=$this->cfg['url']?>" autocomplete="on"/>
</p>
<p class="yandex-haber-tr-description">(Animasyon olmayan bir resim seçin, Gif uzantılı olmalıdır , Boyutu - Maksimum 100px)</p>
<strong>Site İsmi:(Yandex Haberlerde Görünür.)</strong>
<p>
<input class="yandex-haber-tr-field" name="yandex_haber_tr[alt]" type="text" value="<?=$this->cfg['alt']?>" autocomplete="on"/>
</p>
<p class="yandex-haber-tr-description">HTML kabul eder.</p>
<strong>Sitenizin URL: </strong>
<p>
<input class="yandex-haber-tr-field" name="yandex_haber_tr[link]" type="text" value="<?=$this->cfg['link']?>" autocomplete="on"/>
</p>
<p class="yandex-haber-tr-description">Örn. (http://gencmedya.com)</p>
<strong>rss sayısı:</strong>
<p>
Yandex bot ileti gönderiminden sonra 15 saniyede gelir. Eğer siteniz çok büyük ise aşağıdan seçim yaparak rss nin içinde en son olarak kaç haber depolanacağını seçebilirsiniz.
</p>
<?
$select_count=array(
'0'=>'',
'100'=>'',
'90'=>'',
'80'=>'',
'70'=>'',
'60'=>'',
'50'=>'',
'40'=>'',
'30'=>'',
'20'=>'',
'10'=>'',
);
$select_count[$this->cfg['count']]=' selected';
?>
<p>
<select size="1" name="yandex_haber_tr[count]">
  <option value="0"<?=$select_count[0]?>>Son 7 gün</option>
  <option value="100"<?=$select_count[100]?>>100</option>
  <option value="90"<?=$select_count[90]?>>90</option>
  <option value="80"<?=$select_count[80]?>>80</option>
  <option value="70"<?=$select_count[70]?>>70</option>
  <option value="60"<?=$select_count[60]?>>60</option>
  <option value="50"<?=$select_count[50]?>>50</option>
  <option value="40"<?=$select_count[40]?>>40</option>
  <option value="30"<?=$select_count[30]?>>30</option>
  <option value="20"<?=$select_count[20]?>>20</option>
  <option value="10"<?=$select_count[10]?>>10</option>
</select>
</p>
<strong>Sütunlar</strong>
<p class="yandex-haber-tr-description">Yandexe gönderilmesini istedğiniz kategorileri seçin.
<p>
<?=$this->category()?>
</p>
<p><input class="button-primary" type="submit" value="Kaydet"/></p>
</form>
Daha fazlası için profilimizi takip ediniz. <a href="http://profiles.wordpress.org/gnckampus" target="_blank">Genç Medya</a> Wordpress Profili
</div>