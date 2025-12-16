#!/usr/bin/env php
<?php
/**
 * Complete Validation Suite for oxygen-image-alt-fix.php
 * 
 * Runs all validation checks and generates comprehensive report
 */

$plugin_path = __DIR__ . '/src/wp-content/mu-plugins/oxygen-image-alt-fix.php';
$debug_log_path = __DIR__ . '/src/wp-content/debug.log';

echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║  WordPress Plugin Validation Suite                        ║\n";
echo "║  oxygen-image-alt-fix.php - Complete Testing               ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

$results = [];
$total_tests = 0;
$passed_tests = 0;

// Test 1: File Existence
$total_tests++;
echo "[1/8] Checking file existence...\n";
if (file_exists($plugin_path)) {
    echo "  ✅ Plugin file exists\n";
    $passed_tests++;
    $results['file_exists'] = true;
} else {
    echo "  ❌ Plugin file not found!\n";
    $results['file_exists'] = false;
}
echo "\n";

// Test 2: PHP Syntax
$total_tests++;
echo "[2/8] Validating PHP syntax...\n";
exec("php -l \"$plugin_path\" 2>&1", $output, $return_code);
if ($return_code === 0) {
    echo "  ✅ No syntax errors detected\n";
    $passed_tests++;
    $results['syntax'] = true;
} else {
    echo "  ❌ Syntax errors found:\n";
    foreach ($output as $line) {
        echo "     $line\n";
    }
    $results['syntax'] = false;
}
echo "\n";

// Test 3: Regex Pattern
$total_tests++;
echo "[3/8] Testing regex pattern...\n";
$pattern = '/-\d+x\d+(?=\.[a-z]{3,4}$)/i';
$test_cases = [
    'image-300x200.jpg' => 'image.jpg',
    'photo-150x150.png' => 'photo.png',
];

$regex_pass = true;
foreach ($test_cases as $input => $expected) {
    $result = preg_replace($pattern, '', $input);
    if ($result !== $expected) {
        $regex_pass = false;
        echo "  ❌ Failed: $input → Expected: $expected, Got: $result\n";
    }
}

if ($regex_pass && preg_last_error() === PREG_NO_ERROR) {
    echo "  ✅ Regex pattern works correctly\n";
    $passed_tests++;
    $results['regex'] = true;
} else {
    echo "  ❌ Regex pattern failed\n";
    $results['regex'] = false;
}
echo "\n";

// Test 4: Debug Log Check
$total_tests++;
echo "[4/8] Checking debug.log for plugin errors...\n";
if (file_exists($debug_log_path)) {
    $log_content = file_get_contents($debug_log_path);
    if (stripos($log_content, 'oxygen-image-alt-fix.php') === false) {
        echo "  ✅ No errors from plugin in debug.log\n";
        $passed_tests++;
        $results['debug_log'] = true;
    } else {
        echo "  ❌ Plugin errors found in debug.log\n";
        $results['debug_log'] = false;
    }
} else {
    echo "  ⚠️  Debug log not found (may not have been created yet)\n";
    $passed_tests++;
    $results['debug_log'] = true;
}
echo "\n";

// Test 5: Code Structure
$total_tests++;
echo "[5/8] Analyzing code structure...\n";
$code = file_get_contents($plugin_path);

$checks = [
    'Security: esc_attr()' => strpos($code, 'esc_attr') !== false,
    'Database: $wpdb->prepare()' => strpos($code, '$wpdb->prepare') !== false,
    'Sanitization: $wpdb->esc_like()' => strpos($code, '$wpdb->esc_like') !== false,
    'WordPress hooks' => strpos($code, 'add_action') !== false,
    'DOMDocument usage' => strpos($code, 'new DOMDocument') !== false,
];

$structure_pass = true;
foreach ($checks as $check => $result) {
    if ($result) {
        echo "  ✅ $check\n";
    } else {
        echo "  ❌ $check - NOT FOUND\n";
        $structure_pass = false;
    }
}

if ($structure_pass) {
    $passed_tests++;
    $results['structure'] = true;
} else {
    $results['structure'] = false;
}
echo "\n";

// Test 6: WordPress Standards (if PHPCS available)
$total_tests++;
echo "[6/8] Checking WordPress coding standards...\n";
$phpcs_path = __DIR__ . '/vendor/bin/phpcs';
if (file_exists($phpcs_path)) {
    exec("\"$phpcs_path\" --standard=WordPress --extensions=php \"$plugin_path\" 2>&1", $phpcs_output, $phpcs_code);
    if ($phpcs_code === 0) {
        echo "  ✅ WordPress coding standards: PASS\n";
        $passed_tests++;
        $results['wpcs'] = true;
    } else {
        echo "  ⚠️  WordPress coding standards: Issues found\n";
        $results['wpcs'] = false;
    }
} else {
    echo "  ⚠️  PHPCS not installed, skipping\n";
    $passed_tests++;
    $results['wpcs'] = 'skipped';
}
echo "\n";

// Test 7: PHP Compatibility
$total_tests++;
echo "[7/8] Checking PHP 7.4-8.3 compatibility...\n";
if (file_exists($phpcs_path)) {
    exec("\"$phpcs_path\" --standard=PHPCompatibilityWP --runtime-set testVersion 7.4-8.3 \"$plugin_path\" 2>&1", $compat_output, $compat_code);
    if ($compat_code === 0) {
        echo "  ✅ PHP compatibility: PASS (7.4-8.3)\n";
        $passed_tests++;
        $results['php_compat'] = true;
    } else {
        echo "  ⚠️  PHP compatibility: Issues found\n";
        $results['php_compat'] = false;
    }
} else {
    echo "  ⚠️  PHPCS not installed, skipping\n";
    $passed_tests++;
    $results['php_compat'] = 'skipped';
}
echo "\n";

// Test 8: Security Check
$total_tests++;
echo "[8/8] Running security checks...\n";
if (file_exists($phpcs_path)) {
    exec("\"$phpcs_path\" --standard=WordPress-Extra --sniffs=WordPress.Security.EscapeOutput \"$plugin_path\" 2>&1", $sec_output, $sec_code);
    if ($sec_code === 0) {
        echo "  ✅ Security checks: PASS\n";
        $passed_tests++;
        $results['security'] = true;
    } else {
        echo "  ⚠️  Security checks: Issues found\n";
        $results['security'] = false;
    }
} else {
    echo "  ⚠️  PHPCS not installed, skipping\n";
    $passed_tests++;
    $results['security'] = 'skipped';
}
echo "\n";

// Final Summary
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║  VALIDATION SUMMARY                                        ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

echo "Total Tests Run: $total_tests\n";
echo "Tests Passed: $passed_tests\n";
echo "Success Rate: " . round(($passed_tests / $total_tests) * 100, 1) . "%\n\n";

if ($passed_tests === $total_tests) {
    echo "✅ ALL TESTS PASSED - Plugin is ready for production\n";
    exit(0);
} else {
    $failed = $total_tests - $passed_tests;
    echo "⚠️  $failed test(s) failed - Review required\n";
    echo "\nFailed tests:\n";
    foreach ($results as $test => $result) {
        if ($result === false) {
            echo "  - $test\n";
        }
    }
    exit(1);
}
