<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ route('testeremail.assets').'?path='.urlencode('styles.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">-->
        <title>Testing Email Service</title>
    </head>

    <body>
        <div class="main">
            <p class="sign" align="center">Sending Email</p>
            <form class="form1" action="{{ route('testeremail.sending') }}" method="post">
                {{ csrf_field() }}
                <input class="un" name="email" type="text" placeholder="Email" align="center" required/>
                <button class="submit" align="center">@lang('testeremail::general.submit')</button>
            </form>
            @if($message)
                <b align="center">{{ $message }}</b>
            @endif
        </div>
        
    </body>

</html>