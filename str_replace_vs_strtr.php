<?php
#error_reporting (0);
class perf {
    private $times = [];
    private $start = null;

    public function start() {
        $this->start = microtime(true);
    }
    public function stop(string $label) {
        $this->times[$label] = microtime(true) - $this->start;
    }
    public function report() {
        asort($this->times, SORT_NUMERIC);
        $bench = current($this->times);
        foreach($this->times as $label => $time) {
            $time = number_format($time, 5);
            echo sprintf("%s%% %ss %s\n", number_format(bcmul(bcdiv($time,$bench,10),100, 10),1), $time, $label);
        }
    }
}

$p = new perf();
$x = new class() { public $y = []; };
$array = ['x'=>'y', 'y'=>'z', 'z'=>'a', 'a'=>'Z'];
$value = 'abcxyzabcxyzabcxyzabcxyzabcxyzabcxyzabcxyzabcxyzabcxyzabcxyz';
$p->start();
for($i=10000;$i;$i--) {
     str_replace(array_keys($array), array_values($array), $value);
}
$p->stop('str_replace()');
echo "str_replace:\n",str_replace(array_keys($array), array_values($array), $value), "\n";
    
$p->start();
for($i=10000;$i;$i--) {
    strtr($value, $array);
}
$p->stop('strtr()');
echo "strtr:\n",strtr($value, $array), "\n";

$p->report();

$p = new perf();
$x = new class() { public $y = []; };
// key-value with different order
$array = ['a'=>'Z','x'=>'y', 'y'=>'z', 'z'=>'a' ];
$value = 'abcxyzabcxyzabcxyzabcxyzabcxyzabcxyzabcxyzabcxyzabcxyzabcxyz';
$p->start();
for($i=10000;$i;$i--) {
     str_replace(array_keys($array), array_values($array), $value);
}
$p->stop('str_replace()');
echo "str_replace:\n",str_replace(array_keys($array), array_values($array), $value), "\n";
    
$p->start();
for($i=10000;$i;$i--) {
    strtr($value, $array);
}
$p->stop('strtr()');
echo "strtr:\n",strtr($value, $array), "\n";

$p->report();
