# Modern Programming in PHP - Intermediate Level

Files for Udemy course [Modern Programming in PHP - Intermediate Level](https://www.udemy.com/modern-programming-in-php-intermediate-level)

In addition to the source, you'll need to:

1. Install Vagrant & Virtualbox
1. Run vagrant up from the root director of your project
1. Login to the VM with "vagrant ssh"
1. cd /vagrant/installation
1. sudo bash install (and answer the prompts)
1. Create a cache/views directory
1. Create a storage directory
1. Set up the .env file
1. Run vendor/bin/phinx init
1. Update the development section of the phinx.yml file 
1. Run vendor/bin/phinx migrate

Logout of the VM and type vagrant reload, and you should be able to hit http://localhost:8080 and get some kind of
feedback
