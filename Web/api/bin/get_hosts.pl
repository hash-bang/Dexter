#!/usr/bin/perl
use feature 'say';
$history = 100; # How many lines backwards to scan when the monitor starts. Set to '0' for start of program onwards. A higher number indicates looking back further in the syslog history
$network = '192.168.1'; # Local network to scan
$avoid = qr/$network\.(1|250)$/; # Avoid these victims (typically the reserved IP suffixes of the server and router)

open(SYSLOG, '-|', "tail -n $history /var/log/daemon.log");
while (<SYSLOG>) {
	chomp;
	if (/DHCPOFFER on ($network\.[0-9]+) to ([a-f0-9:]+) (\(.*\) )?via/) {
		next if $1 =~ $avoid;
		say "$1,$2,$3";
	}
}
