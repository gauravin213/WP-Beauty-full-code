<div class="wrap">
  <h1>Gs User Settings</h1>

 <p>Get short code : [gs-user-login]</p>
 <p>Get short code : [gs-user-reg]</p>

  <form action="options.php" method="post">
  <?php wp_nonce_field('update-options') ?>

  	<table class="optiontable editform"><tbody>
         <tr>
            <td></td>
            <td>
               <label for="gs_user_enable_option">
               	Enable
                  <input id="gs_user_enable_option" type="checkbox"
                        name="gs_user_enable_option" value="1"  <?php if (get_option('gs_user_enable_option') == 1) echo 'checked="checked"'; ?>/>
               </label>
            </td>
         </tr>
      </tbody>
  	</table>

  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="gs_user_enable_option" />
  <input type="submit" name="Submit" value="<?php _e('Update Options') ?>" />
  </form>
</div>