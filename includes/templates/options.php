<tr valign="top">
    <th scope="row">
        <label for="show-more"><?php _e( 'Show buttons only for such post types', 'sharedaddy-mc' ); ?></label>
    </th>
    <td>
        <select id="show-more" name="show_more">
            <option <?php selected( '', $show_more ); ?> value="">
                <?php _e( 'All', 'sharedaddy-mc' ); ?>
            </option>
            <?php foreach ( $options as $o ): ?>
            <option <?php selected( $o->name, $show_more ); ?> value="<?php echo $o->name ?>">
                <?php echo $o->label; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>
