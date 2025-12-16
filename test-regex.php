<?php
/**
 * Test Script for Regex Pattern
 * Tests the fixed regex pattern from oxygen-image-alt-fix.php
 */

echo "=== Testing Regex Pattern ===\n\n";

// Test cases
$test_cases = array(
    'image-300x200.jpg' => 'image.jpg',
    'photo-150x150.png' => 'photo.png',
    'banner-1920x1080.webp' => 'banner.webp',
    'logo-64x64.gif' => 'logo.gif',
    'simple.jpg' => 'simple.jpg',
    'no-dimensions.png' => 'no-dimensions.png',
    'image-300x200-scaled.jpg' => 'image-scaled.jpg',
);

$pattern = '/-\d+x\d+(?=\.[a-z]{3,4}$)/i';

echo "Pattern: $pattern\n\n";

foreach ($test_cases as $input => $expected) {
    $result = preg_replace($pattern, '', $input);
    $status = ($result === $expected) ? '✓ PASS' : '✗ FAIL';
    
    echo "$status | Input: $input\n";
    echo "       Expected: $expected\n";
    echo "       Got:      $result\n\n";
}

// Check for regex errors
if (preg_last_error() !== PREG_NO_ERROR) {
    echo "ERROR: Regex compilation failed!\n";
    echo "Error code: " . preg_last_error() . "\n";
} else {
    echo "✓ All regex operations completed without errors.\n";
}
