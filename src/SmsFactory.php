<?php

namespace Lijinhua\HyperfSms;

use Hyperf\Contract\ConfigInterface;
use Lijinhua\HyperfSms\Gateways\LogGateway;
use Overtrue\EasySms\EasySms;
use Psr\Container\ContainerInterface;

class SmsFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class)->get('sms');

        $easySms = new EasySms($config);

        // 注册-本地日志
        $easySms->extend('log', function ($gatewayConfig) {
            return new LogGateway($gatewayConfig);
        });

        return $easySms;
    }
}