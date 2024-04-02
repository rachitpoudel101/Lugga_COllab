function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var userInfo = document.getElementById('userInfo');
    userInfo.innerHTML = '<p>ID: ' + profile.getId() + '</p>' +
                          '<p>Name: ' + profile.getName() + '</p>' +
                          '<p>Email: ' + profile.getEmail() + '</p>' +
                          '<img src="' + profile.getImageUrl() + '" alt="Profile Picture">';
  }
  