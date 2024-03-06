<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <h1>CSV File Import</h1>
        <form action="importfichier.php" method="post" enctype="multipart/form-data">
            <label for="file">Choose a CSV file:</label>
            <input type="file" name="file" id="file" accept=".csv">
            <button type="submit">Import</button>
        </form>
    </div>
</body>
</html>
