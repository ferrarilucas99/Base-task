<?php

if ($_SERVER["REQUEST_URI"] === "/new-package") {
    include_once "request.php";
} else {
    echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>New Shipping</title>
</head>
<body>
    <h1 style=\"text-align: center;\">New Shipping</h1>
    <form action=\"/new-package\" method=\"post\" id=\"new-package-form\">
        <div style=\"max-width: 768px; margin: 0 auto;\">
            <h2>Recipient data</h2>
    
            <div style=\"display: flex;\">
                <div style=\"width: 50%;\">
                    <label for=\"\">Name</label>
                    <input type=\"text\" name=\"\" id=\"\">
                </div>
                <div style=\"width: 50%;\">
                    <label for=\"\">Address</label>
                    <input type=\"text\" name=\"\" id=\"\">
                </div>
                <div style=\"width: 50%;\">
                    <label for=\"\">City</label>
                    <input type=\"text\" name=\"\" id=\"\">
                </div>
                <div style=\"width: 50%;\">
                    <label for=\"\">Zip Code</label>
                    <input type=\"text\" name=\"\" id=\"\">
                </div>
            </div>
        </div>
    
        <div style=\"max-width: 768px; margin: 0 auto;\">
            <h2>Sender data</h2>
    
            <div style=\"display: flex;\">
                <div style=\"width: 50%;\">
                    <label for=\"\">Name</label>
                    <input type=\"text\" name=\"\" id=\"\">
                </div>
                <div style=\"width: 50%;\">
                    <label for=\"\">Address</label>
                    <input type=\"text\" name=\"\" id=\"\">
                </div>
                <div style=\"width: 50%;\">
                    <label for=\"\">City</label>
                    <input type=\"text\" name=\"\" id=\"\">
                </div>
                <div style=\"width: 50%;\">
                    <label for=\"\">Zip Code</label>
                    <input type=\"text\" name=\"\" id=\"\">
                </div>
            </div>
        </div>

        <button type=\"submit\">Save</button>
    </form>
    

    <script>
        // Validation
        document.getElementById('new-package-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch(\"/new-package\", {
                method: \"POST\",
                // headers: {
                //     'Content-Type': 'application/json' // Define o tipo de conteúdo como JSON
                // },
                body: formData
            }).then(response => response.json())
            .then(data => console.log(data));
            
        });
    </script>
</body>
</html>";
}

?>

