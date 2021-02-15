<?php
# https://phpsandbox.io/n/performance-strrpos-vs-strpos-substr-compare-vs-posvs-preg-match-op6yr
#error_reporting (0);

$string = '2021-02-11 14:28:34';
#$string = 'very long other text and not a timestamp';
#$string = '2';
$len = strlen($string);
$times = 10000000;

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
$p->start();
for($i=$times;$i;$i--) {
    if(strrpos($string, ':'));
}
$p->stop('strrpos()');

$p->start();
for($i=$times;$i;$i--) {
    if(strrpos($string, ':', -4));
}
$p->stop('strrpos(+pos)');

$p->start();
for($i=$times;$i;$i--) {
    if(strpos($string, ':'));
}
$p->stop('strpos()');

$p->start();
for($i=$times;$i;$i--) {
    if(strpos($string, ':', 12));
}
$p->stop('strpos(+pos)');

$p->start();
for($i=$times;$i;$i--) {
    if(substr_compare($string, ':', -3,1)===1);
}
$p->stop('substr_compare()');

$p->start();
for($i=$times;$i;$i--) {
    if($len-3>0 and $string[$len-3]===':');
}
$p->stop("[x]===':'");

$p->start();
for($i=$times;$i;$i--) {
    preg_match('/\d{4}-\d{2}-\d{2}( \d\d:\d\d\:?\d?\d?)?/', $string);
}
$p->stop("preg_match");

$p->report();
