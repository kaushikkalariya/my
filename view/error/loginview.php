      <form action="index.php?route=loginview" enctype="multipart/form-data" method="post">
            <table>
                <tr>
                    <th>User Name:</th>
                    <th><input type="text" name="username" ></th>
                </tr>
                <tr>
                    <th>Password:</th>
                    <th><input type="password" name="password" ></th>
                </tr>
                <tr>
                    <th><input name="submit" value="submit" type="submit" ></th>
                </tr>
            </table>
    </form>
        <a href="index.php?route=register">Register</a>
  <h1>Login</h1>
    <input type="email" name="username" class="login-input" placeholder="Email Address" autofocus>
    <input type="password" name="password" class="login-input" placeholder="Password">
    <input type="submit" value="Login" name="submit" class="login-submit">
    <p class="login-help"><a href="index.html">Forgot password?</a></p>