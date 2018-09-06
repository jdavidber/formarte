<?php if(oxides_edge_options()->getOptionValue('portfolio_single_hide_date') !== 'yes') : ?>

    <div class="edgtf-portfolio-info-item edgtf-portfolio-date">
        <h6 class="edgtf-portfolio-info-item-info-subtitle"><?php esc_html_e('Date', 'oxides'); ?></h6>

        <p><?php the_time(get_option('date_format')); ?></p>
    </div>

<?php endif; ?>