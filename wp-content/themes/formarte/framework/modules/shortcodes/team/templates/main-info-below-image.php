<?php
/**
 * Team info on hover shortcode template
 */
global $oxides_edgeIconCollections;
$number_of_social_icons = 6;
?>

<div class="edgtf-team <?php echo esc_attr($team_type) ?>">
	<div class="edgtf-team-inner">
        <?php if ($team_image !== '') { ?>
            <div class="edgtf-team-image">
                <?php if ($team_link !== '') { ?>
                    <a href="<?php echo esc_url($team_link); ?>" target="<?php echo esc_url($team_target); ?>">
                <?php } ?>
                    <img src="<?php print $team_image_src; ?>" alt="edgtf-team-image"/>
                <?php if ($team_link !== '') { ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
		<?php if ($team_name !== '' || $team_position !== '' || $team_description != "" || $show_skills == 'yes') { ?>
			<div class="edgtf-team-info">
				<?php if ($team_name !== '' || $team_position !== '') { ?>
					<div class="edgtf-team-title-holder <?php echo esc_attr($team_social_icon_type) ?>">
						<?php if ($team_name !== '') { ?>
							<<?php echo esc_attr($team_name_tag); ?> class="edgtf-team-name">
								<?php echo esc_attr($team_name); ?>
							</<?php echo esc_attr($team_name_tag); ?>>
						<?php } ?>
						<?php if ($team_position !== "") { ?>
							<span class="edgtf-team-position"><?php echo esc_attr($team_position) ?></span>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if ($team_description != "") { ?>
					<div class='edgtf-team-text'>
						<div class='edgtf-team-text-inner'>
							<div class='edgtf-team-description'>
								<p><?php echo esc_attr($team_description) ?></p>
							</div>
						</div>
					</div>
				<?php }
			} ?>

		<div class="edgtf-team-social-holder-between">
			<div class="edgtf-team-social <?php echo esc_attr($team_social_icon_type) ?>">
				<div class="edgtf-team-social-inner">
					<div class="edgtf-team-social-wrapp">

						<?php foreach( $team_social_icons as $team_social_icon ) {
							print $team_social_icon;
						} ?>

					</div>
				</div>
			</div>
		</div>

		</div>
	</div>
</div>