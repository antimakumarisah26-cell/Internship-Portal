<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="resume">Upload Resume</label>
        <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx,.jpg,.png" placeholder="upload resume"/>
        <br><br>
        <button type="submit">Create Resume</button>

    </form>
</body>
</html>