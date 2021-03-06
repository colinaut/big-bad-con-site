<?php do_action('em_template_my_bookings_header'); ?>
<?php
	global $wpdb, $current_user, $EM_Notices, $EM_Person;
	if( is_user_logged_in() ):
		$EM_Person = new EM_Person( get_current_user_id() );
		$EM_Bookings = $EM_Person->get_bookings();
		$bookings_count = count($EM_Bookings->bookings);
		if($bookings_count > 0){
			//Get events here in one query to speed things up
			$event_ids = array();
			foreach($EM_Bookings as $EM_Booking){
				$event_ids[] = $EM_Booking->event_id;
			}
			$EM_Events = EM_Events::get($event_ids);
		}
		$limit = ( !empty($_GET['limit']) ) ? $_GET['limit'] : 20;//Default limit
		$page = ( !empty($_GET['pno']) ) ? $_GET['pno']:1;
		$offset = ( $page > 1 ) ? ($page-1)*$limit : 0;
		echo $EM_Notices;
		?>
		<div class='em-my-bookings'>
				<!--
				<ul class="subsubsub">
					<li>
						<a href='edit.php?post_type=post' class="current">All <span class="count">(1)</span></a> |
					</li>
				</ul>
				-->
				<?php if ( $bookings_count >= $limit ) : ?>
				<div class='tablenav'>
					<?php 
					if ( $bookings_count >= $limit ) {
						$bookings_nav = em_admin_paginate( $bookings_count, $limit, $page, array('em_ajax'=>0, 'em_obj'=>'em_bookings_confirmed_table'));
						echo $bookings_nav;
					}
					?>
					<div class="clear"></div>
				</div>
				<?php endif; ?>
				<div class="clear"></div>
				<?php if( $bookings_count > 0 ): ?>
				<div class='table-wrap'>
				<table id='dbem-bookings-table' class='widefat post fixed'>
					<thead>
						<tr>
							<th class='manage-column' scope='col'><?php _e('Event', 'dbem'); ?></th>
							<th class='manage-column' scope='col'><?php _e('Date', 'dbem'); ?></th>
							<th class='manage-column' scope='col'><?php _e('Time', 'dbem'); ?></th>
							<th class='manage-column' scope='col'><?php _e('Role', 'dbem'); ?></th>
							<th class='manage-column' scope='col'><?php _e('Status', 'dbem'); ?></th>

						</tr>
					</thead>
					<tbody>
						<?php 
						$rowno = 0;
						$event_count = 0;
						$nonce = wp_create_nonce('booking_cancel');
						foreach ($EM_Bookings as $EM_Booking) {
							$EM_Event = $EM_Booking->get_event();						
							if( ($rowno < $limit || empty($limit)) && ($event_count >= $offset || $offset === 0) ) {
								$rowno++;
								if( $EM_Event->start > 1346457600 ){
								?>
								<tr>
									<td><?php echo $EM_Event->output("#_EVENTLINK"); ?></td>
									<td><?php echo date_i18n( get_option('date_format'), $EM_Event->start ); ?></td>
<td><?php echo $EM_Event->output("#_12HSTARTTIME")  . " - " .  $EM_Event->output("#_12HENDTIME"); ?></td>

									<td><?php echo $EM_Booking->output("#_BOOKINGCOMMENT"); ?></td>
									<td>
										<?php echo apply_filters('em_my_bookings_booking_status', $EM_Booking->status_array[$EM_Booking->status], $EM_Booking); ?>
									</td>
								</tr>
								<?php
								}

							}
							do_action('em_my_bookings_booking_loop',$EM_Booking);
							$event_count++;
						}
						?>
					</tbody>
				</table>
				</div>
				<?php else: ?>
					<?php _e('You do not have any bookings. Game sign ups begin September 8th at noon.', 'dbem'); ?>
				<?php endif; ?>
			<?php if( !empty($bookings_nav) && $EM_Bookings >= $limit ) : ?>
			<div class='tablenav'>
				<?php echo $bookings_nav; ?>
				<div class="clear"></div>
			</div>
			<?php endif; ?>
		</div>	
<?php else: ?>
	<p><?php echo sprintf(__('Please <a href="%s">Log In</a> to view your bookings.','dbem'),site_url('wp-login.php', 'login'))?></p>
<?php endif; ?>
<?php do_action('em_template_my_bookings_footer', $EM_Bookings); ?>