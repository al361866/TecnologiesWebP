<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
			    
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) :
					?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
                        <?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
								)
							);
						?>					</nav><!-- .social-navigation -->
					<?php
					
				endif;
				

				get_template_part( 'template-parts/footer/site', 'info' );
				?>
				<h5>Copyright Rasoelectronic</h5>
				<h5>Adrián Sorribas Segura & Ferran Ramia Tena</h5>

				<aside>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6056.990287900814!2d-0.10588382297647608!3d40.61896116116939!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5f826921eb2015%3A0x44dc51618342d7d1!2sCastillo%20de%20Morella!5e0!3m2!1ses!2ses!4v1573838706596!5m2!1ses!2ses" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
<iframe src="https://www.tiempo.com/wimages/fotoadb08536f13da0e4bc0282c889aed16b.png" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</aside>
				
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
