<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <app-template></app-template>
            <vue-cookie-accept-decline
                :ref="'myPanel1'"
                :elementId="'myPanel1'"
                :debug="false"
                :position="'bottom-left'"
                :type="'floating'"
                :disableDecline="false"
                :transitionName="'slideFromBottom'"
                :showPostponeButton="false"
                @status="cookieStatus"
                @clicked-accept="cookieClickedAccept"
                @clicked-decline="cookieClickedDecline"
            >
                <div slot="postponeContent">
                    &times;
                </div>

                <div slot="message">
                    We use cookies to ensure you get the best experience on our website. <a href="https://cookiesandyou.com/" target="_blank">Learn More...</a>
                </div>
                <div slot="acceptContent">
                    Accept
                </div>
                <div slot="declineContent">
                    Decline
                </div>
            </vue-cookie-accept-decline>
        </div>
    </body>
</html>
