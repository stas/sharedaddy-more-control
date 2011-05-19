<tr valign="top">
    <th scope="row">
        <label for="show-more"><?php _e( 'Show buttons only for such post types', 'sharedaddy-mc' ); ?></label>
    </th>
    <td>
        <?php foreach ( $options as $o ) : ?>
            <input type="checkbox" <?php checked( in_array( $o->name, $show_more ) ); ?> name="show_more[<?php echo $o->name ?>]" id="show_more_<?php echo $o->name; ?>">
            <label for="show_more_<?php echo $o->name; ?>"><?php echo $o->label; ?></label>
        <?php endforeach; ?>
    </td>
</tr>
