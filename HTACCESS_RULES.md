# .htaccess rules

## Redirect subdir to root

With RedirectMatch
```
RedirectMatch 302 ^/blog[/]?$ http://192.168.99.100:8000/
```

With mod_rewrite
```
RewriteRule ^blog(/?)(.*) http://%{HTTP_HOST}/$2 [L,R=302]
```
