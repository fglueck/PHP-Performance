# PHP-Performance

PHP Performance Measuring

This project contains several PHP performance measuring tests in different scopes.
100.0% represents the best performance.

## Prerequisites

- PHP >= 7.0
- `bcmath` extension (used for precision in performance reporting)

## Available Benchmarks

### 1. Timestamp Detection (`is_timestamp.php`)
Compares different ways to find a colon in a string (simulating part of a timestamp validation).
- `strrpos()`
- `strpos()`
- `substr_compare()`
- Direct index access `[x]===':'`
- `preg_match`

### 2. Property/Array Access Checks (`property_is_set.php`)
Compares different ways to check if an array key is set.
- `isset()`
- Null coalescing operator `??`
- No check (ignoring errors)

### 3. String Replacement (`str_replace_vs_strtr.php`)
Compares performance and behavior differences between `str_replace()` and `strtr()`.

## How to Run

You can run any benchmark directly using the PHP CLI:

```bash
php is_timestamp.php
php property_is_set.php
php str_replace_vs_strtr.php
```

## Contributing

If you have interesting performance measurements, please feel free to extend this project!
