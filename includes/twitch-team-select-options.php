<?php

/**
 * Add the admin options page
 * Called by admin_menu action
 * @return void
 */
define( 'TWITCH_TEAM_SELECT_ICON_URL', 'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" fill="#FFFFFF" xmlns="http://www.w3.org/2000/svg"><path fill="#FFFFFF" d="M15.5,0 L14,0 L14,5 L15.65,7.2 L14,16 L2,16 L0.35,7.2 L2,5 L2,0 L0.5,0 L15.5,0 Z M4,0 L8,3 L12,0 L4,0 Z M6,6 L6,7 L10,7 L9,6 L6,6 Z M9,7 L9,8 L10,8 L10,7 L9,7 Z M7,8 L7,9 L10,9 L10,8 L7,8 Z M9,9 L9,10 L10,10 L10,9 L9,9 Z M6,10 L6,11 L9,11 L10,10 L6,10 Z"/></svg>'));

function twitch_team_select_admin_add_page() {
  add_menu_page( 'Twitch Team', 'Twitch Team', 'manage_options', 'twitch_team_select', 'twitch_team_select_options_page', TWITCH_TEAM_SELECT_ICON_URL, null, 99);
}

add_action( 'admin_menu', 'twitch_team_select_admin_add_page' );
add_action( 'admin_enqueue_scripts', 'load_tts_api_request' );


function load_tts_api_request( $page ) {
  // change to the $page where you want to enqueue the script
  if( $page == 'twitch-team-select-options.php' ) {
    // Enqueue custom script that will interact with twitch api
    wp_enqueue_script( 'twitch_team_select_script', TWITCH_TEAM_SELECT_URL . '/js/twitch-team-select.js' , __FILE__ , array('$'), '0.1' );

  }
}



/**
 * Admin options page
 */
function twitch_team_select_options_page() {
  $options = get_option('twitch_team_select_options');
?>
  <div class="wrap">
    <h2>Twitch Team Select <span style="font-size:12px; font-variant: small-caps; font-family: Verdana, Geneva, sans-serif;">by <a class="pluginhelp" style=" text-decoration:none;" href="http://www.friendlyneighborhoodgeeks.com" rel="help">Anthony Lester</a></span></h2>

    <h2>Feedback, Requests &amp; Appreciation</h2>
        <div class="donate" style="width:320px; float:left; padding:20px; height:248px;">
            <a href="https://www.twitch.tv/products/friendlyngeeks/ticket?ref=below_video_subscribe_button" target="_blank" title="sub to me">
              <img alt="" border="0" src="<?php echo (TWITCH_TEAM_SELECT_URL . '/assets/teir1subteam.png')?>" width="320" height="80">
            </a>
            <a href="https://www.twitch.tv/products/friendlyngeeks_2000/ticket?ref=below_video_subscribe_button" target="_blank" title="sub to me">
              <img alt="" border="0" src="<?php echo (TWITCH_TEAM_SELECT_URL . '/assets/teir2subteam.png')?>" width="320" height="80">
            </a>
            <a href="https://www.twitch.tv/products/friendlyngeeks_3000/ticket?ref=below_video_subscribe_button" target="_blank" title="sub to me">
              <img alt="" border="0" src="<?php echo (TWITCH_TEAM_SELECT_URL . '/assets/teir3subteam.png')?>" width="320" height="80">
            </a>
       </div><!--.donate-->

      <p><strong>Feedback:</strong> I'm very interested in hearing your thoughts about the plugin. Please drop me a line on <a href="http://www.friendlyneighborhoodgeeks.com">FriendlyNeighborhoodGeeks.com</a> or stop by my <a target="_blank" href="https://twitch.tv/friendlyngeeks">stream</a> and say hello</p>
      <p><strong>Coding requests:</strong> If you have any particular modification request you can hire me to tailor the plugin to meet your needs. You can contact me <a href="mailto:friendlyneighborhoodgeeks@gmailcom">here</a> via email.</p>
      <p><strong>Say thanks:</strong> Developing a plugin takes time and energy. If you like the plugin consider making a using the buttons on the left to subcribe to me or a donation <a target="_blank" href="https://streamelements.com/tip/friendlyngeeks">here</a>. Thanks!</p>
      <div>
      <h2>INSTRUCTIONS</h2>
      <p>Ensure you have typed in the team name as it appears in the url ie(twitch.tv/team/<strong>trademarks</strong>), then press save.<br>Place this shortcode in any text on any page: <strong>[twitch_team_select]</strong> | and thats it. </p>
      </div>

    <form action="options.php" method="post">
    <?php settings_fields( 'twitch_team_select_options' ); ?>
    <?php do_settings_sections('twitch_team_select'); ?>
      <table class="form-table">
        <tr valign="top">
          <th scope="row">Select Your Team</th>
          <td>
            <input id="twitch_team_select_section_teamname" type="text" name="twitch_team_select_options[teamName]" value="<?php echo $options['teamName']; ?>" />
          </td>
        </tr>
      </table>
      <p class="submit">
        <input name="Submit" onclick="" class="team-save button button-primary" type="submit" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
      </p>
    </form>
  </div>
    <input name="Submit"  onclick="" class="submit button button-primary preview-team"  type="submit" value="<?php esc_attr_e( 'Show Team' ); ?>">
    <div>
      <h4>TEAM PREVIEW</h4>
    </div>
    <div id="twitchWrap">
      <div id="teamMembers">
      </div>
    </div>
    
    
<?php

}


function twitch_team_select_setting_description() {
  echo '<p>Main description of this section here.</p>';
}

  /**
  * Init admin options
  */
function twitch_team_select_admin_init() {
  register_setting( 'twitch_team_select_options' , 'twitch_team_select_options' );
  add_settings_section( 'twitch_team_select_main' , null , null , 'twitch_team_select' );
  add_settings_field( 'twitch_team_select_team', 'Team Name' , 'twitch_team_select_options_page', 'twitch_team_select' , 'twitch_team_select_section_options');
  wp_register_script( 'twitch_team_select_admin', TWITCH_TEAM_SELECT_URL . '/js/twitch-team-select-admin.js', array(), TWITCH_TEAM_SELECT_VER, true );
  wp_enqueue_script( 'twitch_team_select' , TWITCH_TEAM_SELECT_URL . '/js/twitch-team-select-admin.js' , array( 'jquery' ), TWITCH_TEAM_SELECT_VER, true );
  wp_enqueue_style( 'twitch_team_select', TWITCH_TEAM_SELECT_URL . '/css/twitch-team-select-admin.css', false, TWITCH_TEAM_SELECT_VER );
}

add_action( 'admin_init', 'twitch_team_select_admin_init' );


function make_admin_variables_js() {
  $options = get_option('twitch_team_select_options');
  $ballPass = $options['teamName'];
  echo '<script type="text/javascript">var twitchBall = "'.$ballPass.'";</script>';
}

add_action( 'admin_head', 'make_admin_variables_js' );

function make_variables_js() {
  $options = get_option('twitch_team_select_options');
  $ballPass = $options['teamName'];
  echo '<script type="text/javascript">var twitchBall = "'.$ballPass.'";</script>';
}

add_action( 'wp_head', 'make_variables_js' );


/**
* Twitch Team Select Shortcode
*/
function twitch_team_select_func( $atts ) {
    return '<div id="teamMembers"></div>';
}
add_shortcode( 'twitch_team_select', 'twitch_team_select_func' );