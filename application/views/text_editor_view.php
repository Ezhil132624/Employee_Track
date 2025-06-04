<!DOCTYPE html>
<html>

<head>
    <title>Text File Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding: 40px;
        }

        h2 {
            color: #333;
        }

        textarea {
            width: 80%;
            max-width: 600px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h2>Enter Your Text</h2>

    <form id="textForm">
        <textarea id="textContent" rows="10" cols="50" placeholder="Type your content here..."></textarea><br><br>
        <button type="button" onclick="downloadText()">Download as Text File</button>
    </form>

    <script>
        function downloadText() {
            const text = document.getElementById('textContent').value;

            const blob = new Blob([text], {
                type: 'text/plain'
            });

            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'my_text_file.txt';
            link.click();
        }
    </script>

</body>

</html>