<?php
/**
Plugin Name: Telegram-Quickshare
Plugin URI: https://git.colinshark.de/ColinShark/yourls_tg-quickshare
Description: Add Telegram-Quickshare to YOURLS
Version: 1.0
Author: Nicolas Neht (ColinShark)
Author URI: https://colinshark.de
**/
yourls_add_action( 'share_links', 'prb_yourls_telegram' );
function prb_yourls_telegram( $args ) {
    list( $longurl, $shorturl, $title, $text ) = $args;
    $shorturl = rawurlencode( $shorturl );
    $title = rawurlencode( htmlspecialchars_decode( $title ) );
    $prb_path = YOURLS_PLUGINURL . '/' . yourls_plugin_basename( dirname(__FILE__) );
    $prb_icon = $prb_path.'/telegram.png';
    echo <<<TELEGRAM
    <style type="text/css">
    #share_tg{
        background:transparent url("$prb_icon") left center no-repeat;
    }
    </style>
    <a id="share_tg"
        title="Share via Telegram"
        onclick="javascript:window.open(this.href,'#tweet_body1', 'menubar=no,toolbar=no,height=1024,width=768,left=100');return false;">Telegram
    </a>
    <script type="text/javascript">
    // Dynamically update Telegram link
    // when user clicks on the "Share" Action icon, event $('#q1').keypress() is fired, so we'll add to this
      $('#tweet_body').keypress(function(){
          var tg_url = encodeURIComponent( $('#copylink').val() );
          var tg = 'https://telegram.me/share?url=', '+tg_url;
          $('#share_tg').attr('href', tg);        
      });
    </script>
    
TELEGRAM;
}