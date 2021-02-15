# PHP-Performance
PHP Performance Measuring

This Project is for some PHP Peformance measuring tests in different scopes.
If you have some intresting Perfomance measurings, please extend this project :-)

https://phpsandbox.io/n/performance-strrpos-vs-strpos-substr-compare-vs-posvs-preg-match-op6yr

PHP 8.0:
```
100.0% 0.36413s strrpos()
110.9% 0.40368s strrpos(+pos)
116.3% 0.42361s [x]===':'
121.9% 0.44401s strpos()
144.6% 0.52642s substr_compare()
155.4% 0.56575s strpos(+pos)
256.2% 0.93287s preg_match
```
https://phpsandbox.io/n/performancetest-isset-vs-vs-ignoringerror-a6gaa

PHP 8.0:
```
100.0% 0.02643s isset()
112.4% 0.02969s ??
944.9% 0.24970s No Check
```
