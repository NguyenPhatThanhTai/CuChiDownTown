<?php

function handle_booking_gateway() {
    if (!session_id()) session_start();

    require_once get_theme_file_path ('service/db_config/db.php');
    require_once get_theme_file_path ('service/room_service.php');

    $pdo = get_db_connection();
    $roomService = new RoomService($pdo);

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
