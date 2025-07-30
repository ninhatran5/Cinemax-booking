<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VNPay Configuration
    |--------------------------------------------------------------------------
    |
    | Để test với thẻ thật, thay đổi:
    | - 'url' => 'https://pay.vnpay.vn/vpcpay.html'
    | - Cập nhật tmn_code và hash_secret từ tài khoản production
    |
    | Thẻ test Sandbox đúng:
    | - ATM NCB: 9704198526191432198
    | - Quốc tế: 4200000000000000
    | - OTP: 123456
    |
    */

    // Terminal code do VNPay cấp
    'tmn_code'    => env('VNPAY_TMN_CODE', '0ZAOTZ7E'),

    // Chuỗi bí mật để tạo chữ ký
    'hash_secret' => env('VNPAY_HASH_SECRET', 'SPVAP4UXJOLOHNYIJ0WXMHSOINBHVX9N'),

    // URL cổng thanh toán (Sandbox hoặc Production)
    'url'         => env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),

    // URL nhận kết quả thanh toán trả về (callback)
    'return_url'  => env('VNPAY_RETURN_URL', 'http://127.0.0.1:8000/vnpay/return'),

    // Loại chữ ký (cố định SHA512)
    'hash_type'   => 'SHA512',
];
