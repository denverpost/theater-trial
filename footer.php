<?php
/**
 * The template for displaying the footer
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>
       
        <?php reactor_footer_before(); ?>
        
        <footer id="footer" class="site-footer" role="contentinfo">
        
        	<?php reactor_footer_inside(); ?>
  
        </footer><!-- #footer -->
        
        <?php reactor_footer_after(); ?>

    </div><!-- #main -->
</div><!-- #page -->

<?php wp_footer(); reactor_foot(); ?>

<script type="text/javascript">
	var _sf_async_config={};
	/** CONFIGURATION START **/
	_sf_async_config.title = "<?php echo get_bloginfo( 'name' ); ?>";
	_sf_async_config.uid = 2671;
	_sf_async_config.domain = "denverpost.com";
	_sf_async_config.sections = "<?php echo $GLOBALS['dfmcat'][0]; ?>";
	_sf_async_config.useCanonical = false;
	/** CONFIGURATION END **/
	(function(){
	  function loadChartbeat() {
	    window._sf_endpt=(new Date()).getTime();
	    var e = document.createElement("script");
	    e.setAttribute("language", "javascript");
	    e.setAttribute("type", "text/javascript");
	    e.setAttribute('src', '//static.chartbeat.com/js/chartbeat.js');
	    document.body.appendChild(e);
	  }
	  var oldonload = window.onload;
	  window.onload = (typeof window.onload != "function") ?
	     loadChartbeat : function() { oldonload(); loadChartbeat(); };
	})();
</script>

</body>
</html>