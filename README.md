# Nook Theme
NookTheme is a free and open source [Pterodactyl theme](https://pterodactyl.io) designed to be simple, clean, and modern.

![Image](https://i.imgur.com/AFjHGBr.png)

<details>
<summary>View Screenshots</summary>

![Image](https://i.imgur.com/CNxF3iT.png)
![Image](https://i.imgur.com/IflRtEX.png)
![Image](https://i.imgur.com/vNLK5jP.png)
![Image](https://i.imgur.com/dnxV2CS.png)
</details>

## Installation

This will update your panel to the latest version of NookTheme panel is based. <br>
You can see the version in the current branch name.

<details>
<summary>Upgrade PHP</summary>

Before proceeding with the installation steps, ensure that your PHP version is upgraded to 8.2 or newer. Follow the instructions below to upgrade PHP:

1. Update your package list:
```bash
sudo apt update
```

2. Install the required dependencies:
```bash
sudo apt install -y software-properties-common
```

3. Add the PHP repository:
```bash
sudo add-apt-repository ppa:ondrej/php
```

4. Update your package list again:
```bash
sudo apt update
```

5. Install PHP 8.3:
```bash
sudo apt install -y php8.3
```

6. Verify the PHP version:
```bash
php -v
```

</details>

### Enter Maintenance Mode

Whenever you are performing an update you should be sure to place your Panel into maintenance mode. This will prevent
users from encountering unexpected errors and ensure everything can be updated before users encounter
potentially new features.

```bash
cd /var/www/pterodactyl

php artisan down
```

### Download the theme

The first step in the update process is to download the new panel files from GitHub. The command below will download
the release archive for the most recent version of Pterodactyl, save it in the current directory and will automatically
unpack the archive into your current folder.

```bash
curl -L https://github.com/Nookure/NookTheme/releases/latest/download/panel.tar.gz | tar -xzv
```

Once all of the files are downloaded we need to set the correct permissions on the cache and storage directories to avoid
any webserver related errors.

```bash
chmod -R 755 storage/* bootstrap/cache
```

### Update Dependencies

After you've downloaded all of the new files you will need to upgrade the core components of the panel. To do this,
simply run the commands below and follow any prompts.

```bash
composer install --no-dev --optimize-autoloader
```

### Clear Compiled Template Cache

You'll also want to clear the compiled template cache to ensure that new and modified templates show up correctly for
users.

```bash
php artisan view:clear
php artisan config:clear
```

### Database Updates

You'll also need to update your database schema for the newest version of Pterodactyl. Running the command below
will update the schema and ensure the default eggs we ship are up to date (and add any new ones we might have). Just
remember, _never edit core eggs we ship_! They will be overwritten by this update process.

```bash
php artisan migrate --seed --force
```

### Set Permissions

The last step is to set the proper owner of the files to be the user that runs your webserver. In most cases this
is `www-data` but can vary from system to system &mdash; sometimes being `nginx`, `caddy`, `apache`, or even `nobody`.

```bash
# If using NGINX or Apache (not on CentOS):
chown -R www-data:www-data /var/www/pterodactyl/*

# If using NGINX on CentOS:
chown -R nginx:nginx /var/www/pterodactyl/*

# If using Apache on CentOS
chown -R apache:apache /var/www/pterodactyl/*
```

### Restarting Queue Workers

After _every_ update you should restart the queue worker to ensure that the new code is loaded in and used.

```bash
php artisan queue:restart
```

### Exit Maintenance Mode

Now that everything has been updated you need to exit maintenance mode so that the Panel can resume accepting
connections.

```bash
php artisan up
```

## Documentation

* [Panel Documentation](https://pterodactyl.io/panel/1.0/getting_started.html)
* [Wings Documentation](https://pterodactyl.io/wings/1.0/installing.html)
* [Community Guides](https://pterodactyl.io/community/about.html)
* Or, get additional help [via Discord](https://discord.nookure.com/)

## Star History

## Star History

<a href="https://star-history.com/#SilverDevTeam/ThemePanel&Date">
 <picture>
   <source media="(prefers-color-scheme: dark)" srcset="https://api.star-history.com/svg?repos=SilverDevTeam/ThemePanel&type=Date&theme=dark" />
   <source media="(prefers-color-scheme: light)" srcset="https://api.star-history.com/svg?repos=SilverDevTeam/ThemePanel&type=Date" />
   <img alt="Star History Chart" src="https://api.star-history.com/svg?repos=SilverDevTeam/ThemePanel&type=Date" />
 </picture>
</a>


## License

Pterodactyl® Copyright © 2015 - 2023 Dane Everitt and contributors.

> Nookure is not affiliated with Pterodactyl® Panel or its contributors.

Pterodactyl code released under the [MIT License](./LICENSE.md).

NookTheme code  edits released under the [GNU GPLv3 License](./NookLicense.md).
