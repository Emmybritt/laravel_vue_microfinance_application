<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        Transaction: {{ $transaction }}
    </div>
    <div>
        {{-- Embedding inline images --}}
        <h1>Here is an image</h1>
       <img src="{{ message->embed($pathToimage) }}" alt="">
    </div>
</body>
</html>