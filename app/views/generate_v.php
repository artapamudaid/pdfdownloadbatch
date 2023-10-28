<!DOCTYPE html>
<html>

<head>
    <title>Generate and Download ZIP</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <button id="generateButton">Generate and Download ZIP</button>
    <div id="result"></div>
    <script>
        $(document).ready(function() {
            $("#generateButton").click(function() {
                $("#generateButton").prop("disabled", true);
                $("#result").text("Sedang menghasilkan dan mengunduh ZIP...");
                generateAndDownloadZIP();
            });

            function generateAndDownloadZIP() {
                $.ajax({
                    url: "../services/generate_pdf_zip.php",
                    method: "POST",
                    success: function(data) {
                        $("#result").html(data);
                        $("#generateButton").prop("disabled", false);
                    }
                });
            }
        });
    </script>
</body>

</html>