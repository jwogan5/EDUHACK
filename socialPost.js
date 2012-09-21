function facebookPost(fbmessage, fblink, fbname, fbdescription) {
    // Load the SDK Asynchronously
    (function (d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    } (document));

    // Init the SDK upon load
    window.fbAsyncInit = function () {
        FB.init({
            appId: '390083347723743', // App ID
            channelUrl: '//' + window.location.hostname + '/channel.html', // Path to your Channel File
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true  // parse XFBML
        });

        // listen for and handle auth.statusChange events
        FB.Event.subscribe('auth.statusChange', function (response) {
            if (response.authResponse) {
                // user has auth'd your app and is logged into Facebook
                FB.api('/me/feed', 'post',
                    {
                        message: fbmessage,
                        link: fblink,
                        name: fbname,
                        picture: 'http://dorick.com/eduhack/Lessons-Learned-logo-small.png',
                        description: fbdescription
                    }, function (response) {
                        if (!response || response.error) {
                            //alert('Oops! User Denied Access');
                        } else {
                            //alert('Success: Content Published');
                        }
                    });                
            } else {
                // user has not auth'd your app, or is not logged into Facebook               
            }
        });

        // respond to clicks on the login and logout links
        document.getElementById('facebookpost').addEventListener('click', function () {
            FB.login();
        });
    }
}

function twitterPost(tweetContent) {
    var twtLink = 'http://twitter.com/home?status=' + encodeURIComponent(tweetContent);
    window.open(twtLink);
}