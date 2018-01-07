#!/bin/bash

echo 'copying files'

cp ../aggregated_data/monthly_raw_data/pollution_us_2000.csv ../aggregated_data/monthly_data/pollution_us_2000.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2001.csv > ../aggregated_data/monthly_data/pollution_us_2001.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2002.csv > ../aggregated_data/monthly_data/pollution_us_2002.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2003.csv > ../aggregated_data/monthly_data/pollution_us_2003.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2004.csv > ../aggregated_data/monthly_data/pollution_us_2004.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2005.csv > ../aggregated_data/monthly_data/pollution_us_2005.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2006.csv > ../aggregated_data/monthly_data/pollution_us_2006.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2007.csv > ../aggregated_data/monthly_data/pollution_us_2007.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2008.csv > ../aggregated_data/monthly_data/pollution_us_2008.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2009.csv > ../aggregated_data/monthly_data/pollution_us_2009.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2010.csv > ../aggregated_data/monthly_data/pollution_us_2010.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2011.csv > ../aggregated_data/monthly_data/pollution_us_2011.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2012.csv > ../aggregated_data/monthly_data/pollution_us_2012.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2013.csv > ../aggregated_data/monthly_data/pollution_us_2013.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2014.csv > ../aggregated_data/monthly_data/pollution_us_2014.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2015.csv > ../aggregated_data/monthly_data/pollution_us_2015.txt
sed 1d ../aggregated_data/monthly_raw_data/pollution_us_2016.csv > ../aggregated_data/monthly_data/pollution_us_2016.txt


echo 'joining files'

cd ../aggregated_data/monthly_data/
cat pollution_us_2000.txt pollution_us_2001.txt pollution_us_2002.txt pollution_us_2003.txt pollution_us_2004.txt pollution_us_2005.txt pollution_us_2006.txt pollution_us_2007.txt pollution_us_2008.txt pollution_us_2009.txt pollution_us_2010.txt pollution_us_2010.txt pollution_us_2011.txt pollution_us_2012.txt pollution_us_2013.txt pollution_us_2014.txt pollution_us_2015.txt pollution_us_2016.txt > pollution_us_2000_2016.txt
