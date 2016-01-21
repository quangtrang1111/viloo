<?php
/**
 * The template for displaying all single posts.
 *
 * @package Awaken
 */

get_header(); ?>
<div class="row">
<?php is_rtl() ? $rtl = 'awaken-rtl' : $rtl = ''; ?>

<!--QuangTrang-->  
    <div class="col-xs-1 col-sm-1 col-md-2" style="position: fixed; margin-bottom:50px"><?php echo adrotate_ad(2); ?></div>
    <div class="col-xs-1 col-sm-1 col-md-2" style="width:180px"></div>
<!--QuangTrangEnd-->

<div class="col-xs-12 col-sm-12 col-md-7 <?php echo $rtl ?>">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php awaken_post_nav(); ?>

			<?php
                if ( get_theme_mod( 'display_post_comments', 1 ) ) {
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() ) :
                        comments_template();
                    endif;

                }
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .bootstrap cols -->
<div class="col-xs-12 col-sm-6 col-md-3">
	<?php get_sidebar(); ?>
</div><!-- .bootstrap cols -->
</div><!-- .row -->
<?php get_footer(); ?>