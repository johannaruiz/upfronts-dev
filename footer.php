<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foxlive
 */

$theme_class = get_field('field_5ec21974d4504', 'option');
$override_predefined_defaults = get_field('field_5ec212ca04fd0', 'option');
$disable_login = get_field('field_5f5866a60b401', 'option');
$login_message = get_field('field_5f47fc94ed9c8', 'option');
$disable_login_message = get_field('field_5f586bc2f054b', 'option');
$login_message_copy = '';
if ( $login_message ):
	$login_message_copy = $login_message;
else:
	$login_message_copy = 'All login credentials are currently inactive.';
endif;
$page_content_submit_button_color = get_field('field_5ec2137804fd4', 'option');

$legal_copy = get_field('field_5eaa5cbe66de8', 'option');

?>

<footer>
  <div class="row">
    <div class="columns">
      <?php if ( $legal_copy ): ?>
        <?php echo $legal_copy; ?>
      <?php else: ?>
        <p>Trademark & Copyright Notice: <sup>&trade;</sup> and <sup>&copy;</sup> <?php echo date('Y'); ?> Fox Media LLC. All rights reserved. Use of this Website (including any and all parts and components) constitutes your acceptance of these <a href="https://www.fox.com/article/fox-networks-sites-and-services-terms-of-use-agreement-597bc239ef528f0026dc0316/" target="_blank">Terms of Use</a> and <a href="https://www.fox.com/article/privacy-policy-597bbe4f6603660022fa8689/" target="_blank">Updated Privacy Policy</a>. <a href="https://www.fox.com/article/do-not-sell-5df81e0a23fb8600186ecc17/" target="_blank">DO NOT SELL MY PERSONAL INFORMATION</a></p>
      <?php endif; ?>
    </div>
  </div>
</footer>

<div class="reveal" id="contact" data-reveal>
  <h2>Request Assistance</h2>
  <p class="assistance-intro">Use the form below or email <a href="mailto:support@live.fox">support@live.fox</a> <!--or call <a href="tel:+12133701010">213-370-1010</a>--> </p>
  <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
  <button class="close-button" data-close aria-label="Close modal" type="button">
   <span aria-hidden="true">&times;</span>
 </button>
</div>

<?php wp_footer(); ?>


  <script>
	<?php if ( $override_predefined_defaults ): ?>
    if ( $$('body').hasClass('<?php echo $theme_class; ?>') ){
      $$('#wppb-submit').css('background-color', '<?php echo $page_content_submit_button_color; ?>');
    }
	<?php else: ?>
	/*No defaults overriden*/
	<?php endif; ?>
	<?php if ( $login_message_copy ): ?>
		<?php if ( $disable_login_message ): ?>
		<?php else: ?>
		if ( $$('#wppb-login-wrap').length > 0 ){
			var loginMessage = "<?php echo $login_message_copy; ?>";
			$$('<p>'+ loginMessage +'</p>').insertBefore($$('#wppb-login-wrap') ).css('padding-left', '0px').css('font-size', '15px').css('margin-top', '1rem').css('font-weight', '700');
		}
		<?php endif; ?>

	<?php else: ?>
	/*No Login Message Copy*/
	<?php endif; ?>

	<?php if ( $disable_login ): ?>
		$$('#wppb-submit, #user_login, #user_pass').attr('disabled', 'true');
	<?php else: ?>
	/*Login was not disabled*/
	<?php endif; ?>
  </script>


<?php if ( is_user_logged_in() ): ?>

<?php else: ?>

<?php endif; ?>
<!--
<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});
</script><script type="text/javascript">window.Beacon('init', 'c8173700-705f-487c-a1bc-02070e10efb9')</script>
-->
</body>
</html>
