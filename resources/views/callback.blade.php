<html>
<head>
  <meta charset="utf-8">
  <title>{{ config('app.name') }}</title>
  <script>
    window.opener.postMessage({ token: "{{ $token }}", name: "{{ $name }}", id: "{{ $id }}", email: "{{ $email }}" }, "*")
    window.close()
  </script>
</head>
<body>
</body>
</html>