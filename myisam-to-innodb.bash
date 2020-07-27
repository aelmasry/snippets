#!/usr/bin/env bash
# Author Mike https://guides.wp-bullet.com
# Purpose - Convert MyISAM tables to InnoDB with WP-CLI

# create array of MyISAM tables
WPTABLES=($(wp db query "SHOW TABLE STATUS WHERE Engine = 'MyISAM'" --allow-root --silent --skip-column-names | awk '{ print $1}'))

# loop through array and alter tables
for WPTABLE in ${WPTABLES[@]}
do
    echo "Converting ${WPTABLE} to InnoDB"
    wp db query "ALTER TABLE ${WPTABLE} ENGINE=InnoDB" --allow-root
    echo "Converted ${WPTABLE} to InnoDB"
done