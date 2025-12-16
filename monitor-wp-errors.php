#!/usr/bin/env php
<?php
/**
 * WordPress Error Monitor
 * 
 * Monitors debug.log for critical errors and provides summary
 * 
 * Usage: php monitor-wp-errors.php
 */

$debug_log_path = __DIR__ . '/src/wp-content/debug.log';

if (!file_exists($debug_log_path)) {
    echo "✗ Debug log not found: $debug_log_path\n";
    exit(1);
}

echo "=== WordPress Error Monitor ===\n";
echo "Analyzing: $debug_log_path\n\n";

$content = file_get_contents($debug_log_path);
$lines = explode("\n", $content);

// Statistics
$stats = [
    'total_lines' => count($lines),
    'warnings' => 0,
    'deprecated' => 0,
    'errors' => 0,
    'notices' => 0,
    'fatal' => 0,
];

// Error sources
$sources = [];
$error_types = [];

foreach ($lines as $line) {
    if (empty(trim($line))) continue;
    
    // Count error types
    if (stripos($line, 'PHP Warning') !== false) {
        $stats['warnings']++;
        
        // Check if it's our plugin
        if (stripos($line, 'oxygen-image-alt-fix.php') !== false) {
            echo "🔴 CRITICAL: Error in oxygen-image-alt-fix.php\n";
            echo "   $line\n\n";
        }
    }
    
    if (stripos($line, 'PHP Deprecated') !== false) {
        $stats['deprecated']++;
    }
    
    if (stripos($line, 'PHP Error') !== false || stripos($line, 'PHP Fatal') !== false) {
        $stats['errors']++;
        $stats['fatal']++;
        echo "🔴 FATAL ERROR DETECTED:\n";
        echo "   $line\n\n";
    }
    
    if (stripos($line, 'PHP Notice') !== false) {
        $stats['notices']++;
    }
    
    // Extract source files
    if (preg_match('/in (.*?) on line (\d+)/', $line, $matches)) {
        $file = basename(dirname($matches[1])) . '/' . basename($matches[1]);
        if (!isset($sources[$file])) {
            $sources[$file] = 0;
        }
        $sources[$file]++;
    }
}

// Display statistics
echo "=== ERROR STATISTICS ===\n";
echo "Total log lines: {$stats['total_lines']}\n";
echo "PHP Warnings: {$stats['warnings']}\n";
echo "PHP Deprecated: {$stats['deprecated']}\n";
echo "PHP Errors/Fatal: {$stats['fatal']}\n";
echo "PHP Notices: {$stats['notices']}\n\n";

// Display top error sources
if (!empty($sources)) {
    echo "=== TOP ERROR SOURCES ===\n";
    arsort($sources);
    $count = 0;
    foreach ($sources as $file => $occurrences) {
        echo sprintf("%-50s %d occurrences\n", $file, $occurrences);
        if (++$count >= 10) break;
    }
    echo "\n";
}

// Check for our plugin errors
$our_plugin_errors = 0;
foreach ($lines as $line) {
    if (stripos($line, 'oxygen-image-alt-fix.php') !== false) {
        $our_plugin_errors++;
    }
}

echo "=== PLUGIN STATUS ===\n";
if ($our_plugin_errors === 0) {
    echo "✅ oxygen-image-alt-fix.php: NO ERRORS\n";
    echo "✅ Plugin is functioning correctly\n";
} else {
    echo "❌ oxygen-image-alt-fix.php: $our_plugin_errors ERRORS FOUND\n";
    echo "⚠️  Plugin requires attention\n";
}

echo "\n";

// Overall status
if ($stats['fatal'] > 0) {
    echo "🔴 CRITICAL: Fatal errors detected. Immediate action required.\n";
    exit(2);
} elseif ($our_plugin_errors > 0) {
    echo "⚠️  WARNING: Plugin errors detected. Review and fix required.\n";
    exit(1);
} elseif ($stats['warnings'] > 0 || $stats['deprecated'] > 0) {
    echo "⚠️  INFO: Warnings/Deprecated notices present (likely from external code).\n";
    echo "    These are not critical but should be monitored.\n";
    exit(0);
} else {
    echo "✅ SUCCESS: No errors detected in debug log.\n";
    exit(0);
}
