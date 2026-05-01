<?php
global $wpdb;
$table = "query_table";
wp_enqueue_style('custom-tempate2-css', path .'shotcode/css/backend.css');
$data = $wpdb->get_results( "SELECT * FROM $wpdb->prefix$table"); ?>
<div class="table_r">
    <table class="qtable">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>Email</th>
                <th>Massage</th>
                <th>CREATE TIME</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $key => $value) {  ?>
        <tr>
        <td><?= $value->created_at ?? ''  ?></td>
            <td><?= $key+1 ?></td>
            <td><?= $value->name ?? ''  ?></td>
            <td><?= $value->email ?? ''  ?></td>
            <td><?= $value->msg ?? ''  ?></td>
            <td><?= $value->time ?? '' ?></td>
            <td><a href="<?= $value->_permalink ?? ''  ?>"><button class="dashicons-before dashicons-visibility"></button></a></td>
            <td><button id="<?= $value->id   ?>" class="dashicons-before dashicons-trash del_query"></button></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>