<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Awaken
 */
?>
		</div><!-- container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="footer-widget-area">
					<div class="col-md-4">
						<div class="left-footer">
							<div class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-left' ) ) : ?>

								<?php endif; // end sidebar widget area ?>
							</div><!-- .widget-area -->
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="mid-footer">
							<div class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-mid' ) ) : ?>

								<?php endif; // end sidebar widget area ?>
							</div><!-- .widget-area -->						</div>
					</div>

					<div class="col-md-4">
						<div class="right-footer">
							<div class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-right' ) ) : ?>

								<?php endif; // end sidebar widget area ?>
							</div><!-- .widget-area -->				
						</div>
					</div>						
				</div><!-- .footer-widget-area -->
			</div><!-- .row -->
		</div><!-- .container -->	

		<div class="footer-site-info">	
			<div class="container">
				<div class="row">
				<?php 
					$footer_copyright_text = get_theme_mod( 'footer_copyright_text', '' );
					if( !empty( $footer_copyright_text ) ) {
						echo wp_kses_post( $footer_copyright_text ); 
					} else { ?>
						<div class="col-xs-12 col-md-6 col-sm-6">				
							<?php printf( __( '© Copyright %s - Viloo all rights reserved', '' ), date('Y') ); ?>
						</div>
						<div class="col-xs-12 col-md-6 col-sm-6 fr">
							<a href="mailto:huynhquangtrang1994@gmail.com"> <?php printf( __( 'Developed by Quang Trang' ) ); ?></a>
						</div>
				<?php } ?>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>