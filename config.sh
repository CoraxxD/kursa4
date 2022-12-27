#/bin/bash
cp postgresql.conf /etc/postgresql/12/main/
cp pg_hba.conf /etc/postgresql/12/main/
cp -r html /var/www/
cp apache2.conf /etc/apache2/
systemctl restart apache2
systemctl restart postgresql
