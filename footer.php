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

<!-- START Parse.ly Include: Standard -->
<div id="parsely-root" style="display: none">
  <span id="parsely-cfg" data-parsely-site="denverpost.com"></span>
</div>
<script>
    (function(s, p, d) {
      var h=d.location.protocol, i=p+"-"+s,
          e=d.getElementById(i), r=d.getElementById(p+"-root"),
          u=h==="https:"?"d1z2jf7jlzjs58.cloudfront.net"
          :"static."+p+".com";
      if (e) return;
      e = d.createElement(s); e.id = i; e.async = true;
      e.src = h+"//"+u+"/p.js"; r.appendChild(e);
    })("script", "parsely", document);
</script>
<!-- END Parse.ly Include: Standard -->

</body>
</html>