<?php
/*
Plugin Name:dlbox
Plugin URI: https://ht.acgbuster.com
Description: 在wordpress原生编辑器上注册一个“下载面板”的按钮，只需按照相应提示填写，就可以获得一个规整的下载面板
Version: 1.0
Author:aimer酱
Author URI: https://www.acgbuster.com
*/
function aimer_my_add_mce_button()
{
    add_filter('mce_external_plugins', 'aimer_my_add_tinymce_plugin');
    add_filter('mce_buttons', 'aimer_my_register_mce_button');
}
add_action('admin_head', 'aimer_my_add_mce_button');
add_action('wp_head', 'aimer_my_add_mce_button');
function aimer_my_add_tinymce_plugin($plugin_array)
{
    $plugin_array['specs_code_plugin'] = plugin_dir_url(__FILE__) . '/js/dlbox.js';
    return $plugin_array;
}
function aimer_my_register_mce_button($buttons)
{
    array_push($buttons, 'specs_code_plugin');
    return $buttons;
}
function plugincss() {       
    wp_register_style( 'plugin', plugins_url( 'css/dlbox.css' , __FILE__ ) );  
    if ( !is_admin() ) {           
        wp_enqueue_style( 'plugin' );  
    }  
}  
add_action( 'init', 'plugincss' );
function aimer_dlbox($atts, $content = null)
{
    extract(shortcode_atts(array('b' => '', 'c' => '', 'd' => '', 'e' => '', 'f' => ''), $atts));
    $out = '<span style="font-size: 12pt;"><div class="aimerdown" id="aimerdown"><div class="down-title"><br>下<br>载<br>面<br>板</div><div class="down-detail"><p class="down-price"><i class="fa fa-calendar" aria-hidden="true"></i>
来源：<span>' . $b . '</span><a style="color: #FF0000;"> 【文件大小：' . $f . '】</a></p><p class="down-ordinary"><i class="fa fa-clock-o" aria-hidden="true"></i>
更新日期：' . $c . '</p>
      <p class="down-vip"><i class="fa fa-ravelry" aria-hidden="true"></i>
提取码&解压密码：' . $d . '</p><p class="down-tip"><i class="fa fa-magnet" aria-hidden="true"></i>
磁力：' . $e . '</p><p><p class="down-tip"><i class="fa fa-connectdevelop" aria-hidden="true"></i>
传送门：' . $content . ',<p hidden>本下载框使用A酱的插件:aimer-dlbox生成<br />了解更多信息请访问 https://ht.acgbuster.com</p></div><div class="clear"></div></div></span>';
    return $out;
}
add_shortcode('aimer_dlbox', 'aimer_dlbox');

