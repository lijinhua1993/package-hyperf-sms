<?php

declare(strict_types=1);

use Hyperf\Guzzle\HandlerStackFactory;

return [
    'options'  => [
        'config' => [
            'handler' => (new HandlerStackFactory())->create([
                'min_connections' => 1,
                'max_connections' => 30,
                'wait_timeout'    => 3.0,
                'max_idle_time'   => 60,
            ]),
        ],
    ],
    // 默认发送配置
    'default'  => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'qcloud',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'log'    => [
            'name'  => 'sms',
            'group' => 'default',
        ],
        'qcloud' => [
            'sdk_app_id' => \Hyperf\Support\env('SMS_QCLOUD_SDK_APP_ID'), // 短信应用的 SDK APP ID
            'secret_id'  => \Hyperf\Support\env('SMS_QCLOUD_SECRET_ID'), // SECRET ID
            'secret_key' => \Hyperf\Support\env('SMS_QCLOUD_SECRET_KEY'), // SECRET KEY
            'sign_name'  => \Hyperf\Support\env('SMS_QCLOUD_SIGN_NAME'), // 短信签名

            'templates' => [
                'code' => \Hyperf\Support\env('SMS_QCLOUD_CODE_TEMPLATE_ID'),
            ],
        ],
    ],

];
