<?php
/**
 * @package Get Go Galapagos
 * @version 1.0
 */
/*
Plugin Name: Go Galapagos iPartners
Plugin URI: https://ipartners.gogalapagos.com
Description: This plugin allows you to have a communication interace with Go Galapagos, in order to give your visitors the chance to quote a cruise for Galapagos Island with Go Galapagos Cruises
Author: Jose Manuel Rodriguez padrino
Version: 1.0
Author URI: http://jmrpadrino.com
*/
require_once('ipartners_gogalapagos_widget.php');

define('GETGOGALAPAGOS_DEFULAT_CSS',
      '.getgogalapagos{max-width:320px;width:100%;border-width:4px;border-style:solid;padding:28px 32px;display:block;margin:18px 0}.getgogalapagos h2{text-align:center;font-size:24px;font-weight:700;color:orange;line-height:1}.getgogalapagos select{width:100%;height:36px;padding:5px;border-radius:4px}.getgogalapagos a.more-departures-link{display:block;text-align:right;text-decoration:none;font-size:10px;margin-top:8px;color:orange!important}.getgogalapagos button{margin:18px auto;border-radius:4px;padding:8px 17px;text-align:center;background:orange;color:#2f2f2f;border:none;display:block;font-weight:900;text-transform:uppercase}');

// CREAR EL SHORTCODE PARA INYECTAR LAS FUNCIONES DEL COTIZADOR
add_shortcode('getgogalapagos', 'goga_main_function');
function goga_main_function($atts, $content = null){
    
    if(array_key_exists('theme', $atts)){
        $tema = $atts['theme'];
    }
    if(array_key_exists('title', $atts)){
        $titulo = $atts['title'];
    }
    if(array_key_exists('align', $atts)){
        $alinear = $atts['align'];
    }
    
    ob_start();
    ?>
<div id="getgogalapagos" class="getgogalapagos <?= !empty($tema) ? $tema  : '' ?> <?= !empty($alinear) ? $alinear  : '' ?>">
    <h2><?= !empty($titulo) ? $titulo : _e('Go travel to<br />Galapagos Island', 'gogalapagos') ?></h2>
    <form id="getgogalapagos-form" role="form" action="https://quote.gogalapagos.com/en/site/cruceros" target="_blank">
        <input type="hidden" name="site" value="<?= $_SERVER['SERVER_NAME'] ?>">
        <input type="hidden" name="partner" value="<?= md5('123') ?>">
        <label>How many of you?</label>
        <select name="pax">
            <option value="1">1</option>
            <option value="2" selected>2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
        <br />
        <label>Our nearly departure dates</label>
        <br />
        <select name="date">
            <option>Please choose one</option>
            <option value="1">Mar 5th - 8th 2018 (A) - Galapagos Legend</option>
            <option value="2">Mar 7th - 11th 2018 (B) - Coral Yacths</option>
            <option value="3">Mar 8th - 12th 2018 (B) - Galapagos Legend</option>
            <option value="4">Mar 11th - 14th 2018 (C) - Coral Yatchs</option>
            <option value="5">Mar 12th - 15th 2018 (C) - Galapagos Legend</option>
        </select>
        <br />
        <button type="submit">Find My Cruise Now</button>
    </form>
    <img class="getgogalapagos-logo" src="https://www.gogalapagos.com/assets/images/logo-34-anos-blanco.png">
</div>
    <?php
    return ob_get_clean();
}
add_action('admin_enqueue_scripts','add_getgogalapagos_style_and_scripts_for_admin');
function add_getgogalapagos_style_and_scripts_for_admin(){
    return;
}
add_action('wp_enqueue_scripts', 'add_getgogalapagos_style_and_scripts_for_theme');
function add_getgogalapagos_style_and_scripts_for_theme(){
    echo '<!-- Get Go Gapalagos plugin. -->';
    wp_enqueue_style( 'getgogalapagos',  plugin_dir_url( __FILE__ ) .'css/getgogalapagos.css', array(), $ver, 'screen' );
    wp_enqueue_script( 'getgogalapagos', plugin_dir_url( __FILE__ ) .'js/getgogalapagos.js', array ( 'jquery' ), $ver, true);
}