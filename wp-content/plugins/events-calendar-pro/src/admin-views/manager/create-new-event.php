<?php
/**
 * Admin View: Admin Manager Add New event link
 *
 * @version  5.9.0
 *
 * @var string $today_date Today's date in the `Y-m-d` format.
 * @var string $day_date The current day date, in the `Y-m-d` format.
 * @var array  $day The current day data.{
 *          @type string $date The day date, in the `Y-m-d` format.
 *          @type bool $is_start_of_week Whether the current day is the first day of the week or not.
 *          @type string $year_number The day year number, e.g. `2019`.
 *          @type string $month_number The day year number, e.g. `6` for June.
 *          @type string $day_number The day number in the month with leading 0, e.g. `11` for June 11th.
 *          @type string $day_url The day url, e.g. `http://yoursite.com/events/2019-06-11/`.
 *          @type int $found_events The total number of events in the day including the ones not fetched due to the per
 *                                  page limit, including the multi-day ones.
 *          @type int $more_events The number of events not showing in the day.
 *          @type array $events The non multi-day events on this day. The format of each event is the one returned by
 *                    the `tribe_get_event` function. Does not include the below events.
 *          @type array $featured_events The featured events on this day. The format of each event is the one returned
 *                    by the `tribe_get_event` function.
 *          @type array $multiday_events The stack of multi-day events on this day. The stack is a mix of event post
 *                              objects, the format is the one returned from the `tribe_get_event` function, and
 *                              spacers. Spacers are falsy values indicating an empty space in the multi-day stack for
 *                              the day
 *      }
 */

use Tribe__Events__Main as TEC;

$add_new_url = admin_url( 'post-new.php' );
$args = [
	'post_type' => TEC::POSTTYPE,
];

$args['tribe-start-date'] = $day['date'];
$add_new_url = add_query_arg( $args, $add_new_url );
$link_title = sprintf( __( 'Add New %1$s on %2$s', 'tribe-events-calendar-pro' ), tribe( 'tec.main' )->singular_event_label, tribe_format_date( $day['date'], false ) );
?>
<a
	title="<?php echo esc_attr( $link_title ); ?>"
	href="<?php echo esc_url( $add_new_url ); ?>"
	class="tribe-events-admin-manager__add-link"
>
	<span class="dashicons dashicons-plus"></span><?php esc_html_e( 'Add', 'tribe-events-calendar-pro' ); ?>
</a>