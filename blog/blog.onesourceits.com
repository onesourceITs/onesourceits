<VirtualHost *:80>

    ServerAdmin info@onesourceits.com
    ServerName blog.onesourceits.com
    ServerAlias blog.onesourceits.com

    DocumentRoot /var/www/html/websites/onesourceits/blog

</VirtualHost>


