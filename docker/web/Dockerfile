FROM centos:latest

# Install & Add repo
RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
RUN rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

# Install PHP5.6 & Apache
RUN yum --enablerepo=remi-php56 install php php-devel php-gd php-xml php-mbstring php-opcache php-mcrypt php-mysqlnd -y

# Clear yum cache
RUN yum clean all

# for web
EXPOSE 80

CMD /usr/sbin/httpd -DFOREGROUND
