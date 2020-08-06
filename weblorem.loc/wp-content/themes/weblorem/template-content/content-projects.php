<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WebLorem
 */

/**
 * Taxonomy
 */
$terms = get_terms( array(
	'taxonomy'               => array( $current_term->taxonomy ),
	'orderby'                => 'id',
	'order'                  => 'ASC',
	'hide_empty'             => false,
	'fields'                 => 'all',
	'hierarchical'           => false,
	'parent'                 => $current_term->parent ? $current_term->parent : $current_term->term_id,
	'pad_counts'             => false,
	'update_term_meta_cache' => true, // метадані в кеш
) );

?>
<?php if ( is_singular() ): ?>


<?php else: ?>

    <div class="container">

        <div class="projects_tittle_second">
            <h1>Проекти</h1>
        </div>

        <ul class="filters">
            <li class="active"><a data-filter="all">Всі проекти</a></li>
            <li><a data-filter="landings">Лендінги</a></li>
            <li><a data-filter="corporate">Корпоративні сайти</a></li>
            <li><a data-filter="eshops">Інтернет-магазини</a></li>
            <li><a data-filter="polygraphy">Поліграфія</a></li>
            <li><a data-filter="logos">Логотипи</a></li>
        </ul>

        <div data-gridify="3-columns">

			<?php while ( have_posts() ): ?>

				<?php the_post(); ?>

                <p>Post list (wp-content/themes/weblorem/template-content/content-projects.php)</p>

			<?php endwhile; ?>

        </div>

    </div>

    <button class="btn btn-lead center-block" data-toggle="modal" data-target="#callback">Залишити заявку</button>

<?php endif; ?>