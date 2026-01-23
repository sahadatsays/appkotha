<?php

/**
 * Wrapper script for pre-package-uninstall that handles errors gracefully
 */

try {
    if (class_exists('Illuminate\Foundation\ComposerScripts')) {
        Illuminate\Foundation\ComposerScripts::prePackageUninstall();
    }
} catch (Exception $e) {
    // Silently fail to allow composer update to continue
    // The error is likely due to packages being removed that the script depends on
    exit(0);
}
