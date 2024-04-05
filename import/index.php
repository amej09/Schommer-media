<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Produkte importieren</title>
    <link rel="stylesheet" href="../css/import.css">
</head>
<body>
<div class="container">
        <h1>CSV-Dateiimport</h1>
        <form action="importfichier.php" method="post" enctype="multipart/form-data">
            <label for="file">Wählen Sie eine CSV-Datei:</label>
            <input type="file" name="file" id="file" accept=".csv">
            <button type="submit">Importieren</button>
        </form>
    </div>
</body>
</html>
