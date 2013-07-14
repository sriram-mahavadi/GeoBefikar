<?php
$sApplicationId = '251427108306717';
$sApplicationSecret = 'fb344913874dca0357589c99041cc10a';
$iLimit = 99;
?><center>
<img src="./facebook.png" class="facebook" alt="facebook" />
          </center>
        <center>
            Authorization step:
            <div id="user-info"></div>
            <button id="fb-auth">Please login here</button>
        </center>

        <div id="result_friends"></div>
        <div id="fb-root"></div>

        <script>
        function sortMethod(a, b) {
            var x = a.name.toLowerCase();
            var y = b.name.toLowerCase();
            return ((x < y) ? -1 : ((x > y) ? 1 : 0));
        }
        window.fbAsyncInit = function() {
            FB.init({ appId: '<?= $sApplicationId ?>',
                status: true,
                cookie: true,
                xfbml: true,
                oauth: true
            });

            function updateButton(response) {
                var button = document.getElementById('fb-auth');

                if (response.authResponse) { // in case if we are logged in
                    var userInfo = document.getElementById('user-info');
                    FB.api('/me', function(response) {
                        userInfo.innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
                        button.innerHTML = 'Logout';
                    });

                    // get friends
                    FB.api('/me/friends?limit=<?= $iLimit ?>', function(response) {


                        var result_holder = document.getElementById('result_friends');
                        var friend_data = response.data.sort(sortMethod);
                        var location = response.location.name;

                        var results = '';
                        for (var i = 0; i < friend_data.length; i++) {

                            results += '<div><img src="https://graph.facebook.com/' + friend_data[i].id + '/picture">' + friend_data[i].name +'</div>';
                        }

                        // and display them at our holder element
                        result_holder.innerHTML = '<h2>Result list of your friends:</h2>' + results;
                    });

                    button.onclick = function() {
                        FB.logout(function(response) {
                            window.location.reload();
                        });
                    };
                } else { // otherwise - dispay login button
                    button.onclick = function() {
                        FB.login(function(response) {
                            if (response.authResponse) {
                                window.location.reload();
                            }
                        }, {scope:'email,friends_location,user_location'});
                    }
                }
            }

            // run once with current status and whenever the status changes
            FB.getLoginStatus(updateButton);
            FB.Event.subscribe('auth.statusChange', updateButton);
        };

        (function() {
            var e = document.createElement('script'); e.async = true;
            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
            document.getElementById('fb-root').appendChild(e);
        }());
        </script>