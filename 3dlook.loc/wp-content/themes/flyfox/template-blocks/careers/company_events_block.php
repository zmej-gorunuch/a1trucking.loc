<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

/**
 * Vacancy department
 */
$departments = get_terms( [
	'taxonomy'               => [ 'vacancy_department' ],
	'orderby'                => 'id',
	'order'                  => 'ASC',
	'hide_empty'             => false,
	'fields'                 => 'all',
	'hierarchical'           => false,
	'pad_counts'             => false,
	'update_term_meta_cache' => true, // метадані в кеш
] );

/**
 * Vacancy cities
 */
$cities = get_terms( [
	'taxonomy'               => [ 'vacancy_city' ],
	'orderby'                => 'id',
	'order'                  => 'ASC',
	'hide_empty'             => false,
	'fields'                 => 'all',
	'hierarchical'           => false,
	'pad_counts'             => false,
	'update_term_meta_cache' => true, // метадані в кеш
] );

/**
 * Vacancies
 */
$args      = [
	'post_type'        => 'vacancy',
	'post_status'      => 'publish',
	'nopaging'         => true,
	'suppress_filters' => true,
];
$vacancies = get_posts( $args );

?>
	<div class="career-slider-hider">
		<div class="career-slider">

			<div class="carreer-slide">
				<img src="./assets/img/about/square-figure.png" alt="">
				<span class="career-slide-title">Event1</span>
				<span class="career-slide-text">Short description about event</span>
			</div>
			<div class="carreer-slide">
				<img src="./assets/img/about/square-figure.png" alt="">
				<span class="career-slide-title">Event2</span>
				<span class="career-slide-text">Short description about event</span>
			</div>
			<div class="carreer-slide">
				<img src="./assets/img/about/square-figure.png" alt="">
				<span class="career-slide-title">Event3</span>
				<span class="career-slide-text">Short description about event</span>
			</div>
			<div class="carreer-slide">
				<img src="./assets/img/about/square-figure.png" alt="">
				<span class="career-slide-title">Event4</span>
				<span class="career-slide-text">Short description about event</span>
			</div>
			<div class="carreer-slide">
				<img src="./assets/img/about/square-figure.png" alt="">
				<span class="career-slide-title">Event5</span>
				<span class="career-slide-text">Short description about event</span>
			</div>
			<div class="carreer-slide">
				<img src="./assets/img/about/square-figure.png" alt="">
				<span class="career-slide-title">Event6</span>
				<span class="career-slide-text">Short description about event</span>
			</div>
			<div class="carreer-slide">
				<img src="./assets/img/about/square-figure.png" alt="">
				<span class="career-slide-title">Event7</span>
				<span class="career-slide-text">Short description about event</span>
			</div>

		</div>
	</div>
	<div class="slider-arrows">
		<div class="slider-arrow icon-arr-r" id="s-next"></div>
		<div class="slider-arrow icon-arr-l" id="s-prev"></div>
	</div>














<?php if ( $vacancies ): ?>
    <div class="pinter_counts_wrap">
        <div class="pinter_counts"><?php echo count( $vacancies ) ?> open positions</div>
    </div>

    <div class="cr__select_wrap">
        <select class="outline_select department-select">
            <option value="" selected>All Departments</option>
			<?php foreach ( $departments as $department ): ?>
                <option value="<?php echo $department->term_id ?>"><?php echo $department->name ?></option>
			<?php endforeach; ?>
        </select>
        <select class="outline_select city-select" >
            <option value="" selected>All Locations</option>
			<?php foreach ( $cities as $city ): ?>
                <option value="<?php echo $city->term_id ?>"><?php echo $city->name ?></option>
			<?php endforeach; ?>
        </select>
    </div>

    <div class="wrapl">
        <div class="blog_article__vacancies_wrap">
            <div class="cr__analitics">
                Analytics
            </div>
            <div class="blog_article__vacancies">
				<?php foreach ( $vacancies as $vacancy ): ?>
                    <a href="<?php the_permalink( $vacancy->ID ); ?>" class="blog_article__vacancies_item">
                        <div class="ba_v_title">
							<?php echo $vacancy->post_title ?>
                        </div>
						<?php $vacancy_workloads = wp_get_post_terms( $vacancy->ID, 'vacancy_workload', [ 'fields' => 'names' ] ) ?>
						<?php if ( $vacancy_workloads ): ?>
                            <div class="ba_v_time">
								<?php echo implode( ', ', $vacancy_workloads ) ?>
                            </div>
						<?php endif; ?>
						<?php $vacancy_cities = wp_get_post_terms( $vacancy->ID, 'vacancy_city', [ 'fields' => 'names' ] ) ?>
						<?php if ( $vacancy_cities ): ?>
                            <div class="ba_v_address">
								<?php echo implode( ' / ', $vacancy_cities ) ?>
                            </div>
						<?php endif; ?>
                        <div class="ba_v_apply_nw">
                            Apply now
                        </div>
                    </a>
				<?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="center_more_btn">
        <button class="btnr black icon-arr-b" type="button" id="cp-load-more">More</button>
    </div>
<?php endif; ?>