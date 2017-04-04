<h1>Hello</h1>
<h3>Reset password link:</h3>
<a target="_blank" href="{{ config('app.url_spa') . '/reset-password?hash=' . $hash . '&email=' . $email }}"
   style="display: inline-block;
 padding: 14px 32px;
 background: #0f6ab4;
 border-radius: 4px;
 font-weight: normal;
 letter-spacing: 1px;
 font-size: 20px;
 line-height: 26px;
 color: white;
 text-shadow: 0 1px 1px black;
 text-shadow: 0 1px 1px rgba(0,0,0,0.25);
 text-decoration: none">
    Reset password
</a>
