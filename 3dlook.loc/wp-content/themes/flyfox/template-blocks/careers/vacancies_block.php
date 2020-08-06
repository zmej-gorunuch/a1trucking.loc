<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

/**
 * Vacancies
 */
$vacancies = get_posts( [
	'post_type'        => 'vacancy',
	'suppress_filters' => true,
] );

?>
<div class="pinter_counts_wrap">
	<div class="pinter_counts">31 open positions</div>
</div>

<div class="cr__select_wrap">
	<select class="outline_select">
		<option value="NY" selected>All Departments</option>
		<option value="NY1">New York,USA</option>
		<option value="NY2">New York,USA</option>
		<option value="NY3">New York,USA</option>
	</select>
	<select class="outline_select">
		<option value="NY" selected>All Locations</option>
		<option value="NY1">New York,USA</option>
		<option value="NY2">New York,USA</option>
		<option value="NY3">New York,USA</option>
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
