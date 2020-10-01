<?php
/*
Plugin Name: CoronaStatics
Plugin URI: https://devecity.com/CoronaStatics
Description: this plugin retrieving real-time coronavirus data into your website. we are using api for showup the data to your website via this plugin. here you can use the widgets for show the statics anywhere you else. also you can use our shortcode to show the data to any of your theme files. more information include while you installed the plugin to your wordpress website.
Author: DeveCity
Author URI: https://devecity.com/
License: GPL3
Version: 1.0

*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License version 3
as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

License Details: http://www.gnu.org/licenses/gpl-3.0.html
*/


// includes widgets
require_once plugin_dir_path(__FILE__) . 'countries/bangladesh.php';
require_once plugin_dir_path(__FILE__) . 'all_data/global.php';
//includes shortcode
require_once plugin_dir_path(__FILE__) . 'shortcode/bangladesh.php';
require_once plugin_dir_path(__FILE__) . 'shortcode/global.php';

if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

// widgets for corona statics
function coronastatics_widgetreg()
{
    register_widget('coronastatics_bangladeshwidget');
    register_widget('coronastatics_globalwidget');
}
add_action('widgets_init', 'coronastatics_widgetreg');

// translate functions
 function coronastatics_translator($number){
     $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0","Jan","Feb","Mar", "Apr", "May", "Jun","Jul","Aug","Sep","Oct","Nov","Dec","Mon","Tue","Wed","Thu","Fri","Sat","Sun");
    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০","জানুয়ারী","ফেব্রুয়ারী","মার্চ", 
  "এপ্রিল","মে","জুন","জুলাই","আগস্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","শনিবার","রবিবার");
   
    $bn_number = str_replace($search_array, $replace_array, $number);

    return $bn_number;
}
add_filter( 'plugin_row_meta', 'coronastatics_devecity', 10, 2 );
 
// developer's social link 
function coronastatics_devecity( $links, $file ) {    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'docs'    => '<a href="' . esc_url( 'https://www.facebook.com/hacku2day/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Developer', 'domain' ) . '" style="color:green;">' . esc_html__( 'Developed By: Liton', 'domain' ) . '</a>'
        );
 
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}

// fetching json data for bangladesh
function coronastatics_bangladeshapi(){
    $endPoint   = 'https://api.devecity.com/CoronaStatics/';
            $methodPath = 'bangladesh.php';
            $endPoint = $endPoint.$methodPath;

            $argment = array(
                'timeout' => 60
            ); 

            $request = wp_remote_get($endPoint, $argment);
            $body = wp_remote_retrieve_body( $request );
            
            return $body;
}

//fetching json data for world
function coronastatics_globalapi(){
    $endPoint   = 'https://api.devecity.com/CoronaStatics/';
            $methodPath = 'world.php';
            $endPoint = $endPoint.$methodPath;

            $argment = array(
                'timeout' => 60
            ); 

            $request = wp_remote_get($endPoint, $argment);
            $body = wp_remote_retrieve_body( $request );
            
            return $body;
}

// translate functions
function coronastatics_translator_bangladesh($perm = "cases"){
    
            return coronastatics_translator($perm);
        }

function coronastatics_translator_world($perm){
    return $perm;
}

/**
* to enqueue scripts and styles.
*/
$DeveCity ="test";
function coronastatics_assets()
{
    wp_enqueue_style('solaiman-lipi-css', '//fonts.maateen.me/solaiman-lipi/font.css');
    wp_enqueue_style('corona-css', plugin_dir_url(__FILE__) . 'styles/main.css',array(),time());
}
add_action('wp_enqueue_scripts', 'coronastatics_assets');