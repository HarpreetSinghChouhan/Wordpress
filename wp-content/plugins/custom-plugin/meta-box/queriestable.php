<?php
global $wpdb;
$table = "query_table";
wp_enqueue_style('custom-template-plugin2-css', path . 'assets/css/backend.css');
$data = $wpdb->get_results("SELECT * FROM  $wpdb->prefix$table");
//   print_r($data);
?>
<style>
    .qtable {
        width: 100%;
        margin-bottom: 20px;
    }

    .qtable>tbody>tr>td,.qtable>tbody>tr>th,.qtable>tfoot>tr>td,.qtable>tfoot>tr>th,.qtable>thead>tr>td,.qtable>thead>tr>th {
        border: 1px solid #ddd;
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
    }
    th{
        border:1px solid black;
    }
    table,tr,td {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
    }

    .table_r {
        min-height: .01%;
        overflow-x: auto;
    }
</style>
<div class="table_r">
    <table class="gtable">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    NAME
                </th>
                <th>
                    Email
                </th>
                <th>
                    Message
                </th>
                <th>
                    CREATED_TIME
                </th>
                <th colspan="2">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) {  ?>
                <tr>
                    <td><?= $value->created_at ?? ''  ?></td>
                    <td><?= $key + 1 ?></td>
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