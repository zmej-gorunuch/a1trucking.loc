<?php
/**
 * Template part for displaying code block
 *
 * @package WebLorem
 */

/**
 * Custom fields
 */
$block_2 = get_field( 'block_2', page_id_by_template( 'home' ) );
if ( $block_2 ) {
	$projects_count = ! empty( $block_2['projects_count'] ) ? $block_2['projects_count'] : null;
	$projects_link  = ! empty( $block_2['projects_link'] ) ? $block_2['projects_link'] : null;
}

/**
 * Projects
 */
$projects = get_posts( [
	'numberposts'      => $projects_count,
	'post_type'        => 'projects',
	'suppress_filters' => true,
] );

?>
<?php if ( $projects ): ?>
    <div class="container" id="projects">
        <div class="projects_tittle">
            <h2>Проекти</h2>
            <span class="border_sixth"></span>
        </div>
        <div class="portfolio">
            <div data-gridify="3-columns">
				<?php foreach ( $projects as $project ): ?>
                    <div class="item">
                        <div class="mask">
                            <p class="portfolio_category"><?php echo get_the_title( $project->ID ); ?></p>
                            <p><?php echo get_the_excerpt( $project->ID ); ?></p>
                            <a href="<?php echo get_field( 'link', $project->ID ); ?>">на сайт</a>
                        </div>
						<?php if ( has_post_thumbnail( $project ) ): ?>
                            <img class="img-fluid" src="<?php echo  get_the_post_thumbnail_url( $project->ID ); ?>"
                                 alt="<?php echo get_the_title( $project->ID ); ?>">
						<?php endif; ?>
                    </div>
				<?php endforeach; ?>
            </div>

			<?php if ( $projects_link ): ?>
                <a href="<?php echo $projects_link['url']; ?>"
                   target="<?php echo $projects_link['target']; ?>"><?php echo $projects_link['title']; ?></a>
			<?php endif; ?>
        </div>
    </div>
<?php endif; ?>
