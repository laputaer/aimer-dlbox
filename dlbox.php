<?php
/*
Plugin Name:dlbox
Plugin URI: https://ht.acgbuster.com
Description: 在wordpress原生编辑器上注册一个“下载面板”的按钮，只需按照相应提示填写，就可以获得一个规整的下载面板
Version: 1.0
Author:A酱
Author URI: https://www.acgbuster.com
*/
function aimerforreimu_my_add_mce_button()
{
    add_filter('mce_external_plugins', 'A_my_add_tinymce_plugin');
    add_filter('mce_buttons', 'A_my_register_mce_button');
}
add_action('admin_head', 'A_my_add_mce_button');
add_action('wp_head', 'A_my_add_mce_button');
function aimerforreimu_my_add_tinymce_plugin($plugin_array)
{
    $plugin_array['specs_code_plugin'] = plugin_dir_url(__FILE__) . '/js/dlbox.js';
    return $plugin_array;
}
function aimerforreimu_my_register_mce_button($buttons)
{
    array_push($buttons, 'specs_code_plugin');
    return $buttons;
}
function aimerforreimu_dlbox_style()
{
    echo '<link rel="stylesheet" href="' . plugin_dir_url(__FILE__) . 'css/dlbox.css" type="text/css" />';
}
function aimerforreimu_dlbox($atts, $content = null)
{
    extract(shortcode_atts(array('b' => '', 'c' => '', 'd' => '', 'e' => '', 'f' => ''), $atts));
    $out = '<span style="font-size: 12pt;"><div class="aimerforreimudown" id="aimerforreimudown"><div class="down-title"><br>下<br>载<br>面<br>板</div><div class="down-detail"><p class="down-price"><i class="fa fa-calendar" aria-hidden="true"></i>
来源：<span>' . $b . '</span><a style="color: #FF0000;"> 【文件大小：' . $f . '】</a></p><p class="down-ordinary"><i class="fa fa-clock-o" aria-hidden="true"></i>
更新日期：' . $c . '</p>
      <p class="down-vip"><i class="fa fa-ravelry" aria-hidden="true"></i>
提取码&解压密码：' . $d . '</p><p class="down-tip"><i class="fa fa-magnet" aria-hidden="true"></i>
磁力：' . $e . '</p><p><p class="down-tip"><i class="fa fa-connectdevelop" aria-hidden="true"></i>
传送门：' . $content . '</div><div class="clear"></div></div></span>';
    return $out;
}
add_shortcode('dlbox', 'dlbox');

