<div class="wrap">
  <h2>External Authentication Options</h2>

  <form method="post" action="options.php">
    <?php settings_fields('external-auth-settings'); ?>
    <?php do_settings_sections('external-auth-settings'); ?>
    <table class="form-table">
      <tr valign="top">
        <th scope="row">URL</th>
        <td><input type="text" name="authentication_url" value="<?php echo get_option('authentication_url'); ?>" /></td>
      </tr>
      <tr valign="top">
        <th scope="row">Login param name</th>
        <td><input type="text" name="login_param_name" value="<?php echo get_option('login_param_name'); ?>" /></td>
      </tr>
      <tr valign="top">
        <th scope="row">Password param name</th>
        <td><input type="text" name="password_param_name" value="<?php echo get_option('password_param_name'); ?>" /></td>
      </tr>
    </table>
    <?php submit_button(); ?>
  </form>
</div>
