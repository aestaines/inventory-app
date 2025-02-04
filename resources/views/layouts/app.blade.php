<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + Vue</title>
    @vite(['resources/js/app.js', 'resources/css/app.css']) <!-- This is necessary to load Vite's assets -->
</head>
<body>
    <div id="app"></div> <!-- Vue will mount here -->
    
    <!-- Make sure the script for Vite's JS is included -->
    @vite
</body>
</html>
