<?php 
    $cclass_booking = C('booking');
    $result         = $cclass_booking->getActivityList();
    $list           = $result['list'];
    