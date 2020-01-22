<?php
/*
Plugin Name: My Insta Feed
Description: This is the My Instagram Feed plugin
Author: Gaurav Sharma
Text Domain: my-insta-feed
*/

//prefix: MyInstaFeed

defined( 'ABSPATH' ) or die();

define( 'MyInstaFeed_VERSION', '1.0.0' );
define( 'MyInstaFeed_URL', plugin_dir_url( __FILE__ ) );
define( 'MyInstaFeed_PATH', plugin_dir_path( __FILE__ ) );

if (!class_exists('MyInstaFeed')) {

  class MyInstaFeed {
    
        function __construct(){  
          
          add_action( 'admin_menu', array($this, 'MyInstaFeed_admin_menu_fun') );

          add_shortcode('Show_My_Insta_Feed', array($this, 'show_MyInstaFeed_shortcode_fun'));

        }

        public function MyInstaFeed_admin_menu_fun(){

            $page_title = $menu_title = "My Instagram Feed";
            $capability = "manage_options";
            $menu_slug = "paypal-invoice-merchant-info-settings-options";
            $function = "paypal_invoice_merchantInfo_settings_options";
            add_options_page( $page_title, $page_title, 'manage_options', 'my-instagram-feed', array($this, 'MyInstaFeed_Options_Page'));

        }

        public function MyInstaFeed_Options_Page(){

            $client_id = get_option('MyInstaFeed_clientid');
            $client_secret = get_option('MyInstaFeed_client_secret');
            $redirect_url = get_option('MyInstaFeed_redirect_url');

            $url = 'https://api.instagram.com/oauth/authorize/?client_id='.$client_id.'&redirect_uri='.$redirect_url.'&response_type=code';

            $code = $_GET['code'];

            if (isset($code)) { 

                //echo 'code :: '.$code;

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.instagram.com/oauth/access_token",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"client_id\"\r\n\r\n".$client_id."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"client_secret\"\r\n\r\n".$client_secret."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"grant_type\"\r\n\r\nauthorization_code\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"redirect_uri\"\r\n\r\n".$redirect_url."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"code\"\r\n\r\n".$code."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                  CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: multipart/form-data; boundary=--------------------------495548333179656603950242",
                    "Cookie: PHPSESSID=54bhhr9tcnjk741eam375gn0e9",
                    "Host: api.instagram.com",
                    "Postman-Token: f07a5763-2126-4944-98c1-c67c65f4818b,ae3ec74f-9913-445f-a2da-c9bee453afed",
                    "User-Agent: PostmanRuntime/7.20.1",
                    "cache-control: no-cache",
                    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
                  ),



                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                $api_response = json_decode($response, true);


                if ($err) {
                    echo "<pre>"; print_r($api_response);echo "</pre>";
                }

                if ($api_response['error_type'] != 'OAuthException' && $api_response['code'] != 400) { 

                    $access_token = $api_response ['access_token'];

                    update_option('MyInstaFeed_access_token', $access_token);
                    
                }else{

                    $access_token = "";

                }


            }
           
           require_once 'settings/my-settings.php';

        }



        public function show_MyInstaFeed_shortcode_fun(){

            ob_start();

            $access_token = get_option('MyInstaFeed_access_token');

            set_time_limit(150);

            $data = array();  

            $data['access_token'] = $access_token; 

            $data['max_id'] = '';

            $data['min_id'] = '';

            $data['count'] = '';

            $api_response = $this->MyInstaFeed_API_POST($data);

            $api_response_interpreted = json_decode($api_response, true);

            $insta_data = $api_response_interpreted['data'];

            ?>

            <?php foreach ($insta_data as $data) { ?>

              <?php
              $images = $data['images']['thumbnail']['url']; 
              $text = $data['caption']['text'];
              $created_time = $data['created_time'];
              ?>

              <div>
                <img src="<?php echo $images;?>"> 
                <div><?php echo 'text: '.$text;?></div>
                <div><?php echo 'created_time: '.$created_time;?></div>
              </div>

            <?php } ?>

            <?php

            return ob_get_clean();

        }

        public function MyInstaFeed_API_POST($data){
          $data_raw = "";
          foreach ($data as $key => $value){
            $data_raw = $data_raw . $key . "=" . urlencode($value) . "&";
          }

          $client_url =  "https://api.instagram.com/v1/users/self/media/recent/?".$data_raw;

          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $client_url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $response = trim(curl_exec($ch));
          curl_close($ch);
          return $response;
        }


    }
   
}
new MyInstaFeed;