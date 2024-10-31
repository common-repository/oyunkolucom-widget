<?php
/*
Plugin Name: OyunKolu RSS Bileşeni
Plugin URI: http://www.oyunkolu.com
Description: Oyunkolu RSS bileşen desteği kaldırılmıştır. Özel reklam istekleriniz için bizimle oyun@cntbilisim.com.tr adresinden irtibata geçebilirsiniz.
Version:3.1.4
Author: Oyunkolu
Author URI: http://www.oyunkolu.com
License: All Free
*/

// Sabitler  Eger bir sorun varsa sayfayi yoket.
defined('ABSPATH') or die("Bu bölüme erişim izniniz yok.");
defined("DS") or define("DS", DIRECTORY_SEPARATOR);

/*
define('OYUNKOLU', 'http://www.oyunkolu.com/');
define('REF', 'oyunkolu');
define('WEBSITE', $_SERVER['SERVER_NAME']);
define('BLOGURI', get_bloginfo('url'));

// Widget Tanit
add_action('widgets_init','oyunkolu_widget');
function oyunkolu_widget() {
	register_widget('OyunKolu');
}
// Ana Sablon
class OyunKolu extends WP_Widget {
	  function OyunKolu() {
		  $widget_ops = array('classname'=> 'oyunkolu_rss','description' => 'Oyunkolu.com sitesinden içerikleri RSS ile çekiniz.' );
		  $control_ops = array('width' => 500, 'height' => 450);
		  $this->WP_Widget('oyunkolu', 'Oyunkolu RSS Bileşeni',$widget_ops, $control_ops);      
	  }
	  function following() {
	  	$url_dogru = parse_url(BLOGURI);
		$url_al = $url_dogru['host'];
		return $url_al;
	  }
	  function filtering($value, $type){
	  	switch ($type){
			case 'url':
				$value = stripslashes($value);
				return $value;
			break;
			case 'number':
			$value = (int) $value;
				return $value;
			break;
			case 'text':
				$value = htmlspecialchars( strip_tags($value), ENT_QUOTES);
				return $value;
			break;
			case 'deep':
				$value = htmlentities(strip_tags($value), ENT_QUOTES);
				return $value;
			break;
			case 'normal':
				return trim($value);
			break;
		}
	  }
	  function form($instance) {
		  // select box rss kategorileri - selectbox kaç adet yazı - selectbox tipi (yan menü - geniş menü) - css text
		  $default_csstext = '.oyunkolu{clear:both;overflow:hidden;}'."\n".'.oyunkolu h2{font-weight:bold;font-size:13px;padding:10px 10px 2px 10px;margin-bottom: 5px;border-bottom:1px dotted #ccc;background:none;}'."\n".'.oyunkolu h2 span.oyunkolulogo{ float:right; margin-top:-20px;}'."\n".'.oyunkolu h2 a:link,.oyunkolu h2 a:visited {display:block;font-size:13px;font-weight:bold;text-decoration:none;background:none;}'."\n".'.oyunkolu h2 a:hover,.oyunkolu h2 a:active{display:block;font-size:13px;font-weight:bold;text-decoration:none;background:none;}'."\n".'.oyunkolu .oyun{float:left;width:100px;height:100px;margin-bottom:4px; text-align:center;}'."\n".'.oyunkolu .oyun img{border:1px solid #D4D4D4;height:68px;width:82px;background:none;padding:1px;}'."\n".'.oyunkolu .oyun a:link,.oyunkolu .oyun a:visited {display:block;font-size:11px;text-decoration:none;background:none;}'."\n".'.oyunkolu .oyun a:hover,.oyunkolu .oyun a:active{display:block;font-size:11px;text-decoration:none;background:none;}';
		  $oyunkolu_categories = array(
					  'rss' => 'Yeni Eklenen Oyunlar', 
					  'rss/en-cok-oynanan-oyunlar' => 'En Çok Oynanan Oyunlar (Yeni)',
					  'rss/2-oyunculu-oyunlar' => '2 Kişilik Oyunlar',
					  'rss/3-boyutlu-oyunlar' => '3D Oyunlar',
					  'rss/araba-oyunlari' => 'Araba Oyunları',
					  'rss/avatar-oyunlari' => 'Avatar Oyunları',
					  'rss/bakugan-oyunlari' => 'Bakugan Oyunları',
					  'rss/barbie-oyunlari' => 'Barbie Oyunları',
					  'rss/beceri-oyunlari' => 'Beceri Oyunları',
					  'rss/ben-10-oyunlari' => 'Ben 10 Oyunları',
					  'rss/boyama-oyunlari' => 'Boyama Oyunları',
					  'rss/bratz-oyunlari' => 'Bratz Oyunları',
					  'rss/cizgi-film-oyunlari' => 'Çizgi Film Oyunları',
					  'rss/cocuk-oyunlari' => 'Çocuk Oyunları',
					  'rss/dovus-oyunlari' => 'Dövüş Oyunları',
					  'rss/futbol-oyunlari' => 'Futbol Oyunları',
					  'rss/giydirme-oyunlari' => 'Giydirme Oyunları',
					  'rss/kagit-oyunlari' => 'Kağıt Oyunları',
					  'rss/karisik-oyunlar' => 'Karışık Oyunlar',
					  'rss/kiz-oyunlari' => 'Kız Oyunları',
					  'rss/komik-oyunlar' => 'Komik Oyunlar',
					  'rss/macera-oyunlari' => 'Macera Oyunları',
					  'rss/makyaj-oyunlari' => 'Makyaj Oyunları',
					  'rss/mario-oyunlari' => 'Mario Oyunları',
					  'rss/motor-oyunlari' => 'Motor Oyunları',
					  'rss/naruto-oyunlari' => 'Naruto Oyunları',
					  'rss/nisan-oyunlari' => 'Nişan Oyunları',
					  'rss/online-oyunlar' => 'Online Oyunlar',
					  'rss/savas-oyunlari' => 'Savaş Oyunları',
					  'rss/spor-oyunlari' => 'Spor Oyunları',
					  'rss/strateji-oyunlari' => 'Strateji Oyunları',
					  'rss/sue-oyunlari' => 'Sue Oyunları', 
					  'rss/webcam-oyunlari' => 'Webcam Oyunları', 
					  'rss/winx-oyunlari' => 'Winx Oyunları', 
					  'rss/yaris-oyunlari' => 'Yarış Oyunları', 
					  'rss/yemek-oyunlari' => 'Yemek Oyunları', 
					  'rss/yetenek-oyunlari' => 'Yetenek Oyunları', 
					  'rss/zeka-oyunlari' => 'Zeka Oyunları'					
		  );
		  $oyunkolu_howmany = array('5','6','8','9','10');		  
		  // Form bolumu
		  $defaults = array('oyunkolutitle' => 'Oyun Kolu', 'rsscategory' => 'rss', 'rsslimit' => '10', 'csstext' => $default_csstext);
		  $instance = wp_parse_args( (array) $instance, $defaults );
		  
		  // Form Bilgileri
		  $oyunkolutitle = esc_attr($instance['oyunkolutitle']);
		  $rsscategory = esc_attr($instance['rsscategory']);
		  $rsslimit = $this->filtering($instance['rsslimit'], 'number');
		  if($instance['csstext']) {
		  	$csstext = esc_textarea($instance['csstext']);
		  } else {
			$csstext = esc_textarea($default_csstext); 	
		  }
		  ?>
        <p>
		<label for="<?php echo $this->get_field_id('oyunkolutitle'); ?>">Başlık</label> 
		<input class="widefat" id="<?php echo $this->get_field_id('oyunkolutitle'); ?>" name="<?php echo $this->get_field_name('oyunkolutitle'); ?>" type="text" value="<?php echo $oyunkolutitle; ?>" />
		</p>
         <p>
         	<label for="<?php echo $this->get_field_id('rsscategory'); ?>">Kategori Seçiniz</label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'rsscategory' ); ?>" name="<?php echo $this->get_field_name( 'rsscategory' ); ?>">
         		<?php 
				foreach($oyunkolu_categories as $key => $arg)
				{
					if($rsscategory == $key) { $write = ' selected="selected"'; } else { $write = ""; }
					$output = '<option value="'.$key.'"'.$write.'>'.$arg.'</option>';
					echo $output;
				} ?>
            </select>
         </p>
         <p>
         	<label for="<?php echo $this->get_field_id('rsslimit'); ?>">Yazı Adedi</label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'rsslimit' ); ?>" name="<?php echo $this->get_field_name( 'rsslimit' ); ?>">
         		<?php 
				foreach($oyunkolu_howmany as $arg)
				{
					if($rsslimit == $arg) { $write = ' selected="selected"'; } else { $write = ""; }
					$output = '<option value="'.$arg.'"'.$write.'>'.$arg.'</option>';
					echo $output;
				} ?>
            </select>
         </p>
         <p>
         	<label for="<?php echo $this->get_field_id('csstext'); ?>">CSS Ayarları</label>
         	<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('csstext'); ?>" name="<?php echo $this->get_field_name('csstext'); ?>"><?php echo $csstext; ?></textarea>
         </p>
		  <?php
	  }
  
	  function update($new_instance, $old_instance) {
		  // Formdan gelen verilerin temizlenip donduruldugu bolum
		  if($new_instance['rsscategory'] != $old_instance['rsscategory']) {
			  $clientname = REF;
			  $filename = $clientname.'.xml';
			  $cachefile = plugin_dir_path(__FILE__).'xml/'.$filename; // gerçek yolu bulması için ayarlama yapılması gerekiyor.
			  unlink($cachefile);
		  }
		  // widgette update edildiğinde mevcut cachefile sıfırlanacak - silinecek.
		  $new_instance = array_map('strip_tags', $new_instance);
		  $instance = wp_parse_args($new_instance, $old_instance);
		  return $instance;
		  
	  }
  
	  function widget($args, $instance) {
		  extract($args);
		  
		  // Bu bölüm widgetin çıktısının olduğu bölüm
		  $oyunkolutitle = esc_attr($instance['oyunkolutitle']);
		  $rsscategory = esc_attr($instance['rsscategory']);
		  $rsslimit = $this->filtering($instance['rsslimit'], 'number');
		  //$rss_type = esc_attr($instance['rss_type']);
		  $csstext = esc_textarea($instance['csstext']);
		  
		  // Default widgets
		  $before_widgets = $before_widget."\n".'<div class="oyunkolu">'."\n";
		  $after_widgets = '</div><!--/oyunkolu -->'.$after_widget;
		  $addcss = '<style type="text/css"><!-- /*Oyunkolu CSS* /'."\n".$csstext."\n".'--></style>'."\n";
		  
		  // RSS'in cekilmesi islemleri
		  $clientname = REF;
		  $clienturl = stripslashes(OYUNKOLU.$rsscategory.'?'.REF.'='.WEBSITE);
		  $filename = $clientname.'.xml';
		  
		  $defaultfile = plugin_dir_path(__FILE__).'xml/oyunkolu_standart.xml'; // varsayılan dosya ismi
		  $cachefile = plugin_dir_path(__FILE__).'xml/'.$filename; // gerçek yolu bulması için ayarlama yapılması gerekiyor.
		  $cachetime = 3 * 60 * 60; // 3 saatte bir
		  $findtime = time() - $cachetime;
		  if (file_exists($cachefile)) {
		  	$cachefiletime = filemtime($cachefile);
		  } else {
		    $cachefiletime = time();
		  }
		  
		  if (file_exists($cachefile) && ($findtime < $cachefiletime)) { 
		  	// dosya var veya cache süresi henüz bitmemis ise
			$this->rsstemplate($cachefile, false, $rsslimit, $csstext, false, $before_widgets, $after_widgets, $addcss,$rsscategory);
		  } else {
		  	// dosya yok veya cache süresi dolmuş ise
			if(!function_exists('curl_open')){
				
				// Curl kütüphanesi yüklü ve aktif ise
				$session = curl_init();	
				curl_setopt($session, CURLOPT_URL, $clienturl);
				curl_setopt($session, CURLOPT_HEADER, false);
				curl_setopt($session, CURLOPT_FOLLOWLOCATION, false);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				$storedata = curl_exec($session);
				curl_close($session);
				if($storedata) {
					// storedata içi dolu
					$this->rsstemplate($cachefile, $storedata, $rsslimit, $csstext, true, $before_widgets, $after_widgets, $addcss,$rsscategory);
				} else {
					// storedata ici bos
					$this->rsstemplate($cachefile, false, $rsslimit, $csstext, false, $before_widgets, $after_widgets, $addcss,$rsscategory);
				} // storedata end
			} else { 
				// Curl kütüphanesi kapalı ise 2.yola basvur file_get_contents
				$storedata = file_get_contents($clienturl);
				if($storedata) {
					// storedata içi dolu
					$this->rsstemplate($cachefile, $storedata, $rsslimit, $csstext, true, $before_widgets, $after_widgets, $addcss,$rsscategory);
				} else {
					// storedata ici bos
					$this->rsstemplate($cachefile, false, $rsslimit, $csstext, false, $before_widgets, $after_widgets, $addcss,$rsscategory);
				} // storedata end
			}
		  }
	  }
	  function rsstemplate($filename, $storedata, $rsslimit, $csstext, $type = true, $before ='', $after = '', $addcss, $rsscategory)
	  {
		  echo $before;
		  echo $addcss;
		  if($type) { @file_put_contents($filename,$storedata,FILE_USE_INCLUDE_PATH);}
		  $xml = @simplexml_load_file($filename, 'SimpleXMLElement',LIBXML_NOCDATA);
		  if (file_exists($filename)){ $filename = $filename; } else { $filename = $defaultfile; }	
			  	// general info
				$title 	= $this->filtering($xml->channel->title, 'text'); // Site Name
				$url 	= esc_url($xml->channel->link); // Site URL
				if($rsscategory == 'rss'){
				  	$seotitle = 'Yeni Oyunlar';
				  } else {
				  	$seotitle = $title;
				  }
				echo '<h2><a target="_blank" href="'.$url.'" title="'.$seotitle.'">'.$seotitle.'</a><span class="oyunkolulogo"><a target="_blank" href="'.OYUNKOLU.'" title="Oyun"><img src="'.plugins_url( "images/oyun_kolu_logo.gif" , __FILE__ ).'" alt="" /></a></span></h2>';
				// all posts
				for($i=0; $i<$rsslimit; $i++)
				{	
					$ptitle 	= $this->filtering($xml->channel->item[$i]->title, 'text');
					$plink 		= esc_url($xml->channel->item[$i]->link);
					$pimg 		= $xml->channel->item[$i]->image->url;
					if($pimage){
						$pthumb = $pimage;
					} else {
						$pcontent	= preg_match( '/src="([^"]*)"/i', $xml->channel->item[$i]->description, $pthumb_string);
						if($pthumb_string) {
							$pthumb = $pthumb_string[1];
						} else {
							$pthumb		= 'images/no-image.gif';
						}
					}
					$cikti = '<div class="oyun"><a target="_blank" href="'.$plink.'" title="'.$ptitle.' Oyunu"><img src="'.$pthumb.'" alt="" /></a><a target="_blank" href="'.$plink.'">'.$ptitle.'</a></div>';
					echo $cikti;
				} // for end
		  echo $after;
	  }
  
  }
  */
?>