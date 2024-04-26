<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach ($acc as $accountType => $items)
        <ul>
            <li>{{ $accountType }}</li>
            @foreach ($items as $item => $accountName)
                <ul>
                    <li>{{ $item }}</li>
                    @foreach ($accountName as $name)
                        <div>- {{ $name }}</div>
                    @endforeach
                </ul>
            @endforeach
        </ul>
    @endforeach
</body>

</html>
