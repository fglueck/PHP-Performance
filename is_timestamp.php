# https://phpsandbox.io/n/performance-strrpos-vs-strpos-substr-compare-vs-posvs-preg-match-op6yr
#error_reporting (0);

$string = '2021-02-11 14:28:34';
#$string = 'very long other text and not a timestamp';
#$string = '2';
$len = strlen($string);

/**
Author Frank Glück
https://github.com/fglueck/PHP-Performance
*/
class perf {
    private array $times = [];
    private float $start = 0.0;
    
    private int   $loops = 1000;
    
    public function __construct(int $loops=1000) {
        $this->loops = $loops;
    }

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
    public function test(string $label, callable $call) {
        $this->start();
        for($i=0;$i<$this->loops;$i++) {
            $call();
        }
        $this->stop($label);
    }
}
$p = new perf(1000000);

$p->test('strrpos()', function () use ($string) {
    if(strrpos($string, ':'));
});

$p->test('strrpos(+pos)', function () use ($string) {
    if(strrpos($string, ':', -4));
});

$p->test('strpos()', function () use ($string) {
    if(strpos($string, ':'));
});

$p->test('strpos(+pos)', function () use ($string) {
    if(strpos($string, ':', 12));
});

$p->test('substr_compare()', function () use ($string) {
    if(substr_compare($string, ':', -3,1)===1);
});

$len = strlen($string);
$p->test("[x]===':'", function () use ($string, $len) {
    if($len-3>0 and $string[$len-3]===':');
});

$p->test('preg_match', function () use ($string) {
    preg_match('/\d{4}-\d{2}-\d{2}( \d\d:\d\d\:?\d?\d?)?/', $string);
});

$p->report();
