<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SSLCZ\SSLCommerz\SSLCommerz;
use SSLCZ\SSLCommerz\SSLCommerzService;

class SSLCommerzController extends Controller
{
    use SSLCommerzService;

    public function hosted()
    {
        $sslcommerz = new SSLCommerz();
        $sslcommerz->setPaymentDisplayType('hosted');

        $sslcommerz->setPrimaryInformation([
            'total_amount' => 1000,
            'currency' => 'BDT',
        ]);
        $sslcommerz->setSuccessUrl(route('sslcommerz.success'));
        $sslcommerz->setFailUrl(route('sslcommerz.fail'));
        $sslcommerz->setCancelUrl(route('sslcommerz.cancel'));
        $sslcommerz->setTranId('ikram-1421447042');

        $sslcommerz->setCustomerInformation([
            'cus_name' => 'John Doe',
            'cus_email' => 'john.doe@yahoo.com',
            'cus_add1' => 'Dhaka',
            'cus_add2' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_state' => 'Dhaka',
            'cus_postcode' => '1000',
            'cus_country' => 'Bangladesh',
            'cus_phone' => '+8801919001122',
        ]);

        $sslcommerz->setShipmentInformation([
            'ship_name' => 'Store Test',
            'ship_add1' => 'Dhaka',
            'ship_add2' => 'Dhaka',
            'ship_city' => 'Dhaka',
            'ship_state' => 'Dhaka',
            'ship_postcode' => '1000',
            'ship_country' => 'Bangladesh',
            'shipping_method' => 'NO',
        ]);

        $sslcommerz->setAdditionalInformation([
            'value_a' => 'CPT-112-A',
            'value_b' => 'CPT-112-B',
            'value_c' => 'CPT-112-C',
            'value_d' => 'CPT-112-D',
        ]);

        $sslcommerz->setEmiOption(1);

        $sslcommerz->setProductInformation([
            'product_name' => 'Computer',
            'product_category' => 'Goods',
            'product_profile' => 'physical-goods',
        ]);

        $sslcommerz->setProductCart([
            ['product' => 'Laptop X', 'amount' => '2000.00'],
            ['product' => 'Laptop Y', 'amount' => '4000.00'],
            ['product' => 'Laptop Z', 'amount' => '8000.00'],
        ]);

        $sslcommerz->setProductAmount('1000');
        $sslcommerz->setProductVat('100');
        $sslcommerz->setProductDiscountAmount('0');
        $sslcommerz->setProductConvenienceFee('50');

        $response = $sslcommerz->initPayment($sslcommerz);

//        dd($response);

        return redirect($response['GatewayPageURL']);
    }

    public function checkout()
    {
        return view('sslcommerz.checkout');
    }

    public function initViaAjax(Request $request)
    {
        $sslcommerz = new SSLCommerz();
        $sslcommerz->setPaymentDisplayType('checkout');

        $sslcommerz->setPrimaryInformation([
            'total_amount' => 1000,
            'currency' => 'BDT',
        ]);
        $sslcommerz->setSuccessUrl(route('sslcommerz.success'));
        $sslcommerz->setFailUrl(route('sslcommerz.fail'));
        $sslcommerz->setCancelUrl(route('sslcommerz.cancel'));

        $sslcommerz->setCustomerInformation([
            'cus_name' => 'John Doe',
            'cus_email' => 'john.doe@yahoo.com',
            'cus_add1' => 'Dhaka',
            'cus_add2' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_state' => 'Dhaka',
            'cus_postcode' => '1000',
            'cus_country' => 'Bangladesh',
            'cus_phone' => '+8801919001122',
        ]);

        $sslcommerz->setTranId('ikram-1421447042');

        $sslcommerz->setShipmentInformation([
            'ship_name' => 'Store Test',
            'ship_add1' => 'Dhaka',
            'ship_add2' => 'Dhaka',
            'ship_city' => 'Dhaka',
            'ship_state' => 'Dhaka',
            'ship_postcode' => '1000',
            'ship_country' => 'Bangladesh',
            'shipping_method' => 'NO',
        ]);

        $sslcommerz->setAdditionalInformation([
            'value_a' => 'CPT-112-A',
            'value_b' => 'CPT-112-B',
            'value_c' => 'CPT-112-C',
            'value_d' => 'CPT-112-D',
        ]);

        $sslcommerz->setEmiOption(1);

        $sslcommerz->setProductInformation([
            'product_name' => 'Computer',
            'product_category' => 'Goods',
            'product_profile' => 'physical-goods',
        ]);

        $sslcommerz->setProductCart([
            ['product' => 'Laptop X', 'amount' => '2000.00'],
            ['product' => 'Laptop Y', 'amount' => '4000.00'],
            ['product' => 'Laptop Z', 'amount' => '8000.00'],
        ]);

        $sslcommerz->setProductAmount('1000');
        $sslcommerz->setProductVat('100');
        $sslcommerz->setProductDiscountAmount('0');
        $sslcommerz->setProductConvenienceFee('50');

        $response = $sslcommerz->initPayment($sslcommerz);

        echo json_encode(['status' => 'success', 'data' => $response['GatewayPageURL'], 'logo' => $response['storeLogo']]);
    }

    public function success(Request $request)
    {
//        dd($request->all());
        $sslcommerz = new SSLCommerz();
        dd($sslcommerz->orderValidate($request->all()));
    }

    public function fail(Request $request)
    {
        dd($request->all());
    }

    public function cancel(Request $request)
    {
        dd($request->all());
    }

    public function ipn(Request $request)
    {
        $sslcommerz = new SSLCommerz();
        dd($sslcommerz->orderValidate($request->all()));
    }
}
