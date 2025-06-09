<?php

// service/router/router.php

// 1. Register /booking-callback rewrite URL
add_action('init', function () {
    add_rewrite_rule('^booking-callback$', 'index.php?booking_callback=1', 'top');
});

// 2. Allow 'booking_callback' as a query var
add_filter('query_vars', function ($vars) {
    $vars[] = 'booking_callback';
    return $vars;
});

// 3. Handle the callback when the URL matches
add_action('template_redirect', function () {
    if (get_query_var('booking_callback')) {
        require_once get_theme_file_path('service/db_config/db.php');
        require_once get_theme_file_path('service/room_service.php');

        $pdo = get_db_connection();
        $roomService = new RoomService($pdo);

        $roomService->handle_call_back($_GET);

        echo "✅ Callback received. Code: " . esc_html($_GET['vnp_ResponseCode'] ?? 'none');
        exit;
    }
});


function handle_booking_gateway() {
    if (!session_id()) session_start();

    require_once get_theme_file_path ('service/db_config/db.php');
    require_once get_theme_file_path ('service/room_service.php');

    $pdo = get_db_connection();
    $roomService = new RoomService($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['vnp_ResponseCode'])) {
        $roomService->handle_call_back($_GET);  // Your logic
        exit;
    }

    $action = $_POST['action_type'] ?? null;

    if ($action === 'check_availability') {
        $roomService->check_availability($_POST);
    } elseif ($action === 'submit_booking') {
        $roomService->book_room($_POST);
    } else {
        echo "Unknown action: " . esc_html($action);
    }

    exit;
}
