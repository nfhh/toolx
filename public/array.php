<?php
$data = [
    'postData' =>
        [
            'shell_res' =>
                [
                    0 => '内存容量少 error',
                ],
            'init' =>
                [
                    'nas_temp' => '37 ℃',
                    'cpu_temp' => '38 ℃',
                    'fan_speed' => '1207 RPM',
                    'cpu_used' => '1.99%',
                    'sn' => 'abc1234',
                    'model' => 'F5422',
                    'kernel_version' => '4.13.16',
                    'bios_version' => 'MAPL0301V10',
                    'cpu' => 'Intel(R) Celeron(R) CPU J3455 @1.5GHz',
                    'mac' =>
                        [
                            0 => '6c:bf:b5:00:dc:5b',
                            1 => '6c:bf:b5:00:dc:5c',
                            2 => '6c:bf:b5:00:dc:d0',
                        ],
                    'ram' => '4096 MB',
                    'disk' =>
                        [
                            0 => 'ST6000VN001-2BB186',
                        ],
                    'net' =>
                        [
                            'eth0' => 'Unknown!',
                            'eth1' => '1000Mb/s',
                            'eth2' => 'Unknown!',
                        ],
                    'u_disk' =>
                        [
                            0 =>
                                [
                                    'devicename' => 'USB Disk 1',
                                    'size' => '7.45 GB',
                                ],
                            1 =>
                                [
                                    'devicename' => 'USB Disk 2',
                                    'size' => '7.45 GB',
                                ],
                        ],
                ],
        ],
];
$z_data = $data['postData']['init'];
$z_data['shell_res'] = $data['postData']['shell_res'];
dd($z_data);
