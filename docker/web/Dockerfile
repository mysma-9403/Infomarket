FROM debian:stretch

MAINTAINER BrainyWebCoders

RUN apt-get update && apt-get dist-upgrade --allow-unauthenticated -y && export LANG=C.UTF-8

# Install required dependencies
RUN apt update && apt upgrade -y && apt install -y \
    git \
    unzip \
    zip \
    vim \
    mc \
    mcedit \
    wget \
    curl \
    sudo \
    gnupg \
    apache2 \
    ca-certificates \
    apt-transport-https

RUN echo "deb https://packages.sury.org/php/ stretch main" >> /etc/apt/sources.list
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -

RUN apt-get update && apt-get dist-upgrade --allow-unauthenticated -y
RUN apt-get install gcc make autoconf libc-dev pkg-config --allow-unauthenticated -y

RUN wget -q https://packages.sury.org/php/apt.gpg -O- | sudo apt-key add -
RUN echo "deb https://packages.sury.org/php/ stretch main" | sudo tee /etc/apt/sources.list.d/php.list

# Install PHP
RUN apt update && apt install -y \
        php7.3 \
        php7.3-mysql \
        php7.3-xml \
        php7.3-gd \
        php7.3-curl \
        php7.3-zip \
        php7.3-mbstring \
        php7.3-bcmath \
        php7.3-pdo \
        php7.3-soap \
        php7.3-intl \
        php7.3-http \
        php7.3-imap \
        poppler-utils \
        mysql-client \
        mcrypt \
        php-redis \
        redis-server \
        nodejs \
    && rm -r /var/lib/apt/lists/* \
    && apt-get clean

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN update-alternatives --set php /usr/bin/php7.3

WORKDIR /usr/local/bin
RUN apt-get update && apt-get install -y \
 libfontenc1 \
 libxfont1 \
 x11-common \
 xfonts-encodings \
 xfonts-utils \
 xfonts-base \
 xfonts-75dpi \
 fontconfig
RUN wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.stretch_amd64.deb
RUN sudo dpkg -i wkhtmltox_0.12.6-1.stretch_amd64.deb
RUN rm wkhtmltox_0.12.6-1.stretch_amd64.deb

WORKDIR /var/www/infomarket

# Instalacja chrome na kontenerze do potrzeb Headless Chrome - Wersję puppeteera powinniśmy aktualizować ręcznie
RUN apt-get update && apt-get install -y \
gconf-service \
libasound2 \
libatk1.0-0 \
libc6 \
libcairo2 \
libcups2 \
libdbus-1-3 \
libexpat1 \
libfontconfig1 \
libgbm1 \
libgcc1 \
libgconf-2-4 \
libgdk-pixbuf2.0-0 \
libglib2.0-0 \
libgtk-3-0 \
libnspr4 \
libpango-1.0-0 \
libpangocairo-1.0-0 \
libstdc++6 \
libx11-6 \
libx11-xcb1 \
libxcb1 \
libxcomposite1 \
libxcursor1 \
libxdamage1 \
libxext6 \
libxfixes3 \
libxi6 \
libxrandr2 \
libxrender1 \
libxss1 \
libxtst6 \
ca-certificates \
fonts-liberation \
libappindicator1 \
libnss3 \
lsb-release \
xdg-utils \
wget \
libgbm-dev
RUN npm install --global --unsafe-perm puppeteer@5.2.1
RUN chmod -R o+rx /usr/lib/node_modules/puppeteer/.local-chromium

COPY start.sh /usr/local/bin/start

RUN chown -R www-data:www-data /var/www/
RUN chmod u+x /usr/local/bin/start

ADD sites-enabled /etc/apache2/sites-enabled/

RUN /etc/init.d/apache2 stop
RUN a2enmod ssl
RUN a2enmod rewrite
RUN a2enmod headers

ADD php.ini /etc/php/7.3/apache2/php.ini
ADD php.ini /etc/php/7.3/cli/php.ini

RUN mkdir -m 700 -p /root/.ssh/
RUN mkdir -m 700 -p /var/www/.ssh/

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN chown -R www-data:www-data /var/www/
RUN chmod u+x /usr/local/bin/start

CMD ["/usr/local/bin/start"]
