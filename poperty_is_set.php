<?php
# https://phpsandbox.io/n/performancetest-isset-vs-vs-ignoringerror-a6gaa

error_reporting (0);
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

$p->start();
for($i=1000000;$i;$i--) {
    if($x->y['']!=='');
}
$p->stop('No Check');
    
$p->start();
for($i=1000000;$i;$i--) {
    if(isset($x->y['']) and $x->y['']!=='');
}
$p->stop('isset()');

$p->start();
for($i=1000000;$i;$i--) {
    if($x->y['']??''!=='');
}
$p->stop('??');
$p->report();
