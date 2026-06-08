<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Pick a file</legend>
            <input type="file" class="file-input" name="profile" />
            <label class="label">Max size 2MB</label>
        </fieldset>
        <br><br>
        <button type="submit">Upload Profile</button>

    </form>
</body>
</html>