<div class="wrap">

    <form method="post" action="options.php" novalidate="novalidate">

     <div id="InnerPageBannerOverlayLoader" class="InnerPageBannerOverlayLoaderClass=="></div>

      <?php wp_nonce_field('update-options') ?>

      <br><br>

      <h3 style="display: none;" id="myGetAccessTokenLinkloader">Loading</h3>

      <div id="access-token-succ-container">
          <?php if (!empty($access_token)) { ?>
              
              <div>
                <div class="access-token-succ-msg">Access token updated successfully</div>
              </div>

              <script type="text/javascript">
                  jQuery(document).ready(function(){

                    setTimeout(function(){ 

                            jQuery('#access-token-succ-container').remove();
                            jQuery('#InnerPageBannerOverlayLoader').removeClass('InnerPageBannerOverlayLoaderClass');

                    }, 3000);

                  });
              </script>

          <?php } ?>
      </div>

        <table class="form-table">

            <tbody>

            <tr>
                <th scope="row">
                    <label><?php echo _e('Shortcode', 'cus-spin-tool');?></label>
                </th>
            
                <td>
                <pre>[Show_My_Insta_Feed]</pre>
                </td>
            
            </tr>

             <tr>
                <th scope="row">
                    <label><?php echo _e('Get Access Token', 'cus-spin-tool');?></label>
                </th>
            
                <td>
               <a href="<?php echo $url;?>" class="button button-primary" id="myGetAccessTokenLink">Get Access Token</a>
                </td>
            
            </tr>


            <tr>
                <th scope="row">
                    <label><?php echo _e('Client Id', 'cus-spin-tool');?></label>
                </th>
            
                <td>
                <input name="MyInstaFeed_clientid" id="MyInstaFeed_clientid" type="text" class="regular-text" value="<?php if (get_option('MyInstaFeed_clientid')) echo get_option('MyInstaFeed_clientid'); ?>">
                </td>
            
            </tr>

            <tr>
                <th scope="row">
                    <label><?php echo _e('Client Secret', 'cus-spin-tool');?></label>
                </th>
            
                <td>
                <input name="MyInstaFeed_client_secret" id="MyInstaFeed_client_secret" type="text" class="regular-text" value="<?php if (get_option('MyInstaFeed_client_secret')) echo get_option('MyInstaFeed_client_secret'); ?>">
                </td>
            
            </tr>

            <tr>
                <th scope="row">
                    <label><?php echo _e('redirect_url', 'cus-spin-tool');?></label>
                </th>
            
                <td>
                <input name="MyInstaFeed_redirect_url" id="MyInstaFeed_redirect_url" type="text" class="regular-text" value="<?php if (get_option('MyInstaFeed_redirect_url')) echo get_option('MyInstaFeed_redirect_url'); ?>">
                </td>
            
            </tr>


            <tr>
                <th scope="row">
                    <label><?php echo _e('Access Token', 'cus-spin-tool');?></label>
                </th>
            
                <td>
                <input name="MyInstaFeed_access_token" id="MyInstaFeed_access_token" type="text" class="regular-text" value="<?php if (get_option('MyInstaFeed_access_token')) echo get_option('MyInstaFeed_access_token'); ?>">
                </td>
            
            </tr>

            </tbody>

        </table>

        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="MyInstaFeed_clientid, MyInstaFeed_client_secret, MyInstaFeed_redirect_url, MyInstaFeed_access_token" />
      
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
        </p>

    </form>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){

    if (jQuery('#MyInstaFeed_redirect_url').val() == "") {  
        var admin_url = "<?php echo admin_url().'options-general.php?page=my-instagram-feed'; ?>";
        jQuery('#MyInstaFeed_redirect_url').val(admin_url);
    }

    jQuery(document).on('click', '#myGetAccessTokenLink', function(){

        jQuery('#InnerPageBannerOverlayLoader').addClass('InnerPageBannerOverlayLoaderClass');

    });

  });
</script>


<style type="text/css">
.access-token-succ-msg{
    background-color: #447944;
    color: #fff;
    padding: 5px;
    border-radius: 2px;
    font-size: 14px;
    width: 100%;
}

.InnerPageBannerOverlayLoaderClass{
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(167, 159, 159, 0.5);
    z-index: 9999;
    cursor: pointer;
    background-image: url('<?php echo MyInstaFeed_URL?>/spinner-2x.gif');
    background-repeat: no-repeat;
    background-position: center;
}
</style>