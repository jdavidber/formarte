<?php
/**
 * Footer template part
 */
?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<footer <?php oxides_edge_class_attribute($footer_classes); ?>>
	<div class="edgtf-footer-inner clearfix">

		<?php

		if($display_footer_top) {
			oxides_edge_get_footer_top();
		}
		if($display_footer_bottom) {
			oxides_edge_get_footer_bottom();
		}
		?>

	</div>
</footer>

</div> <!-- close div.edgtf-wrapper-inner  -->
</div> <!-- close div.edgtf-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
