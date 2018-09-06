<?php if($fullwidth) : ?>
<div class="edgtf-full-width">
    <div class="edgtf-full-width-inner">
<?php else: ?>
<div class="edgtf-container">
    <div class="edgtf-container-inner clearfix">
<?php endif; ?>
        <div <?php oxides_edge_class_attribute($holder_class); ?>>
            <?php if(post_password_required()) {
                echo get_the_password_form();
            } else {
                //load proper portfolio template
                oxides_edge_get_module_template_part('templates/single/single', 'portfolio', $portfolio_template);

                //load portfolio navigation
                oxides_edge_get_module_template_part('templates/single/parts/navigation', 'portfolio');

                //load portfolio comments
                oxides_edge_get_module_template_part('templates/single/parts/comments', 'portfolio');

            } ?>
        </div>
    </div>
</div>