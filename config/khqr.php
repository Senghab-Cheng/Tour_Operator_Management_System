<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ABA payment for customers
    |--------------------------------------------------------------------------
    |
    | Simple, no library/API needed. Put a screenshot of your own ABA "My QR"
    | (from the ABA Mobile app) at the path below, and/or a payment link
    | (e.g. a PayWay link). Whichever is set will be shown on the payment page.
    |
    */

    // Path relative to /public, e.g. "img/aba-qr.png". Leave null to hide.
    'qr_image' => env('KHQR_QR_IMAGE'),

    // A link customers can tap to pay (e.g. a PayWay link). Leave null to hide.
    'link' => env('KHQR_LINK'),

];