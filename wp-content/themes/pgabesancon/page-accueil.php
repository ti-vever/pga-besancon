<?php
/*
Template name: Accueil
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="center">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="article-accueil" <?php post_class(); ?>>
				
					<div class="entry-content">
						<?php the_content(); ?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->
				<aside id="aside-accueil">
					<div id="encart-visite" class="encart-accueil">
						<h1>Œuvres WOJTASZYK</h1>
						<a href="<?php echo get_permalink(29); ?>">
							<img src="wp-content/themes/pgabesancon/images/x2/poster_visite_virtuelle.jpg" class="x2" />
							<img src="wp-content/themes/pgabesancon/images/poster_visite_virtuelle.jpg" class="x1" />
						</a>
						Découvrez la visite virtuelle
					</div>

					<?php
				    $recentPosts = new WP_Query();
				    $recentPosts->query('showposts=2');
					?>
					<div id="encart-actualites" class="encart-accueil">
						<h1>Actualités</h1>
						<ul>
						<?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
						    <li><a href="<?php the_permalink() ?>"><?php the_title(); ?><br /><span><?php echo custom_excerpt(20,false); ?></span></a></li>
						<?php endwhile; ?>
						</ul>
						<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Voir toutes les actualités</a>
					</div>
				</aside>

				<div class="clear"></div>
				<?php /*comments_template();*/ ?>
			<?php endwhile; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>