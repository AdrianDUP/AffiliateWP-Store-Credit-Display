<?php
$user_id = affwp_get_affiliate_user_id($user);
$user_credit_balance = get_user_meta($user_id, 'affwp_wc_credit_balance', true);

if ( empty($user_credit_balance)) {
	$user_credit_balance = 0;
}
?>

<table class="affwp-table">
	<thead>
	<tr>
		<th><?php _e('Store Credits', 'affwp-scd'); ?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo affwp_currency_filter($user_credit_balance); ?></td>
	</tr>
	</tbody>
</table>