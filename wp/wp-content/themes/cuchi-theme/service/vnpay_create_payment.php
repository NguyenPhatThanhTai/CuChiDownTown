<?php
require_once get_theme_file_path ('service/db_config/db.php');
require_once get_theme_file_path ('service/config/config.php');

function create_payment($room, $request){
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    $merchant_id = init_transaction($request);
    
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => vnp_TmnCode,
        "vnp_Amount" => $room['price'] * 100,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
        "vnp_Locale" => "vn",
        "vnp_OrderInfo" => "Thanh toan giao dich dat phong:" . $merchant_id,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => vnp_ReturnUrl,
        "vnp_TxnRef" => $merchant_id,
        "vnp_ExpireDate"=>date('YmdHis',strtotime('+15 minutes',strtotime(date("YmdHis"))))
    );
    
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = vnp_Url . "?" . $query;
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    return $vnp_Url;
}

function init_transaction($data) {
    $pdo = get_db_connection();

    $uuid = generate_uuid_v4();
    $room_id = $data['room_id'];
    $check_in = DateTime::createFromFormat('d/m/Y', $data['check_in'])->format('Y-m-d');
    $check_out = DateTime::createFromFormat('d/m/Y', $data['check_out'])->format('Y-m-d');
    $email = $data['email'];

    $sql = "INSERT INTO transaction (id, room_id, check_in, check_out, email)
            VALUES (:id, :room_id, :check_in, :check_out, :email)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $uuid,
        ':room_id' => $room_id,
        ':check_in' => $check_in,
        ':check_out' => $check_out,
        ':email' => $email
    ]);

    return $uuid;
}

function generate_uuid_v4() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),     // 32 bits
        mt_rand(0, 0xffff),                         // 16 bits
        mt_rand(0, 0x0fff) | 0x4000,                // 16 bits, version 4
        mt_rand(0, 0x3fff) | 0x8000,                // 16 bits, variant
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff) // 48 bits
    );
}

