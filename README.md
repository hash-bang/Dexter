Dexter is an automated computer scanning and hacking tool.

It functions using an OpenWRT Wireless Access Point to provide an internet connection. Dexter will automatically attempt to attack any user that connects to it.
It does this by monitoring the DHCP and Squid logs to detect newcommers to the network. After detection a series of attacks are triggered the status of which is shown on screen.
Any subsequent web traffic is also shown.


Installation
============

System Setup
------------

Run the following as root to set up the system:

	apt-get install nmap dhcp3 squid
	apt-get install libxml-sax-perl libxml-sax-expat-perl
	cpan Nmap::Scanner
	cpan Data::Dump
	chmod +xr /var/log/squid/
	chmod ugo+r /var/log/squid/access.log /var/log/daemon.log

And install the demonstration config files for DHCP3 and Squid:

	cp Install/dhcpd.conf /etc/dhcp3/dhcpd.conf
	cp Install/squid.conf /etc/squid/squid.conf


Promiscuous wireless setup
--------------------------

* Plug server into Lynksys OpenWRT and load the bind.tbz ruleset
* Ensure that the server ip is 192.168.1.250


Demonstration
=============

Whenever you wish to run the demonstration simply run

	./setup_networking

...first to correctly configure the local network then...

	./dexter

...to begin the monitoring process.
