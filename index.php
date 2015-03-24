<?php get_header(); ?>
<div class="container">
	<div id="main" role="main" class="span16">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}//end while
		} else {
			?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title">
						Nothing Found
					</h1>
				</header>
				<div class="entry-content">
					<p>
						Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.
					</p>
					<?php get_search_form(); ?>
				</div>
			</article>
			<?php
		}//end else
		?>
	</div>
</div>
<?php
get_footer();
