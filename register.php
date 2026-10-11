<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Genshin Impact Registration Page">
  <title>Genshin Impact - Create Account</title>
  <link rel="stylesheet" href="css/auth.css">
  <link href="https://fonts.googleapis.com/css2?family=Valley+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="teyvat-theme" style="background-image: url('https://upload-os-bbs.hoyolab.com/upload/2021/05/22/21867498/19fb8c0ff0e27428841a05ddbfc0851d_3933469727756591456.jpg'); background-size: cover; background-position: center">
  <main class="page-wrapper">
    <div class="auth-card">
      <header class="card-header">
        <h1 class="brand-title">Genshin Impact</h1>
      </header>

      <div id="register-message" class="form-message" role="alert" aria-live="polite"></div>

      <form action="#" method="POST" class="auth-form" autocomplete="on" novalidate>
        <div class="form-group">
          <label for="email" class="sr-only">Email</label>
          <div class="input-wrapper">
            <input
              type="email"
              id="email"
              name="email"
              class="form-control"
              placeholder="Email"
              required
              autocomplete="email"
            >
            <span class="input-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24">
                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/>
              </svg>
            </span>
          </div>
          <span id="email-error" class="field-error"></span>
        </div>

        <div class="form-group">
          <label for="username" class="sr-only">Username</label>
          <div class="input-wrapper">
            <input
              type="text"
              id="username"
              name="username"
              class="form-control"
              placeholder="Username"
              required
              autocomplete="username"
              minlength="4"
            >
            <span class="input-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24">
                <path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.33 0-10 1.67-10 5v3h20v-3c0-3.33-6.67-5-10-5z"/>
              </svg>
            </span>
          </div>
          <span id="username-error" class="field-error"></span>
        </div>

        <div class="form-group">
          <label for="password" class="sr-only">Password</label>
          <div class="input-wrapper">
            <input
              type="password"
              id="password"
              name="password"
              class="form-control"
              placeholder="Password"
              required
              autocomplete="new-password"
              minlength="8"
            >
            <span class="input-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24">
                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
              </svg>
            </span>
          </div>
          <span id="password-error" class="field-error"></span>
        </div>

        <div class="form-group">
          <label for="confirm-password" class="sr-only">Confirm Password</label>
          <div class="input-wrapper">
            <input
              type="password"
              id="confirm-password"
              name="confirm-password"
              class="form-control"
              placeholder="Confirm Password"
              required
              autocomplete="new-password"
              minlength="8"
            >
            <span class="input-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24">
                <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
              </svg>
            </span>
          </div>
          <span id="confirm-password-error" class="field-error"></span>
        </div>

        <div class="options-row">
          <label class="checkbox-label" for="show-password">
            <input type="checkbox" id="show-password" class="custom-checkbox" aria-controls="password confirm-password">
            <span>Show password</span>
          </label>
        </div>

        <button type="submit" class="btn-submit" id="registerBtn">Create Account</button>

      </form>

      <footer class="card-footer">
        <p>Already a Traveler? <a href="index.php" class="switch-link">Log in</a></p>
      </footer>

    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
  <script>
    $(function () {
      'use strict';

      var EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      // 8+ chars, at least 1 lowercase, 1 uppercase, 1 digit, 1 special character
      var PASSWORD_REGEX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/;

      function showFieldError($field, message) {
        $field.addClass('is-invalid');
        $('#' + $field.attr('id') + '-error').text(message);
      }
      function clearFieldError($field) {
        $field.removeClass('is-invalid');
        $('#' + $field.attr('id') + '-error').text('');
      }
      function showFormMessage($msg, text, type) {
        $msg
          .text(text)
          .removeClass('form-message--error form-message--success')
          .addClass('form-message--' + type);
      }
      function clearFormMessage($msg) {
        $msg.text('').removeClass('form-message--error form-message--success');
      }

      var $registerBtn = $('#registerBtn');
      var $registerForm = $registerBtn.closest('form');
      var $email = $('#email');
      var $username = $('#username');
      var $password = $('#password');
      var $confirmPassword = $('#confirm-password');
      var $showPassword = $('#show-password');
      var $registerMsg = $('#register-message');

      $.each([$email, $username, $password, $confirmPassword], function () {
        var $f = this;
        $f.on('input', function () { clearFieldError($f); });
      });
      $showPassword.on('change', function () {
        var inputType = this.checked ? 'text' : 'password';
        $password.add($confirmPassword).attr('type', inputType);
      });

      $registerForm.on('submit', function (e) {
        e.preventDefault();
        clearFormMessage($registerMsg);

        var emailVal = $email.val().trim();
        var usernameVal = $username.val().trim();
        var passwordVal = $password.val();
        var confirmVal = $confirmPassword.val();
        var valid = true;

        if (emailVal === '') {
          showFieldError($email, 'Email is required.');
          valid = false;
        } else if (!EMAIL_REGEX.test(emailVal)) {
          showFieldError($email, 'Please enter a valid email address.');
          valid = false;
        } else {
          clearFieldError($email);
        }

        if (usernameVal === '') {
          showFieldError($username, 'Username is required.');
          valid = false;
        } else if (usernameVal.length < 4) {
          showFieldError($username, 'Username must be at least 4 characters.');
          valid = false;
        } else {
          clearFieldError($username);
        }

        if (passwordVal === '') {
          showFieldError($password, 'Password is required.');
          valid = false;
        } else if (!PASSWORD_REGEX.test(passwordVal)) {
          showFieldError(
            $password,
            'Password needs 8+ characters, including upper & lower case, a number, and a special character.'
          );
          valid = false;
        } else {
          clearFieldError($password);
        }

        if (confirmVal === '') {
          showFieldError($confirmPassword, 'Please confirm your password.');
          valid = false;
        } else if (confirmVal !== passwordVal) {
          showFieldError($confirmPassword, 'Passwords do not match.');
          valid = false;
        } else {
          clearFieldError($confirmPassword);
        }

        if (!valid) {
          return;
        }

        showFormMessage($registerMsg, 'Account created! Redirecting to login...', 'success');
        window.setTimeout(function () {
          window.location.href = 'index.php';
        }, 900);
      });
    });
  </script>
</body>
</html>