<?
$prices = [
    [
        'price' => 21999,
        'shop_name' => 'Shop 1',
        'shop_link' => 'http://',
    ],
    [
        'price' => 21550,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://',
    ],
    [
        'price' => 21950,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://',
    ],
    [
        'price' => 21350,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://',
    ],
    [
        'price' => 21050,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://',
    ],
];
function ShellSort($elements)
{
    $k = 0;
    $length = count($elements);
    $gap[0] = (int) ($length / 2);
    $m;
    while ($gap[$k] > 1) {
        $k++;
        $gap[$k] = (int) ($gap[$k - 1] / 2);
    }
    for ($i = 0; $i <= $k; $i++) {
        $step = $gap[$i]; 
        for ($j = $step; $j < $length; $j++) {
            $temp = $elements[$j];
            $p = $j - $step;
            while ($p >= 0 && $temp['price'] < $elements[$p]['price']) {
                $elements[$p + $step] = $elements[$p];
                $p = $p - $step;
                $m++;
            }
            $elements[$p + $step] = $temp;
        }
    }
    return [$elements, $m, $p];
}
echo '<pre>',
    print_r(ShellSort($prices)[0]),
    '<br>',
    print_r(ShellSort($prices)[1]),
    '<br>',
    print_r(ShellSort($prices)[2]),
    '</pre>';