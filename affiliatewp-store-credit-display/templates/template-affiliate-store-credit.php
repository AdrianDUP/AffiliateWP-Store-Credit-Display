<table id="affwp-affiliate-dashboard-store-credit-count" class="affwp-tab-content">
	<thead>
	<tr>
		<th><?php _e('Store Credits', 'affwp-scd'); ?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo get_user_meta($user_id, 'affwp_wc_credit_balance', true); ?></td>
	</tr>
	</tbody>
</table>