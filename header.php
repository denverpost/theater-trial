<?php
/**
 * The template for displaying the header
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */?><!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if ( IE 7 )&!( IEMobile )]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if ( IE 8 )&!( IEMobile )]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
<!-- WordPress head -->
<?php wp_head(); ?>
<!-- end WordPress head -->
<?php reactor_head(); ?>

<meta name="twitter:app:name:iphone" value="Denver Post">
<meta name="twitter:app:name:ipad" value="Denver Post">
<meta name="twitter:app:name:googleplay" value="The Denver Post">
<meta name="twitter:app:id:iphone" value="id375264133">
<meta name="twitter:app:id:ipad" value="id409389010">
<meta name="twitter:app:id:googleplay" value="com.ap.denverpost" />

<meta property="fb:app_id" content="105517551922"/>
<meta property="article:publisher" content="https://www.facebook.com/denverpost" />

<meta name="google-site-verification" content="AS2VvSiXejAUPYWy3RnQ_tL-tQ6NAbKWeaEL_O64z8k" />

<meta http-equiv="refresh" content="1800">

<meta name="language" content="en, sv" />
<meta name="Copyright" content="Copyright &copy; The Denver Post." />
<meta name="description" content="<?php echo $twitter_desc; ?>" />
<meta name="news_keywords" content="Aurora, theater, shooting, trial, James Holmes, Arapahoe County, Colorado, Batman, Century 16, crime" />

<?php $GLOBALS['dfmcat'] = '';
  $GLOBALS['dfmby'] = '';
  $GLOBALS['dfmid'] = '';
  $GLOBALS['dfmthetitle'] = get_bloginfo( 'name' );
  $GLOBALS['dfmcat'] = array('','');
if ( is_category() ) {
    $category = get_the_category();
    $GLOBALS['dfmcat'][0] = $category[0]->cat_name;
} else if ( is_tag() ) {
    $GLOBALS['dfmcat'][0] = single_tag_title( '', false );
} else {
    $GLOBALS['dfmcat'][0] = 'Home';
} ?>

<script type="text/javascript">
    //configure Chartbeat variables
    var _sf_startpt=(new Date()).getTime();
    //confiure Outbrainvariables
    var outbrainurl = '<?php echo get_permalink(); ?>';
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-62104666-1', 'auto');
  ga('send', 'pageview');
</script>
</head>

<body <?php body_class(); ?>>

<div id="omniture" style="display:none">
    <script type="text/javascript">var s_account="denverpost"</script>
    <script type="text/javascript" src="http://extras.mnginteractive.com/live/omniture/sccore.js"></script>
    <script type="text/javascript">
        s.trackExternalLinks = false
        s.pageName = document.title
        s.channel = "Theater Shooting Trial Blog"
        s.prop1 = "D=g"
        s.prop2 = "Theater Shooting Trial Blog/?"
        s.prop3 = "Theater Shooting Trial Blog/?/?"
        s.prop4 = "Theater Shooting Trial Blog/?/?/?"
        s.prop5 = "Theater Shooting Trial Blog/?/?/?/" + document.title
        var s_code=s.t();if(s_code)document.write(s_code)
    </script>
    <noscript><img src="http://denverpost.112.2O7.net/b/ss/denverpost/1/H.17--NS/0" height="1" width="1" border="0" alt="" /></noscript>
</div>

	<?php reactor_body_inside(); ?>

    <div id="page" class="hfeed site"> 
    
        <?php reactor_header_before(); ?>
    
        <header id="header" class="site-header" role="banner">
            <div class="row">
                <div class="<?php reactor_columns( 12 ); ?>">
                    
                    <?php reactor_header_inside(); ?>
                    
                </div><!-- .columns -->
            </div><!-- .row -->
        </header><!-- #header -->
        
        <?php reactor_header_after(); ?>
        
        <div id="main" class="wrapper">
