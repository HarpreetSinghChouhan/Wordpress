<?php

    parse_str($_POST['ajax_form'], $my_array_of_vars);

    $name         =  $my_array_of_vars ? $my_array_of_vars['name'] : ''; 
    $last_name    =  $my_array_of_vars ? $my_array_of_vars['lst_name'] : ''; 
    $mobile       =  $my_array_of_vars ? $my_array_of_vars['mobile'] : '';
    $email        =  $my_array_of_vars ? $my_array_of_vars['email'] : '';
    $__query      =  $my_array_of_vars ? $my_array_of_vars['__query'] : ''; 
    $_permalink   =  $my_array_of_vars ? $my_array_of_vars['_permalink'] : '';   
    $travel_date_ =  $my_array_of_vars ? $my_array_of_vars['date'] : '';
    $call_email   =  $my_array_of_vars ? $my_array_of_vars['radio'] : '';    
    //add data to database
        global $wpdb;   
        $date = date_create();
        date_default_timezone_set('Asia/Kolkata');
        $tablename = $wpdb->prefix.'query_table';
        $wpdb->insert( $tablename, array(
            'name'       => $name, 
            'last_name'  => $last_name, 
            'mobile'     => $mobile, 
            'email'      => $email, 
            '__query'    => $__query, 
            '_permalink' => $_permalink, 
            'date'       => $travel_date_, 
            'call_email' => $call_email,
        ),
         array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')    
        );
        
       //mail function
        $admin_email = get_option( 'admin_email' );
        $cc = 'saurabh.eligocs@gmail.com';

        $subject = 'Booking Confiremed';   
        $headers = "From: " .$admin_email. "\r\n";
        $headers .= "Reply-To: ".$admin_email. "\r\n";
        $headers .= "CC: " .$cc.  "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = '<html>
            <body>
                <div>
                    <h3>New Booking Request</h3>
                        <table rules="all" style="border-color: #666;" cellpadding="10">
                            <tr><td><strong>Name:</strong> </td><td>' . $name . '</td></tr>
                            <tr><td><strong>Last Name:</strong> </td><td>' . $last_name . '</td></tr>
                            <tr><td><strong>Email:</strong> </td><td>' . $email . '</td></tr>
                            <tr><td><strong>Mobile:</strong> </td><td>' . $mobile . '</td></tr>
                            <tr><td><strong>Query Name:</strong> </td><td>' . $__query . '</td></tr>
                            <tr><td><strong>Permalink:</strong> </td><td>' . $_permalink . '</td></tr>
                            <tr><td><strong>Call OR Email - :</strong> </td><td>' . $call_email . '</td></tr>
                            <tr><td><strong>Travel Date: - :</strong> </td><td>' . $travel_date_ . '</td></tr>
                        </table>
                </div>
            </body>
        </html>';     
         wp_mail($admin_email, $subject, $message, $headers);