<?php
/**
Plugin Name: Telegram-Quickshare
Plugin URI: https://git.colinshark.de/ColinShark/yourls_tg-quickshare
Description: Add Telegram-Quickshare to YOURLS
Version: 0.2
Author: Nicolas Neht (ColinShark)
Author URI: https://colinshark.de
**/
yourls_add_action( 'share_links', 'telegram_share' );
function telegram_share( $args ) {
    list( $shorturl, $title, $text ) = $args;
    $shorturl = rawurlencode( $shorturl );
    $title = rawurlencode( htmlspecialchars_decode( $title ) );
    $prb_path = YOURLS_PLUGINURL . '/' . yourls_plugin_basename( dirname(__FILE__) );
    $tg_icon = $prb_path.'/telegram.png';
    echo <<<TELEGRAM
    <style type="text/css">
    #share_tg{
        background:transparent url("$tg_icon") left center no-repeat;
    }
    </style>
    <a id="share_tg" title="Share via Telegram" onclick="javascript:window.open(this.href,'#tweet_body1', 'menubar=no,toolbar=no,height=480,width=640,left=100,top=100');return false;">Telegram
    </a>
    <script type="text/javascript">
    // Dynamically update Telegram link
    // when user clicks on the "Share" Action icon, event $('#q1').keypress() is fired, so we'll add to this
      $('#tweet_body').keypress(function(){
          var tg_text = encodeURIComponent( $('#titlelink').val() );
          var tg_url = encodeURIComponent( $('#copylink').val() );
          var tg = 'https://t.me/share/url?url='+tg_url+'&text='+tg_text;
          $('#share_tg').attr('href', tg);
      });
    </script>
    
TELEGRAM;
}