<?php

namespace App\Utilities;

use App\Models\Order;

class GlobalUtilities
{
    /**
     * Convert an image to base64.
     *
     * @param string $imagePath
     * @return string
     */
    public static function imageToBase64($imagePath): string|null
    {
        if (file_exists($imagePath)) {
            $imageData = file_get_contents($imagePath);
            return base64_encode($imageData);
        }
        return null; // Return null if file doesn't exist
    }

    public static function getImageStoragePath($imagePath): string
    {
        return storage_path('app/public/' . $imagePath);
    }



    /**
     * Generate a unique code for a specific model.
     *
     * @param string $modelClass The model class name.
     * @param string $columnName The column name to check uniqueness.
     * @param string $prefix The prefix for the generated code.
     * @param int $length The desired length of the generated code.
     * @return string The generated unique code.
     */
    public static function generateCode(string $modelClass, string $columnName, string $prefix, int $length = 6): string
    {
        do {
            // Generate a random code with the specified prefix
            $code = $prefix . strtoupper(substr(bin2hex(random_bytes(ceil($length / 2))), 0, $length));
            // Check if the code already exists
            $exists = $modelClass::where($columnName, $code)->exists();
        } while ($exists);
        return $code;
    }


    /**
     * Convert phone number to international format
     * @return string
     */
    public static function internationalPhoneNumber(string $phone): string
    {
        // Check if the phone number starts with '0'
        if (substr($phone, 0, 1) === '0') {
            // Remove the leading '0' and replace it with the country code
            return '254' . substr($phone, 1);
        }
        return $phone;
    }
}
